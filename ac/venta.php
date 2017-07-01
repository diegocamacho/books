<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//Validamos datos completos
if(!$id_venta) exit("No llegó el identificador del la clínica.");
if(!$estado) exit("Debe escribir un nombre para el prototipo.");

//Formateamos y validamos los valores
$id_venta=escapar($id_venta,1);
$estado=escapar($estado,1);

//Creamos el mensaje para los logs
if($estado==1){
	$msg="x";
}elseif($estado==3){
	$msg="EL USUARIO $s_nombre A CANCELADO EL PRESUPUESTO.";
}elseif($estado==5){
	$msg="EL USUARIO $s_nombre A CANCELADO LA REMISIÓN.";
}

//Insertamos datos
mysql_query('BEGIN');

$sql="UPDATE books_ventas SET estado='$estado' WHERE id_venta=$id_venta AND id_empresa=$s_id_empresa";
$qu=mysql_query($sql) or $error=true;

//Guardamos los logs
$sql="INSERT INTO books_logs_ventas (id_venta,log,fecha_hora,tipo)VALUES('$id_venta','$msg','$fechahora','1')";
$qu=mysql_query($sql) or $error=true;


if($error):
	mysql_query('ROLLBACK');
	exit('Ocurrió un error al guardar, intente más tarde por favor.');
else:
	mysql_query('COMMIT');
	echo "1";
endif;
?>