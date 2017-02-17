<?php
include("../includes/db.php");
include("../includes/funciones.php");

if(!$_GET['id_cita']) exit("Error de ID");

$id_cita = escapar($_GET['id_cita'],1);

$sql = "
SELECT pacientes.nombre,pacientes.telefono,citas.fecha_hora,clinicas.clinica, tratamientos.tratamiento, citas.comentario, citas.confirmada
FROM citas
JOIN pacientes ON pacientes.id_paciente = citas.id_paciente
JOIN clinicas ON clinicas.id_clinica = citas.id_clinica
JOIN tratamientos ON tratamientos.id_tratamiento  = citas.id_tratamiento
WHERE citas.activo = 1 AND citas.id_cita = $id_cita";

$q = mysql_query($sql);
$data = mysql_fetch_object($q);
$data->fecha_hora = fechaHoraMeridian($data->fecha_hora);
echo json_encode($data);