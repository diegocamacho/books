<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//Validamos datos completos
if(!$id_paciente_agenda) exit("Seleccione un paciente.");
if(!$id_clinica) exit("Seleccione una clínica.");
if(!$id_tratamiento) exit("Seleccione un tratamiento.");
//if(!$id_promocion) exit("Seleccione un tratamiento.");
if(!$fecha_hora) exit("Debe especificar la fecha y hora de la cita.");
if(!$fecha_hora_final) exit("Debe especificar la fecha y hora en que va a terminar la cita.");
//if(!$comentarios) exit("Debe especificar la fecha y hora de la cita.");
if($comentarios) $comentarios=limpiaStr($comentarios,1,1);



	//Insertamos datos
	$sql="INSERT INTO citas (id_paciente,id_clinica,id_tratamiento,id_promocion,id_usuario,fecha_hora,fecha_hora_final,comentario,color) VALUES ('$id_paciente_agenda','$id_clinica','$id_tratamiento','$id_promocion','$id_doctor','$fecha_hora','$fecha_hora_final','$comentarios','$color')";
	$q=mysql_query($sql);
	if($q){
		if(mysql_query("UPDATE pacientes SET tipo='1' WHERE id_paciente=$id_paciente_agenda")){
			echo "1";
		}
	}else{
		echo "Ocurrió un error, intente más tarde.";
	}
