<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//if(!$principal_email) exit("Debe escribir el email del representante.");
//if(!$empresa) exit("Debe escribir el nombre de la empresa a la que pertenece el representante.");
if(!$principal_nombre): 
	exit("Debe escribir el nombre del contacto.");
else:
	$principal_nombre=limpiaStr($principal_nombre,1,1);
endif;
	
if($principal_email):
	$principal_email=limpiaStr($principal_email,1,1,1);
endif;
	
if($empresa):
	$empresa=limpiaStr($empresa,1,1);
endif;

if($razon_social):
	$razon_social=limpiaStr($razon_social,1,1);
endif;

//Datos de facturación

if(!$rfc): 
	exit("Debe escribir el nombre del contacto.");
else:
	$rfc=limpiaStr($rfc,1,1);
endif;

if($calle): $calle=limpiaStr($rfc,1,1); endif;
if($n_exterior): $n_exterior=limpiaStr($n_exterior,1,1); endif;
if($n_interior): $n_interior=limpiaStr($n_interior,1,1); endif;
if($colonia): $colonia=limpiaStr($colonia,1,1); endif;
if($cp): $cp=limpiaStr($cp,1,1); endif;
if($localidad): $localidad=limpiaStr($localidad,1,1); endif;
if($municipio): $municipio=limpiaStr($municipio,1,1); endif;

mysql_query('BEGIN');

if($id_contacto):

	$sql="UPDATE books_contactos SET empresa='$empresa', telefono='$telefono', tipo='$tipo_contacto' WHERE id_contacto=$id_contacto";
	$q=mysql_query($sql) or $error=true;
	
	$sql="UPDATE books_contactos_personas SET nombre='$principal_nombre', email='$principal_email' WHERE id_contacto='$id_contacto' AND principal=1";
	$q=mysql_query($sql) or $error=true;
	
	$sql="UPDATE books_contactos_facturacion SET razon_social='$razon_social', rfc='$rfc', calle='$calle', n_exterior='$n_exterior', n_interior='$n_interior', colonia='$colonia', cp='$cp', localidad='$localidad', municipio='$municipio', estado='$estado' WHERE id_contacto='$id_contacto'";
	$q=mysql_query($sql) or $error=true;
	
	if($contacto_nombre):
		foreach($contacto_nombre as $id => $val):
		
			$nombre_=$contacto_nombre[$id];
			$email_=$contacto_email[$id];
				
			if((!trim($nombre_))	||	(!trim($email_))):
				exit("Los contactos adicionales no pueden tener campos vacios.");
			endif;
			
			$nombre_=limpiaStr($nombre_,1,1);
			$email_=limpiaStr($email_,1,1,1);
			
			$sq=@mysql_query("INSERT INTO books_contactos_personas (id_contacto,nombre,email)VALUES('$id_contacto','$nombre_','$email_')");
			if(!$sq) $error = true;
				
		endforeach;
	endif;

else:
	
	$sql="INSERT INTO books_contactos (id_empresa,fecha_alta,empresa,telefono,tipo) VALUES ('$s_id_empresa','$fecha_actual','$empresa','$telefono','$tipo_contacto')";
	$q=mysql_query($sql) or $error=true;
	$id_contacto=mysql_insert_id();
	
	$sql="INSERT INTO books_contactos_personas (id_contacto,nombre,email,principal)VALUES('$id_contacto','$principal_nombre','$principal_email','1')";
	$q=mysql_query($sql) or $error=true;
	
	$sql="INSERT INTO books_contactos_facturacion (id_contacto,razon_social,rfc,calle,n_exterior,n_interior,colonia,cp,localidad,municipio,estado)VALUES('$id_contacto','$razon_social','$rfc','$calle','$n_exterior','$n_interior','$colonia','$cp','$localidad','$municipio','$estado')";
	$q=mysql_query($sql) or $error=true;


	foreach($contacto_nombre as $id => $val):
	
		$nombre_=$contacto_nombre[$id];
		$email_=$contacto_email[$id];
			
		if((!trim($nombre_))	||	(!trim($email_))):
			continue;
		endif;
		
		$nombre_=limpiaStr($nombre_,1,1);
		$email_=limpiaStr($email_,1,1,1);
		
		$sq=@mysql_query("INSERT INTO books_contactos_personas (id_contacto,nombre,email)VALUES('$id_contacto','$nombre_','$email_')");
		if(!$sq) $error = true;
			
	endforeach;

	
endif;



if($error):
	mysql_query('ROLLBACK');
	exit('Ocurrió un error al guardar, intente más tarde por favor.');
else:
	mysql_query('COMMIT');
	echo "1";
endif;