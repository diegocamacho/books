<?

include("../includes/db.php");
include("../includes/funciones.php");

if(!$_GET['id_clinica']){ exit("Error de ID");}
$id_clinica=escapar($_GET['id_clinica'],1);
if($_GET['id_usuario']): $id_usuario=$_GET['id_usuario']; endif;
//Doctores
$sql="SELECT id_usuario,nombre FROM usuarios WHERE id_tipo_usuario=3 AND id_clinica=$id_clinica";
$q=mysql_query($sql);
$doctores=array();
while($datos=mysql_fetch_object($q)):
	$doctores[] = $datos;
endwhile;
$valida_doctores=count($doctores);
?>
<label for="nombre" class="col-md-3 control-label">Doctor</label>
<div class="col-md-9">
	<select class="form-control" data-show-subtext="false" name="id_doctor">
		<? if($valida_doctores): ?>
		<option>Seleccione un doctor</option>
		<? foreach($doctores AS $doctor): ?>
			<option <? if($id_usuario==$doctor->id_usuario): ?>selected="1"<? endif; ?> value="<?=$doctor->id_usuario?>"><?=$doctor->nombre?></option>
		<? endforeach; ?>
		<? else: ?>
		<option>No se encontraron doctores en esta clínica</option>
		<? endif; ?>
	</select>
</div>