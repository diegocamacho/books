<?
$sql="SELECT empresa, fecha, fecha_expira, nombre, borrador, cliente, id_presupuesto FROM books_presupuestos
JOIN books_clientes ON books_clientes.id_cliente=books_presupuestos.id_cliente
JOIN books_empresas ON books_empresas.id_empresa=books_presupuestos.id_empresa
JOIN usuarios ON usuarios.id_usuario=books_presupuestos.id_usuario
WHERE books_presupuestos.activo=1";
$q=mysql_query($sql);
$presupuestos = array();
while($datos=mysql_fetch_object($q)):
	$presupuestos[] = $datos;
endwhile;
$val=count($presupuestos);

?>
<style>
.oculto{
	display: none;
}
.link{
	cursor: pointer;
}
</style>

<div class="page-content">
	<div class="container">    
		<div class="page-content-inner">
			<div class="row">
				<div class="col-md-12">
					
					<div class="portlet light  portlet-fit">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-book-open font-dark"></i>
								<span class="caption-subject font-dark bold uppercase">Presupuestos</span>
							</div>
							<div class="actions btn-set">
								<a href="?Modulo=Presupuesto" class="btn btn-sm blue-chambray "> Nuevo presupuesto </a>
							</div>
						</div>
						<div class="portlet-body">
							<? if($val>0): ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>Fecha</th>
										<th>Empresa</th>
										<th>Usuario</th>
										<th>Cliente</th>
										<th>Vencimiento</th>
										<th width="100"></th>
							        </tr>
							    </thead>
							    <tbody>
								    <? foreach($presupuestos as $presupuesto): 
									    
									    $fecha=$presupuesto->fecha;
									    $fecha_expira=$presupuesto->fecha_expira;
									    
									    $datetime1 = new DateTime($fecha_expira);
										$datetime2 = new DateTime($fecha);
										$interval = $datetime1->diff($datetime2);
										
								    ?>  
							        <tr>
										<td><?=fechaLetra($presupuesto->fecha)?></td>
										<td><?=$presupuesto->empresa?></td>
										<td><?=$presupuesto->nombre?></td>
										<td><?=$presupuesto->cliente?></td>
										<td><?=fechaLetra($presupuesto->fecha_expira)?> (<? if($fecha>$fecha_expira): echo "Vence en ".$interval->format('%R%a días'); else: echo "Vencido"; endif;?>)</td>
										<td align="right">
											<div class="btn-group">
                                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Opciones
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="?Modulo=VerPresupuesto&id=<?=$presupuesto->id_presupuesto?>"> Ver </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;"> Editar </a>
                                                    </li>
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;"> Cancelar </a>
                                                    </li>
                                                </ul>
                                            </div>
										</td>
							        </tr>
							        <? endforeach ?>
							    </tbody>
							</table>
							<? else: ?>
							<div class="alert alert-dismissable alert-warning">
						  		<button type="button" class="close" data-dismiss="alert">×</button>
						  		<p>Aún no se han creado presupuestos</p>
						  	</div>
							<? endif; ?>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		</div>
	</div>
</div>












<!-- Modal -->
<div class="modal fade" id="nuevaCuenta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title">Nueva Cuenta</h4>
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

		</form>
		      
      </div>
      <div class="modal-footer">
      	<img src="assets/global/img/loading-spinner-grey.gif" border="0" id="load" width="25" class="oculto" />
        <button type="button" class="btn btn-default btn_ac" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success btn_ac" onclick="nuevaCuenta()">Guardar Cuenta</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<!-- Modal -->
<div class="modal fade" id="EditaCuenta">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title">Edita Cuenta</h4>
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
				<label for="nombre" class="col-md-3 control-label">Nombre</label>
				<div class="col-md-9">
					<input type="text" maxlength="64" class="form-control edit" id="nombre" name="nombre" autocomplete="off">
				</div>
			</div>
			
			<input type="hidden" name="id_tipo_ingreso" id="id_tipo_ingreso" />
		</form>
		      
      </div>
      <div class="modal-footer">      	
      	<img src="assets/global/img/loading-spinner-grey.gif" border="0" id="load2" width="25" class="oculto" />
        <button type="button" class="btn btn-default btn_ac btn-modal" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success btn_ac btn-modal" onclick="EditaCuenta()">Actualizar Cuenta</button>
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
	    $.ajax({
	   	url: "data/cuenta_ingresos.php",
	   	data: 'id='+data_id,
	   	success: function(data){
		   	
	   		var datos = data.split('|');
	   		$('#nombre').val(datos[0]);
	   		$('#id_tipo_ingreso').val(data_id);
	   		
	   		$('#load_big').hide();
	   		$('#frm_edita').show();
	   		$('.btn-modal').show();
	  	
	   	},
	   	cache: false
	   });
	});
	
	$('#nuevaCuenta').on('shown.bs.modal',function(e){
		$('#nuevo_nombre').focus();
	});
	
	$('#nuevaCuenta').on('hidden.bs.modal',function(e){
		$('.dat').val("");
		$('#msg_error2').hide();
		$('#msg_error').hide();
	});
	
	$('#EditaCuenta').on('hidden.bs.modal',function(e){
		$('.edit').val("");
		$('#msg_error2').hide();
		$('#msg_error').hide();
	});
	
	$('form').submit(function(e){
		e.preventDefault();	
	});
});

function EditaCuenta(){
	$('#msg_error2').hide('Fast');
	$('.btn_ac').hide();
	$('#load2').show();
	var datos=$('#frm_edita').serialize();
	$.post('ac/edita_cuenta_ingresos.php',datos,function(data){
	    if(data==1){
			window.open("?Modulo=CuentasIngresos&msg=2", "_self");
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
	$.post('ac/activa_desactiva_cuenta_i.php', { tipo: "0", id_cuenta: ""+id+"" },function(data){
		if(data==1){
			window.open("?Modulo=CuentasIngresos", "_self");
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
	$.post('ac/activa_desactiva_cuenta_i.php', { tipo: "1", id_cuenta: ""+id+"" },function(data){
		if(data==1){
			window.open("?Modulo=CuentasIngresos", "_self");
		}else{
			$("#load_"+id+"").hide();
			$(".btn_"+id+"").show();
			alert(data);
		}
	});
}
function nuevaCuenta(){
	$('#msg_error').hide('Fast');
	$('.btn_ac').hide();
	$('#load').show();
	var datos=$('#frm_guarda').serialize();
	$.post('ac/nueva_cuenta_ingresos.php',datos,function(data){
	    if(data==1){
			window.open("?Modulo=CuentasIngresos&msg=1", "_self");
	    }else{
	    	$('#load').hide();
			$('.btn').show();
			$('#msg_error').html(data);
			$('#msg_error').show('Fast');
	    }
	});
}
</script>