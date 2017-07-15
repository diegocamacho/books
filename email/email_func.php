<?php

function enviar_email_SG($para, $asunto, $html, $reply,  $adjunto = false){
	
	require ('postmark.php');
		
	$remite 			= "Adminbooks <hola@adminus.mx>";
	$destino 			= $para;
	$asunto 			= $asunto;
	$mensaje_html 		= $html;
	
	$ad_auth = stream_context_create(array('http' => array('header'  => "Authorization: Basic " . base64_encode("em_adminus:2016"))));
	$ad_data = file_get_contents("https://adminus.mx/app/config.php", false, $ad_auth);
	$ad_config = json_decode($ad_data);
	$postmark_api = $ad_config->postmark_api;
	
	$postmark = new Postmark($postmark_api,$remite);
	$postmark->to($destino);
	$postmark->subject($asunto);
	if(strlen($reply)>5):
		$postmark->reply($reply);
	endif;
	$postmark->html_message($mensaje_html);
	$postmark->adjunta_vato($adjunto);
		
	if($postmark->send()===true){
		return true;
	}else{
		return false;
	}
	
}


$html = "Estimado/a Sr. Reynaldo Aguilar:
<br/><br/>
Le agradecemos el interés mostrado.
<br/><br/>
Su invoice INV-236 se puede ver, imprimir o descargar como PDF mediante el enlace siguiente o en el archivo adjunto.
<br/><br/>
Esperamos seguir trabajando con usted.
<br/><br/>
<br/>
Saludos cordiales,
<br/><br/>
Adolfo Flores";

$adjunto[] = "http://adminus.mx/app/INV-236.pdf";

enviar_email_SG('diegocamacho20@gmail.com', 'Presupuesto PRE-002 de COMPUPLAZA', $html, 'adolfo@samcro.mx', $adjunto);
