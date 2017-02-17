<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);
//Validamos datos completos
if(!$id_cita) exit("No llegó el identificador de la cita.");
if(!$id_clinica) exit("Seleccione una clínica.");
if(!$id_tratamiento) exit("Seleccione un tratamiento.");
//if(!$id_promocion) exit("Seleccione un tratamiento.");
if(!$fecha_hora) exit("Debe especificar la fecha y hora de la cita.");
//if(!$comentarios) exit("Debe especificar la fecha y hora de la cita.");
if($comentarios) $comentarios=limpiaStr($comentarios,1,1);



	//Insertamos datos
	$sql="UPDATE citas SET id_clinica='$id_clinica', id_tratamiento='$id_tratamiento', id_promocion='$id_promocion', fecha_hora='$fecha_hora', comentario='$comentarios' WHERE id_cita='$id_cita'";
	$q=mysql_query($sql);
	if($q){
		echo "1";
	}else{
		echo "Ocurrió un error, intente más tarde.";
	}
