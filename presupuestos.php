<?

$sql="SELECT 
books_empresas.empresa, 
books_presupuestos.fecha,
books_presupuestos.fecha_expira, 
books_presupuestos.id_presupuesto, 
books_presupuestos.estado,
books_presupuestos.folio_presupuesto
FROM books_presupuestos
JOIN books_contactos ON books_contactos.id_contacto=books_presupuestos.id_contacto
JOIN books_empresas ON books_empresas.id_empresa=books_presupuestos.id_empresa
JOIN usuarios ON usuarios.id_usuario=books_presupuestos.id_usuario
WHERE books_presupuestos.id_empresa=$s_id_empresa ORDER BY id_presupuesto DESC";

$q=mysql_query($sql);

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
								<span class="caption-subject font-dark bold uppercase">TODOS LOS PRESUPUESTOS</span>
							</div>
							<div class="actions btn-set">
								<div class="btn-group">
                                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Ver
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
	                                    <li>
                                            <a href="#"> Todo </a>
                                        </li>
	                                    <li>
                                            <a href="#"> Borrador </a>
                                        </li>
	                                    <li>
                                            <a href="#"> Enviado </a>
                                        </li>
	                                    <li>
                                            <a href="#"> Vencido </a>
                                        </li>
	                                    <li>
                                            <a href="#"> Aceptado </a>
                                        </li>
	                                    <li>
                                            <a href="#"> Rechazado </a>
                                        </li>
	                                    <li>
                                            <a href="#"> Visto por el Cliente </a>
                                        </li>
                                    </ul>
                                </div>&nbsp;&nbsp;
								<a href="?Modulo=Presupuesto" class="btn btn-sm btn-danger "> Nuevo Presupuesto </a>

							</div>
						</div>
						<div class="portlet-body">
							<? if($val>0): ?>
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th width="120">Fecha</th>
										<th width="120">Presupuesto</th>
										<th>Cliente</th>
										<th>Estado</th>
										<th width="120">Monto</th>
										<th width="100"></th>
							        </tr>
							    </thead>
							    <tbody>
								    <? foreach($presupuestos as $presupuesto): 
									    
									    $fecha=$presupuesto->fecha;
									    $fecha_expira=$presupuesto->fecha_expira;
									   										
								    ?>  
							        <tr>
										<td><?=fechaLetra($presupuesto->fecha)?></td>
										<td style="text-align: left">PRE-<?=$presupuesto->folio_presupuesto?></td>
										<td><?=$presupuesto->cliente?></td>
										<td><?=$fecha?></td>
										<td><?=number_format(getMonto($presupuesto->id_presupuesto),2)?></td>
										<td align="right">
											<div class="btn-group">
                                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Opciones
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="?Modulo=VerPresupuesto&id=<?=$presupuesto->id_presupuesto?>"> Ver </a>
                                                    </li>
                                                    <li>
                                                        <a href="?Modulo=Presupuesto&id=<?=$presupuesto->id_presupuesto?>"> Editar </a>
                                                    </li>
													<li>
													    <a href="?Modulo=Presupuesto&id=<?=$presupuesto->id_presupuesto?>&c=1" > Clonar </a>
													</li>
													<li>
													    <a href="data/download.php?id=<?=$presupuesto->id_presupuesto?>" > Descargar PDF </a>
													</li>
													<li>
													    <a href="?Modulo=EnviarCorreo&id=<?=$presupuesto->id_presupuesto?>" > Enviar por Correo </a>
													</li>
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;" class="text-danger bold"> Convertir en Remisión </a>
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
						  		<p>Aún no se han creado <?=$titulo?></p>
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
/*
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
	
}	*/
</script>