<?php
if(is_numeric($_GET['id_clinica'])):
	$id_clinica_event = "?id_clinica=".$_GET['id_clinica'];
	$nombreClinica = @dameClinica($_GET['id_clinica']);
	if(!$nombreClinica):
		$nombreClinica = 'Todos';
		$id_clinica_event = '';
	endif;
else:
	$nombreClinica = 'Todos';
endif;
?>

<div class="page-content-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit  calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">Agenda de <?=$nombreClinica?></span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div id="calendar" class="has-toolbar"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
var AppCalendar = function() {

    return {
        //main function to initiate the module
        init: function() {
            this.initCalendar();
        },

        initCalendar: function() {

            if (!jQuery().fullCalendar) {
                return;
            }

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();
            var h = {};

            if ($('#calendar').parents(".portlet").width() <= 720) {
                $('#calendar').addClass("mobile");
                h = {
                    left: 'title, prev, next',
                    center: '',
                    right: 'today,month,agendaWeek,agendaDay'
                };
            } else {
                $('#calendar').removeClass("mobile");
                h = {
                    left: 'title',
                    center: '',
                    right: 'prev,next,today,month,agendaWeek,agendaDay'
                };
            }

			$('#VerDetalle').on('hidden.bs.modal', function () {
			  	$('.inp').html('Cargando...');
			});

            $('#calendar').fullCalendar('destroy');
            $('#calendar').fullCalendar({
	            lang: 'es',
                header: h,
                defaultView: 'month',
                slotMinutes: 15,
                editable: false,
                droppable: false,
                displayEventTime: false,
                events: 'eventos.php<?=$id_clinica_event?>',

		        eventClick: function (calEvent, jsEvent, view) {
					
					$.getJSON('data/agenda.php', {id_cita:calEvent.id} ,function(data) {
						
						var confirmada = (data.confirmada==1) ? '<u>Confirmada</u>' : 'Por Confirmar';						
						
						$('#estado').html(confirmada);
						$('#paciente').html(data.nombre);
						$('#telefono').html(data.telefono);
						$('#fecha').html(data.fecha_hora);
						$('#clinica').html(data.clinica);
						$('#tratamiento').html(data.tratamiento);
						$('#comentarios').html(data.comentario);
						
					});
					
					$('#VerDetalle').modal('show');

		        }
		        
/***/
            });

        }

    };

}();

jQuery(document).ready(function() {    
   AppCalendar.init(); 
});


</script>

<!--- Pra la cita -->
<!-- Modal -->
<div class="modal fade" id="VerDetalle">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Cerrar</span></button>
				<h4 class="modal-title">Detalle de Cita</h4>
			</div>
			
			<div class="modal-body">
				<!--Formulario -->
				<form id="" class="form-horizontal">
					<div class="form-group">
						<label for="descripcion" class="col-md-3 control-label bold">Estado:</label>
						<div class="col-md-9 control-label" style="text-align: left"><span id="estado" class="inp">Cargando...</span></div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-md-3 control-label bold">Paciente:</label>
						<div class="col-md-9 control-label" style="text-align: left"><span id="paciente" class="inp">Cargando...</span></div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-md-3 control-label bold">Teléfono:</label>
						<div class="col-md-9 control-label" style="text-align: left"><span id="telefono" class="inp">Cargando...</span></div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-md-3 control-label bold">Fecha Inicio:</label>
						<div class="col-md-9 control-label" style="text-align: left"><span id="fecha" class="inp">Cargando...</span></div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-md-3 control-label bold">Clínica:</label>
						<div class="col-md-9 control-label" style="text-align: left"><span id="clinica" class="inp">Cargando...</span></div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-md-3 control-label bold">Tratamiento:</label>
						<div class="col-md-9 control-label" style="text-align: left"><span id="tratamiento" class="inp">Cargando...</span></div>
					</div>
					<div class="form-group">
						<label for="descripcion" class="col-md-3 control-label bold">Comentarios:</label>
						<div class="col-md-9 control-label" style="text-align: left"><span id="comentarios" class="inp">Cargando...</span></div>
					</div>

				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn_ac" data-dismiss="modal">Cerrar</button>
<!--				<button type="button" class="btn btn-info btn_ac" onclick="">Cambiar Cita</button>
				<button type="button" class="btn btn-danger btn_ac" onclick="">Cancelar Cita</button>
				<button type="button" class="btn btn-success btn_ac" onclick="">Confirmar Cita</button>-->
			</div>
		</div>
	</div>
</div>