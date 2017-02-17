<?php

include('includes/db.php');
$id_clinica = $_GET['id_clinica'];
$sc = ($id_clinica) ? "= $id_clinica" : ">0";

$sql="SELECT citas.id_cita,pacientes.nombre,citas.color,citas.fecha_hora,citas.fecha_hora_final,citas.confirmada FROM citas 
JOIN pacientes ON pacientes.id_paciente=citas.id_paciente
JOIN clinicas ON clinicas.id_clinica=citas.id_clinica
WHERE citas.activo = 1 AND citas.atendida = 0 AND citas.id_clinica $sc";

$q=mysql_query($sql);

$citas		= array();
$e			= array();
$eventos	= array();

while($datos=mysql_fetch_object($q)):
	$citas[] = $datos;
endwhile;

foreach($citas as $cita):
	
	$hora = explode(' ', $cita->fecha_hora);
	$fecha = $hora[0];	
	$hora = explode(':', $hora[1]);
	$hora = $hora[0].':'.$hora[1];
	
	$conf = ($cita->confirmada) ? '✓' : '';
	
	$e['id'] = $cita->id_cita;
	$e['title'] = $conf.$hora.' '.$cita->nombre;
	$e['start'] = str_replace(' ', 'T', $cita->fecha_hora);
	$e['end'] = str_replace(' ', 'T', $cita->fecha_hora_final);
	$e['allDay'] = false;
	$e['backgroundColor'] = $cita->color;
	array_push($eventos, $e);

endforeach;

echo json_encode($eventos);
