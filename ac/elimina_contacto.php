<?
include("../includes/session.php");
include("../includes/db.php");
//exit("error");
extract($_POST);
//print_r($_POST);
//Validamos datos completos
if(!$id) exit("No llego el identificador del contacto");

$sql="DELETE FROM books_clientes_contactos WHERE id_cliente_contacto=$id";
$q=mysql_query($sql);
if($q){
	echo "1";
}else{
	echo "Ocurrió un error al eliminar el contacto, intente más tarde.";
}


?>