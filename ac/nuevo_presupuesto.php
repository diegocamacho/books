<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_GET);
//Validamos datos completos
if(!$id_empresa) exit("Seleccione la empresa emisora del presupuesto.");
if(!$id_cliente) exit("Seleccione el cliente receptor del presupuesto.");
//if(!$referencia) exit("");
if(!$fecha) exit("Seleccione una fecha para el presupuesto.");
if(!$fecha_expira) exit("Seleccione una fecha de expiración para el presupuesto.");
//if(!$ajuste_texto) exit("");
//if(!$ajuste_monto) exit("");
//if(!$notas) exit("");
//if(!$terminos) exit("");

	if($fecha) $fecha=fechaBase2($fecha);
	
	if($fecha_expira) $fecha_expira=fechaBase2($fecha_expira);

	//$nombre=limpiaStr($nombre,1,1);

	

	mysql_query('BEGIN');
		
	$sql="INSERT INTO books_presupuestos (id_usuario, id_empresa, id_cliente, fecha_hora_creacion, referencia, fecha, fecha_expira, notas, terminos, ajuste_text, ajuste_monto) 
	VALUES ('$s_id_usuario','$id_empresa','$id_cliente','$fechahora','$referencia','$fecha','$fecha_expira', '$notas','$terminos','$ajuste_texto','$ajuste_monto')";
	$qu=mysql_query($sql) or $error=true;
	$id_presupuesto=mysql_insert_id();
	
	foreach($cantidad as $id => $val):
		
		$producto_=$producto[$id];
		$cant=$val;
		$tarifa_=$tarifa[$id];
		$descuento_=$descuento[$id];
		$impuesto_=$impuesto[$id];
		$importe_=$importe[$id];
		
		$sq=@mysql_query("INSERT INTO books_presupuestos_producto (id_presupuesto,producto,cantidad,tarifa,descuento,impuesto,importe)VALUES('$id_presupuesto','$producto_','$cant','$tarifa_','$descuento_','$impuesto_','$importe_')");
		if(!$sq) $error = true;
		
	endforeach;
	
	//Guardamos los logs
	$sql="INSERT INTO books_logs_presupuestos (id_presupuesto,log,fecha_hora,tipo)VALUES('$id_presupuesto','EL USUARIO $s_nombre HA CREADO EL PRESUPUESTO.','$fechahora','1')";
	$qu=mysql_query($sql) or $error=true;

	
	if($error):
		mysql_query('ROLLBACK');
		$ret['respuesta']='2';
		$ret['id_presupuesto']='0';
	else:
		mysql_query('COMMIT');
		$ret['respuesta']='1';
		$ret['id_presupuesto']=$id_presupuesto;
	endif;
	
	echo json_encode($ret);