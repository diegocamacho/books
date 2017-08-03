<?
$id_contacto=$_GET['id'];
$titulo="Agregar contacto nuevo para ".dameDatosEmpresa($s_id_empresa);
if($id_contacto):

	$sql="SELECT * FROM books_contactos 
	LEFT JOIN books_contactos_personas ON books_contactos_personas.id_contacto=books_contactos.id_contacto 
	LEFT JOIN books_contactos_facturacion ON books_contactos_facturacion.id_contacto=books_contactos.id_contacto
	WHERE books_contactos.id_contacto=$id_contacto AND principal=1 AND id_empresa=$s_id_empresa";
	$q = mysql_query($sql);
	$datos=mysql_fetch_assoc($q);
	
	$cliente=$datos['empresa'];
	$telefono=$datos['telefono'];
	$id_empresa=$datos['id_empresa'];
	$principal_nombre=$datos['nombre'];
	$principal_email=$datos['email'];
	$tipo=$datos['tipo'];
	//Facturacion
	$razon_social=$datos['razon_social'];
	$rfc=$datos['rfc'];
	$calle=$datos['calle'];
	$n_exterior=$datos['n_exterior'];
	$n_interior=$datos['n_interior'];
	$colonia=$datos['colonia'];
	$cp=$datos['cp'];
	$localidad=$datos['localidad'];
	$municipio=$datos['municipio'];
	$estado=$datos['estado'];
	
	// Contactos
	$sql="SELECT * FROM books_contactos_personas WHERE id_contacto=$id_contacto AND principal=0";
	$q = mysql_query($sql);
	$contactos = array();
	while($datos=mysql_fetch_object($q)):
		$contactos[] = $datos;
	endwhile;
	$valida_contactos=count($contactos);
	
	
	$titulo="Editar contacto";
endif;
	
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
			        <div class="portlet light portlet-fit " style="min-height: 346px;">
			            <div class="portlet-title">
			                <div class="caption">
			                    <i class="icon-globe font-dark"></i>
			                    <span class="caption-subject font-dark sbold uppercase"><?=$titulo?></span>
			                </div>
			                <div class="actions">
				                
			                    <!--<a href="#" class="btn btn-sm blue-chambray "><i class="fa fa-plus"></i> Cancelar </a>-->
			                    
			                </div>
			            </div>
			            <div class="portlet-body">
				            <form id="frm-datos" class="form-horizontal">
								<div class="alert alert-danger oculto" role="alert" id="msg_error"></div>
								<div class="form-body">
									
									<h4>Datos Generales </h4>
									<br>
									<div class="form-group">
										<label for="nombre" class="col-md-2 control-label">Nombre</label>
										<div class="col-md-6">
											<input type="text" maxlength="128" class="form-control dat" name="principal_nombre" id="principal_nombre" autocomplete="off" value="<?=$principal_nombre?>">
											<p class="help-block text-info">*Este será el contacto principal.</p>
										</div>
									</div>
									
									<div class="form-group">
										<label for="nombre" class="col-md-2 control-label">Email</label>
										<div class="col-md-6">
											<input type="text" maxlength="128" class="form-control dat" name="principal_email" id="principal_email" autocomplete="off" value="<?=$principal_email?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="nombre" class="col-md-2 control-label">Nombre Comercial</label>
										<div class="col-md-6">
											<input type="text" maxlength="128" class="form-control dat" name="empresa" autocomplete="off" value="<?=$cliente?>">
										</div>
									</div>
									
									<div class="form-group">
										<label for="telefono" class="col-md-2 control-label">Teléfono</label>
										<div class="col-md-6">
											<input type="text" maxlength="10" class="form-control dat" name="telefono" autocomplete="off" value="<?=$telefono?>">
										</div>
									</div>
									
									<div class="form-group">
                                        <label class="col-md-2 control-label">Tipo de contacto</label>
                                        <div class="col-md-6">
                                        	<div class="radio-list">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            	<label class="radio-inline"><input type="radio" name="tipo_contacto" value="1" <? if($tipo==1){ echo "checked"; } ?>> Cliente </label>
												<label class="radio-inline"><input type="radio" name="tipo_contacto" value="2" <? if($tipo==2){ echo "checked"; } ?>> Proveedor </label>
											</div>
										</div>
									</div>
									
									<br><br>
									<h4>Datos Físcales</h4>
									<br>
									
									<div class="form-group">
										<label for="rfc" class="col-sm-2 control-label">Razón Social:</label>
										<div class="col-sm-6">
											<input type="text" class="form-control limpia" id="razon_social" name="razon_social" value="<?=$razon_social?>">
    									</div>
  									</div>
									
									<div class="form-group">
										<label for="rfc" class="col-sm-2 control-label">RFC:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control limpia" id="rfc" name="rfc" value="<?=$rfc?>">
    									</div>
  									</div>
  									
  									<div class="form-group">
										<label for="rfc" class="col-sm-2 control-label">Calle:</label>
										<div class="col-sm-10">
											<input type="text" class="form-control limpia" id="calle" name="calle" value="<?=$calle?>">
    									</div>
  									</div>
  									
  									<div class="form-group">
										<label for="rfc" class="col-sm-2 control-label">Número Exterior:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control limpia" id="n_exterior" name="n_exterior" value="<?=$n_exterior?>">
    									</div>
    									
    									<label for="rfc" class="col-sm-2 control-label">Número Interior:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control limpia" id="n_interior" name="n_interior" placeholder="Opcional" value="<?=$n_interior?>">
    									</div>
  									</div>
  									
  									<div class="form-group">
										<label for="rfc" class="col-sm-2 control-label">Colonia:</label>
										<div class="col-sm-5">
											<input type="text" class="form-control limpia" id="colonia" name="colonia" value="<?=$colonia?>">
    									</div>
    									
    									<label for="rfc" class="col-sm-2 control-label">Código Postal:</label>
										<div class="col-sm-3">
											<input type="text" class="form-control limpia" id="cp" name="cp" value="<?=$cp?>">
    									</div>
  									</div>
  									
  									<div class="form-group">
										<label for="rfc" class="col-sm-2 control-label">Localidad:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control limpia" id="localidad" name="localidad" value="<?=$localidad?>">
    									</div>
    									
    									<label for="rfc" class="col-sm-2 control-label">Delegación o Municipio:</label>
										<div class="col-sm-4">
											<input type="text" class="form-control limpia" id="municipio" name="municipio" value="<?=$municipio?>">
    									</div>
  									</div>
  									
  									<div class="form-group">
										<label for="rfc" class="col-sm-2 control-label">Estado:</label>
										<div class="col-sm-4">
											<select name="estado" id="estado" class="form-control">
												<option value="0">Seleccione Estado</option>
												<option <? if($estado=="AGUASCALIENTES"){ ?> selected="1" <? } ?> value="AGUASCALIENTES">Aguascalientes</option>
												<option <? if($estado=="BAJA CALIFORNIA"){ ?> selected="1" <? } ?> value="BAJA CALIFORNIA">Baja California</option>
												<option <? if($estado=="BAJA CALIFORNIA SUR"){ ?> selected="1" <? } ?> value="BAJA CALIFORNIA SUR">Baja California Sur</option>
												<option <? if($estado=="CAMPECHE"){ ?> selected="1" <? } ?> value="CAMPECHE">Campeche</option>
												<option <? if($estado=="CHIAPAS"){ ?> selected="1" <? } ?> value="CHIAPAS">Chiapas</option>
												<option <? if($estado=="CHIHUAHUA"){ ?> selected="1" <? } ?> value="CHIHUAHUA">Chihuahua</option>
												<option <? if($estado=="COAHUILA"){ ?> selected="1" <? } ?> value="COAHUILA">Coahuila</option>
												<option <? if($estado=="COLIMA"){ ?> selected="1" <? } ?> value="COLIMA">Colima</option>
												<option <? if($estado=="CIUDAD DE MEXICO"){ ?> selected="1" <? } ?> value="CIUDAD DE MEXICO">Ciudad de México</option>
												<option <? if($estado=="DISTRITO FEDERAL"){ ?> selected="1" <? } ?> value="DISTRITO FEDERAL">Distrito Federal</option>
												<option <? if($estado=="CIUDAD DE MEXICO"){ ?> selected="1" <? } ?> value="CIUDAD DE MEXICO">Ciudad de México</option>
												<option <? if($estado=="DURANGO"){ ?> selected="1" <? } ?> value="DURANGO">Durango</option>
												<option <? if($estado=="ESTADO DE MEXICO"){ ?> selected="1" <? } ?> value="ESTADO DE MEXICO">Estado de México</option>
												<option <? if($estado=="GUANAJUATO"){ ?> selected="1" <? } ?> value="GUANAJUATO">Guanajuato</option>
												<option <? if($estado=="GUERRERO"){ ?> selected="1" <? } ?> value="GUERRERO">Guerrero</option>
												<option <? if($estado=="HIDALGO"){ ?> selected="1" <? } ?> value="HIDALGO">Hidalgo</option>
												<option <? if($estado=="JALISCO"){ ?> selected="1" <? } ?> value="JALISCO">Jalisco</option>
												<option <? if($estado=="MICHOACAN"){ ?> selected="1" <? } ?> value="MICHOACAN">Michoacán</option>
												<option <? if($estado=="MORELOS"){ ?> selected="1" <? } ?> value="MORELOS">Morelos</option>
												<option <? if($estado=="NAYARIT"){ ?> selected="1" <? } ?> value="NAYARIT">Nayarit</option>
												<option <? if($estado=="NUEVO LEON"){ ?> selected="1" <? } ?> value="NUEVO LEON">Nuevo León</option>
												<option <? if($estado=="OAXACA"){ ?> selected="1" <? } ?> value="OAXACA">Oaxaca</option>
												<option <? if($estado=="PUEBLA"){ ?> selected="1" <? } ?> value="PUEBLA">Puebla</option>
												<option <? if($estado=="QUERETARO"){ ?> selected="1" <? } ?> value="QUERETARO">Querétaro</option>
												<option <? if($estado=="QUINTANA ROO"){ ?> selected="1" <? } ?> value="QUINTANA ROO">Quintana Roo</option>
												<option <? if($estado=="SAN LUIS POTOSI"){ ?> selected="1" <? } ?> value="SAN LUIS POTOSI">San Luis Potosí</option>
												<option <? if($estado=="SINALOA"){ ?> selected="1" <? } ?> value="SINALOA">Sinaloa</option>
												<option <? if($estado=="SONORA"){ ?> selected="1" <? } ?> value="SONORA">Sonora</option>
												<option <? if($estado=="TABASCO"){ ?> selected="1" <? } ?> value="TABASCO">Tabasco</option>
												<option <? if($estado=="TAMAULIPAS"){ ?> selected="1" <? } ?> value="TAMAULIPAS">Tamaulipas</option>
												<option <? if($estado=="TLAXCALA"){ ?> selected="1" <? } ?> value="TLAXCALA">Tlaxcala</option>
												<option <? if($estado=="VERACRUZ"){ ?> selected="1" <? } ?> value="VERACRUZ">Veracruz</option>
												<option <? if($estado=="YUCATAN"){ ?> selected="1" <? } ?> value="YUCATAN">Yucatán</option>
												<option <? if($estado=="ZACATECAS"){ ?> selected="1" <? } ?> value="ZACATECAS">Zacatecas</option>
											</select>
    									</div>
  									</div>
  									
									<br><br>
									<h4>Contactos Adicionales &nbsp;&nbsp;&nbsp;<a role="button" class="btn red-thunderbird btn-outline btn-xs" onclick="agregaContacto()">Nuevo</a></h4>
									<br>
									<div class="form-group">
										<div class="col-md-6 col-md-offset-2">
											<table class="table table-hover table-light">
												<thead>
													<tr class="uppercase">
						                                <th width="220"> Nombre </th>
						                                <th> Email </th>
						                                <th width="120">  </th>
													</tr>
												</thead>
			                		    		<tbody id="nuevo_contacto">
				                		    	<? if($id_contacto): ?>
													<? foreach($contactos as $contacto): ?>
			                		    				<tr class="row_<?=$contacto->id_contacto_persona?>">
			                		    			    	<td> <?=$contacto->nombre?> </td>
			                		    			        <td> <?=$contacto->email?> </td>
			                		    			        <td align="right" valign="top" style="vertical-align: top;">
				                		    			        <a role="button" class="btn btn-default btn-xs btn-outline" onclick="principal(<?=$contacto->id_contacto_persona?>,<?=$id_contacto?>)" style="margin-top: 6px;">Principal</a>
				            		    	    		    	<a role="button" class="btn btn-danger btn-xs" onclick="remover(<?=$contacto->id_contacto_persona?>,1)" style="margin-top: 6px;"><i class="fa fa-remove"></i></a>
															</td>
														</tr>
													<? endforeach; ?>
												<? else: ?>
													<tr class="row_<?=$contacto->id_contacto_persona?>">
			                		    			    <td> <input type="text" name="contacto_nombre[]" maxlength="128" class="form-control dat" autocomplete="off" /> </td>
			                		    			    <td colspan="2"> <input type="text" name="contacto_email[]" maxlength="128" class="form-control dat" autocomplete="off" /> </td>
													</tr>
												<? endif; ?>
												</tbody>
											</table>
										</div>
									</div>
									
	        					
								</div>
								
								<div class="form-actions text-right">
									<? if($id_contacto): ?>
									<input type="hidden" name="id_contacto" value="<?=$id_contacto?>" />
									<? endif; ?>
									<a role="button" class="btn btn-default btn-outline " href="javascript:history.back(1)">Cancelar</a>&nbsp;&nbsp;
									<a role="button" class="btn green-jungle btn-outline " onclick="guardaCliente()">Guardar Cliente</a>
								</div>
		        			</form>
			            </div>
			            
			        </div>
			        <!-- END BORDERED TABLE PORTLET-->
			    </div>

				
				
				
				

			</div>
		</div>
	</div>
</div>
<!--
validar email
validar numeros en telefono
	
	-->
<script>
$(function(){
	
	
});
function remover(id,tipo){
	App.blockUI();
	if(tipo==1){
		$.post('ac/elimina_contacto.php',{id:id},function(data){
	    	if(data==1){
				$('.row_'+id).remove();
				App.unblockUI();
			}else{
	    		alert(data);
	    		App.unblockUI();
	    	}
		});
	}else{
		$('.row_'+id).remove();
		App.unblockUI();
	}
}
function guardaCliente(){
	App.blockUI();
	var datos=$('#frm-datos').serialize();
	$.post('ac/contacto.php',datos,function(data){
		console.log(data);
	    if(data==1){
			<? if($id_contacto){ ?>
		    window.open("?Modulo=Contactos&msg=2", "_self");
		    <? }else{ ?>
		    window.open("?Modulo=Contactos&msg=1", "_self");
		    <? } ?>
	    }else{
	    	alert(data);
			App.unblockUI();
	    }
	});
}

function principal(persona,contacto){
	App.blockUI();
	$.post('ac/contacto_principal.php',{id_contacto:contacto, id_persona:persona},function(data){
		console.log(data);
	    if(data==1){
			window.open("?Modulo=Contacto&id="+contacto, "_self");
	    }else{
	    	alert(data);
			App.unblockUI();
	    }
	});
}

function agregaContacto(){


	var random = new Date().getTime();	
	var html = '';
	
	html+='<tr class="row_'+random+'">';
	html+='<td><input type="text" name="contacto_nombre[]" maxlength="128" class="form-control dat" autocomplete="off" /> </td>';
	html+='<td><input type="text" name="contacto_email[]" maxlength="128" class="form-control dat" autocomplete="off" /> </td>';
	html+='<td align="right" valign="top" style="vertical-align: top;"><a role="button" class="btn btn-danger btn-xs" onclick="remover('+random+')" style="margin-top: 6px;"><i class="fa fa-remove"></i></a></td>';
	html+='</tr>';
	$('#nuevo_contacto').append(html);

}
</script>