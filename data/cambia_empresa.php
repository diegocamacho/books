<? include('../includes/session.php');
include('../includes/db.php'); 
include('../includes/funciones.php');
extract($_POST);
if(!$id) exit("No se reconce esta empresa, intenta nuevamente.");

$id=escapar($id,1);

$sql = "SELECT id_empresa FROM books_usuarios_empresas WHERE id_usuario='$s_id_usuario' AND id_empresa='$id'";
$q = mysql_query($sql);
$valida=mysql_num_rows($q);

if($valida>0){
	
	$data = mysql_fetch_assoc($q);
	
	$_SESSION['s_id_empresa'] = $data['id_empresa'];
	
	echo "1";
	
}else{
	exit("Ocurrió un error, intenta nuevamente");
}