<? include('includes/session_ui.php'); 
include('includes/db.php'); 
include('includes/funciones.php');
$menu = isset($_GET['Modulo']) ? $_GET['Modulo']: NULL;
?>
<!DOCTYPE html>
<!-- 
Build with Twitter Bootstrap 3.3.7
Version: 4.7.1
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Admin Books</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #3 for dashboard & statistics" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        
        <link href="js/dropzone.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> </head>
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
		<style>
			.oculto{
				display: none;
			}
		</style>
        
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
        <div class="page-wrapper">
            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div class="page-header">
                        <!-- BEGIN HEADER TOP -->
                        <div class="page-header-top">
                            <div class="container">
                                <!-- BEGIN LOGO -->
                                <div class="page-logo">
                                    <a href="index.php">
                                        <img src="logo.png" alt="logo" class="logo-default" height="26" style="margin-top: 26px;">
                                    </a>
                                </div>
                                <!-- END LOGO -->
                                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                                <a href="javascript:;" class="menu-toggler"></a>
                                <!-- END RESPONSIVE MENU TOGGLER -->
                                <!-- BEGIN TOP NAVIGATION MENU -->
                                <div class="top-menu">
                                    <ul class="nav navbar-nav pull-right">
                                        
                                        <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <li class="dropdown dropdown-user dropdown-dark">
                                            <a href="javascript:;" class="dropdown-toggle" data-close-others="true">
                                                <img alt="" class="img-circle" src="<? if($s_display){ echo "files/thumb_".$s_display; }else{ echo "files/bot_icon.png"; }?>">
                                                <span class="username username-hide-mobile"><?=$s_nombre?><br><small><?= dameClinica($s_id_clinica); ?></small></span>
                                            </a>
                                        </li>
                                        <!-- END USER LOGIN DROPDOWN -->
                                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                                        <li class="dropdown dropdown-extended quick-sidebar-toggler">
                                            <span class="sr-only">Salir</span>
                                            <i class="icon-logout"></i>
                                        </li>
                                        <!-- END QUICK SIDEBAR TOGGLER -->
                                    </ul>
                                </div>
                                <!-- END TOP NAVIGATION MENU -->
                            </div>
                        </div>
                        <!-- END HEADER TOP -->
                        <!-- BEGIN HEADER MENU -->
                        <div class="page-header-menu">
                            <div class="container">
                                <!-- BEGIN MEGA MENU -->
                                <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                                <div class="hor-menu hor-menu-light">
                                    <ul class="nav navbar-nav">
	                                    <li <? if(!$menu){ ?>class="active"<?}?>><a href="index.php">Escritorio</a></li>
                                        
                                        <? if($s_tipo==1): ?>
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                            <a href="javascript:;"> Ventas
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Presupuestos" class="nav-link">Presupuestos</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Facturas" class="nav-link">Facturas</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=PagosRecibidos" class="nav-link">Pagos recibidos</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                            <a href="javascript:;"> Compras
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Gastos" class="nav-link">Gastos</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=FacturasProveedor" class="nav-link">Facturas de proveedor</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=PagosRealizados" class="nav-link">Pagos realizados</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        <li <? if($menu=="Operaciones"){ ?>class="active"<?}?>><a href="?Modulo=Operaciones"> Operaciones</a></li>
                                        
                                        <? $facturacion_activa = ($menu=="Facturacion") ? 'active' : ''; ?>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown <?=$facturacion_activa?>">
                                            <a href="javascript:;"> Facturación
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Facturacion" class="nav-link">Facturas</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Facturacion&Tipo=2" class="nav-link">Facturas Canceladas</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=PreFacturas" class="nav-link">Pre Facturas</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown hide">
                                            <a href="javascript:;"> Reportes
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true">
                                                    <a href="javascript:;" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#reporte-ventas" class="nav-link">Ventas</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="javascript:;" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#reporte-citas" class="nav-link">Citas</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="javascript:;" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#reporte-citas-dia" class="nav-link">Citas por día</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        <!--
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown">
                                            <a href="javascript:;"> Configuración
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Usuarios" class="nav-link">Usuarios</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Clinicas" class="nav-link">Clínicas</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Canales" class="nav-link">Canales</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Tratamientos" class="nav-link">Tratamientos</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Promociones" class="nav-link">Promociones</a>
                                                </li>
                                                <li aria-haspopup="true">
                                                    <a href="?Modulo=Proveedores" class="nav-link">Proveedores</a>
                                                </li>
                                            </ul>
                                        </li>
                                        -->
                                        
                                        <li aria-haspopup="true" class="menu-dropdown mega-menu-dropdown  ">
                                            <a href="javascript:;"> Configuración
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-right" style="min-width: 710px">
                                                <li>
                                                    <div class="mega-menu-content">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <ul class="mega-menu-submenu">
                                                                    <li>
                                                                        <h3> Configuración General</h3>
                                                                    </li>
                                                                    <li>
                                                                        <a href="?Modulo=Usuarios"> Usuarios </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="?Modulo=Empresas"> Empresas </a>
                                                                    </li>
                                                                    <!--
                                                                    <li>
                                                                        <a href="#"> Facturación </a>
                                                                    </li>
                                                                    -->
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <ul class="mega-menu-submenu">
                                                                    <li>
                                                                        <h3>Configuración Books</h3>
                                                                    </li>
                                                                    <li>
                                                                        <a href="?Modulo=Cuentas"> Cuentas </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="?Modulo=Clientes"> Clientes</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="?Modulo=Proveedores"> Proveedores </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="?Modulo=CuentasGastos"> Cuentas de Gastos </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="?Modulo=CuentasIngresos"> Cuentas de Ingresos </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4">Banner de publicidad o algo </div>
                                                            
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                        
                                        <? endif; ?>
                                    </ul>
                                </div>
                                <!-- END MEGA MENU -->
                            </div>
                        </div>
                        <!-- END HEADER MENU -->
                    </div>
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                           
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <?
                                	switch($menu):
							    		
							    		case 'Usuarios':
							    		include("usuarios.php");	
							    		break;

							    		/* Books */
							    		
							    		case 'Cuentas':
							    		include("cuentas.php");	
							    		break;

							    		case 'Empresas':
							    		include("empresas.php");	
							    		break;

							    		case 'CuentasGastos':
							    		include("cuentas_gastos.php");	
							    		break;
							    		
							    		case 'CuentasIngresos':
							    		include("cuentas_ingresos.php");	
							    		break;
							    		
							    		case 'Proveedores':
							    		include("proveedores.php");	
							    		break;
							    		
							    		case 'Transacciones':
							    		include("transacciones.php");	
							    		break;
							    		
							    		case 'Operaciones':
							    		include("operaciones.php");	
							    		break;
							    		
							    		case 'Clientes':
							    		include("clientes.php");	
							    		break;
							    		
							    		/* Facturacion */
							    		
							    		case 'Facturacion':
							    		include("facturacion.php");	
							    		break;
							    		
							    		case 'PreFacturas':
							    		include("pre_facturas.php");	
							    		break;

							    		default:
							    		include('dashboard.php');
							    	
									endswitch;
									
									?>
                                </div>
                            </div>
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->
                        
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <div class="page-wrapper-row">
                <div class="page-wrapper-bottom">
                    <!-- BEGIN FOOTER -->
                    <!-- BEGIN INNER FOOTER -->
                    <div class="page-footer">
                        <div class="container"> <?=date('Y')?> © Adminus Books. Hecho con <i class="fa fa-heart" style="color: #e74c3c;"></i> &amp; <i class="fa fa-coffee"></i> por <a href="http://epicmedia.pro" target="_blank">EPICMEDIA</a>
                        </div>
                    </div>
                    <div class="scroll-to-top">
                        <i class="icon-arrow-up"></i>
                    </div>
                    <!-- END INNER FOOTER -->
                    <!-- END FOOTER -->
                </div>
            </div>
        </div>
        
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/fullcalendar/lang-all.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
        
        <script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		
		<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        
        
        <script src="assets/global/plugins/echarts/echarts.js" type="text/javascript"></script>
        
        
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="assets/global/scripts/app.js" type="text/javascript"></script>
        
        <!-- END THEME GLOBAL SCRIPTS -->
        <script src="assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
        <script src="assets/pages/scripts/components-select2.js" type="text/javascript"></script>
        <script src="assets/pages/scripts/components-bootstrap-select.min.js" type="text/javascript"></script>
        
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
	        $(function(){
	        	$('.quick-sidebar-toggler').click(function(){
		        	window.open("login.php", "_self");
	        	});
	        });
	    </script>
    </body>

</html>




<!-- Reportes -->

<!-- Modal -->
<div class="modal fade" id="reporte-ventas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title">Reporte de ventas</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger oculto" role="alert" id="reporte-msg_error"></div>
<!--Formulario -->
		<form class="form-horizontal" id="frm-reporte-ventas">
			
			<div class="form-group">
				<label for="direccion" class="col-md-4 control-label">Clínica</label>
				<div class="col-md-7">
					<select class="form-control r_limpia_s" name="id_clinica" id="ventas_id_clinica">
						<option value="0">Seleccione una clínica</option>
						<? foreach($clinicas as $clinica): ?>
						<option value="<?=$clinica->id_clinica?>"><?=$clinica->clinica?></option>
						<? endforeach; ?>
					</select>
				</div>
			</div>
            
            <div class="form-group">
                <label class="control-label col-md-4">Rango de fechas</label>
                <div class="col-md-8">
                    <div class="input-group input-large date-picker input-daterange" data-date="" data-date-format="yyyy-mm-dd">
						<input type="text" class="form-control r_limpia" name="fecha1" id="ventas_fecha1">
						<span class="input-group-addon"> a </span>
						<input type="text" class="form-control r_limpia" name="fecha2" id="ventas_fecha2"> 
					</div>
                </div>
            </div>            
            
		</form>
	</div>
		
    <div class="modal-footer">
    	<img src="assets/global/img/loading-spinner-grey.gif" border="0" id="reporte-load" width="20" class="oculto" />
		<button type="button" class="btn btn-default btn_ac" data-dismiss="modal">Cancelar</button>
		<button type="button" class="btn btn-success btn_ac" onclick="reporteVentas()">Aceptar</button>
	</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	

<div class="modal fade" id="reporte-citas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title">Reporte de citas</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger oculto" role="alert" id="citas-msg_error"></div>
<!--Formulario -->
		<form class="form-horizontal" id="frm-reporte-citas">
			
			<div class="form-group">
				<label for="direccion" class="col-md-4 control-label">Clínica</label>
				<div class="col-md-7">
					<select class="form-control r_limpia_s" name="id_clinica" id="citas_id_clinica">
						<option value="0">Seleccione una clínica</option>
						<? foreach($clinicas as $clinica): ?>
						<option value="<?=$clinica->id_clinica?>"><?=$clinica->clinica?></option>
						<? endforeach; ?>
					</select>
				</div>
			</div>
            
            <div class="form-group">
                <label class="control-label col-md-4">Rango de fechas</label>
                <div class="col-md-8">
                    <div class="input-group input-large date-picker input-daterange" data-date="" data-date-format="yyyy-mm-dd">
						<input type="text" class="form-control r_limpia" name="fecha1" id="citas_fecha1">
						<span class="input-group-addon"> a </span>
						<input type="text" class="form-control r_limpia" name="fecha2" id="citas_fecha2"> 
					</div>
                </div>
            </div>            
            
		</form>
	</div>
		
    <div class="modal-footer">
    	<img src="assets/global/img/loading-spinner-grey.gif" border="0" id="citas-load" width="20" class="oculto" />
		<button type="button" class="btn btn-default btn_ac" data-dismiss="modal">Cancelar</button>
		<button type="button" class="btn btn-success btn_ac" onclick="reporteCitas()">Aceptar</button>
	</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	


<div class="modal fade" id="reporte-citas-dia">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
        <h4 class="modal-title">Reporte de citas por día</h4>
      </div>
      <div class="modal-body">
      	<div class="alert alert-danger oculto" role="alert" id="dia-msg_error"></div>
<!--Formulario -->
		<form class="form-horizontal" id="frm-reporte-dia">
			
			<div class="form-group">
				<label for="direccion" class="col-md-4 control-label">Clínica</label>
				<div class="col-md-7">
					<select class="form-control r_limpia_s" name="id_clinica" id="dia_id_clinica">
						<option value="0">Seleccione una clínica</option>
						<? foreach($clinicas as $clinica): ?>
						<option value="<?=$clinica->id_clinica?>"><?=$clinica->clinica?></option>
						<? endforeach; ?>
					</select>
				</div>
			</div>
            
            <div class="form-group">
                <label class="control-label col-md-4">Rango de fechas</label>
                <div class="col-md-8">
                    <div class="input-group input-large date-picker input-daterange" data-date="" data-date-format="dd-mm-yyyy">
						<input type="text" class="form-control r_limpia" name="fecha1" id="dia_fecha1">
						<span class="input-group-addon"> a </span>
						<input type="text" class="form-control r_limpia" name="fecha2" id="dia_fecha2"> 
					</div>
                </div>
            </div>            
            
		</form>
	</div>
		
    <div class="modal-footer">
    	<img src="assets/global/img/loading-spinner-grey.gif" border="0" id="citas-load" width="20" class="oculto" />
		<button type="button" class="btn btn-default btn_ac" data-dismiss="modal">Cancelar</button>
		<button type="button" class="btn btn-success btn_ac" onclick="reporteCitasDia()">Aceptar</button>
	</div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	

<script>
$(function(){
	$('#reporte-citas-dia').on('hidden.bs.modal',function(e){
		$('#dia_id_clinica').val("0");
		$('.r_limpia').val("");
		$('#dia-msg_error').hide();
	});	
	$('#reporte-citas').on('hidden.bs.modal',function(e){
		$('#citas_id_clinica').val("0");
		$('.r_limpia').val("");
		$('#citas-msg_error').hide();
	});	
	$('#reporte-ventas').on('hidden.bs.modal',function(e){
		$('#ventas_id_clinica').val("0");
		$('.r_limpia').val("");
		$('#reporte-msg_error').hide();
	});		
});
function reporteVentas(){
	var id_clinica 	= Number($('#ventas_id_clinica').val());
	var fecha1		= $('#ventas_fecha1').val();
	var fecha2		= $('#ventas_fecha2').val();
	
	if(id_clinica==0){
		$('#reporte-msg_error').html("Debe seleccionar una clínica para generar el reporte");
		$('#reporte-msg_error').show('Fast');
		return false;
	}
	
	if(!fecha1){
		$('#reporte-msg_error').html("Seleccione la fecha de inicio");
		$('#reporte-msg_error').show('Fast');
		return false;
	}
	
	if(!fecha2){
		$('#reporte-msg_error').html("Seleccione la fecha final");
		$('#reporte-msg_error').show('Fast');
		return false;
	}
	
	$('#reporte-msg_error').hide('Fast');
	//$('.btn_ac').hide();
	//$('#reporte-load').show();
	var datos=$('#frm-reporte-ventas').serialize();
	window.open("reportes/ventas.php?"+datos, "_blank");	    
}


function reporteCitas(){
	var id_clinica 	= Number($('#citas_id_clinica').val());
	var fecha1		= $('#citas_fecha1').val();
	var fecha2		= $('#citas_fecha2').val();
	
	if(id_clinica==0){
		$('#citas-msg_error').html("Debe seleccionar una clínica para generar el reporte");
		$('#citas-msg_error').show('Fast');
		return false;
	}
	
	if(!fecha1){
		$('#citas-msg_error').html("Seleccione la fecha de inicio");
		$('#citas-msg_error').show('Fast');
		return false;
	}
	
	if(!fecha2){
		$('#citas-msg_error').html("Seleccione la fecha final");
		$('#citas-msg_error').show('Fast');
		return false;
	}
	
	$('#citas-msg_error').hide('Fast');
	//$('.btn_ac').hide();
	//$('#reporte-load').show();
	var datos=$('#frm-reporte-citas').serialize();
	window.open("reportes/citas.php?"+datos, "_blank");	    
}

function reporteCitasDia(){
	var id_clinica 	= Number($('#dia_id_clinica').val());
	var fecha1		= $('#dia_fecha1').val();
	var fecha2		= $('#dia_fecha2').val();
	
	if(id_clinica==0){
		$('#dia-msg_error').html("Debe seleccionar una clínica para generar el reporte");
		$('#dia-msg_error').show('Fast');
		return false;
	}
	
	if(!fecha1){
		$('#dia-msg_error').html("Seleccione la fecha de inicio");
		$('#dia-msg_error').show('Fast');
		return false;
	}
	
	if(!fecha2){
		$('#dia-msg_error').html("Seleccione la fecha final");
		$('#dia-msg_error').show('Fast');
		return false;
	}
	
	$('#dia-msg_error').hide('Fast');
	//$('.btn_ac').hide();
	//$('#reporte-load').show();
	var datos=$('#frm-reporte-dia').serialize();
	window.open("reportes/citasxdia.php?"+datos, "_blank");	    
}
</script>