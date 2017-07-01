<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_GET);
//if(!$id_presupuesto) exit("No llegó el identificador.");
//Validamos si el usuario tiene permiso para modificar este presupuesto
$sql="SELECT id_empresa FROM books_presupuestos WHERE id_presupuesto=$id_presupuesto";
$q=mysql_query($sql);
$ft=mysql_fetch_assoc($q);
$id_empresa=$ft['id_empresa'];

$sql="SELECT * FROM books_usuarios_empresas WHERE id_usuario=$s_id_usuario AND id_empresa=$id_empresa";
$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if(!$valida):
	$ret['respuesta']='2';
	$ret['id_presupuesto']='0';
	echo json_encode($ret);
	exit();
endif;


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
		
	$sql="UPDATE books_presupuestos SET id_empresa='$id_empresa', id_cliente='$id_cliente', referencia='$referencia', fecha='$fecha', fecha_expira='$fecha_expira', notas='$notas', terminos='$terminos', ajuste_text='$ajuste_texto', ajuste_monto='$ajuste_monto' WHERE id_presupuesto=$id_presupuesto";
	$qu=mysql_query($sql) or $error=true;
	
	$sql="DELETE FROM books_presupuestos_producto WHERE id_presupuesto=$id_presupuesto";
	$qu=mysql_query($sql) or $error=true;
	
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
	$sql="INSERT INTO books_logs_presupuestos (id_presupuesto,log,fecha_hora,tipo)VALUES('$id_presupuesto','EL USUARIO $s_nombre HA EDITADO EL PRESUPUESTO.','$fechahora','1')";
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