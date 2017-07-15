<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

if(!$id_contacto) exit("No se recibio el identificador del contacto.");
if(!$id_persona) exit("No se recibio el identificador del contacto.");

$sql="SELECT * FROM books_contactos WHERE id_contacto=$id_contacto AND id_empresa=$s_id_empresa";
$q = mysql_query($sql);
$val=mysql_num_rows($q);

if($val){
	mysql_query('BEGIN');
	
	$sq=@mysql_query("UPDATE books_contactos_personas SET principal=0 WHERE id_contacto=$id_contacto");
	if(!$sq) $error = true;
			
	$sq=@mysql_query("UPDATE books_contactos_personas SET principal=1 WHERE id_contacto_persona=$id_persona");
	if(!$sq) $error = true;
	
	if($error):
		mysql_query('ROLLBACK');
		exit('Ocurrió un error al guardar, intente más tarde por favor.');
	else:
		mysql_query('COMMIT');
		echo "1";
	endif;
}else{
	exit("Ocurrió un error, intente más tarde");
}