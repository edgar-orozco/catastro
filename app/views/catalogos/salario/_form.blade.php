{{ HTML::script('js/jquery/jquery.validate.min.js') }}
{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop


<div class="form-group">
    {{Form::label('zona','Zona')}}
    {{Form::text('zona', null, ['Placeholder'=>'Zona','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'1'] )}}
    {{$errors->first('zona', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Zona geografica en la que aplica el salario minimo.</p>
</div>
<div class="form-group">
    {{Form::label('anio','Año')}}
    {{Form::select('anio',$anio, null,['Under 18', 'tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.anio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('anio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('salario_minimo','Salario minimo')}}
    {{Form::text('salario_minimo', null, ['Placeholder'=>'Salario Minimo','tabindex'=>'3','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.salario_minimo', 'onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('salario_minimo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Valor del salario minimo.</p>
</div>

<div class="form-group">
    {{Form::label('fecha_inicio_periodo','Fecha inicio')}}
    {{Form::input('date2','fecha_inicio_periodo', null, ['Placeholder'=>'Fecha Inicio','tabindex'=>'4','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_inicio_periodo'] )}}
    {{$errors->first('fecha_inicio_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('fecha_termino_periodo','Fecha termino')}}
    {{Form::input('date2','fecha_termino_periodo', null, ['Placeholder'=>'Fecha Termino','tabindex'=>'5','class'=>'fecha form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_termino_periodo'] )}}
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

    function aMayusculas(obj, id) {
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
    $(function () {
        $("#fecha_inicio_periodo").datepicker();
    });
    $(function () {
        $("#fecha_termino_periodo").datepicker();
    });
//Cambiar a español el calendario
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
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
    $("body").delegate('.eliminar', 'click', function () {
        if (!confirm("¿Seguro que quiere eliminar el salario minimo?")) {
            return false;
        }

    });
//Validador
    $.validator.addMethod(
            "date",
            function (value, element) {
                var bits = value.match(/([0-9]+)/gi), str;
                if (!bits)
                    return this.optional(element) || false;
                str = bits[ 1 ] + '/' + bits[ 0 ] + '/' + bits[ 2 ];
                return this.optional(element) || !/Invalid|NaN/.test(new Date(str));
            },
            "Please enter a date in the format dd/mm/yyyy"
            );
</script>
<script>
    $(document).ready(function () {
//        $('#form').on('submit', function () {
        $("#form").validate({
            errorClass: "my-error-class",
            validClass: "my-valid-class",
            rules:
                    {
                        zona:
                                {
                                    required: true,
                                },
                        salario_minimo:
                                {
                                    required: true,
                                },
                        anio:
                                {
                                    required: true,
                                },
                        fecha_inicio_periodo:
                                {
                                    required: true,
                                    date: true,
                                },
                        fecha_termino_periodo:
                                {
                                    required: true,
                                    date: true
                                }
                    },
            messages: {
                zona: {
                    required: "Campo requerido: Zona",
                },
                salario_minimo:
                        {
                            required: "Campo requerido: Salario Minimo",
                        },
                anio:
                        {
                            required: "Campo requerido: Año",
                        },
                fecha_inicio_periodo:
                        {
                            required: "Campo requerido:Fecha Inicio",
                            date: "Fecha Invalida",
                        },
                fecha_termino_periodo:
                        {
                            required: "Campo requerido: Fecha Termino",
                            date: "Fecha Invalida"
                        }
            }
        });
    });
//    });
</script>
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