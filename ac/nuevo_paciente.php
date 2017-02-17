<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//Validamos datos completos
if(!$nombre) exit("Debe escribir el nombre del prospecto.");
if(!$telefono) exit("Debe escribir un teléfono para el prospecto.");
//if(!$email) exit("Debe escribir la dirección de correo del prospecto.");
//if(!$id_canal) exit("Debe seleccionar un canal de contacto por donde llego el prospecto.");

$nombre=limpiaStr($nombre,1,1);
if($comentarios) $comentarios=limpiaStr($comentarios,1,1);


	//Insertamos datos
	$sql="INSERT INTO pacientes (fecha_registro,nombre,telefono,email,tipo) VALUES ('$fecha_actual','$nombre','$telefono','$email','1')";
	$q=mysql_query($sql);
	if($q){
		echo "1";
	}else{
		echo "Ocurrió un error, intente más tarde.";
	}
