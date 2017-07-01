<?
$sql="SELECT id_cliente,cliente FROM books_clientes WHERE activo=1";
$q=mysql_query($sql);
$clientes = array();
while($datos=mysql_fetch_object($q)):
	$clientes[] = $datos;
endwhile;
/*
$sql="SELECT id_empresa,empresa FROM books_empresas WHERE activo=1";
$q=mysql_query($sql);
$empresas = array();
while($datos=mysql_fetch_object($q)):
	$empresas[] = $datos;
endwhile;
*/
if($_GET['id']):

	$id_presupuesto=$_GET['id'];
	
	$sql="SELECT * FROM books_ventas WHERE id_venta=$id_presupuesto";
	$q=mysql_query($sql);
	$ft=mysql_fetch_assoc($q);
	$id_empresa=$ft['id_empresa'];
	$id_cliente=$ft['id_cliente'];
	$referencia=$ft['referencia'];
	$fecha=$ft['fecha'];
	$fecha_expira=$ft['fecha_expira'];
	$notas=$ft['notas'];
	$terminos=$ft['terminos'];
	$ajuste_text=$ft['ajuste_text'];
	$ajuste_monto=$ft['ajuste_monto'];
	
	$sql="SELECT * FROM books_ventas_producto WHERE id_venta=$id_presupuesto";
	$q=mysql_query($sql);
	$productos=array();
	while($datos=mysql_fetch_object($q)):
		$productos[] = $datos;
	endwhile;
	$valida_productos=count($productos);
	
	
	//Validamos si el usuario tiene permiso para modificar este presupuesto
	$sql="SELECT * FROM books_usuarios_empresas WHERE id_usuario=$s_id_usuario AND id_empresa=$id_empresa";
	$q=mysql_query($sql);
	$valida=mysql_num_rows($q);
	
endif;

if(($id_presupuesto)&&(!$valida)):
	echo '<div class="page-content">
			<div class="container"> 
				<div class="page-content-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="alert alert-dismissable alert-warning"><p>Oooops, algo ocurrió, intenta nuevamente.</p></div>
						</div>
					</div>		  
				</div>	
			</div>
		</div>';
else:
?>
<style>
.oculto{
	display: none;
}
.link{
	cursor: pointer;
}
.cantidades{
	text-align: right;
}
.control-ajuste{
	background-color: #f7f8fa;
}
</style>
<div class="page-content">
	<div class="container">    
		<div class="page-content-inner">
			<div class="row">
				<div class="col-md-12">
			        <!-- BEGIN BORDERED TABLE PORTLET-->
			        <div class="portlet light portlet-fit ">
			            <div class="portlet-title">
			                <div class="caption">
			                    <i class="icon-doc font-dark"></i>
			                    <span class="caption-subject font-dark sbold uppercase">Presupuesto (Cotización)</span>
			                </div>
			                <div class="actions">
				                
			                    <!--<a href="#" class="btn btn-sm blue-chambray "><i class="fa fa-plus"></i> Cancelar </a>-->
			                    
			                </div>
			            </div>
			            <div class="portlet-body">
								<div class="alert alert-danger oculto" role="alert" id="msg_error"></div>
								<div class="form-body">
					                
					                <form id="frm-datos" class="form-horizontal">
						            <!--
						            <div class="form-group">
										<label for="id_cliente" class="col-md-2 control-label">Empresa emisora</label>
										<div class="col-md-6">
											<select class="form-control select2" name="id_empresa" id="id_empresa" >
												<option value="0" >Seleccione</option>
												<? foreach($empresas as $empresa): ?>
												<option <? if($id_empresa==$empresa->id_empresa):?>selected="1"<? endif; ?> value="<?=$empresa->id_empresa?>"><?=$empresa->empresa?></option>
												<? endforeach; ?>
											</select>
										</div>
									</div>
									<hr>
									-->
									<div class="form-group">
										<label for="id_cliente" class="col-md-2 control-label">Seleccione el cliente</label>
										<div class="col-md-6">
											<select class="form-control select2" name="id_cliente" id="id_cliente" >
												<option value="0" >Seleccione</option>
												<? foreach($clientes as $cliente): ?>
												<option <? if($id_cliente==$cliente->id_cliente):?>selected="1"<? endif; ?> value="<?=$cliente->id_cliente?>"><?=$cliente->cliente?></option>
												<? endforeach; ?>
												<!--<option value="NUEVO">NUEVO CLIENTE</option>-->
											</select>
										</div>
									</div>
									
									<hr>
		<!--
									<div class="form-group">
										<label for="nombre" class="col-md-2 control-label">Referencia</label>
										<div class="col-md-4">
											<input type="text" maxlength="64" class="form-control dat" name="referencia" autocomplete="off" value="<?=$referencia?>">
										</div>
									</div>
		-->
									<div class="form-group">
										<label for="nombre" class="col-md-2 control-label">Fecha del presupuesto</label>
										<div class="col-md-4">
											<input type="text" maxlength="64" class="form-control dat " name="fecha" autocomplete="off" id="fecha" <? if($fecha): ?>value="<?=fechaDeBase($fecha)?>" <?endif;?>>
										</div>
									</div>
								
									<div class="form-group">
										<label for="nombre" class="col-md-2 control-label">Fecha de vencimiento</label>
										<div class="col-md-4">
											<input type="text" maxlength="64" class="form-control dat" name="fecha_expira" autocomplete="off" id="fecha_expira" <? if($fecha_expira): ?>value="<?=fechaDeBase($fecha_expira)?>" <?endif;?>>
										</div>
									</div>
					                </form>
					                
					                
									<hr>
									<form id="frm-productos" class="form">
									<table class="table table-hover table-light">
		        					    <thead>
		        					        <th>Descripción</th>
		        					        <th style="text-align: right" width="50">Cantidad</th>
		        					        <th style="text-align: right" width="140">Tarifa</th>
		        					        <th style="text-align: right" width="100">Descuento</th>
		        					        <th style="width: 115px;">Impuesto</th>
		        					        <th style="width: 150px; text-align: right">Importe</th>
		        					        <th style="width: 30px; text-align: right">&nbsp;</th>
		        					    </thead>
		        					    <tbody id="tabla_productos">
			        					    <? if($valida_productos): ?>
			        					    <? foreach($productos as $producto): ?>
			        					    <tr class="row_<?=$producto->id_presupuesto_producto?>">
		        					            <td valign="top" style="vertical-align:top;">
			        					            <textarea class="form-control autosizeme" name="producto[<?=$producto->id_presupuesto_producto?>]" id="producto" autocomplete="off" rows="1"><?=$producto->producto?></textarea>
			        					        </td>
		        					            <td valign="top" style="vertical-align:top;">
			        					            <input type="text" class="form-control cantidades numero cantidad" name="cantidad[<?=$producto->id_presupuesto_producto?>]" autocomplete="off" id="<?=$producto->id_presupuesto_producto?>"  maxlength="10" onkeyup="keyup_total_conceptos();" value="<?=number_format($producto->cantidad, 2, '.', '')?>"/>
			        					        </td>
		        					            <td valign="top" style="vertical-align: top;">
			        					            <input type="text" class="form-control cantidades numero tarifa_<?=$producto->id_presupuesto_producto?>" name="tarifa[<?=$producto->id_presupuesto_producto?>]" autocomplete="off" id="tarifa"  onkeyup="keyup_total_conceptos();"  value="<?=number_format($producto->tarifa, 2, '.', '')?>"/>
			        					        </td>
		        					            <td align="right" valign="top" style="vertical-align: top;">
													<div class="input-group">
														<input type="text" class="form-control cantidades numero descuento_<?=$producto->id_presupuesto_producto?>" name="descuento[<?=$producto->id_presupuesto_producto?>]" id="descuento" autocomplete="off" maxlength="5" onkeyup="keyup_total_conceptos();"  value="<?=number_format($producto->descuento, 0, '.', '')?>">
														<div class="input-group-addon">%</div>
													</div>
		        					            </td>
		        					            <td valign="top" style="vertical-align: top;">
			        					            <select class=" form-control impuesto_<?=$producto->id_presupuesto_producto?>" data-width="95px" name="impuesto[<?=$producto->id_presupuesto_producto?>]" onchange="keyup_total_conceptos();">
				        					            <option>&nbsp;</option>
		                                            	<option <? if($producto->impuesto=="16.0000"): ?>selected="1" <? endif; ?> value="16">IVA 16%</option>
		                                            </select>
		                                        </td>
		        					            <td valign="top" style="vertical-align: top;">
			        					            <input type="text" class="form-control cantidades numero importe_<?=$producto->id_presupuesto_producto?>" name="importe[<?=$producto->id_presupuesto_producto?>]" autocomplete="off" id="importe" readonly="1"  value="<?=$producto->importe?>"/>
			        					        </td>
		        					            <td align="right" valign="top" style="vertical-align: top;">
			        					            <a role="button" class="btn btn-danger btn-xs" onclick="remover()" style="margin-top: 6px;"><i class="fa fa-remove"></i></a>
		        					            </td>
		        					        </tr>
		        					        <? endforeach; ?>
			        					    <? else: ?>
		        					        <tr class="row_1">
		        					            <td valign="top" style="vertical-align:top;">
			        					            <textarea class="form-control autosizeme" name="producto[1]" id="producto" autocomplete="off" rows="1"></textarea>
			        					        </td>
		        					            <td valign="top" style="vertical-align:top;">
			        					            <input type="text" class="form-control cantidades numero cantidad" name="cantidad[1]" autocomplete="off" id="1"  maxlength="10" onkeyup="keyup_total_conceptos();"/>
			        					        </td>
		        					            <td valign="top" style="vertical-align: top;">
			        					            <input type="text" class="form-control cantidades numero tarifa_1" name="tarifa[1]" autocomplete="off" id="tarifa"  maxlength="10" onkeyup="keyup_total_conceptos();"/>
			        					        </td>
		        					            <td align="right" valign="top" style="vertical-align: top;">
													<div class="input-group">
														<input type="text" class="form-control cantidades numero descuento_1" name="descuento[1]" id="descuento" autocomplete="off" maxlength="3" onkeyup="keyup_total_conceptos();">
														<div class="input-group-addon">%</div>
													</div>
		        					            </td>
		        					            <td valign="top" style="vertical-align: top;">
			        					            <select class=" form-control impuesto_1" data-width="95px" name="impuesto[1]" onchange="keyup_total_conceptos();">
				        					            <option>&nbsp;</option>
		                                            	<option value="16">IVA 16%</option>
		                                            </select>
		                                        </td>
		        					            <td valign="top" style="vertical-align: top;">
			        					            <input type="text" class="form-control cantidades numero importe_1" name="importe[1]" autocomplete="off" id="importe" readonly="1"/>
			        					        </td>
		        					            <td align="right" valign="top" style="vertical-align: top;">
			        					            <a role="button" class="btn btn-danger btn-xs" onclick="remover()" style="margin-top: 6px;"><i class="fa fa-remove"></i></a>
		        					            </td>
		        					        </tr>
		        					        <? endif; ?>
		        					    </tbody>
		        					</table>
		        					
		        					<hr>
		        					<div class="row">
		        						<div class="col-md-6">
			        						<a role="button" class="btn blue-chambray btn-outline" onclick="agregaProducto()">Agregar otra línea</a>
			        						<div class="well" style="margin-top: 20px;">
				        						
				        						<div class="form-group">
													<label for="exampleInputEmail1">Notas para el cliente</label>
													<textarea class="form-control control-ajuste autosizeme" name="notas" id="notas" autocomplete="off" rows="2"><?=$notas?></textarea>
												</div>
												
												<div class="form-group">
													<label for="exampleInputEmail1">Términos y condiciones</label>
													<textarea class="form-control control-ajuste autosizeme" name="terminos" id="terminos" autocomplete="off" rows="2"><?=$terminos?></textarea>
												</div>
												
			        						</div>
		        						</div>
		        						<div class="col-md-6">
			        						<div class="well">
				        						<hr style="border-top: 1.5px dashed #333;margin-top: 0px;">
		                                        <div class="row static-info align-reverse">
		                                            <div class="col-md-8 name"> Sub Total: </div>
		                                            <div class="col-md-3 value" id="muestra_subtotal"> 0.00 </div>
		                                        </div>
		                                        <div class="row static-info align-reverse">
		                                            <div class="col-md-8 name"> IVA: </div>
		                                            <div class="col-md-3 value" id="muestra_impuesto"> 0.00 </div>
		                                        </div>
		                                        <div class="row static-info align-reverse">
		                                            <div class="col-md-8 name"> 
			                                            <input type="text" class="form-control cantidades pull-right control-ajuste" name="ajuste_texto" autocomplete="off" id="ajuste_texto" <? if($ajuste_text):?> value="<?=$ajuste_text?>" <? else: ?> value="Ajuste" <? endif;?> style="width: 100px;" maxlength="18"/> </div>
		                                            <div class="col-md-3 value" style="padding-right: 2px;"> 
			                                            <i class="fa fa-info-circle popovers" style="margin: 10px 8px 0px 0px" data-container="body" data-trigger="hover" data-placement="top" data-content="Añada cualquier cargo positivo o negativo que se deba aplicar para ajustar el importe total de la factura, por ejemplo, +10 o -10." ></i>
			                                            <input type="text" class="form-control cantidades numero pull-right control-ajuste" name="ajuste_monto" autocomplete="off" id="ajuste" maxlength="10" style="width: 80px;" <? if($ajuste_monto): ?> value="<?=$ajuste_monto?>" <? else: ?> value="0.00" <? endif; ?> onkeyup="keyup_total_conceptos()"/> 
			                                        </div>
		                                        </div>
		                                        <div class="row static-info align-reverse">
		                                            <div class="col-md-8 name"> Total ( MXN ): </div>
		                                            <div class="col-md-3 value" id="muestra_total"> 0.00 </div>
		                                        </div>
		                                    </div>
		                                    <div class="row">
			                                    <div class="col-md-12" style="text-align: right;margin-top: 28px;">
													<a role="button" class="btn btn-default btn-outline hide" onclick="guardaPresupuesto(borrador)">Guardar como borrador</a>&nbsp;&nbsp;
		
													<a role="button" class="btn red-thunderbird btn-outline " onclick="guardaPresupuesto()">Guardar</a>&nbsp;&nbsp;
		
													<a role="button" class="btn btn-default btn-outline " href="javascript:history.back(1)">Cancelar</a>
												</div>
		        						</div>
		        					</div>
		
		        					</form>
		        					
								</div>
		        					
								</div>
			            </div>
			            
			        </div>
			        <!-- END BORDERED TABLE PORTLET-->
			    </div>
			</div>
		</div>
	</div>
</div>

<script>
<? if($id_presupuesto): ?>
	total_conceptos();
<? endif; ?>
function total_conceptos(){
	
	var totales = 0;
	var ivas = 0;
	var macizo = 0;
	$('.cantidad').each(function() {
	
		var cantidad 	= $(this).val();
		var myid 		= $(this).attr('id');
		var p_unit		= $('.tarifa_'+myid).val();
		var desc		= Number($('.descuento_'+myid).val());
		var impuesto	= $('.impuesto_'+myid).val();
		var porcentaje	= desc/100;
		var subtotal	= Number(cantidad)*Number(p_unit);
		var ajuste		= Number($('#ajuste').val());
		if(desc>0){
			var monto_descuento = subtotal*Number(porcentaje);
			var subtotal = subtotal-monto_descuento;
		}
		
		if(impuesto){

			var iva	= impuesto/100;
			var monto_impuesto = subtotal*Number(iva);
			//var subtotal=subtotal+monto_impuesto;
			
			ivas+=Number(monto_impuesto);
		}
				
		$('.importe_'+myid).val(subtotal.toFixed(2));
		
		totales+=Number(subtotal);
		macizo=totales+ivas;
		
		if(ajuste){
			macizo = macizo+ajuste;
		}
		
	});
	totales=numeral(totales).format('0,0.00');
	ivas=numeral(ivas).format('0,0.00');
	macizo=numeral(macizo).format('0,0.00');

	$('#muestra_subtotal').html(totales);
	$('#muestra_impuesto').html(ivas);
	$('#muestra_total').html(macizo);
	
}

function keyup_total_conceptos(){
	
	total_conceptos();
	
}

function agregaProducto(){

	var random = new Date().getTime();	
	var html = '';	
		
	html+='<tr class="row_'+random+'">';
	html+='<td valign="top" style="vertical-align:top;"><textarea class="form-control autosizeme" name="producto[]" id="producto" autocomplete="off" rows="1"></textarea></td>';
	html+='<td valign="top" style="vertical-align:top;"><input type="text" class="form-control cantidades numero cantidad" name="cantidad[]" autocomplete="off" id="'+random+'"  maxlength="10" onkeyup="keyup_total_conceptos();"/></td>';
	html+='<td valign="top" style="vertical-align: top;"><input type="text" class="form-control cantidades numero tarifa_'+random+'" name="tarifa[]" autocomplete="off" id="tarifa"  maxlength="10" onkeyup="keyup_total_conceptos();"/></td>';
	html+='<td align="right" valign="top" style="vertical-align: top;">';
		html+='<div class="input-group">';
		html+='<input type="text" class="form-control cantidades numero descuento_'+random+'" name="descuento[]" id="descuento" autocomplete="off" maxlength="3" onkeyup="keyup_total_conceptos();">';
		html+='<div class="input-group-addon">%</div>';
		html+='</div>';
	html+='</td>';
	html+='<td valign="top" style="vertical-align: top;">';
		html+='<select class=" form-control impuesto_'+random+'" data-width="95px" name="impuesto[]" onchange="keyup_total_conceptos();">';
		html+='<option>&nbsp;</option>';
		html+='<option value="16">IVA 16%</option>';
		html+='</select>';
	html+='</td>';
	html+='<td valign="top" style="vertical-align: top;"><input type="text" class="form-control cantidades numero importe_'+random+'" name="importe[]" autocomplete="off" id="importe" readonly="1"/></td>';
	html+='<td align="right" valign="top" style="vertical-align: top;"><a role="button" class="btn btn-danger btn-xs" onclick="remover('+random+')" style="margin-top: 6px;"><i class="fa fa-remove"></i></a></td>';
	html+='</tr>';
						
	$('#tabla_productos').append(html);
		
}

function guardaPresupuesto(){
	//App.blockUI();
	$('#msg_error').hide('Fast');
	var datos=$('#frm-datos').serialize()+"&"+$('#frm-productos').serialize();
	<? if($id_presupuesto): ?>
	$.getJSON('ac/edita_presupuesto.php',datos,function(data) {
	<? else: ?>
	$.getJSON('ac/nuevo_presupuesto.php',datos,function(data) {
	<? endif; ?>
			console.log(data);
			if(data.respuesta==1){
				window.open("?Modulo=VerPresupuesto&id="+data.id_presupuesto, "_self");
	    	}else{
				$('#msg_error').html(data.mensaje);
				$('#msg_error').show('Fast');
				//App.unblockUI();
			}
	});
	
}

$(function(){
	
	$('#fecha').datepicker({
	    format: 'dd/mm/yyyy',
	    autoclose: true,
	    todayHighlight: true,
	    language: 'es'
	});
	$('#fecha_expira').datepicker({
	    format: 'dd/mm/yyyy',
	    autoclose: true,
	    language: 'es'
	});
});

autosize(document.querySelectorAll('textarea'));
</script>
<? endif; ?>