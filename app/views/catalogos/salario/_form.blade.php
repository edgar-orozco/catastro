{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop

<div class="form-group">
    {{Form::label('zona','Zona')}}
    {{Form::text('zona', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)'] )}}
    {{$errors->first('zona', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Zona geografica en la que aplica el salario minimo.</p>
</div>
<div class="form-group">
    {{Form::label('anio','Año')}}
    {{Form::text('anio', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.anio','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('anio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('salario_minimo','Salario minimo')}}
    {{Form::text('salario_minimo', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.salario_minimo', 'onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('salario_minimo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Valor del salario minimo.</p>
</div>

<div class="form-group">
    {{Form::label('fecha_inicio_periodo','Fecha inicio')}}
    {{Form::text('fecha_inicio_periodo', null, ['id'=>'fecha_inicio_periodo','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_inicio_periodo'] )}}
    {{$errors->first('fecha_inicio_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('fecha_termino_periodo','Fecha termino')}}
    {{Form::text('fecha_termino_periodo', null, ['id'=>'fecha_termino_periodo','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_termino_periodo'] )}}
    {{$errors->first('fecha_termino_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>


@section('javascript')
<script>
function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}    
    
    
//Numero    
function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
}
//Calendario
$(function() {
    $( "#fecha_inicio_periodo" ).datepicker();
  });
$(function() {
    $( "#fecha_termino_periodo" ).datepicker();
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





    
$("body").delegate('.eliminar', 'click', function(){
	    	if(!confirm("¿Seguro que quiere eliminar el salario minimo?")){
	    		return false;
	    	}

	});





</script>
@append