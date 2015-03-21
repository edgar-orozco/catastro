{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop

<div>
    {{Form::label('id_p','Nombre del ejecutor')}}
    <!--SI "TRAE" ALGO LA VARIABLE $nombrec -->
    @if(!empty($nombrec))
    {{Form::text('nombrec',$nombrec, ['id' => 'nombrec', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.nombrec','required' => 'required'] )}}
    @endif
    <!--SI "NO" TRAE ALGO LA VARIABLE $nombrec -->
    @if(empty($nombrec))
    {{Form::text('nombrec',null, ['id' => 'nombrec', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.nombrec','required' => 'required'] )}}
    @endif
    
    {{Form::text('id_p',null, ['id' => 'response', 'hidden'] )}}
    {{$errors->first('id_p', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('titulo','Titulo')}}
    {{Form::text('titulo', null, ['class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.titulo','onblur'=>'aMayusculas(this.value,this.id)','required' => 'required'] )}}
    {{$errors->first('titulo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('cargo','Cargo')}}
    {{Form::text('cargo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.cargo','onblur'=>'aMayusculas(this.value,this.id)','required' => 'required'] )}}
    {{$errors->first('cargo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('f_nombramiento','Fecha de nombramiento')}}
    {{Form::input('date2','f_nombramiento', null, ['class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.f_nombramiento','required' => 'required'] )}}
    {{$errors->first('f_nombramiento', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('id_p_otorga_nombramiento','Quien lo nombra')}}
    <!--SI "TRAE" LA VARIABLE $nombre-->
    @if(!empty($nombre))
    {{Form::text('nombre', $nombre, ['id'=>'nombre', 'class'=>'form-control', 'autofocus'=> 'autofocus','ng-model' => 'ejecutores.nombre','required' => 'required'] )}}
    @endif
    <!--SI "NO" TRAE LA VARIABLE $nombre-->
    @if(empty($nombre))
    {{Form::text('nombre', null, ['id'=>'nombre', 'class'=>'form-control', 'autofocus'=> 'autofocus','ng-model' => 'ejecutores.nombre','required' => 'required'] )}}
    @endif
    {{Form::text('id_p_otorga_nombramiento',null, ['id' => 'response2', 'hidden'] )}}
    {{$errors->first('id_p_otorga_nombramiento', '<span class=text-danger>:message</span>')}}
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
    $(function () {
        $("#nombrec").autocomplete({
            source: "/search/autocomplete2",
            minLength: 1,
            select: function (event, ui) {
                $('#response').val(ui.item.id);
            }
        });
    });

    $(function () {
        $("#nombre").autocomplete({
            source: "/search/autocomplete2",
            minLength: 1,
            select: function (event, ui) {
                $('#response2').val(ui.item.id);
            }
        });
    });
//Calendario
$(function() {
    $( "#f_nombramiento" ).datepicker();
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

//Mayuscula    
function aMayusculas(obj,id){
    obj = obj.toUpperCase();
    document.getElementById(id).value = obj;
}
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
//Reglas
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
          f_nombramiento:
          {
              required: true,
              date:true,

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
