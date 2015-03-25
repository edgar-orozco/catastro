{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop

<div>
    {{Form::label('id_p','Nombre del ejecutor')}}
    <!--SI "TRAE" ALGO LA VARIABLE $nombrec -->
    @if(!empty($nombrec))
    {{Form::text('nombrec',$nombrec, ['tabindex'=>'1','id' => 'nombrec', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.nombrec'] )}}
    @endif
    <!--SI "NO" TRAE ALGO LA VARIABLE $nombrec -->
    @if(empty($nombrec))
    {{Form::text('nombrec',null, ['tabindex'=>'1','id' => 'nombrec', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.nombrec'] )}}
    @endif
    {{Form::text('id_p',null, ['id' => 'response','hidden'])}}
    {{$errors->first('id_p', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
    {{Form::label('titulo','Titulo')}}
    {{Form::text('titulo', null, ['tabindex'=>'2','class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.titulo'] )}}
    {{$errors->first('titulo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
<div class="form-group">
    {{Form::label('cargo','Cargo')}}

    {{Form::text('cargo', null, ['tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.cargo'] )}}
    {{$errors->first('cargo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
<div class="form-group">
    {{Form::label('f_nombramiento','Fecha de nombramiento')}}
    {{Form::text('f_nombramiento', null, ['tabindex'=>'4','class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.f_nombramiento'] )}}
    {{$errors->first('f_nombramiento', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
<div class="form-group">
    {{Form::label('id_p_otorga_nombramiento','Quien lo nombra')}}
    <!--SI "TRAE" LA VARIABLE $nombre-->
    @if(!empty($nombre))
    {{Form::text('nombre', $nombre, ['tabindex'=>'5','id'=>'nombre', 'class'=>'form-control', 'autofocus'=> 'autofocus','ng-model' => 'ejecutores.nombre'] )}}
    @endif
    <!--SI "NO" TRAE LA VARIABLE $nombre-->
    @if(empty($nombre))
    {{Form::text('nombre', null, ['tabindex'=>'5','id'=>'nombre', 'class'=>'form-control', 'autofocus'=> 'autofocus','ng-model' => 'ejecutores.nombre'] )}}
    @endif
    {{Form::text('id_p_otorga_nombramiento',null, ['id' => 'response2','hidden'] )}}
    {{$errors->first('id_p_otorga_nombramiento', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
@section('javascript')
{{ HTML::script('js/jquery/jquery.validate.min.js') }}
<script>
    $(function () {
        $("#nombrec").autocomplete({
            source: "/search/autocomplete1",
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
    $(function () {
        $("#f_nombramiento").datepicker();
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

//Mayuscula    
    function aMayusculas(obj, id) {
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }
</script>
<script>
     $(document).ready(function() {
        $('#refresh').click(function() {
           location.reload();
        });
    });
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
