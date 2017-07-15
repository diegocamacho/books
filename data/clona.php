<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");
/*
if(!$_SESSION['adminbooks']):
	header('Location: ../login.php');
	exit;
endif;
*/
extract($_GET);
//error_reporting(0);
//print_r($_GET);
$id_venta = escapar($id_venta,1);
//Sacamos la empresa del presupuesto
$sql="SELECT books_ventas.id_venta FROM books_ventas 
JOIN books_empresas ON books_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_usuarios_empresas ON books_usuarios_empresas.id_empresa=books_ventas.id_empresa
WHERE id_venta=$id_venta AND books_usuarios_empresas.id_usuario=$s_id_usuario";
//exit();
$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if(!$valida):
	$error=true;
	$msg="No tiene acceso a este presupuesto para clonarlo. ".$sql;
endif;
if($error):
	$ret['respuesta']='2';
	$ret['id_presupuesto']='0';
	$ret['mensaje']=$msg;
	echo json_encode($ret);
	exit();
endif;

mysql_query('BEGIN');

$sql="INSERT INTO books_ventas (id_usuario, id_empresa, id_cliente, fecha_hora_creacion, referencia, fecha, notas, terminos, ajuste_text, ajuste_monto) 
(SELECT '$s_id_usuario', id_empresa, id_cliente, '$fechahora', referencia, '$fecha_actual', notas, terminos, ajuste_text, ajuste_monto FROM books_ventas WHERE id_venta=$id_venta)";
$qu=mysql_query($sql) or $error=true;
$id_presupuesto=mysql_insert_id();

$sql="INSERT INTO books_ventas_producto (id_venta, producto, cantidad, tarifa, descuento, impuesto, importe) 
(SELECT '$id_presupuesto', producto, cantidad, tarifa, descuento, impuesto, importe FROM books_ventas_producto WHERE id_venta=$id_venta)";
$qu=mysql_query($sql) or $error=true;

$sql="INSERT INTO books_logs_ventas (id_venta,log,fecha_hora,tipo)VALUES('$id_presupuesto','EL USUARIO $s_nombre HA CREADO EL PRESUPUESTO. APARTIR DE UNA CLONACIÓN','$fechahora','1')";
$qu=mysql_query($sql) or $error=true;

	
if($error):
	mysql_query('ROLLBACK');
	$ret['respuesta']='2';
	$ret['id_presupuesto']='0';
	$ret['mensaje']='Ocurrió un error al clonar, intente más tarde por favor.';
else:
	mysql_query('COMMIT');
	$ret['respuesta']='1';
	$ret['id_presupuesto']=$id_presupuesto;
endif;

echo json_encode($ret);