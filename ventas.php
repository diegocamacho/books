<?
if(!$_GET['Estado']){
	$estado=0;
}else{
	$estado=escapar($_GET['Estado'],1);	
}

$tipo=escapar($_GET['Tipo']);
//1:presupuesto - 2:Borrador - 3:Presupuesto Cancelado - 4:Remisión - 5:Remisión Cancelada
if($tipo=="Presupuestos"){
	if($estado==1){
		$titulo="presupuestos";
		$consula="books_ventas.estado=1";
	}elseif($estado==2){
		$titulo="presupuestos (borradores)";
		$consula="books_ventas.estado=2";
	}elseif($estado==3){
		$titulo="presupuestos cancelados";
		$consula="books_ventas.estado=3";
	}else{
		$titulo="presupuestos";
		$consula="books_ventas.estado <= 3";
	}
}elseif($tipo=="Remisiones"){
	if($estado==4){
		$titulo="remisiones";
		$consula="books_ventas.estado=4";
	}elseif($estado==5){
		$titulo="remisiones canceladas";
		$consula="books_ventas.estado=5";
	}else{
		$titulo="remisiones";
		$consula="books_ventas.estado > 3";
	}
}

$sql="SELECT empresa, fecha, fecha_expira, nombre, borrador, cliente, id_venta, books_ventas.estado FROM books_ventas
JOIN books_clientes ON books_clientes.id_cliente=books_ventas.id_cliente
JOIN books_empresas ON books_empresas.id_empresa=books_ventas.id_empresa
JOIN usuarios ON usuarios.id_usuario=books_ventas.id_usuario
WHERE books_ventas.id_empresa=$s_id_empresa AND $consula";
$q=mysql_query($sql);
$ventas = array();
while($datos=mysql_fetch_object($q)):
	$ventas[] = $datos;
endwhile;
$val=count($ventas);

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
								<span class="caption-subject font-dark bold uppercase"><?=$titulo?></span>
							</div>
							<div class="actions btn-set">
								<a href="?Modulo=Presupuesto" class="btn btn-sm btn-default "> Nuevo presupuesto </a>&nbsp;&nbsp;
								<div class="btn-group">
                                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Filtros
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
	                                    <li>
                                            <a href="?Modulo=Ventas&Tipo=Presupuestos&Estado=1"> Presupuestos </a>
                                        </li>
                                        <li>
                                            <a href="?Modulo=Ventas&Tipo=Presupuestos&Estado=2"> Borradores </a>
                                        </li>
                                        <li>
                                            <a href="?Modulo=Ventas&Tipo=Presupuestos&Estado=3"> Cancelados </a>
                                        </li>
                                        <li class="divider"> </li>
										<li>
                                        	<a href="?Modulo=Ventas&Tipo=Presupuestos"> Todos los presupuestos </a>
										</li>
                                    </ul>
                                </div>
                                
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
										<? if(!$estado){ ?><th>Estado</th><? } ?>
										<th width="100"></th>
							        </tr>
							    </thead>
							    <tbody>
								    <? foreach($ventas as $venta): 
									    
									    $fecha=$venta->fecha;
									    $fecha_expira=$venta->fecha_expira;
									    
									    $datetime1 = new DateTime($fecha_expira);
										$datetime2 = new DateTime($fecha);
										$interval = $datetime1->diff($datetime2);
										
								    ?>  
							        <tr>
										<td><?=fechaLetra($venta->fecha)?></td>
										<td><?=$venta->empresa?></td>
										<td><?=$venta->nombre?></td>
										<td><?=$venta->cliente?></td>
										<td><?=fechaLetra($venta->fecha_expira)?> (<? if($fecha>$fecha_expira): echo "Vence en ".$interval->format('%R%a días'); else: echo "Vencido"; endif;?>)</td>
										<? if(!$estado){ ?><td><?=dameEstado($venta->estado)?></td><? } ?>
										<td align="right">
											<div class="btn-group">
                                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Opciones
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right" role="menu">
                                                    <li>
                                                        <a href="?Modulo=VerPresupuesto&id=<?=$venta->id_venta?>"> Ver </a>
                                                    </li>
                                                    <li>
                                                        <a href="?Modulo=Presupuesto&id=<?=$venta->id_venta?>"> Editar </a>
                                                    </li>
													<li>
													    <a href="javascript:;" > Clonar </a>
													</li>
													<li>
														<? if($tipo=="Presupuestos"){ ?>
													    <a href="javascript:;" onclick="cancelaVenta(<?=$venta->id_venta?>,3)"> Cancelar </a>
													    <? }elseif($tipo=="Remisiones"){ ?>
													    <a href="javascript:;" onclick="cancelaVenta(<?=$venta->id_venta?>,5)"> Cancelar </a>
													    <? } ?>
													</li>
													<li>
													    <a href="javascript:;" > Descargar PDF </a>
													</li>
													<li>
													    <a href="javascript:;" > Envíar por Correo </a>
													</li>
                                                    <li class="divider"> </li>
                                                    <li>
                                                        <a href="javascript:;" class="text-danger bold"> Convertir en remisión </a>
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
		var msg="x";
		var ms2="x";
		var txt="x";
		var btn="x";
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
	
</script>