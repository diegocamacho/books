<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_GET);
//echo json_encode($_GET);
//exit();
//if(!$id_presupuesto) exit("No llegó el identificador.");
//Validamos si el usuario tiene permiso para modificar este presupuesto
$sql="SELECT id_empresa FROM books_ventas WHERE id_venta=$id_venta";
$q=mysql_query($sql);
$ft=mysql_fetch_assoc($q);
$id_empresa=$ft['id_empresa'];

$sql="SELECT * FROM books_usuarios_empresas WHERE id_usuario=$s_id_usuario AND id_empresa=$id_empresa";
$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if(!$valida):
	$error=true;
	$msg="No tienes permisos para editar este presupuesto/remisión.";
endif;


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



if($fecha) $fecha=fechaBase2($fecha);
if($fecha_expira) $fecha_expira=fechaBase2($fecha_expira);
//$nombre=limpiaStr($nombre,1,1);

if($error):
	$ret['respuesta']='2';
	$ret['id_presupuesto']='0';
	$ret['mensaje']=$msg;
	echo json_encode($ret);
	exit();
endif;


	mysql_query('BEGIN');
		
	$sql="UPDATE books_ventas SET id_empresa='$id_empresa', id_cliente='$id_cliente', referencia='$referencia', fecha='$fecha', fecha_expira='$fecha_expira', notas='$notas', terminos='$terminos', ajuste_text='$ajuste_texto', ajuste_monto='$ajuste_monto' WHERE id_venta=$id_venta";
	$qu=mysql_query($sql) or $error=true;
	
	$sql="DELETE FROM books_ventas_producto WHERE id_venta=$id_venta";
	$qu=mysql_query($sql) or $error=true;
	
	foreach($cantidad as $id => $val):
			
		$producto_=$producto[$id];
		$cant=$val;
		$tarifa_=$tarifa[$id];
		$descuento_=$descuento[$id];
		$impuesto_=$impuesto[$id];
		$importe_=$importe[$id];
		
		if(	(!trim($producto_))	||	(!trim($cant)) ):
			$ret['respuesta']='2';
			$ret['id_presupuesto']='0';
			$ret['mensaje']='Asegurese que los campos del artículo (descripción y cantidad) estén llenos.';
			echo json_encode($ret);
			exit();
		endif;
		
		
		$sq=@mysql_query("INSERT INTO books_ventas_producto (id_venta,producto,cantidad,tarifa,descuento,impuesto)VALUES('$id_venta','$producto_','$cant','$tarifa_','$descuento_','$impuesto_')");
		if(!$sq) $error = true;
		
	endforeach;
	
	//Guardamos los logs
	$sql="INSERT INTO books_logs_ventas (id_venta,log,fecha_hora,tipo)VALUES('$id_venta','EL USUARIO $s_nombre HA EDITADO EL PRESUPUESTO.','$fechahora','1')";
	$qu=mysql_query($sql) or $error=true;

	
	if($error):
		mysql_query('ROLLBACK');
		$ret['respuesta']='2';
		$ret['id_presupuesto']='0';
		$ret['mensaje']='Ocurrió un error al guardar, intente más tarde por favor.';
	else:
		mysql_query('COMMIT');
		$ret['respuesta']='1';
		$ret['id_presupuesto']=$id_venta;
	endif;
	
	echo json_encode($ret);