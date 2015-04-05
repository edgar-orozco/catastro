{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery.validate.min.js') }}
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop


<div class="form-group">
    {{Form::label('mes','Mes')}}
    {{Form::select('mes',$mes, null,['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.mes', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('mes', '<span class=text-danger error>:message</span>')}}
    <span id="error"></span>
</div>

<div class="form-group">
    {{Form::label('anio','Año')}} 
    {{Form::select('anio',$anio, null,['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.anio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('anio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('inpc','INPC')}}
    {{Form::text('inpc', null, ['class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'inpc.inpc','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('inpc', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Valor del indice nacional de precios al consumidor.</p>
</div>
@section('styles')
#error
{
color:red;
font: bold 85% monospace;
}
.error
{
color:red;
font: bold 85% monospace;
}

@stop


@section('javascript')
<script>
//Numero    
    function justNumbers(e)
    {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    }
//Mensaje Eliminar
    $("body").delegate('.eliminar', 'click', function () {
        if (!confirm("¿Seguro que quiere eliminar el INPC?")) {
            return false;
        }

    });
</script>
<script>
    $(document).ready(function () {
        $('#form').on('submit', function () {
            if (form.mes.options[form.mes.selectedIndex].value == 0)
            {
                $("#error").text("Por favor, seleccione un Mes");
                form.mes.focus();
                return false;
            }
        });
    });
</script>
<!--<script>
    $(document).ready(function () {
        $('#form').validate({// initialize the plugin
            
            rules: {
                mes: {
                    selectcheck: true
                },
//                inpc: {
//                    required: true,
//                }
            },
            messages: {
//                inpc: {
//                    required: "Campo requerido:INPC",
//                },
            },
            submitHandler: function (form) { // for demo
//                alert('valido'); // for demo
                return false; // for demo
            }
        });
        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        }, "Elija un Mes");
    });
</script>-->
<script>
    // Al presionar cualquier tecla en cualquier campo de texto, ejectuamos la siguiente función
    $('input').on('keydown', function (e) {
        // Solo nos importa si la tecla presionada fue ENTER... (Para ver el código de otras teclas: http://www.webonweboff.com/tips/js/event_key_codes.aspx)
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
@append