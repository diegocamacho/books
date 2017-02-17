<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//Validamos datos completos
if(!$nombre) exit("Debe escribir un nombre para la clínica.");
if(!$telefono) exit("Debe escribir un teléfono para la clínica.");
if(!$direccion) exit("Debe escribir la dirección de la clínica.");
if($tipo==0) exit("Seleccione el tipo de empresa.");
//if(!$color) exit("Seleccione un color para la clínica.");

$nombre=limpiaStr($nombre,1,1);
$direccion=limpiaStr($direccion,1,1);


	mysql_query('BEGIN');
		
	$sql="INSERT INTO clinicas (clinica,telefono,direccion,color,tipo) VALUES ('$nombre','$telefono','$direccion','$color','$tipo')";
	$qu=mysql_query($sql) or $error=true;
	$id_empresa=mysql_insert_id();
	
	//Caja chica
	//$sql="INSERT INTO books_cuentas (id_empresa,alias,tipo_cuenta,fecha_creacion,eliminable)VALUES('$id_empresa','CAJA CHICA','1','$fecha','0')";
	//$qu=mysql_query($sql) or $error=true;
	
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