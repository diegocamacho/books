<?
include("../includes/session.php");
include("../includes/db.php");

extract($_POST);
//print_r($_POST);
//Validamos datos completos
//if(!$tipo) exit("No llego el identificador de la operación");
if(!$id) exit("No llego el identificador del contacto");

//Updateamos el estado
$sql="UPDATE books_contactos SET activo='$tipo' WHERE id_contacto=$id";
$q=mysql_query($sql);
if($q){
	echo "1";
}else{
	echo "Ocurrió un error al actualizar el usuario";
}