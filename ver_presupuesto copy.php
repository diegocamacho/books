<?
$id_presupuesto=$_GET['id'];
//Sacamos la empresa del presupuesto
$sql="SELECT referencia, fecha, fecha_expira, notas, terminos, ajuste_text, ajuste_monto, facturado, cliente, representante, empresa, direccion, ciudad, books_empresas.estado, codigo_postal, telefono_1, telefono_2, web, logo, books_ventas.estado FROM books_ventas 
JOIN books_usuarios_empresas ON books_usuarios_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_empresas ON books_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_clientes ON books_clientes.id_cliente=books_ventas.id_cliente 
WHERE id_venta=$id_presupuesto AND books_usuarios_empresas.id_usuario=$s_id_usuario";

$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if($valida):
	$presupuesto=mysql_fetch_object($q);
	//$presupuesto->fecha;
	
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
	
	//Estados y tipos
	$estado=$presupuesto->estado;
	
	if($estado<=3){
		if($estado==1){
			$titulo="Presupuesto";
		}elseif($estado==2){
			$titulo="Borrador de Presupuesto";
		}elseif($estado==3){
			$titulo="Presupuesto Cancelado";
		}
	}elseif($estado>3){
		if($estado==4){
			$titulo="Remisión";
		}elseif($estado==5){
			$titulo="Remisión Cancelada";
		}
	}

?>
<style>
.amounts {
    margin-top: 0px;
    font-size: 14px;
    margin-right: 20px;
}
</style>						
<div class="page-head">
    <div class="container">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1><?=$titulo?> </h1>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PAGE TOOLBAR -->
        <div class="page-toolbar">
            
            <button type="button" style="margin-top: 12px;" class="btn red-thunderbird">Convertir en Invoice</button>
            
            <div class="btn-group" style="margin-top: 12px;">
			    <a class="btn blue-chambray dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Opciones
			        <i class="fa fa-angle-down"></i>
			    </a>
			    <ul class="dropdown-menu pull-right">
			        <li>
			            <a href="?Modulo=Presupuesto&id=<?=$id_presupuesto?>"> Editar </a>
			        </li>
			        <li>
			            <a href="?Modulo=Presupuesto&id=<?=$venta->id_venta?>&c=1" > Clonar </a>
			        </li>
			        <li>
			            <? if($presupuesto->estado==1){ ?>
							<a href="javascript:;" onclick="cancelaVenta(<?=$id_presupuesto?>,3)"> Cancelar </a>
						<? }elseif($presupuesto->estado==2){ ?>
							<!-- Borradores -->
							<a href="javascript:;" onclick="cancelaVenta(<?=$id_presupuesto?>,1)"> Convertir en Presupuesto </a>
						<? }elseif($presupuesto->estado==3){ ?>
							<!-- Cancelados -->
							<a href="javascript:;" onclick="cancelaVenta(<?=$id_presupuesto?>,1)"> Reactivar </a>
						<? } ?>
			        </li>
			        <li>
						<a href="data/download.php?id=<?=$id_presupuesto?>" > Descargar PDF </a>
			        </li>
			        <li>
			            <a href="javascript:;" > Envíar por Correo </a>
			        </li>
			        
			    </ul>
			</div>


        </div>
        <!-- END PAGE TOOLBAR -->
    </div>
</div>
							

<div class="page-content">
	<div class="container">	                                
		<div class="page-content-inner">
			
			
<!-- Logs -->	
			<? if($valida_logs): ?>
			<div class="row hidden-print">
				<div class="col-md-12">
					<div class="portlet box grey-mint">
						<div class="portlet-title">
                        	<div class="caption"><i class="fa fa-calendar-o"></i>Historial </div>
							<div class="tools">
								<a href="javascript:;" class="expand" data-original-title="" title="Mostrar historial"> </a>
							</div>
						</div>
                        <div class="portlet-body portlet-collapsed">
							<dl>
								<? foreach($logs as $log): ?>
                                <dt class="uppercase"><?=fechaHoraMeridian($log->fecha_hora)?></dt>
                                <dd style="margin-bottom: 10px;"><?=$log->log?></dd>
                                <? endforeach; ?>
                            </dl>
						</div>
					</div>
				</div>
			</div>
			<? endif; ?>
			
			
			
<!-- Presupuesto -->			
		    <div class="invoice-content-2 ">	    
		        <div class="row invoice-head">
		            <div class="col-md-7 col-xs-6">
		                <div class="invoice-logo">
		                    <p><img style="max-width: 300px;" src="files/<? if($presupuesto->logo){ echo $presupuesto->logo; }else{ echo "tu-logo-min.jpg"; }?>" class="img-responsive <? if(!$presupuesto->logo){?>hidden-print<? } ?>" alt=""  /></p>
		                    <h1 class="uppercase"><?=$titulo?></h1>
		                </div>
		            </div>
		            <div class="col-md-5 col-xs-6">
		                <div class="company-address">
		                    <span class="bold uppercase"><?=$presupuesto->empresa;?>.</span>
		                    <? if($presupuesto->direccion){ echo "<br/>".$presupuesto->direccion; }?>
		                    <? if($presupuesto->direccion){ echo "<br/>".$presupuesto->ciudad; if($presupuesto->estado){ echo ", ".$presupuesto->estado; }}?>
		                    <? if($presupuesto->telefono_1){ echo "<br/><span class='bold'>T</span> ".$presupuesto->telefono_1; }?>
		                    <? if($presupuesto->telefono_2){ echo "<br/><span class='bold'>T</span> ".$presupuesto->telefono_2; }?>
		                    <? if($presupuesto->web){ echo "<br/><span class='bold'>W</span> ".$presupuesto->web; }?>
						</div>
		            </div>
		        </div>
		        <div class="row invoice-cust-add">
		            <div class="col-xs-6">
		                <h2 class="invoice-title uppercase">Cliente</h2>
		                <p class="invoice-desc"><?=$presupuesto->cliente;?>. <? if($presupuesto->representante){ echo "<br>".$presupuesto->representante; }?></p>
		            </div>
		            <div class="col-xs-3">
		                <h2 class="invoice-title uppercase" style="text-align: right">Emisión</h2>
		                <p class="invoice-desc" style="text-align: right"><?=fechaLetra($presupuesto->fecha);?></p>
		            </div>
		            <div class="col-xs-3">
			            <? if($presupuesto->fecha_expira){ ?>
		                <h2 class="invoice-title uppercase" style="text-align: right">Vencimiento</h2>
		                <p class="invoice-desc" style="text-align: right"> <?=fechaLetra($presupuesto->fecha_expira);?></p>
		                <? } ?>
		            </div>
		        </div>
		        <? if($valida_productos): ?>
		        <div class="row invoice-body">
		            <div class="col-xs-12 table-responsive">
		                <table class="table table-hover">
		                    <thead>
		                        <tr>
		                            <th class="invoice-title uppercase">Descripción</th>
		                            <th class="invoice-title uppercase text-center">Cantidad</th>
		                            <th class="invoice-title uppercase text-center">Precio</th>
		                            <? if($valida_descuento>0): ?>
			                            <th class="invoice-title uppercase text-center">Descuento</th>
		                            <? endif; ?>
		                            <th class="invoice-title uppercase text-center">Importe</th>
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
		                        <tr>
		                            <td><?=$producto->producto?></td>
		                            <td class="text-center sbold"><?=number_format($producto->cantidad,2)?></td>
		                            <td class="text-center sbold"><?=number_format($producto->tarifa,2)?></td>
		                            <? if($valida_descuento>0): ?>
			                            <td class="text-center sbold"><?
				                            if($producto->descuento>0):
					                        	echo number_format($producto->descuento,2)."%";
				                            else:
				                            	echo "N/A";
				                            endif; ?>
				                        </td>
		                            <? endif; ?>
		                            <td class="text-right sbold" style="padding-right: 10px;"><?=number_format($subtotal,2)?></td>
		                        </tr>
		                        <? endforeach; ?>
		                    </tbody>
		                </table>
		            </div>
		        </div>
		        <div class="row invoice-subtotal">
			        
			        

                        <div class="col-xs-8">
                            <div class="well">
	                            <? if($presupuesto->notas): ?>
                                <address>
                                    <strong>Notas para el cliente</strong>
                                    <br> <?=$presupuesto->notas?>
                                </address>
                                <? endif; ?>
                                
                                <? if($presupuesto->terminos): ?>
                                <address>
                                    <strong>Términos y condiciones</strong>
                                    <br> <?=$presupuesto->terminos?>
                                </address>
                                <? endif; ?>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <table class="table ">
                                                            
                        	    <tbody>
                        	        <tr>
                        	            <td align="right"> SUBTOTAL: </td>
                        	            <td align="right"> <?=number_format($totales,2)?> </td>
                        	        </tr>
                        	        <tr>
                        	            <td align="right"> IVA: </td>
                        	            <td align="right"> <?=number_format($ivas,2)?> </td>
                        	        </tr>
                        	        <tr>
                        	            <td align="right"> <?=$presupuesto->ajuste_text?> </td>
                        	            <td align="right"> <?=number_format($presupuesto->ajuste_monto,2)?> </td>
                        	        </tr>
                        	        <tr>
                        	            <td align="right"> TOTAL: </td>
                        	            <td align="right"> <?=number_format($macizo,2)?> </td>
                        	        </tr>
                        	    </tbody>
                        	    
                        	</table>
                        </div>

                    
                    
		        </div>
		        <? endif; ?>
		        <div class="row">
		            <div class="col-xs-12" style="text-align: right">
			            <a role="button" class="btn hidden-print btn-default btn-outline " href="javascript:history.back(1)">Regresar</a>&nbsp;&nbsp;
		                <a class="btn hidden-print red-thunderbird btn-outline" onclick="javascript:window.print();">Imprimir</a>
		                
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>

<script>
function cancelaVenta(id_venta,estado){
	if(estado==1){
		var msg="Reactivar Presupuesto";
		var ms2="El presupuesto se ha reactivado";
		var txt="¿Estas seguro que deaseas reactivar el presupuesto?";
		var btn="Si, Reactivar";
	}else if(estado==3){
		var msg="Cancelar Presupuesto";
		var ms2="El presupuesto se ha cancelado";
		var txt="¿Estas seguro de cancelar el presupuesto?";
		var btn="Si, Cancelar";
	}else if(estado==5){
		var msg="Cancelar Remisión";
		var ms2="La remisión se ha cancelado";
		var txt="¿Estas seguro de cancelar la remisión?";
		var btn="Si, Cancelar";
	}	
	swal({
		title: msg,
		text: txt,
		type: "info",
		confirmButtonText: btn,
		cancelButtonText: "No",
		showCancelButton: true,
		closeOnConfirm: false,
		showLoaderOnConfirm: true
	},function(){
		$.post('ac/venta.php',{ id_venta: id_venta, estado:estado },function(data){
			console.log(data);

			if(data==1){
				swal({
				title: ms2,
				type: "success",
				confirmButtonText: "Ok",
				}, function () {
					location.reload();
				});
			}else{
				swal("Ocurrió un error", data, "error");
			}
		});
	});
}
function clonaVenta(id_venta){
	//App.blockUI();
	$('#msg_error').hide('Fast');
	$.getJSON('data/clona.php',{ id_venta:id_venta },function(data) {
			console.log(data);
			if(data.respuesta==1){
				window.open("?Modulo=Presupuesto&id="+data.id_presupuesto, "_self");
	    	}else{
				$('#msg_error').html(data.mensaje);
				$('#msg_error').show('Fast');
				//App.unblockUI();
			}
	});
	
}	
</script>


<? else: ?>


<div class="page-content">
	<div class="container"> 
		<div class="page-content-inner">
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-dismissable alert-warning"><p>Oooops, algo ocurrió, intenta nuevamente.</p></div>
				</div>
			</div>		  
		</div>	
	</div>
</div>

<? endif; ?>