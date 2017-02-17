<?
$sql="SELECT books_clientes.*, empresa, representante FROM books_clientes 
LEFT JOIN books_empresas ON books_empresas.id_empresa=books_clientes.id_empresa
ORDER BY empresa ASC";
$q=mysql_query($sql);

$clientes = array();

while($datos=mysql_fetch_object($q)):
	$clientes[] = $datos;
endwhile;
$val=count($clientes);


$sql="SELECT * FROM books_empresas WHERE activo=1";
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
</style>

<div class="page-content-inner">
	<div class="row">
		<div class="col-md-12">
			<!-- Confirmación -->
			  <? if($_GET['msg']==1){ ?>
			  		<br>
			  		<div class="alert alert-dismissable alert-success">
				  		<button type="button" class="close" data-dismiss="alert">×</button>
				  		<p>El cliente se ha agregado</p>
				  	</div>
			  <? }if($_GET['msg']==2){ ?>
			  		<br>
			  		<div class="alert alert-dismissable alert-info">
				  		<button type="button" class="close" data-dismiss="alert">×</button>
				  		<p>El cliente se ha editado</p>
				  	</div>
			  <? } ?>
			  <!-- Contenido -->
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet light  portlet-fit">
				<div class="portlet-title">
					<div class="caption">
						<i class="icon-briefcase font-dark"></i>
						<span class="caption-subject font-dark bold uppercase">Clientes</span>
					</div>
					<div class="actions btn-set">
						<a href="javascript:;" class="btn btn-sm blue-chambray " data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#nuevoCliente"><i class="fa fa-plus"></i> Agregar cliente </a>
					</div>
				</div>
				<div class="portlet-body">
					<? if($val>0): ?>
					<table class="table table-striped table-bordered table-hover">
						<thead>
					        <tr>
					          <th>Cliente</th>
					          <th>Representante</th>
					          <th>Empresa</th>
					          <th>Teléfono</th>
					          <th>Email</th>
					          <th width="150"></th>
					        </tr>
					      </thead>
					      <tbody>
						    <? foreach($clientes as $cliente): ?>  
					        <tr>
								<td><?=$cliente->cliente?></td>
								<td><?=$cliente->representante?></td>
								<td><? if($cliente->id_empresa==0): echo "TODAS"; else: echo $cliente->empresa; endif;?></td>
								<td><?=$cliente->telefono?></td>
								<td><?=$cliente->email?></td>
								<td align="right">
									<a role="button" class="btn blue btn-xs btn_<?=$cliente->id_cliente?>" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#editaCliente" data-id="<?=$cliente->id_cliente?>">Editar</a>
									<a role="button" class="btn red btn-xs btn_<?=$cliente->id_cliente?>" onclick="javascript:Desactiva(<?=$cliente->id_cliente?>)">Desactivar</a>
									<!--<a role="button" class="btn  default btn-xs btn_<?=$cliente->id_cliente?>" onclick="javascript:s(<?=$cliente->id_cliente?>)">Historial</a>-->
								</td>
					        </tr>
					        <? endforeach; ?>
					        
					      </tbody>
					</table>
					<? else: ?>
					<div class="alert alert-dismissable alert-warning">
				  		<button type="button" class="close" data-dismiss="alert">×</button>
				  		<p>Aún no se han creado clientes</p>
				  	</div>
					<? endif; ?>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
</div>













<!-- Modal -->
<div class="modal fade" id="nuevoCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title">Nuevo cliente</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger oculto" role="alert" id="msg_error"></div>
<!--Formulario -->
		<form id="frm_guarda" class="form-horizontal">
			
			<div class="form-group">
				<label for="nombre" class="col-md-3 control-label">Nombre</label>
				<div class="col-md-9">
					<input type="text" maxlength="128" class="form-control dat" name="nombre" id="nuevo_nombre" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="nombre" class="col-md-3 control-label">Representante</label>
				<div class="col-md-9">
					<input type="text" maxlength="128" class="form-control dat" name="representante" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="telefono" class="col-md-3 control-label">Teléfono</label>
				<div class="col-md-9">
					<input type="text" maxlength="10" class="form-control dat" name="telefono" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="direccion" class="col-md-3 control-label">Email</label>
				<div class="col-md-9">
					<input type="text" class="form-control dat" name="email" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="direccion" class="col-md-3 control-label">Empresa</label>
				<div class="col-md-9">
					<select class="form-control" name="id_empresa" >
						<option value="0">Seleccione una</option>
						<? foreach($empresas as $empresa): ?>
						<option value="<?=$empresa->id_empresa?>"><?=$empresa->empresa?></option>
						<? endforeach; ?>
					</select>
					<p class="help-block">*Si se deja en blanco este proveedor podrá tener operaciones con todas las empresas.</p>
				</div>
			</div>

		</form>
		      
      </div>
      <div class="modal-footer">
      	<img src="assets/global/img/loading-spinner-grey.gif" border="0" id="load" width="25" class="oculto" />
        <button type="button" class="btn btn-default btn_ac" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success btn_ac" onclick="nuevoCliente()">Guardar Cliente</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- Modal -->
<div class="modal fade" id="editaCliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title">Edita Cliente</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger oculto" role="alert" id="msg_error2"></div>
<!-- Loader -->
		<div class="row oculto" id="load_big">
			<div class="col-md-12 text-center" >
				<img src="assets/global/img/ajax-loading.gif" border="0"  />
			</div>
		</div>
<!--Formulario -->
		<form id="frm_edita" class="form-horizontal">
			
			<div class="form-group">
				<label for="nombre" class="col-md-3 control-label">Empresa</label>
				<div class="col-md-9">
					<input type="text" maxlength="64" class="form-control edit" id="nombre" name="nombre" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="nombre" class="col-md-3 control-label">Representante</label>
				<div class="col-md-9">
					<input type="text" maxlength="64" class="form-control edit" id="representante" name="representante" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="telefono" class="col-md-3 control-label">Teléfono</label>
				<div class="col-md-9">
					<input type="text" maxlength="10" class="form-control dat" name="telefono" id="telefono" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="direccion" class="col-md-3 control-label">Email</label>
				<div class="col-md-9">
					<input type="text" class="form-control dat" name="email" id="email" autocomplete="off">
				</div>
			</div>
			
			<div class="form-group">
				<label for="direccion" class="col-md-3 control-label">Empresa</label>
				<div class="col-md-9">
					<select class="form-control" name="id_empresa" id="id_empresa" >
						<option value="0">Todas</option>
						<? foreach($empresas as $empresa): ?>
						<option value="<?=$empresa->id_empresa?>"><?=$empresa->empresa?></option>
						<? endforeach; ?>
					</select>
					<p class="help-block">*Si se deja en blanco este proveedor podrá tener operaciones con todas las empresas.</p>
				</div>
			</div>
			
			<input type="hidden" name="id_cliente" id="id_cliente" />
		</form>
		      
      </div>
      <div class="modal-footer">      	
      	<img src="assets/global/img/loading-spinner-grey.gif" border="0" id="load2" width="25" class="oculto" />
        <button type="button" class="btn btn-default btn_ac btn-modal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success btn_ac btn-modal" onclick="editaCliente()">Actualizar Cliente</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!--- Js -->
<script>
$(function(){
	
	//$('#color').minicolors();

	$(document).on('click', '[data-id]', function () {
		$('.edit').val("");
		$('.btn-modal').hide();
		$('#frm_edita').hide();
		$('#load_big').show();
	    var data_id = $(this).attr('data-id');
	    $.getJSON('data/cliente.php', {id:data_id} ,function(data) {
			console.log(data);
			$('#nombre').val(data.cliente);
			$('#representante').val(data.representante);
			$('#telefono').val(data.telefono);
			$('#email').val(data.email);
			$('#id_empresa').val(data.id_empresa);
			$('#id_cliente').val(data_id);

			$('#load_big').hide();
			$('#frm_edita').show();
			$('.btn-modal').show();
			
		});
	   
	});
	
	$('#nuevoProveedor').on('shown.bs.modal',function(e){
		$('#nuevo_nombre').focus();
	});
	
	$('#nuevoProveedor').on('hidden.bs.modal',function(e){
		$('.dat').val("");
		$('#msg_error2').hide();
		$('#msg_error').hide();
	});
	
	$('#editaProveedor').on('hidden.bs.modal',function(e){
		$('.edit').val("");
		$('#msg_error2').hide();
		$('#msg_error').hide();
	});
	
	$('form').submit(function(e){
		e.preventDefault();	
	});
});

function editaCliente(){
	$('#msg_error2').hide('Fast');
	$('.btn_ac').hide();
	$('#load2').show();
	var datos=$('#frm_edita').serialize();
	$.post('ac/edita_cliente.php',datos,function(data){
	    if(data==1){
			window.open("?Modulo=Clientes&msg=2", "_self");
	    }else{
	    	$('#load2').hide();
			$('.btn').show();
			$('#msg_error2').html(data);
			$('#msg_error2').show('Fast');
	    }
	});
}
function Desactiva(id){
	$(".btn_"+id+"").hide();
	$("#load_"+id+"").show();
	$.post('ac/activa_desactiva_clinica.php', { tipo: "0", id_proveedor: ""+id+"" },function(data){
		if(data==1){
			window.open("?Modulo=Clinicas", "_self");
		}else{
			$("#load_"+id+"").hide();
			$(".btn_"+id+"").show();
			alert(data);
		}
	});
}
function Activa(id){
	$(".btn_"+id+"").hide();
	$("#load_"+id+"").show();
	$.post('ac/activa_desactiva_clinica.php', { tipo: "1", id_proveedor: ""+id+"" },function(data){
		if(data==1){
			window.open("?Modulo=Clinicas", "_self");
		}else{
			$("#load_"+id+"").hide();
			$(".btn_"+id+"").show();
			alert(data);
		}
	});
}
function nuevoCliente(){
	$('#msg_error').hide('Fast');
	$('.btn_ac').hide();
	$('#load').show();
	var datos=$('#frm_guarda').serialize();
	$.post('ac/nuevo_cliente.php',datos,function(data){
	    if(data==1){
			window.open("?Modulo=Clientes&msg=1", "_self");
	    }else{
	    	$('#load').hide();
			$('.btn').show();
			$('#msg_error').html(data);
			$('#msg_error').show('Fast');
	    }
	});
}
</script>