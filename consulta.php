<?
	if($_GET['id']):
		$id_cita=$_GET['id'];
		$sql="SELECT * FROM citas
		JOIN pacientes ON pacientes.id_paciente=citas.id_paciente
		WHERE id_cita=$id_cita AND citas.atendida = 0";
		$q=mysql_query($sql);
		$ft=mysql_fetch_assoc($q);
		
		$n = mysql_num_rows($q);
		if(!$n) exit('No existe la cita.');

		$nombre=$ft['nombre'];
		$telefono=$ft['telefono'];
		$email=$ft['email'];
		$id_paciente=$ft['id_paciente'];
		$comentario = $ft['comentario'];
		$id_clinica = $ft['id_clinica'];
		
		$comentario = (!$comentario) ? 'N/A' : $comentario;
		
	else:
		$id_cita=0;
	endif;
$sql="SELECT * FROM tratamientos ORDER BY tratamiento ASC";
$q=mysql_query($sql);
$tratamientos = array();
while($datos=mysql_fetch_object($q)):
	$tratamientos[] = $datos;
endwhile;

//Metódo de pago
$sql="SELECT * FROM books_metodo_pago WHERE activo=1 ORDER BY metodo_pago  ASC";
$q=mysql_query($sql);

$metodo_pago = array();

while($datos=mysql_fetch_object($q)):
	$metodo_pago[] = $datos;
endwhile;

?>
<style>
.foto{
	height: 150px;
	max-width: 240px;
}	
.titulo_producto{
	margin-top: 5px;
	display: block;
}

.color {
background:#ffffda;
-webkit-transition:background 1s;
-moz-transition:background 1s;
-o-transition:background 1s;
transition:background 1s
}

.color2 {
background:white;
-webkit-transition:background 2s;
-moz-transition:background 2s;
-o-transition:background 2s;
transition:background 2s
}
.ocultar{
	display: none;
}
</style>
<script src="assets/jquery.alphanumeric.js" type="text/javascript"></script>
<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-briefcase font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Consulta</span>
                    </div>
                    
                    <div class="actions">
						<a href="?Modulo=Citas" class="btn btn-circle red-thunderbird"> Regresar / Salir</a>
                    </div>
                </div>
                <div class="portlet-body">
	                
	                
	                
                    <div class="row">
<!-- Datos del paciente -->	                    
						<div class="col-md-12">
								<div class="portlet box green">
                            	    <div class="portlet-title">
                            	        <div class="caption">Información del Paciente </div>
                            	    </div>
                            	    <div class="portlet-body">
	                        	        
										<div class="form-body" style="margin-top: 20px;">
								
                            			    <form id="frm_datos" class="form-horizontal" role="form" onsubmit="return false">
			
												<div class="row">
													<div class="col-md-6">
<div class="form-group">
													<label for="nombre" class="col-md-2 control-label" style="text-align: left;">Nombre:</label>
													<div class="col-md-10">
														<input type="text" maxlength="128" class="form-control dat" name="nombre" id="nuevo_nombre" value="<?=$nombre?>" autocomplete="off">
													</div>
												</div>
			
												<div class="form-group">
													<label for="telefono" class="col-md-2 control-label" style="text-align: left;">Teléfono:</label>
													<div class="col-md-10">
														<input type="text" maxlength="10" class="form-control dat" name="telefono" value="<?=$telefono?>" autocomplete="off">
													</div>
												</div>
												
												<div class="form-group">
													<label for="direccion" class="col-md-2 control-label" style="text-align: left;">Email:</label>
													<div class="col-md-10">
														<input type="text" maxlength="92" class="form-control dat" name="email" value="<?=$email?>" autocomplete="off">
													</div>
												</div>

													</div>
													<div class="col-md-6">
														<div class="form-group">
															<div class="col-md-12">
																<span class="control-label" style="border:0"> Observaciones: <?=$comentario?></span>

															</div>
														</div>
													</div>

													
												</div>
												<input type="hidden" name="id_cita" value="<?=$id_cita?>" />
												<input type="hidden" name="id_paciente" value="<?=$id_paciente?>" />
												<input type="hidden" name="id_clinica" value="<?=$id_clinica?>" />
											</form>
											
										</div>

                            	    </div>
                            	</div>
                            	
						</div>
<!-- select de servicios -->						
						<div class="col-md-4">
							<form id="frm_cabecera" role="form"  onsubmit="return false">
								<div class="portlet box blue-madison">
                            	    <div class="portlet-title">
                            	        <div class="caption">
                            	           Agregar tratamiento </div>
                            	    </div>
                            	    <div class="portlet-body ">
	                        	        
										<div class="form-body">
								
                            			    <div class="form-group">
                            			        <label for="id_tratamiento" class="control-label cantidad_label">Cantidad</label>
                            			        <input type="text" class="form-control numerico" name="cantidad_producto" id="cantidad_producto" placeholder="Ingrese Cantidad" value="1" autocomplete="off" maxlength="6" />
                            			    </div>
											
											<div class="form-group">
                            			        <label for="id_tratamiento" class="control-label producto_label">Seleccione tratamiento</label>
                            			        <select id="id_tratamiento" name="id_tratamiento" class="form-control select2">
	                        	    	            <option></option>
                            			            <? foreach($tratamientos as $tratamiento): ?>
                            			            <option value="<?=$tratamiento->id_tratamiento?>" data-precio="<?=$tratamiento->costo?>"><?=$tratamiento->tratamiento?></option>
													<? endforeach; ?>
                            			        </select>
                            			    </div>
											
										</div>
										
										<hr>
										<div class="form-actions text-right">
											<img src="assets/global/img/loading-spinner-grey.gif" style="display:none" class="loader">
											<a role="button" class="btn default boton_agregar" onclick="agregaProducto();">Agregar</a>
										</div>

                            	    </div>
                            	</div>
                            	
                            </form>
						</div>
						

<!-- Tabla se servicios agregados -->						
						<div class="col-md-8">
							<div class="alert alert-danger" style="display: none;" role="alert" id="msg_error"></div>
							<div class="portlet box blue-madison ac_guarda_solicitud">
                                <div class="portlet-title">
                                    <div class="caption">Tratamientos </div>
                                </div>
                                <div class="portlet-body">
	                                <form id="frm_productos">
		                                <div class="text-center ocultar2">
			                                <p><br/><span>Agregue tratamientos.</span></p>
		                                </div>
                                    	<table class="table table-striped table-hover" id="tabla" style="display:none">
                                    	    <thead>
                                    	        <tr>
                                    	            <th width="50"> Cantidad </th>
                                    	            <th> Tratamiento </th>
                                    	            <th width="120" style="text-align: right;">Precio Unitario</th>
                                    	            <th width="120" style="text-align: right;">Sub Total</th>

                                    	            <th width="50"> </th>
                                    	        </tr>
                                    	    </thead>
                                    	    <tbody id="agrega_producto">
	                                    	    <tr>
													<td></td>
													<td align="right"></td>
													<td align="right"> Total: </td>
													<td align="right"><input type="text" class="subtotal_total numerico form-control input-sm" readonly="1" name="subtotal" id="subtotal_conceptos" value="" /> </td>

													<td align="right"></td>
												</tr>
                                    	    </tbody>
                                    	</table>
                                    	<hr class="ocultar">
                                    	
                                    	<div class="form-group ocultar">
                            				<label for="id_metodo_pago" class="control-label">Método de pago</label>
											<select class="form-control" name="id_metodo_pago" id="id_metodo_pago" >
												<option value="0">Seleccione uno</option>
												<? foreach($metodo_pago as $metodo): ?>
												<option value="<?=$metodo->id_metodo_pago?>"><?=$metodo->metodo_pago?></option>
												<? endforeach; ?>
											</select>	
                            			</div>
                            			
                            			<div class="form-group" id="digita_cuenta" style="display: none;">
                            			    <label for="id_tratamiento" class="control-label cantidad_label">Últimos 4 dígitos de tarjeta o cuenta (opcional)</label>
											<input type="text" class="form-control numerico" name="num_cuenta" id="num_cuenta" autocomplete="off" maxlength="4" />
                            			</div>
                                    	
                                    	<div class="form-group ocultar">
                            				<label for="observaciones" class="control-label">Observaciones o comentarios de la consulta</label>
                            				<textarea class="form-control" name="observaciones" rows="3"></textarea>
                            			</div>
                            			
                                    	<div class="form-actions text-right guardar ocultar" >
											<a role="button" class="btn blue-madison" onclick="guardaSolicitud();">Guardar Consulta</a>
										</div>
	                                </form>
                                </div>
                            </div>
						</div>
						
					</div>
					
					
					
					
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
	
	
	$('.numerico').numeric({allow:'.'});

	$('#id_metodo_pago').change(function(){
		
		var id_metodo=$('#id_metodo_pago').val();
		
		if(id_metodo!=1){
			$('#digita_cuenta').show();
		}else{
			$('#digita_cuenta').hide();
		}
	});
});

function total_conceptos(){
	
	var totales = 0;
	
	$('.cantidades').each(function() {
	
		var cantidad 	= $(this).val();
		var myid 		= $(this).attr('id');
		var p_unit		= $('.input_precio_'+myid).val();
		
		var subtotal	= Number(cantidad)*Number(p_unit);
				
		$('.input_suma_precio_'+myid).val(subtotal);
		
		totales+=Number(subtotal);
		
	});
	
	$('.subtotal_total').val(totales);
	
}


function keyup_total_conceptos(){
	
	total_conceptos();
	
}
function agregaProducto(){
	$('.select2-selection__placeholder').css('color','#999');
	$('.cantidad_label,.producto_label,.proyecto_label').css('color','#333');
	var producto			= $('#id_tratamiento :selected').text();
	var id_tratamiento		= $('#id_tratamiento').val();
	var cantidad			= $('#cantidad_producto').val();
	var precio				= $('#id_tratamiento :selected').attr('data-precio');
	if(!id_tratamiento){
		$('.producto_label').css('color','red');
		var error = 1;
	}
	if(!cantidad){
		$('.cantidad_label').css('color','red');
		var error = 2;
	}

	if(error==1){
		return false;
	}else if(error==2){
		$('#cantidad_producto').focus();
		return false;
	}

	$('.titulo_producto').css('font-weight','400');
			
	if($('#'+id_tratamiento).length){
		var valor = Number($('#'+id_tratamiento).val())+Number(cantidad);
		$('#'+id_tratamiento).val(valor);
		total_conceptos();
	}else{	
		
		$.getJSON('data/get_price.php',{id:id_tratamiento},function(data) {
			$('.input_precio_'+id_tratamiento).val(data.costo);
			total_conceptos();
		});
		
		var html = '<tr id="tr_'+id_tratamiento+'">';
			html+= '<td>';
			html+= '<input type="text" value="'+cantidad+'" onkeyup="keyup_total_conceptos();" class="cantidades productos numerico form-control input-sm input_'+id_tratamiento+'" name="cantidad['+id_tratamiento+']" id="'+id_tratamiento+'"/>';
			html+= '</td>';
			html+= '<td>';
			html+= '<span class="titulo_producto" id="span_'+id_tratamiento+'"> '+producto+'</span>';
			html+= '</td>';
			html+= '<td align="right">';
			html+= '<input type="text" onkeyup="keyup_total_conceptos();" class="productos precio_unit numerico form-control input-sm input_precio_'+id_tratamiento+'" name="precio['+id_tratamiento+']" value="" />';
			html+= '</td>';
			html+= '<td align="right">';
			html+= '<input type="text" readonly class="productos numerico form-control input-sm input_suma_precio_'+id_tratamiento+'" name="" value="" />';
			html+= '</td>';
			html+= '<td align="right">';
			html+= '<a role="button" class="btn btn-danger btn-xs" onclick="remover('+id_tratamiento+')">';
			html+= '<i class="fa fa-remove"></i>';
			html+= '</a>';
			html+= '</td>';
			html+= '</tr>';
						
		$('#agrega_producto').prepend(html);
		$('.ocultar2').hide();
		$('.ocultar').show();
	}
	
	$('#tabla').show('fast');
	$('#cantidad_producto').val('1');
	$('#cantidad_producto').focus();
	
	$('#span_'+id_tratamiento).css('font-weight','bold');
	$('.input_'+id_tratamiento).removeClass('color2').addClass('color');
	setTimeout(function() {
		$('.input_'+id_tratamiento).removeClass('color').addClass('color2');		
	}, 3000);

	
	$('#id_tratamiento').val('').trigger('change');
	
	$('.numerico').numeric({allow:'.'});
	

	if($('.productos').length){
			$('.ocultar2').hide();
			$('#tabla,.ocultar').show();
	}else{
			$('.ocultar2').show();
			$('#tabla,.ocultar').hide();		
	}
	total_conceptos();
	
	
}

function remover(id){
	$('#tr_'+id).remove();	
	if($('.productos').length){
			$('.ocultar2').hide();
			$('#tabla,.ocultar').show();
	}else{
			$('.ocultar2').show();
			$('#tabla,.ocultar').hide();		
	}
	total_conceptos();
}

function guardaSolicitud(){
	App.blockUI(
		{
            boxed: true,
            message: 'Guardando Consulta.'
        }
	);
	var datos	=	$('#frm_productos,#frm_datos').serialize();
	$.post('ac/guarda_consulta.php',datos,function(data){
		console.log(data);
		var datos = data.split('|');
		
	    if(datos[0]==1){
		    
			if(datos[1]){
				$.post('http://localhost/imprimir_remoto.php','imprimir='+datos[1]);
				setTimeout(function() {
				
					window.open("?Modulo=Citas&tipo=3&msg=3", "_self");
				
				}, 1000);
			}
			//tal vez un if aqui.
			//
			
	    }else{
	    	App.unblockUI();
			$('#msg_error').html(data);
			$('#msg_error').show('Fast');
	    }
	});
}
</script>