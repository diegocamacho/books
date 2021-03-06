<?
$sql="SELECT id_empresa, empresa FROM books_empresas WHERE activo=1";
$q=mysql_query($sql);
$empresas = array();
while($datos=mysql_fetch_object($q)):
	$empresas[] = $datos;
endwhile;
$valida_empresas=count($empresas);
$cuenta=1;

//Gastos
$mes = "1";
$ano = date("Y");


for ($i = $mes; $i <= 12; $i++):
	$fecha1=$ano."-".$i."-"."01";
	$fecha2=$ano."-".$i."-".ultimoDia($ano,$mes);
	$sql="SELECT SUM(monto) AS total FROM books_gastos WHERE DATE(fecha_gasto) BETWEEN '$fecha1' AND '$fecha2'";
	$q=mysql_query($sql);
	$ft=mysql_fetch_assoc($q);
	
	if($ft['total']):
		$total=$ft['total'];
	else:
		$total=0;
	endif;
	
	if($i==1):
		$c_gastos=$total;
	else:
		$c_gastos.=",".$total;	
	endif;
	
endfor;

//Ingresos
for ($i = $mes; $i <= 12; $i++):
	$fecha1=$ano."-".$i."-"."01";
	$fecha2=$ano."-".$i."-".ultimoDia($ano,$mes);
	$sql="SELECT SUM(monto) AS total FROM books_ingresos WHERE DATE(fecha_ingreso) BETWEEN '$fecha1' AND '$fecha2'";
	$q=mysql_query($sql);
	$ft=mysql_fetch_assoc($q);
	
	if($ft['total']):
		$total=$ft['total'];
	else:
		$total=0;
	endif;
	
	if($i==1):
		$c_ingresos=$total;
	else:
		$c_ingresos.=",".$total;	
	endif;
	
endfor;
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
			<? if($valida_empresas): ?>
			<div class="row">
				<div class="col-md-12">
			        <!-- BEGIN BORDERED TABLE PORTLET-->
			        <div class="portlet light portlet-fit ">
			            <div class="portlet-title">
			                <div class="caption">
			                    <i class="icon-book-open font-dark"></i>
			                    <span class="caption-subject font-dark sbold uppercase">Adminus Books Resumen</span>
			                </div>
			                <div class="actions">
				                
			                    <!--<a href="?Modulo=Cuentas" class="btn btn-sm blue-chambray "><i class="fa fa-plus"></i> Crear cuenta </a>-->
			                    
			                </div>
			            </div>
			            <div class="portlet-body">
			                <div class="table-scrollable table-scrollable-borderless">
			                    <table class="table table-hover table-light">
			                        <thead>
			                            <tr class="uppercase">
			                                <th width="40"> # </th>
			                                <th> Empresas </th>
			                                <th width="120" style="text-align: right"> Efectivo </th>
			                                <th width="120" style="text-align: right"> Banco </th>
			                                <th width="150"> </th>
			                            </tr>
			                        </thead>
			                        <tbody>
				                        <? foreach($empresas as $empresa): 
					                        
					                        //Sacamos saldos
					                        unset($total_ingresos);
					                        unset($total_egresos);
					                        //unset($saldo);
					                        $id_empresa=$empresa->id_empresa;
		
					                        $sql="SELECT id_cuenta FROM books_cuentas WHERE id_empresa=$id_empresa AND activo=1 AND tipo_cuenta=2";
					                        $q=mysql_query($sql);
					                        while($ft=mysql_fetch_assoc($q)):
					                        	$id_cuenta=$ft['id_cuenta'];
					                        	
					                        	//movimientos
					                        	$ingresos=dameIngresos($id_cuenta);
												$egresos=dameEgresoso($id_cuenta);
					                        	
					                        	$total_ingresos+=$ingresos;
					                        	$total_egresos+=$egresos;
					                        endwhile;
					                        $saldo_efectivo=$total_ingresos-$total_egresos;
					                        
					                        unset($total_ingresos);
					                        unset($total_egresos);
					                        $sql="SELECT id_cuenta FROM books_cuentas WHERE id_empresa=$id_empresa AND activo=1 AND tipo_cuenta=3";
					                        $q=mysql_query($sql);
					                        while($ft=mysql_fetch_assoc($q)):
					                        	$id_cuenta=$ft['id_cuenta'];
					                        	
					                        	//movimientos
					                        	$ingresos=dameIngresos($id_cuenta);
												$egresos=dameEgresoso($id_cuenta);
					                        	
					                        	$total_ingresos+=$ingresos;
					                        	$total_egresos+=$egresos;
					                        endwhile;
					                        $saldo_banco=$total_ingresos-$total_egresos;
		
				                        ?>
			                            <tr>
			                                <td> <?=$cuenta?> </td>
			                                <td> <?=$empresa->empresa?> </td>
			                                <td align="right" class="font-dark"> <?=number_format($saldo_efectivo,2)?> </td>
			                                <td align="right" class="font-dark"> <?=number_format($saldo_banco,2)?> </td>
		
			                                <td align="right">
			                                    <a href="?Modulo=Operaciones&id=<?=$empresa->id_empresa?>" role="button" class="btn  blue-chambray btn-xs ">Cuentas</a>
			                                </td>
			                            </tr>
			                            <? 
				                            
				                            $cuenta++;
				                            endforeach; ?>
			                            
			                        </tbody>
			                    </table>
			                </div>
			            </div>
			        </div>
			        <!-- END BORDERED TABLE PORTLET-->
			    </div>
			</div>
		<!--	
			<center>
				<input type="button" value="Imprimir" id="imprimir" />
			</center>	
			<br/>
		-->
		
			<div class="row">
			    <div class="col-md-12">
			        <div class="portlet light portlet-fit ">
			            <div class="portlet-title">
			                <div class="caption">
			                    <i class=" icon-layers font-dark"></i>
			                    <span class="caption-subject font-dark bold uppercase">Estadisticas</span>
			                </div>
			                <div class="actions">
			                    
			                </div>
			            </div>
			            <div class="portlet-body">
			                <div id="echarts_bar" style="height:500px;"></div>
			            </div>
			        </div>
			    </div>
			</div>
			<? else: ?>
			
			
			
			<? endif; ?>
		</div>
	</div>
</div>




<script>
jQuery(document).ready(function() {
	
	
	$('#imprimir').click(function() {
		alert('click');
		$.get('http://epicmedia.pro/dentista/print.php',function(data) {
			alert('data');
			$.post('http://localhost/imprimir_remoto.php','imprimir='+data,function() {			
				alert('post');
			});

			
		
		})
			
	
	});
	
	
    // ECHARTS
    require.config({
        paths: {
            echarts: 'assets/global/plugins/echarts/'
        }
    });

    // DEMOS
    require(
        [
            'echarts',
            'echarts/chart/bar',
            'echarts/chart/chord',
            'echarts/chart/eventRiver',
            'echarts/chart/force',
            'echarts/chart/funnel',
            'echarts/chart/gauge',
            'echarts/chart/heatmap',
            'echarts/chart/k',
            'echarts/chart/line',
            'echarts/chart/map',
            'echarts/chart/pie',
            'echarts/chart/radar',
            'echarts/chart/scatter',
            'echarts/chart/tree',
            'echarts/chart/treemap',
            'echarts/chart/venn',
            'echarts/chart/wordCloud'
        ],
        function(ec) {
            //--- BAR ---
            var myChart = ec.init(document.getElementById('echarts_bar'));
            myChart.setOption({
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['Egresos', 'Ingresos']
                },
                toolbox: {
                    show: false,
                    feature: {
                        mark: {
                            show: true
                        },
                        dataView: {
                            show: true,
                            readOnly: false
                        },
                        magicType: {
                            show: true,
                            type: ['line', 'bar']
                        },
                        restore: {
                            show: true
                        },
                        saveAsImage: {
                            show: true
                        }
                    }
                },
                calculable: true,
                xAxis: [{
                    type: 'category',
                    data: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                }],
                yAxis: [{
                    type: 'value',
                    splitArea: {
                        show: true
                    }
                }],
                series: [{
                    name: 'Egresos',
                    type: 'bar',
                    data: [<?=$c_gastos?>]
                }, {
                    name: 'Ingresos',
                    type: 'bar',
                    data: [<?=$c_ingresos?>]
                }]
            });

        }
    );
});	
</script>