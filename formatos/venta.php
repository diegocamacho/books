<? set_time_limit(0); 
include('../includes/db.php');
include('../includes/session.php');
include('../includes/num_letra.php');
include('../includes/funciones.php');
ob_start();
//$color="#000000";
$id_presupuesto=$_GET['id'];
//Sacamos la empresa del presupuesto
$sql="SELECT referencia, fecha, fecha_expira, notas, terminos, ajuste_text, ajuste_monto, borrador, facturado, cliente, representante, empresa, direccion, ciudad, books_empresas.estado, codigo_postal, telefono_1, telefono_2, web, logo, color, colonia FROM books_ventas 
JOIN books_usuarios_empresas ON books_usuarios_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_empresas ON books_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_clientes ON books_clientes.id_cliente=books_ventas.id_cliente 
WHERE id_venta=$id_presupuesto AND books_usuarios_empresas.id_usuario=$s_id_usuario";

$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if(!$valida):
	exit("Ocurrió un error, intente más tarde");
else:
	$presupuesto=mysql_fetch_object($q);
	$color=$presupuesto->color;
	
	//Sacamos los presupuestos
	$productos=array();
	$sql="SELECT * FROM books_ventas_producto WHERE id_venta=$id_presupuesto";
	$q=mysql_query($sql);
	while($datos=mysql_fetch_object($q)):
		$productos[] = $datos;
	endwhile;
	$valida_productos=count($productos);
	
	//Validamos que tenga descuento
	$sql="SELECT SUM(descuento) AS descuento FROM books_ventas_producto WHERE id_venta=$id_presupuesto";
	$q=mysql_query($sql);
	$ft=mysql_fetch_assoc($q);
	$valida_descuento=$ft['descuento'];
	
	//Mostramos los logs de la factura
	$sql="SELECT log, fecha_hora FROM books_logs_ventas WHERE id_venta=$id_presupuesto";
	$q=mysql_query($sql);
	while($datos=mysql_fetch_object($q)):
		$logs[] = $datos;
	endwhile;
	$valida_logs=count($logs);
endif;
?>
<style>
.titulos{
	background-color: <?=$color?>;
	color: #FFF;
	/*padding-left: 5px;*/
	/*Rojo claro #D90909
	Rojo obscuro #AC0000	
		
	*/
}
.borde-azul{
	border: <?=$color?> 1px solid ;
}
.borde-iz{
	border-left: <?=$color?> 1px solid;
}
.borde-der{
	border-right: <?=$color?> 1px solid;
}
.borde-bot{
	border-bottom: <?=$color?> 1px solid;
}
.borde-top{
	border-too: <?=$color?> 2px solid;
}
b{
	font-family: sfsemi;
}
table{
	font-family: sf;
}
.f12{
	font-size: 12px;
}
.f11{
	font-size: 11px;
}
.f10{
	font-size: 10px;
}
.f14{
	font-size: 14px;
}
.m-top{
	margin-top: 35px;
}
.m-left{
	margin-left: 38px;
}
.logo{
	max-width: 80px;
	/*height: 30;*/
	max-height: 60px;
	width: 230px;
	
}
.fondo{
	background: #f3f3f3;
	font-weight: bold;
}
</style>

<page backtop="60mm" backbottom="5mm" backleft="0mm" backright="10mm" footer="page">

<page_header>
	<table width="723" cellpadding="0" cellspacing="0" class="f14 m-top m-left">
	<tr>
    	<td width="400" height="20" valign="top" >
	    	<? if($presupuesto->logo){ ?>
	    		<img src="../files/<?=$presupuesto->logo?>" class="logo" /><br><br>
	    	<? } ?>
		    <? if($presupuesto->empresa){ ?>
		    	<b><?=$presupuesto->empresa;?></b><br />
		    <? } ?>
		    
		    <? if($presupuesto->direccion){ ?>
				<?=ucwords(strtolower($presupuesto->direccion));?><br />
			<? } ?>
			
			<? if($presupuesto->colonia){ ?>
				<?=ucwords(strtolower($presupuesto->colonia));?><br />
			<? } ?>
			
			<? if($presupuesto->ciudad){ ?>
				<?=ucwords(strtolower($presupuesto->ciudad)).",";?>
			<? } ?> 
			
			<? if($presupuesto->estado){ ?>
				<?=ucwords(strtolower($presupuesto->estado));?>
			<? } ?>
			
			<br><br>
			<? if($presupuesto->telefono_1){ ?>
				<?=$presupuesto->telefono_1?>
				<? if($presupuesto->telefono_2){ ?>- <?=$presupuesto->telefono_2?><? } ?><br>
			<? } ?>
			<? if($presupuesto->web){ ?>
				<?=strtolower($presupuesto->web)?>
			<? } ?>
		</td>
    	<td width="323" height="20" valign="top" align="right">
		    <h2 style="font-weight: bold; margin-top: 0px;">Presupuesto<br><small style="font-weight: 100;font-size: 16px;">#PRE-101</small></h2>
			<!--<h3 style="font-weight: bold;"><small style="font-weight: 100;font-size: 16px;">Saldo adeudado<br></small>MXN 397,847.89</h3>-->
		</td>
	</tr>
</table>
</page_header>

<page_footer>
	<table width="780" border="0" cellpadding="0" cellspacing="0" class="f11">
    	<tr>
			<td width="780" style="padding-top: 10px;padding-bottom: 16px;">Generado con <b>Adminbooks.mx</b></td>
		</tr>
	</table>
</page_footer>


<!-- Header  -->

<table width="723" cellpadding="0" cellspacing="0" class="f14 m-left" style="margin-top: 20px;">
	<tr>
    	<td width="400" height="40" valign="middle" >
	    	<? if($presupuesto->representante){ ?>
		    	Con atención a<br>
				<?=ucwords(strtolower($presupuesto->representante));?>
				<? if($presupuesto->cliente){ ?>
					<br><b><?=ucwords(strtolower($presupuesto->cliente));?></b>
				<? } ?>
			<? } ?>
		</td>
    	<td width="323" height="40" valign="top" align="right">
		    Emisión: <?=ucwords(strtolower(fechaLetra($presupuesto->fecha)));?>
		    <? if($presupuesto->fecha_expira){ ?>
		    <p style="font-weight: bold;">Vencimiento: <?=ucwords(strtolower(fechaLetra($presupuesto->fecha_expira)));?></p>
		    <? } ?>
		</td>
	</tr>
</table>



<!-- Productos -->
<br><br><br>
<table width="705" cellpadding="0" cellspacing="0" class="borde-azul f12 m-left">
	<thead>
    	<tr class="titulos">
			<th width="23" height="25" class="f11">&nbsp;#</th>
			<th width="370" height="25" class="f11">&nbsp;&nbsp;Descripción</th>
			<th width="40" height="25" class="f11" align="right">Cant. &nbsp;</th>
			<th width="90" height="25" class="f11" align="right">Precio&nbsp;&nbsp;</th>
			<th width="70" height="25" class="f11" align="right">Descuento&nbsp;&nbsp;</th>
			<th width="115" height="25" class="f11" align="right">Importe&nbsp;&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<? foreach($productos as $producto): 	                    
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
		?>
    	<tr style="margin-bottom: 10px;">
			<td width="23" height="20">&nbsp;1</td>
		    <td width="370" height="20">&nbsp;<?=$producto->producto?></td>
			<td width="40" height="20" align="right"><?=number_format($producto->cantidad,0)?>&nbsp;</td>
			<td width="90" height="20" align="right"><?=billete($producto->tarifa)?>&nbsp;</td>
			<td width="70" height="20" align="right">
				<? if($valida_descuento>0): ?>
				        <?if($producto->descuento>0):
				        	echo number_format($producto->descuento,0)."%";
				        else:
				        	echo "";
				        endif; ?>
		        <? endif; ?>
		        &nbsp;
			</td>
			<td width="115" height="20" align="right"><?=billete($subtotal);?>&nbsp;&nbsp;</td>
		</tr>
		<? endforeach; ?>
		
		<tr style="margin-bottom: 10px;" >
			<td height="20" align="right" colspan="5" style="border-top: 1px <?=$color?> solid;"><b>Subtotal</b></td>
			<td height="20" align="right" style="border-top: 1px <?=$color?> solid;"><b><?=billete($totales)?></b>&nbsp;&nbsp;</td>
		</tr>
		<tr style="margin-bottom: 10px;">
			<td height="20" align="right" colspan="5"><b>I.V.A</b></td>
			<td height="20" align="right"><b><?=billete($ivas)?></b>&nbsp;&nbsp;</td>
		</tr>
		<? if($presupuesto->ajuste_monto>0){ ?>
		<tr style="margin-bottom: 10px;">
			<td height="20" align="right" colspan="5"><b><?=$presupuesto->ajuste_text?></b></td>
			<td height="20" align="right"><b><?=billete($presupuesto->ajuste_monto)?></b>&nbsp;&nbsp;</td>
		</tr>
		<? } ?>
		<tr style="margin-bottom: 10px;">
			<td height="20" align="right" colspan="5"><b>Total</b></td>
			<td height="20" align="right"><b><?=billete($macizo)?></b>&nbsp;&nbsp;</td>
		</tr>
	</tbody>
</table>
<!-- Términos y condiciones -->
<br>
<table width="723" cellpadding="0" cellspacing="0" class="f12 m-left">
	<tr>
    	<td width="723" height="40" valign="middle" >
	    	<? if($presupuesto->notas): ?>
				<b>Notas</b><br>
				<?=$presupuesto->notas?>
				<br><br>
            <? endif; ?>
            
            <? if($presupuesto->terminos): ?>
				<b>Términos y condiciones</b><br>
                <?=$presupuesto->terminos?>
            <? endif; ?>
		</td>
	</tr>
</table>



</page>


<?php

	$content_html = ob_get_clean();

	// initialisation de HTML2PDF
	require_once(dirname(__FILE__).'/pdf/html2pdf.class.php');
	try
	{
		$html2pdf = new HTML2PDF('P','letter','es', true, 'UTF-8', array(2, 0, 0, 0));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		
		$html2pdf->addFont("sf");
		$html2pdf->addFont("sfsemi");
		//$html2pdf = new HTML2PDF('L','A4','es', false, 'utf-8', array(0, 0, 0, 0));
		$html2pdf->writeHTML($content_html, isset($_GET['vuehtml']));
//		$html2pdf->createIndex('Sommaire', 25, 12, false, true, 1);
		$html2pdf->Output('Factura_'.$tfd['UUID'].'.pdf');
	}
	catch(HTML2PDF_exception $e) { echo $e; }

?>