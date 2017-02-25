<?
$id_presupuesto=$_GET['id'];
//Sacamos la empresa del presupuesto
$sql="SELECT referencia, fecha, fecha_expira, notas, terminos, ajuste_text, ajuste_monto, borrador, facturado, cliente, representante, empresa, direccion, ciudad, estado, codigo_postal, telefono_1, telefono_2, web, logo FROM books_presupuestos 
JOIN books_usuarios_empresas ON books_usuarios_empresas.id_empresa=books_presupuestos.id_empresa 
JOIN books_empresas ON books_empresas.id_empresa=books_presupuestos.id_empresa 
JOIN books_clientes ON books_clientes.id_cliente=books_presupuestos.id_cliente 
WHERE id_presupuesto=$id_presupuesto AND books_usuarios_empresas.id_usuario=$s_id_usuario AND books_presupuestos.activo=1";
$q=mysql_query($sql);
$valida=mysql_num_rows($q);
if($valida):
	$presupuesto=mysql_fetch_object($q);
	//$presupuesto->fecha;
	
	$productos=array();
	$sql="SELECT * FROM books_presupuestos_producto WHERE id_presupuesto=$id_presupuesto";
	$q=mysql_query($sql);
	while($datos=mysql_fetch_object($q)):
		$productos[] = $datos;
	endwhile;
	$valida_productos=count($productos);

?>							
<div class="page-head">
    <div class="container">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Presupuesto </h1>
        </div>
        <!-- END PAGE TITLE -->
        <!-- BEGIN PAGE TOOLBAR -->
        <div class="page-toolbar">
            <!-- BEGIN THEME PANEL -->
            <div class="btn-group btn-theme-panel hide">
                <a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-settings"></i>
                </a>
                <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h3>HISTORIAL</h3>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <ul class="theme-colors">
                                        <li class="theme-color theme-color-default" data-theme="default">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Default</span>
                                        </li>
                                        <li class="theme-color theme-color-blue-hoki" data-theme="blue-hoki">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Blue Hoki</span>
                                        </li>
                                        <li class="theme-color theme-color-blue-steel" data-theme="blue-steel">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Blue Steel</span>
                                        </li>
                                        <li class="theme-color theme-color-yellow-orange" data-theme="yellow-orange">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Orange</span>
                                        </li>
                                        <li class="theme-color theme-color-yellow-crusta" data-theme="yellow-crusta">
                                            <span class="theme-color-view"></span>
                                            <span class="theme-color-name">Yellow Crusta</span>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                
            </div>
            <!-- END THEME PANEL -->
            <button type="button" style="margin-top: 12px;" class="btn red-thunderbird">Convertir en Factura</button>
            
            <div class="btn-group" style="margin-top: 12px;">
			    <a class="btn blue-chambray dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> Opciones
			        <i class="fa fa-angle-down"></i>
			    </a>
			    <ul class="dropdown-menu pull-right">
			        <li>
			            <a href="javascript:;" > Editar </a>
			        </li>
			        <li>
			            <a href="javascript:;" > Clonar </a>
			        </li>
			        <li>
			            <a href="javascript:;" > Cancelar </a>
			        </li>
			        <li>
			            <a href="javascript:;" > Descargar PDF </a>
			        </li>
			        <li>
			            <a href="javascript:;" > Envíar por Correo </a>
			        </li>
			        
			    </ul>
			</div>


        </div>
        <!-- END PAGE TOOLBAR -->
    </div>
</div>
							

<div class="page-content">
	<div class="container">                   
	                                
	                                
	                                
	                                
		<div class="page-content-inner">
		    <div class="invoice-content-2 ">
		        <div class="row invoice-head">
		            <div class="col-md-7 col-xs-6">
		                <div class="invoice-logo">
		                    <img style="max-width: 330px;" src="files/<?=$presupuesto->logo;?>" class="img-responsive" alt=""  />
		                    <h1 class="uppercase">Invoice</h1>
		                </div>
		            </div>
		            <div class="col-md-5 col-xs-6">
		                <div class="company-address">
		                    <span class="bold uppercase"><?=$presupuesto->empresa;?>.</span>
		                    <br/> <?=$presupuesto->direccion;?>
		                    <br/> <?=$presupuesto->ciudad;?> <?=$presupuesto->estado;?>
		                    <br/>
		                    <span class="bold">T</span> <?=$presupuesto->telefono_1;?>
		                    <br/>
		                    <span class="bold">T</span> <?=$presupuesto->telefono_2;?>
		                    <br/>
		                    <span class="bold">W</span> <?=$presupuesto->web;?> </div>
		            </div>
		        </div>
		        <div class="row invoice-cust-add">
		            <div class="col-xs-6">
		                <h2 class="invoice-title uppercase">Cliente</h2>
		                <p class="invoice-desc"><?=$presupuesto->cliente;?>.<br><?=$presupuesto->representante;?></p>
		            </div>
		            <div class="col-xs-3">
		                <h2 class="invoice-title uppercase" style="text-align: right">Emisión</h2>
		                <p class="invoice-desc" style="text-align: right"><?=$presupuesto->fecha;?></p>
		            </div>
		            <div class="col-xs-3">
		                <h2 class="invoice-title uppercase" style="text-align: right">Vencimiento</h2>
		                <p class="invoice-desc" style="text-align: right"><?=$presupuesto->fecha_expira;?></p>
		            </div>
		        </div>
		        <? if($valida_productos): ?>
		        <div class="row invoice-body">
		            <div class="col-xs-12 table-responsive">
		                <table class="table table-hover">
		                    <thead>
		                        <tr>
		                            <th class="invoice-title uppercase">Descripción</th>
		                            <th class="invoice-title uppercase text-center">Cantidad</th>
		                            <th class="invoice-title uppercase text-center">Precio</th>
		                            <th class="invoice-title uppercase text-center">Descuento</th>
		                            <th class="invoice-title uppercase text-center">Importe</th>
		                        </tr>
		                    </thead>
		                    <tbody>
			                    <? foreach($productos as $producto): ?>
		                        <tr>
		                            <td><?=$producto->producto?></td>
		                            <td class="text-center sbold"><?=number_format($producto->cantidad,2)?></td>
		                            <td class="text-center sbold"><?=number_format($producto->tarifa,2)?></td>
		                            <td class="text-center sbold"><?=number_format($producto->descuento,2)?>%</td>
		                            <td class="text-center sbold"><?=number_format($producto->importe,2)?></td>
		                        </tr>
		                        <? endforeach; ?>
		                    </tbody>
		                </table>
		            </div>
		        </div>
		        <div class="row invoice-subtotal">
		            <div class="col-xs-3">
		                <h2 class="invoice-title uppercase">Subtotal</h2>
		                <p class="invoice-desc">23,800$</p>
		            </div>
		            <div class="col-xs-3">
		                <h2 class="invoice-title uppercase">Tax (0%)</h2>
		                <p class="invoice-desc">0$</p>
		            </div>
		            <div class="col-xs-6">
		                <h2 class="invoice-title uppercase">Total</h2>
		                <p class="invoice-desc grand-total">23,800$</p>
		            </div>
		        </div>
		        <? endif; ?>
		        <div class="row">
		            <div class="col-xs-12">
		                <a class="btn btn-lg green-haze hidden-print uppercase print-btn" onclick="javascript:window.print();">Imprimir</a>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>


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