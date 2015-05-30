{{ HTML::style('js/jquery/jquery-ui.css') }}
{{ HTML::script('js/jquery/jquery-ui.js') }}

<script>
   //Calendario
$(function() {
    $( "#datepicker" ).datepicker();
  });
//Cambiar a español el calendario
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#fecha").datepicker();
});
</script>
<script >
    $('#guardar').on('click', function () {
         window.location.reload();
        $('#requerimiento').toggle();
        $('#formulario').hide();
    })
</script>
<script>

            // Al presionar cualquier tecla en cualquier campo de texto, ejectuamos la siguiente función
            $('input, select').on('keydown', function (e) {

                if (e.keyCode === 13)
                {
                    // Obtenemos el número del tabindex del campo actual
                    var currentTabIndex = $(this).attr('tabindex');
                    // Le sumamos 1 :P
                    var nextTabIndex = parseInt(currentTabIndex) + 1;
                    // Obtenemos (si existe) el siguiente elemento usando la variable nextTabIndex
                    var nextField = $('[tabindex=' + nextTabIndex + ']');
                    // Si se encontró un elemento:
                    if (nextField.length > 0)
                    {
                        // Hacerle focus / seleccionarlo
                        nextField.focus();
                        // Ignorar el funcionamiento predeterminado (enviar el formulario)
                        e.preventDefault();
                    }
                    // Si no se encontro ningún elemento, no hacemos nada (se envia el formulario)
                }
            });
</script>
<?php $fecha= date("d/m/Y"); ?>
<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Proceso Requerimiento continuar</h4>
</div>

{{ Form::open(array('url'=>'ejecucion/guardarequerimiento', 'id' => 'formrequerimeinto', 'target'=>'_blank')) }}

<div style="margin-left: 20px">
    <div style="margin-right: 20px">
        <div class="form-group">
            {{Form::text('id',$idrequerimiento,['id'=>'idc', 'hidden'] )}}
            {{$errors->first('id', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('date','Fecha Requerimiento')}}
            {{Form::text('date', $fecha, ['id'=>'datepicker', 'class'=>'btn btn-default btn-sm dropdown-toggle'] )}}
            {{$errors->first('date', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-actions form-group">
            {{ Form::submit('Guardar Datos', array('class' => 'btn btn-primary', 'id' => 'guardar')) }} 
            {{ Form::reset('Limpiar ', ['class' => 'btn btn-warning']) }}
            <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Cancelar Registro</button>
            {{Form::close()}}
        </div>
    </div>
</div>
