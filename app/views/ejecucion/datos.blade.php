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
<?php $fecha= date("d/m/Y"); ?>
<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Datos Entrega</h4>
</div>

{{ Form::open(array('url'=>'ejecucion/guardar')) }}

<div style="margin-left: 20px">
    <div style="margin-right: 20px">
        <div class="form-group">
            {{Form::text('id',$idrequerimiento,['id' => 'id', 'hidden'] )}}
            {{$errors->first('id', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('date','Fecha Notificacion')}}
            {{Form::text('date', $fecha, ['id'=>'datepicker', 'class'=>'btn btn-default btn-sm dropdown-toggle'] )}}
            {{$errors->first('date', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('nombre_ejecutor','Notificador')}}
             <select name="ejecutores" class="form-control">
            @foreach($catalogo as $row)
            <option value="{{$row->id}}">{{$row->nombre}}</option>
            @endforeach
    </select>
            {{$errors->first('nombre_ejecutor', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('notificacion','Via Notificación')}}
            {{Form::text('notificacion', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.nombres'] )}}
            {{$errors->first('notificacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('nombre','Nombre Persona')}}
            {{Form::text('nombre', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.rfc'] )}}
            {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('identificacion','Tipo Identificacion')}}
            {{Form::text('identificacion', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('identificacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('clave','Clave Identificacion')}}
            {{Form::text('clave', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('observaciones','Observaciones')}}
            {{Form::text('observaciones', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('observaciones', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-actions form-group">
            {{ Form::submit('Guardar Datos', array('class' => 'btn btn-primary')) }} 
            {{ Form::reset('Limpiar ', ['class' => 'btn btn-warning']) }}
            <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Cancelar Registro</button>
            {{Form::close()}}
        </div>
    </div>
</div>
