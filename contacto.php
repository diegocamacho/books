<?
$id_contacto=$_GET['id'];
$titulo="Agregar contacto nuevo para ".dameDatosEmpresa($s_id_empresa);
if($id_contacto):

	$sql="SELECT * FROM books_contactos 
	LEFT JOIN books_contactos_personas ON books_contactos_personas.id_contacto=books_contactos.id_contacto 
	WHERE books_contactos.id_contacto=$id_contacto AND principal=1 AND id_empresa=$s_id_empresa";
	$q = mysql_query($sql);
	$datos=mysql_fetch_assoc($q);
	
	$cliente=$datos['empresa'];
	$telefono=$datos['telefono'];
	$id_empresa=$datos['id_empresa'];
	$principal_nombre=$datos['nombre'];
	$principal_email=$datos['email'];
	$tipo=$datos['tipo'];
	
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
										<label for="nombre" class="col-md-2 control-label">Empresa</label>
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
			window.open("?Modulo=Clientes&msg=1", "_self");
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