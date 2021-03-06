<?
//Utilerias
date_default_timezone_set ("America/Mexico_City");
$fechahora=date("Y-m-d H:i:s");
$fecha_actual=date("Y-m-d");
$hora_actual=date("H:i:s");
//Valida cadena de fecha

function mb_ucfirst($string, $encoding = 'UTF-8'){
	$string = mb_strtolower($string, $encoding);
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}

function mayus($string){
	
	return ucwords( mb_strtolower($string,'UTF-8') );
	
}

function validaStrFecha($fecha,$ano=false){
	if(!$ano){
		if( (is_numeric($fecha)) && (strlen((string)$fecha)==2) ){
			return true;
		}else{
			return false;
		}
	}else{
		if( (is_numeric($fecha)) && (strlen((string)$fecha)==4) ){
			return true;
		}else{
			return false;
		}
	}
}
//Encripta contrase–a
function contrasena($contrasena){
	return md5($contrasena);
}
//Valida c—digo postal
function validarCP($cp){
	if( (is_numeric($cp)) && (strlen($cp)==5) ){
		return true;
	}else{
		return false;
	}
}
//Valida teléfono
function validarTelefono($telefono){
	if( (is_numeric($telefono)) && (strlen($telefono)==10) ){
		return true;
	}else{
		return false;
	}
}
//Validar email
function validarEmail($email){
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}
//Formatear cadenas
function limpiaStr($v,$base=false,$m=false,$x=false){

	if(!$x){
		if($m){
			$v =  mb_convert_case($v, MB_CASE_UPPER, "UTF-8");
		}else{
			$v =  mb_convert_case($v, MB_CASE_TITLE, "UTF-8"); 
		}	 
	}
	
	if($base){
		$v = mysql_real_escape_string(strip_tags($v));
	}
	return  $v;
}
//Funcion para escapar
function escapar($cadena,$numerico=false){
	if($numerico){
		if(is_numeric($cadena)){
			return mysql_real_escape_string($cadena);
		}else{
			return false;
		}
	}else{
		return mysql_real_escape_string(strip_tags($cadena));
	}
}
//Fecha para base de datos
function fechaBase($fecha){ 
	list($mes,$dia,$anio)=explode("/",$fecha); 

	$dia=(string)(int)$dia;
	return $anio."-".$mes."-".$dia;
}
function fechaBase2($fecha){ 
	list($dia,$mes,$anio)=explode("/",$fecha); 

	$dia=(string)(int)$dia;
	return $anio."-".$mes."-".$dia;
}
function fechaDeBase($fecha){ 
	list($anio,$mes,$dia)=explode("-",$fecha); 

	$dia=(string)(int)$dia;
	return $dia."/".$mes."/".$anio;
}
//Para mostrar fecha
function fechaSinHora($fecha){
	return $fecha=substr($fecha,0,11);
}
//Fecha sin hora
function fechaLetra($fecha){
    
	list($anio,$mes,$dia)=explode("-",$fecha); 
	switch($mes){
	case 1:
	$mest="ENE";
	break;
	case 2:
	$mest="FEB";
	break;
	case 3:
	$mest="MAR";
	break;
	case 4:
	$mest="ABR";
	break;
	case 5:
	$mest="MAY";
	break;
	case 6:
	$mest="JUN";
	break;
	case 7:
	$mest="JUL";
	break;
	case 8:
	$mest="AGO";
	break;
	case 9:
	$mest="SEP";
	break;
	case 10:
	$mest="OCT";
	break;
	case 11:
	$mest="NOV";
	break;
	case 12:
	$mest="DIC";
	break;
	
	}
	$dia=(string)(int)$dia;
	return $dia." ".$mest." ".$anio;
}

function fechaLetraAlt($fecha){
    
	list($anio,$mes,$dia)=explode("-",$fecha); 
	switch($mes){
	case 1:
	$mest="ENE";
	break;
	case 2:
	$mest="FEB";
	break;
	case 3:
	$mest="MAR";
	break;
	case 4:
	$mest="ABR";
	break;
	case 5:
	$mest="MAY";
	break;
	case 6:
	$mest="JUN";
	break;
	case 7:
	$mest="JUL";
	break;
	case 8:
	$mest="AGO";
	break;
	case 9:
	$mest="SEP";
	break;
	case 10:
	$mest="OCT";
	break;
	case 11:
	$mest="NOV";
	break;
	case 12:
	$mest="DIC";
	break;
	
	}
	$dia=(string)(int)$dia;
	return $dia." ".$mest;
}

function fechaLetraAltAnio($fecha){
    
	list($anio,$mes,$dia)=explode("-",$fecha); 
	switch($mes){
	case 1:
	$mest="ENE";
	break;
	case 2:
	$mest="FEB";
	break;
	case 3:
	$mest="MAR";
	break;
	case 4:
	$mest="ABR";
	break;
	case 5:
	$mest="MAY";
	break;
	case 6:
	$mest="JUN";
	break;
	case 7:
	$mest="JUL";
	break;
	case 8:
	$mest="AGO";
	break;
	case 9:
	$mest="SEP";
	break;
	case 10:
	$mest="OCT";
	break;
	case 11:
	$mest="NOV";
	break;
	case 12:
	$mest="DIC";
	break;
	
	}
	$dia=(string)(int)$dia;
	return $dia." ".$mest." ".substr($anio,2,4);
}


function fechaLetraDos($fecha){
    
	list($anio,$mes,$dia)=explode("-",$fecha); 
	switch($mes){
	case 1:
	$mest="ENE";
	break;
	case 2:
	$mest="FEB";
	break;
	case 3:
	$mest="MAR";
	break;
	case 4:
	$mest="ABR";
	break;
	case 5:
	$mest="MAY";
	break;
	case 6:
	$mest="JUN";
	break;
	case 7:
	$mest="JUL";
	break;
	case 8:
	$mest="AGO";
	break;
	case 9:
	$mest="SEP";
	break;
	case 10:
	$mest="OCT";
	break;
	case 11:
	$mest="NOV";
	break;
	case 12:
	$mest="DIC";
	break;
	
	}
	$dia=$dia;
	return $dia."/".$mest."/".$anio;
}

function fechaLetraTres($fecha){
    
	list($anio,$mes,$dia)=explode("-",$fecha); 
	switch($mes){
	case 1:
	$mest="Enero";
	break;
	case 2:
	$mest="Febrero";
	break;
	case 3:
	$mest="Marzo";
	break;
	case 4:
	$mest="Abril";
	break;
	case 5:
	$mest="Mayo";
	break;
	case 6:
	$mest="Junio";
	break;
	case 7:
	$mest="Julio";
	break;
	case 8:
	$mest="Agosto";
	break;
	case 9:
	$mest="Septiembre";
	break;
	case 10:
	$mest="Octubre";
	break;
	case 11:
	$mest="Noviembre";
	break;
	case 12:
	$mest="Diciembre";
	break;
	
	}
	$dia=$dia;
	return $dia." de ".$mest." del ".$anio;
}



//Obtener el mes
function soloMesNumero($fecha){
    
	$x=explode("-",$fecha);
	return $x[1];
}
function soloMes($mes){
    
	switch($mes){
	case 1:
	$mest="Enero";
	break;
	case 2:
	$mest="Febrero";
	break;
	case 3:
	$mest="Marzo";
	break;
	case 4:
	$mest="Abril";
	break;
	case 5:
	$mest="Mayo";
	break;
	case 6:
	$mest="Junio";
	break;
	case 7:
	$mest="Julio";
	break;
	case 8:
	$mest="Agosto";
	break;
	case 9:
	$mest="Septiembre";
	break;
	case 10:
	$mest="Octubre";
	break;
	case 11:
	$mest="Noviembre";
	break;
	case 12:
	$mest="Diciembre";
	break;
	
	}
	return $mest;
}
function fnum($num,$sinDecimales = false, $sinNumberFormat = false){

//SinDecimales = TRUE: envias: 1500.1234 devuelve: 1,500
//SinNumberFormat = TRUE: envias 1500.1234 devuelve 1500.12
//SinNumberFormat = TRUE && SinDecimales = TRUE: envias: 1500.1234 devuelve 1500

	if(is_numeric($num)){
		$roto = explode('.',$num);
		if($roto[1]){
			$dec = substr($roto[1],0,2);
		}else{
			$dec = "00";
		}

		if(is_numeric($roto[0])){
			if($sinDecimales){
				if($sinNumberFormat){
					return $roto[0];
				}else{
					return number_format($roto[0]);
				}
			}else{
				if($sinNumberFormat){
					return $roto[0].'.'.$dec;
				}else{
					return number_format($roto[0]).'.'.$dec;
				}
			}
		}else{
			if($sinDecimales){
				return '0';
			}else{
				return '0.'.$dec;
			}
		}
	}else{
		if($sinDecimales){
			return '0';
		}else{
			return '0.00';
		}
	}

}
function tipo_usuario($id_tipo_usuario){
	$sql="SELECT tipo FROM tipo_usuario WHERE id_tipo_usuario=$id_tipo_usuario";
	$q=mysql_query($sql);
	$ft=mysql_fetch_assoc($q);
	$tipo=$ft['tipo'];
	return $tipo;
}

function acentos($cadena){
    $originales =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
    $modificadas = 'AAAAAAACEEEEIIIIDNOOOOOOUUUUYbsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
    $cadena = utf8_decode($cadena);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    return utf8_encode($cadena);
}


function devuelveFechaHora($fecha_hora){
	
	
$data = explode(' ', $fecha_hora);

return fechaLetraDos($data[0]).' - '.substr($data[1], 0,5);

	
	
}

function fechaHoraMeridian($fecha_hora){
	
	
$data = explode(' ', $fecha_hora);

return fechaLetraTres($data[0]).' - '.date('h:i A', strtotime($fecha_hora));

	
	
}

//Hora del dia en formato 24 hrs
function horaOficial($hora){
  $hora_oficial = date("H:i",strtotime($hora));
  return $hora_oficial;
}

//Hora del dia en formato 12 hrs
function horaInput($hora){
  $hora_oficial = date("h:i A",strtotime($hora));
  return $hora_oficial;
}

function damePorcentaje($cantidad,$porciento){
	return number_format($cantidad*$porciento/100 ,2);
}

function dias_restantes($fecha_final) {
	$fecha_actual = date("Y-m-d");
	$s = strtotime($fecha_actual)-strtotime($fecha_final);
	$d = intval($s/86400);
	$diferencia=$d;
	return $diferencia;
}

function dias_restantes_formato($fecha_final) {
	if(!$fecha_final){ return "N/A"; }
	$fecha_actual = date("Y-m-d");
	$s = strtotime($fecha_actual)-strtotime($fecha_final);
	$d = intval($s/86400);
	if($d==0){
		$diferencia="Hoy";
	}elseif($d==1){
		$diferencia="Ayer";
	}else{
		$diferencia=$d." días";
	}
	return $diferencia;
}

function prioridad($prioridad) {
	if($prioridad==1){
		return "Baja";
	}elseif($prioridad==2){
		return "Media";
	}elseif($prioridad==3){
		return "Alta";
	}
}


function dias_restantes_mostrar($fecha_tarea){
	
	$dias_restantes = dias_restantes($fecha_tarea);
	$dias_restantes = abs($dias_restantes);	
	$hoy = date('Y-m-d');
	
	if(strtotime($hoy)<strtotime($fecha_tarea)):
		if($dias_restantes==1):
			$en = "Para Mañana";
		else:
		$en = "Entrega en $dias_restantes días";
		endif;
	elseif(date('Y-m-d')==$fecha_tarea):
		$en = "Entrega: Hoy";			
	else:
		if($dias_restantes==1):
			$en = "Venció Ayer";
		else:
			$en = "Venció hace $dias_restantes días";
		endif;
	endif;
	
	return $en;
	
}

function dameIngresos($id_cuenta){
	
	$sql="SELECT SUM(monto) AS total_ingresos FROM books_ingresos WHERE id_cuenta=$id_cuenta";
	$q=mysql_query($sql);
	$dt=mysql_fetch_assoc($q);
	return $dt['total_ingresos'];
}
function dameEgresoso($id_cuenta){
	
	$sql="SELECT SUM(monto) AS total_egresos FROM books_gastos WHERE id_cuenta=$id_cuenta";
	$q=mysql_query($sql);
	$dt=mysql_fetch_assoc($q);
	return $dt['total_egresos'];
}
function datosCuenta($id_cuenta){
	
	$sql="SELECT clinica,alias FROM books_cuentas 
	JOIN clinicas ON clinicas.id_clinica=books_cuentas.id_empresa
	WHERE id_cuenta=$id_cuenta";
	$q=mysql_query($sql);
	$dt=mysql_fetch_assoc($q);
	return $dt['clinica']." ".$dt['alias'];
	
}
function metodoPago($id_metodo_pago){
	
	$sql="SELECT metodo_pago FROM books_metodo_pago 
	WHERE id_metodo_pago=$id_metodo_pago";
	$q=mysql_query($sql);
	$dt=mysql_fetch_assoc($q);
	return $dt['metodo_pago'];
	
}
function clavemetodoPago($id_metodo_pago){
	
	$sql="SELECT clave FROM books_metodo_pago 
	WHERE id_metodo_pago=$id_metodo_pago";
	$q=mysql_query($sql);
	$dt=mysql_fetch_assoc($q);
	return $dt['clave'];
	
}

function ultimoDia($ano,$mes) {
  return date("d",(mktime(0,0,0,$mes+1,1,$ano)-1));
}
function validaRFC($valor) { 
        $valor = str_replace("-", "", $valor); 
        $valor = str_replace("&", "X", $valor); 
        $cuartoValor = substr($valor, 3, 1); 
        //RFC Persona Moral. 
        if (ctype_digit($cuartoValor) && strlen($valor) == 12) { 
            $letras = substr($valor, 0, 3); 
            $numeros = substr($valor, 3, 6); 
            $homoclave = substr($valor, 9, 3); 
            if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) { 
                return true; 
            } 
        //RFC Persona Física. 
        } else if (ctype_alpha($cuartoValor) && strlen($valor) == 13) { 
            $letras = substr($valor, 0, 4); 
            $numeros = substr($valor, 4, 6); 
            $homoclave = substr($valor, 10, 3); 
            if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) { 
                return true; 
            } 
        }else { 
            return false; 
        } 
}
function dameDatosEmpresa($id_empresa) { 
	$sql="SELECT empresa FROM books_empresas WHERE id_empresa=$id_empresa";
	$q=mysql_query($sql);
	$dt=mysql_fetch_assoc($q);
	return $dt['empresa'];
}
function dameEstado($estado){
	if($estado==1){
		$msg="Presupuesto";
	}elseif($estado==2){
		$msg="Borrador";
	}elseif($estado==3){
		$msg="Cancelado";
	}elseif($estado==4){
		$msg="Remisión";
	}elseif($estado==5){
		$msg="Remisión cancelada";
	}else{
		$msg="N/A";
	}
	
	return $msg;
}
function getCuentasPorPagarMonto($id_cliente){
	
}

function getCuentasPorCobrarMonto($id_cliente){
	
	
	
}

function getMonto($id_venta){ /* OBTIENE EL MONTO FINAL DE LA VENTA */
	global $conexion;
	$sql = "SELECT*FROM books_ventas_producto WHERE id_venta = $id_venta";
	$q = mysql_query($sql);

	while($datos=mysql_fetch_object($q)):
		$productos[] = $datos;
	endwhile;
	
	$sql = "SELECT ajuste_monto FROM books_ventas WHERE id_venta = $id_venta";
	$q = mysql_query($sql);
	$presupuesto = mysql_fetch_object($q);
	
	
	foreach($productos as $producto): 
					                    
		$cantidad=$producto->cantidad;
		$tarifa=$producto->tarifa;
		
		$subtotal=$cantidad*$tarifa;
		
		if($producto->descuento>0):
			$descuento=$producto->descuento;
			$porentaje=$descuento/100; 
			
			$monto_descuento = $subtotal*$porentaje;
			$subtotal = $subtotal-$monto_descuento;
		endif;
		
		if($producto->impuesto>0):
			
			$impuesto=$producto->impuesto;
			$iva= $impuesto/100;
			$monto_impuesto= $subtotal*$iva;
			
			$ivas+=$monto_impuesto;
			
		endif;
		
		$totales+=$subtotal;
		$macizo=$totales+$ivas;
		
		if($presupuesto->ajuste_monto!="0.00"):
			$ajuste=$presupuesto->ajuste_monto;
			$macizo=$macizo+$ajuste;
		endif;
		
	endforeach;
	
	return $macizo;
}


function billete($number, $precision = 2, $separator = '.')
{
    $numberParts = explode($separator, sprintf("%01.4f",$number));
    $response = number_format($numberParts[0]);
    if(count($numberParts)>1){
        $response .= $separator;
        $response .= substr($numberParts[1], 0, $precision);
    }
    return $response;
}

class imCurlBitch {
    private $curl;
    private $id;

    public function __construct() {
        $this->id = time();
    }

    public function init() {
        
        $this->curl=curl_init();
        
        curl_setopt($this->curl, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1");
        curl_setopt($this->curl, CURLOPT_COOKIEFILE,'cookies.txt');
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, 'cookies.txt');
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($this->curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($this->curl, CURLOPT_AUTOREFERER, TRUE);
	}

    public function get($url) {
        $this->init();
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST,false);
        curl_setopt($this->curl, CURLOPT_REFERER, '');
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, TRUE);
        $result=curl_exec ($this->curl);
		/*  if($result === false){
            echo curl_error($this->curl);
        }*/
        
        $this->_close();
        return $result;
    }

    public function post($url,$data) {
        $this->init();

        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST,true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, TRUE);
        $result=curl_exec ($this->curl);
        $this->_close();
        return $result;
    }

    private function _close() {
        curl_close($this->curl);
    }

}
