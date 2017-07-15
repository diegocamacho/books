<?
$id_venta=$_GET['id'];

$sql="SELECT books_ventas.id_venta, books_ventas.estado, folio_presupuesto, folio_remision, empresa, cliente, representante, mensaje_presupuesto, mensaje_remision FROM books_ventas 
JOIN books_usuarios_empresas ON books_usuarios_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_empresas ON books_empresas.id_empresa=books_ventas.id_empresa 
JOIN books_clientes ON books_clientes.id_cliente=books_ventas.id_cliente 
WHERE id_venta=$id_venta AND books_usuarios_empresas.id_usuario=$s_id_usuario";
$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if($valida):
	$venta=mysql_fetch_object($q);
	//Armado del mensaje
	$estado=$venta->estado;
	$representante=$venta->representante;
	$mensaje_presupuesto=$venta->mensaje_presupuesto;
	$empresa=$venta->empresa;
	
	if($estado<=3){
		$folio="Presupuesto PRE-".$venta->folio_presupuesto;
		$msg=str_replace("NOMBRE_CLIENTE", ucwords(strtolower($representante)), $mensaje_presupuesto);
		$msg=str_replace("NUMERO_FOLIO", $folio, $msg);
		$msg=str_replace("NOMBRE_USUARIO", ucwords(strtolower($s_nombre)), $msg);
		$asunto="Su Presupuesto de ".ucwords(strtolower($empresa));
		$sujeto="El";
	}elseif($estado>3){
		$folio="Remisión REM-".$venta->folio_remision;
		$msg=str_replace("NOMBRE_CLIENTE", ucwords(strtolower($representante)), $mensaje_remision);
		$msg=str_replace("NUMERO_FOLIO", $folio, $msg);
		$msg=str_replace("NOMBRE_USUARIO", ucwords(strtolower($s_nombre)), $msg);
		$asunto="Su Remisión de ".ucwords(strtolower($empresa));
		$sujeto="La";
	}


	$sql="SELECT nombre,email,usuarios.id_usuario FROM usuarios 
	JOIN books_usuarios_empresas ON books_usuarios_empresas.id_usuario=usuarios.id_usuario
	WHERE books_usuarios_empresas.id_empresa=$s_id_empresa";
	$q=mysql_query($sql);
	$contactos = array();
	while($datos=mysql_fetch_object($q)):
		$contactos[] = $datos;
	endwhile;
	
	
	$sql="SELECT nombre,email FROM books_ventas 
	JOIN books_clientes_contactos ON books_clientes_contactos.id_cliente=books_ventas.id_cliente 
	WHERE id_venta=$id_venta";
	$q=mysql_query($sql);
	$clientes = array();
	while($datos=mysql_fetch_object($q)):
		$clientes[] = $datos;
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
			                    <span class="caption-subject font-dark sbold uppercase">Enviar presupuesto</span>
			                </div>
			                <div class="actions">
				                
			                    <!--<a href="#" class="btn btn-sm blue-chambray "><i class="fa fa-plus"></i> Cancelar </a>-->
			                    
			                </div>
			            </div>
			            <div class="portlet-body">
				            <form id="frm-datos" class="form-horizontal">
								<div class="alert alert-danger oculto" role="alert" id="msg_error"></div>
								<div class="form-body">

						            <div class="form-group">
										<label for="id_cliente" class="col-md-2 control-label">Desde</label>
										<div class="col-md-9">
											<select class="form-control select2" name="id_empresa" id="id_empresa" >
												<? foreach($contactos as $contacto): ?>
												<option <? if($contacto->id_usuario==$s_id_usuario){ ?>selected="1"<? } ?> value="<?=$contacto->email?>"><?=$contacto->nombre?> (<?=$contacto->email?>)</option>
												<? endforeach; ?>
											</select>
										</div>
									</div>


									<div class="form-group">
										<label for="id_cliente" class="col-md-2 control-label">Enviar a</label>
										<div class="col-md-9">
											<? if($clientes): ?>
											<select class="form-control select2-multiple" name="id_cliente" id="id_cliente" multiple>
												<? foreach($clientes as $cliente): ?>
												<option value="<?=$cliente->email?>"><?=$cliente->nombre?> (<?=$cliente->email?>)</option>
												<? endforeach; ?>
											</select>
											<? else: ?>
											<span class="help-block text-danger" style="font-weight: 900;margin-top: 7px;">***Este cliente no tiene contactos para envíar correos.</span>
											<? endif; ?>
										</div>
									</div>
									
									<div class="form-group">
										<label for="id_cliente" class="col-md-2 control-label">Asunto</label>
										<div class="col-md-6">
											<input type="text" maxlength="128" class="form-control dat " name="asunto" autocomplete="off" id="asunto" value="<?=$asunto?>">
										</div>
									</div>
									
									<hr>
									
									<div class="form-group">
										<label class="control-label col-md-2">Mensaje</label>
                                        <div class="col-md-9">
                                        	<div name="mensaje" id="mensaje"> <?=$msg?></div>
                                        	<span class="help-block text-info" style="font-weight: 900">* <?=$sujeto?> <?=$folio?> se esta adjuntando en pdf a este correo. </span>
										</div>
									</div>

	        					
								</div>
								
								<div class="form-actions  text-right">
									<div class="form-group">
                                        <div class="col-md-11">
	                                        <a role="button" class="btn btn-default btn-outline " href="javascript:history.back(1)">Cancelar</a>&nbsp;&nbsp;
                                        	<a role="button" class="btn green-jungle btn-outline ">Enviar por Correo</a>
										</div>
									</div>
									
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

<script>
$(function(){
	
	$('#mensaje').summernote({
		height: 300,
		lang: 'es-ES',
		codemirror: { 
			theme: 'monokai'
		},
		toolbar: [
			//['style', ['style']],			
			['style', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['hr', ['hr']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['link', ['link']],
			//['fullscreen', ['fullscreen']],
			['undo', ['undo']],
			['redo', ['redo']],
			//['codeview', ['codeview']]
			
			
		]
	});
	
	//var contenido = encodeURIComponent($('#mensaje').summernote('code'));
});
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