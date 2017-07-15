<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_GET);
//echo json_encode($_GET);
//print_r($_GET);
//exit();
//Validamos datos completos
if(!$fecha_expira):
	$error=true;
	$msg="Seleccione una fecha de vencimiento para el presupuesto.";
endif;

if(!$fecha):
	$error=true;
	$msg="Seleccione una fecha para el presupuesto.";
endif;

if(!$id_cliente):
	$error=true;
	$msg="Seleccione un cliente para crear el presupuesto.";
endif;

$fecha 			= fechaBase2($fecha);
$fecha_expira 	= fechaBase2($fecha_expira);


if($error):
	$ret['respuesta']='2';
	$ret['id_presupuesto']='0';
	$ret['mensaje']=$msg;
	echo json_encode($ret);
	exit();
endif;

	#1:presupuesto - 2:Borrador - 3:Presupuesto Cancelado - 4:Remisión - 5:Remisión Cancelada

	mysql_query('BEGIN');
	$sql = "SELECT folio_presupuesto FROM books_ventas WHERE estado = 1 OR estado = 3 ORDER BY folio_presupuesto DESC LIMIT 1";
	$ultimo_folio = @mysql_result(@mysql_query($sql), 0);
	
	$ultimo_folio++;
	
	$sql="INSERT INTO books_ventas (id_usuario, id_empresa, id_cliente, folio_presupuesto, fecha_hora_creacion, referencia, fecha, fecha_expira, notas, terminos, ajuste_text, ajuste_monto) 
	VALUES ('$s_id_usuario','$s_id_empresa','$id_cliente','$ultimo_folio','$fechahora','$referencia','$fecha','$fecha_expira', '$notas','$terminos','$ajuste_texto','$ajuste_monto')";
	$qu=mysql_query($sql) or $error=true;
	$id_presupuesto=mysql_insert_id();
	
	foreach($cantidad as $id => $val):
			
		$producto_=$producto[$id];
		$cant=abs($val);
		$tarifa_=$tarifa[$id];
		$descuento_=abs($descuento[$id]);
		$impuesto_=abs($impuesto[$id]);
		
		if(	(!trim($producto_))	||	(!trim($cant)) ):
			$ret['respuesta']='2';
			$ret['id_presupuesto']='0';
			$ret['mensaje']='Asegurese que los campos del artículo (descripción y cantidad) estén llenos.';
			echo json_encode($ret);
			exit();
		endif;
		
		
		$sq=@mysql_query("INSERT INTO books_ventas_producto (id_venta,producto,cantidad,tarifa,descuento,impuesto)VALUES('$id_presupuesto','$producto_','$cant','$tarifa_','$descuento_','$impuesto_')");
		if(!$sq) $error = true;
		
	endforeach;
	
	//Guardamos los logs
	$sql="INSERT INTO books_logs_ventas (id_venta,log,fecha_hora,tipo)VALUES('$id_presupuesto','EL USUARIO $s_nombre HA CREADO EL PRESUPUESTO.','$fechahora','1')";
	$qu=mysql_query($sql) or $error=true;

	
	if($error):
		mysql_query('ROLLBACK');
		$ret['respuesta']='2';
		$ret['id_presupuesto']='0';
		$ret['mensaje']='Ocurrió un error al guardar, intente más tarde por favor. [1]';
	else:
		mysql_query('COMMIT');
		$ret['respuesta']='1';
		$ret['id_presupuesto']=$id_presupuesto;
	endif;
	
	echo json_encode($ret);