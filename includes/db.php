<?php
//error_reporting(0);
/* Conexión en entorno local 
$servidor="localhost";
$usuario="root";
$clave="root";
$base="evisur_app";*/

/* Conexión en producción */
$servidor="localhost";
$usuario="root";
$clave="root";
$base="admin";

$conexion = @mysql_connect ($servidor,$usuario,$clave) or die ("Ocurrió un error al conectarse.");
@mysql_select_db($base) or die ("No BD ");
?>