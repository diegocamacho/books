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
$id_presupuesto = limpiaStr($id);
//Sacamos la empresa del presupuesto
$sql="SELECT books_ventas.id_venta FROM books_ventas 
JOIN books_empresas ON books_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_usuarios_empresas ON books_usuarios_empresas.id_empresa=books_ventas.id_empresa
WHERE id_venta=$id_presupuesto AND books_usuarios_empresas.id_usuario=$s_id_usuario";
//exit();
$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if(!$valida) exit('nain');

$http = new imCurlBitch();  
$http->init();  
$url = "http://localhost:8888/admin/formatos/venta.php?id=$id_presupuesto&id_usuario=$s_id_usuario";
$content = $http->get($url);
$ft=mysql_fetch_assoc($q);
$nombre_pdf = 'PDF_'.$ft['id_venta'].'.pdf';
$pdf= "../archivos_pdf/$nombre_pdf";

if(file_exists($pdf)){

	header("Content-Type: application/pdf");
	header("Content-Transfer-Encoding: Binary");
	header("Content-disposition: attachment; filename=".$nombre_pdf);
	readfile($pdf);

}else{
	echo 'no exist';
}