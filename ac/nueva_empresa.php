<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//Validamos datos completos
if(!$nombre) exit("Debe escribir un nombre para la empresa.");

$nombre=limpiaStr($nombre,1,1);
	
	mysql_query('BEGIN');
		
	$sql="INSERT INTO books_empresas (empresa,fecha_creacion) VALUES ('$nombre','$fecha_actual')";
	$qu=mysql_query($sql) or $error=true;
	$id_empresa=mysql_insert_id();
	
	//Ligamos el usuario
	$sql="INSERT INTO books_usuarios_empresas (id_usuario,id_empresa)VALUES('$s_id_usuario','$id_empresa')";
	$qu=mysql_query($sql) or $error=true;
	
	//Efectivo
	$sql="INSERT INTO books_cuentas (id_empresa,alias,tipo_cuenta,fecha_creacion,eliminable)VALUES('$id_empresa','EFECTIVO','2','$fecha','0')";
	$qu=mysql_query($sql) or $error=true;
	
	//Banco
	$sql="INSERT INTO books_cuentas (id_empresa,alias,tipo_cuenta,fecha_creacion,eliminable)VALUES('$id_empresa','BANCO','3','$fecha','0')";
	$qu=mysql_query($sql) or $error=true;
	
	if($error):
		mysql_query('ROLLBACK');
		exit("Ocurrió un error, intente nuevamente");
	else:
		mysql_query('COMMIT');
		echo "1";
	endif;