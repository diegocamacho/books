<?
session_start();
require '../includes/db.php';
require '../includes/funciones.php';

date_default_timezone_set ("America/Mexico_City");
$fecha_hora=date("Y-m-d H:i:s");



if(!$_POST['user']) exit("Debe escribir su usuario");
if(!$_POST['pass']) exit("Debe escribir su contraseña");

	if(isset ($_POST['user']) && ($_POST['pass']))
	{

		$usuario=mysql_real_escape_string($_POST['user']);
		$contrasena=contrasena(mysql_real_escape_string($_POST['pass']));
		// Admin
 		$sql = "SELECT * FROM usuarios WHERE email='$usuario' AND pass='$contrasena' AND activo='1' LIMIT 1";
		$res = mysql_query($sql) or die ('Error en db');
		$num_result = mysql_num_rows($res);
		if($num_result != 0){
			while ($row=mysql_fetch_object($res))
				{
					$id_us=$row->id_usuario;
					
					$sql="SELECT id_empresa FROM books_usuarios_empresas WHERE id_usuario=$id_us LIMIT 1";
					$q=mysql_query($sql);
					$ft=mysql_fetch_assoc($q);
					$id_empresa=$ft['id_empresa'];
					
					$_SESSION['s_id'] = $row->id_usuario;
					$_SESSION['s_tipo'] = $row->id_tipo_usuario;
					$_SESSION['s_id_empresa'] = $id_empresa;
					$_SESSION['s_nombre'] = $row->nombre;
					$_SESSION['s_display'] = $row->foto;
					$_SESSION['adminbooks'] = 1;
				}
			if(mysql_query("UPDATE usuarios SET ultimo_acceso='$fecha_hora' WHERE id_usuario='".$_SESSION['s_id']."'")){
				echo "1";
			}
		}else{
			exit('Datos de acceso incorrectos, por favor intente nuevamente.');
		}

	}
?>