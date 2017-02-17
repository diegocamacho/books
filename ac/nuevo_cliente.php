<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//Validamos datos completos
if(!$nombre) exit("Debe escribir un nombre para el cliente.");
if(!$representante) exit("Debe escribir un nombre del representante.");
//if(!$telefono) exit("Debe escribir un número de teléfono para el proveedor.");
//if(!$email) exit("Debe escribir una cuenta de email para el proveedor.");

$nombre=limpiaStr($nombre,1,1);
$representante=limpiaStr($representante,1,1);



	//Insertamos datos
	$sql="INSERT INTO books_clientes (id_empresa,fecha_alta,cliente,representante,telefono,email) VALUES ('$id_empresa','$fecha_actual','$nombre','$representante','$telefono','$email')";
	$q=mysql_query($sql);
	if($q){
		echo "1";
	}else{
		echo "Ocurrió un error, intente más tarde.";
	}
