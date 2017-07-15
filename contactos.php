<?
$sql = "SELECT books_contactos.*, books_contactos.empresa FROM books_contactos LEFT JOIN books_empresas ON books_empresas.id_empresa=books_contactos.id_empresa WHERE (books_contactos.id_empresa=0 OR books_contactos.id_empresa=$s_id_empresa) ORDER BY books_contactos.empresa ASC";
$q=mysql_query($sql);

$contactos = array();

while($datos=mysql_fetch_object($q)):
	$contactos[] = $datos;
endwhile;
$val=count($contactos);

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
								<span class="caption-subject font-dark bold uppercase">Contactos</span>
							</div>
							<div class="actions btn-set">
								<a href="?Modulo=Contacto" class="btn btn-sm blue-chambray "><i class="fa fa-plus"></i> Agregar Contacto </a>
							</div>
						</div>
						<div class="portlet-body">
							<? if($val>0): ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
							        <tr>
							          <th>Nombre</th>
							          <th>Empresa</th>
							          <th>Teléfono</th>
							          <th>Email</th>
							          <th width="150">Cuentas por Cobrar</th>
							          <th width="150">Cuentas por Pagar</th>
							          <th width="150"></th>
							        </tr>
							      </thead>
							      <tbody>
								    <? foreach($contactos as $contacto): ?>  
							        <tr class="tr_<?=$contacto->id_contacto?>">
										<td><?=$contacto->representante?></td>
										<td><?=$contacto->empresa?></td>
										<td><?=$contacto->telefono?></td>
										<td><?=$contacto->email?></td>
										<td><?=getCuentasPorCobrarMonto($contacto->id_contacto)?></td>
										<td><?=getCuentasPorPagarMonto($contacto->id_contacto)?></td>
										<td align="right">
											<a role="button" href="?Modulo=Contacto&id=<?=$contacto->id_contacto?>" class="btn blue btn-xs btn_<?=$contacto->id_contacto?>">Editar</a>
											<a role="button" class="btn red btn-xs btn_<?=$contactos->id_contacto?>" onclick="javascript:Desactiva(<?=$contacto->id_contacto?>)">Desactivar</a>
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
	</div>
</div>

<!--- Js -->
<script>
function Desactiva(id){
	App.blockUI();
	$.post('ac/activa_desactiva_contacto.php', { tipo: "0", id_proveedor: ""+id+"" },function(data){
		if(data==1){
			$(".tr_"+id).remove();
			App.unblockUI();
		}else{
			App.unblockUI();
			alert(data);
		}
	});
}
function Activa(id){
	App.blockUI();
	$.post('ac/activa_desactiva_contacto.php', { tipo: "1", id_proveedor: ""+id+"" },function(data){
		if(data==1){
			$(".tr_"+id).remove();
		}else{
			App.unblockUI();
			alert(data);
		}
	});
}
</script>