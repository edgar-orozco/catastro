{{ HTML::script('js/jquery/jquery.validate.min.js') }}
{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop


<div class="form-group">
    {{Form::label('zona','Zona')}}
    {{Form::text('zona', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'1'] )}}
    {{$errors->first('zona', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Zona geografica en la que aplica el salario minimo.</p>
</div>
<div class="form-group">
    {{Form::label('anio','Año')}}
    {{Form::select('anio',$anio, null,['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.anio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
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
    {{Form::input('date2','fecha_inicio_periodo', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_inicio_periodo'] )}}
    {{$errors->first('fecha_inicio_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('fecha_termino_periodo','Fecha termino')}}
    {{Form::input('date2','fecha_termino_periodo', null, ['class'=>'fecha form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_termino_periodo'] )}}
    {{$errors->first('fecha_termino_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
@section('styles')

	.my-error-class
	{
		color:red;
		font: bold 85% monospace;
	}

@stop
@section('javascript')
{{ HTML::script('js/jquery/jquery.validate.min.js') }}
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
//Mensaje para eliminar
$("body").delegate('.eliminar', 'click', function(){
	    	if(!confirm("¿Seguro que quiere eliminar el salario minimo?")){
	    		return false;
	    	}

	});
//Validador
$.validator.addMethod(
    "date",
    function ( value, element ) {
        var bits = value.match( /([0-9]+)/gi ), str;
        if ( ! bits )
            return this.optional(element) || false;
        str = bits[ 1 ] + '/' + bits[ 0 ] + '/' + bits[ 2 ];
        return this.optional(element) || !/Invalid|NaN/.test(new Date( str ));
    },
    "Please enter a date in the format dd/mm/yyyy"
);
//Regelas 
jQuery.extend(jQuery.validator.messages, 
  {
   required: " *Este campo es obligatorio.",
   remote: " *Por favor, rellena este campo.",
   email: " *Por favor, escribe una dirección de correo válida",
   url: " *Por favor, escribe una URL válida.",
   date: " *Por favor, escribe una fecha válida.",
   dateISO: " *Por favor, escribe una fecha (ISO) válida.",
   number: " *Por favor, escribe un número entero válido.",
   digits: " *Por favor, escribe sólo dígitos.",
   creditcard: " *Por favor, escribe un número de tarjeta válido.",
   equalTo: " *Por favor, escribe el mismo valor de nuevo.",
   accept: " *Por favor, escribe un valor con una extensión aceptada.",
   maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
   minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
   rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
   range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
   max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
   min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
  });

  var form = $('#form');
  $('#form').validate(
  {

         errorClass: "my-error-class",
      validClass: "my-valid-class",
      errorPlacement: function(error, element) {
    error.insertBefore(element);
},
         rules:
         {
          fecha_inicio_periodo:
          {
              required: true,
              date:true,

             },
             fecha_termino_periodo:
          {
              required: true,
              date:true
             }
         }
     });

     $('#form input').on('change', function ()
     {
      if ($('#form').valid())
      {
          $('button.btn').prop('disabled', false);
         } 
         else
         {
          $('button.btn').prop('disabled', 'disabled');
         }
     });
    
        
</script>
@append