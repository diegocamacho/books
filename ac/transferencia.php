<?
include("../includes/session.php");
include("../includes/db.php");
include("../includes/funciones.php");

extract($_POST);

//Validamos datos completos
if(!$id_empresa_1) exit("Seleccione la empresa de salida.");
if(!$id_cuenta_1) exit("Seleccione la cuenta de salida.");
if(!$id_empresa_2) exit("Seleccione la empresa de entrada.");
if(!$id_cuenta_2) exit("Seleccione la cuenta de entrada.");
if(!$descripcion) exit("Escriba una descripción para la operación.");
if(!$monto) exit("Escriba el monto de la operación.");

//Validamos saldos
$ingresos=dameIngresos($id_cuenta_1);
$egresos=dameEgresoso($id_cuenta_1);
$saldo=$ingresos-$egresos;

if($saldo<1) exit("La cuenta de salida no tiene saldo para hacer una operación");
if($saldo<$monto) exit("La cuenta de salida no tiene suficiente saldo para hacer la operación");

//Limpiamos campos
$descripcion=limpiaStr($descripcion,1,1);

//Insertamos datos
mysql_query('BEGIN');

$sq=@mysql_query("INSERT INTO books_transferencias (id_cuenta_emisora,id_cuenta_receptora)VALUES('$id_cuenta_2','$id_cuenta_1')");
if(!$sq) $error = true;
$id_transferencia=mysql_insert_id();

$sq=@mysql_query("INSERT INTO books_ingresos (id_cuenta,id_cuenta_emisora,id_usuario,id_tipo_ingreso,id_transferencia,fecha_hora_captura,fecha_ingreso,monto,referencia)VALUES('$id_cuenta_2','$id_cuenta_1','$s_id_usuario','1','$id_transferencia','$fechahora','$fechahora','$monto','$descripcion')");
if(!$sq) $error = true;
	
$sq=@mysql_query("INSERT INTO books_gastos (id_cuenta,id_cuenta_receptora,id_usuario,id_tipo_gasto,id_transferencia,fecha_hora_captura,fecha_gasto,monto,referencia) VALUES ('$id_cuenta_1','$id_cuenta_2','$s_id_usuario','1','$id_transferencia','$fechahora','$fechahora','$monto','$descripcion')");
if(!$sq) $error = true;

if($error):
    mysql_query('ROLLBACK');
    echo "Ocurrió un error, intente más tarde.";
else:
    mysql_query('COMMIT');
    echo "1";
endif;
