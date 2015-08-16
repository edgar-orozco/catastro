@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    {{--{{ HTML::style('css/forms.css') }} --}}

<h1>Registro de escrituras</h1>


        <div class="row">

            {{ Form::model($registro, ['url' => array('ofvirtual/notario/registro/update', $registro->id ), 'method'=>'GET' ]) }}
                @include('ofvirtual.notario.registro._form', compact('registro'))

                <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
                  {{ Form::submit('Guardar cambios en registro de dominio', array('class' => 'btn btn-primary')) }}
                </div>
            {{Form::close()}}

            {{ Form::model($registro, ['url' => array('ofvirtual/notario/registro-escrituras'), 'method'=>'GET' ]) }}
            <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
              {{ Form::submit('No guardar cambios', array('class' => 'btn btn-warning')) }}
            </div>
        {{Form::close()}}



        </div>



@stop

@section('javascript')
<script >
    $(document).ready(function(){
        $(".adquiriente-radio-persona").each(function () {


                var radio = $(this);
                 if(radio.is(':checked')){
                if (radio.val() == 1) {
                     // alert('a1');
                    var id = radio.data('tipo');
                    $("."+id).show();
                    $("#id_tipo").val('1');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');

                }
                else if (radio.val() == 2) {
                    //alert('a2');
                    var id = radio.data('tipo');
                    $("."+id).hide();
                    $("#id_tipo").val('2');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

                }
            }
 });

         $(".enajenante-radio-persona").each(function () {

                var select = $(this);
                if(select.is(':checked')){
                if (select.val() == 1) {
               //alert('e1');
                    var id = select.data('tipo');
                    $("."+id).show();
                    $("#id_tipo").val('1');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');

                }
                else if (select.val() == 2) {
                 //     alert('e2');
                    var id = select.data('tipo');
                    $("."+id).hide();
                    $("#id_tipo").val('2');

                    var rfc = id+"[rfc]";
                    $("#" + rfc.replace( /(:|\.|\[|\]|,)/g, "\\$1" )).attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');

                }
            }



});

});
</script>
@append