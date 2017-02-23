<?
$sql="SELECT id_cliente,cliente FROM books_clientes WHERE activo=1";
$q=mysql_query($sql);
$clientes = array();
while($datos=mysql_fetch_object($q)):
	$clientes[] = $datos;
endwhile;

$sql="SELECT id_empresa,empresa FROM books_empresas WHERE activo=1";
$q=mysql_query($sql);
$empresas = array();
while($datos=mysql_fetch_object($q)):
	$empresas[] = $datos;
endwhile;
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
<!--<h3>Dentista Books</h3>-->
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

						<div class="form-body">
			                
			                <form id="frm_guarda" class="form-horizontal">
				            
				            <div class="form-group">
								<label for="id_cliente" class="col-md-2 control-label">Empresa emisora</label>
								<div class="col-md-6">
									<select class="form-control select2" name="id_cliente" id="id_cliente" >
										<option value="0" >Seleccione</option>
										<? foreach($empresas as $empresa): ?>
										<option value="<?=$empresa->id_empresa?>"><?=$empresa->empresa?></option>
										<? endforeach; ?>
									</select>
								</div>
							</div>
							<hr>
							<div class="form-group">
								<label for="id_cliente" class="col-md-2 control-label">Seleccione el cliente</label>
								<div class="col-md-6">
									<select class="form-control select2" name="id_cliente" id="id_cliente" >
										<option value="0" >Seleccione</option>
										<? foreach($clientes as $cliente): ?>
										<option value="<?=$cliente->id_cliente?>"><?=$cliente->cliente?></option>
										<? endforeach; ?>
										<option value="NUEVO">NUEVO CLIENTE</option>
									</select>
								</div>
							</div>
							
							<hr>

							<div class="form-group">
								<label for="nombre" class="col-md-2 control-label">Referencia</label>
								<div class="col-md-4">
									<input type="text" maxlength="64" class="form-control dat" name="nombre" autocomplete="off">
								</div>
							</div>
							
							<div class="form-group">
								<label for="nombre" class="col-md-2 control-label">Fecha del presupuesto</label>
								<div class="col-md-4">
									<input type="text" maxlength="64" class="form-control dat " name="nombre" autocomplete="off" id="fecha">
								</div>
							</div>
						
							<div class="form-group">
								<label for="nombre" class="col-md-2 control-label">Fecha de vencimiento</label>
								<div class="col-md-4">
									<input type="text" maxlength="64" class="form-control dat" name="nombre" autocomplete="off" id="fecha_final">
								</div>
							</div>
			                </form>
			                
			                
							<hr>
							<form id="frm_guarda" class="form">
							<table class="table table-hover table-light">
        					    <thead>
        					        <th>Detalles del artículo</th>
        					        <th style="text-align: right" width="50">Cantidad</th>
        					        <th style="text-align: right" width="140">Tarifa</th>
        					        <th style="text-align: right" width="100">Descuento</th>
        					        <th style="width: 115px;">Impuesto</th>
        					        <th style="width: 150px; text-align: right">Importe</th>
        					        <th style="width: 30px; text-align: right">&nbsp;</th>
        					    </thead>
        					    <tbody id="tabla_productos">
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
	        					            <select class="bs-select form-control impuesto_1" data-width="95px" name="impuesto[1]" onchange="keyup_total_conceptos();">
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
        					    </tbody>
        					</table>
        					
        					<hr>
        					<div class="row">
        						<div class="col-md-6">
	        						<a role="button" class="btn blue-chambray btn-outline" onclick="agregaProducto()">Agregar otra línea</a>
	        						<div class="well" style="margin-top: 20px;">
		        						
		        						<div class="form-group">
											<label for="exampleInputEmail1">Notas para el cliente</label>
											<textarea class="form-control control-ajuste autosizeme" name="producto" id="producto" autocomplete="off" rows="2"></textarea>
										</div>
										
										<div class="form-group">
											<label for="exampleInputEmail1">Términos y condiciones</label>
											<textarea class="form-control control-ajuste autosizeme" name="producto" id="producto" autocomplete="off" rows="2"></textarea>
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
	                                            <input type="text" class="form-control cantidades pull-right control-ajuste" name="ajuste_texto" autocomplete="off" id="ajuste_texto" value="Ajuste" style="width: 100px;" maxlength="18"/> </div>
                                            <div class="col-md-3 value" style="padding-right: 2px;"> 
	                                            <i class="fa fa-info-circle popovers" style="margin: 10px 8px 0px 0px" data-container="body" data-trigger="hover" data-placement="top" data-content="Añada cualquier cargo positivo o negativo que se deba aplicar para ajustar el importe total de la factura, por ejemplo, +10 o -10." ></i>
	                                            <input type="text" class="form-control cantidades numero pull-right control-ajuste" name="ajuste" autocomplete="off" id="ajuste" maxlength="10" style="width: 80px;" value="0.00" onkeyup="keyup_total_conceptos()"/> 
	                                        </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Total ( MXN ): </div>
                                            <div class="col-md-3 value" id="muestra_total"> 0.00 </div>
                                        </div>
                                    </div>
                                    <div class="row">
	                                    <div class="col-md-12" style="text-align: right;margin-top: 28px;">
											<a role="button" class="btn btn-default btn-outline ">Guardar como borrador</a>&nbsp;&nbsp;

											<a role="button" class="btn red-thunderbird btn-outline ">Guardar y enviar</a>&nbsp;&nbsp;

											<a role="button" class="btn btn-default btn-outline ">Cancelar</a>
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
<script>
function total_conceptos(){
	
	var totales = 0;
	var ivas = 0;
	var macizo = 0;
	$('.cantidad').each(function() {
	
		var cantidad 	= $(this).val();
		var myid 		= $(this).attr('id');
		var p_unit		= $('.tarifa_'+myid).val();
		var desc		= Number($('.descuento_'+myid).val());
		var impuesto	= $('.impuesto_'+myid).selectpicker('val');
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
				
		$('.importe_'+myid).val(subtotal);
		
		totales+=Number(subtotal);
		macizo=totales+ivas;
		
		if(ajuste){
			macizo = (macizo)(ajuste);
		}
		
	});
	
	$('#muestra_subtotal').html(totales.toFixed(2));
	$('#muestra_impuesto').html(ivas.toFixed(2));
	$('#muestra_total').html(macizo.toFixed(2));
	
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
		html+='<select class="bs-select form-control impuesto_'+random+'" data-width="95px" name="impuesto[]" onchange="keyup_total_conceptos();">';
		html+='<option>&nbsp;</option>';
		html+='<option value="16">IVA 16%</option>';
		html+='</select>';
	html+='</td>';
	html+='<td valign="top" style="vertical-align: top;"><input type="text" class="form-control cantidades numero importe_'+random+'" name="importe[]" autocomplete="off" id="importe" readonly="1"/></td>';
	html+='<td align="right" valign="top" style="vertical-align: top;"><a role="button" class="btn btn-danger btn-xs" onclick="remover('+random+')" style="margin-top: 6px;"><i class="fa fa-remove"></i></a></td>';
	html+='</tr>';
						
	$('#tabla_productos').append(html);
		
}

$(function(){
	
	$('#fecha').datepicker({
	    format: 'dd/mm/yyyy',
	    autoclose: true,
	    todayHighlight: true,
	    language: 'es'
	});
	$('#fecha_final').datepicker({
	    format: 'dd/mm/yyyy',
	    autoclose: true,
	    language: 'es'
	});
});

autosize(document.querySelectorAll('textarea'));
</script>