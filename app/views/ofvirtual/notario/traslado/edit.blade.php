@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

{{ HTML::style('css/forms.css') }}

<h1>Traslado de dominios</h1>


        <div class="row">

            {{ Form::model($traslado, ['url' => array('ofvirtual/notario/traslado/update', $traslado->id ), 'method'=>'GET' ]) }}
                @include('ofvirtual.notario.traslado._form', compact('traslado'))

                <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
                  {{ Form::submit('Guardar cambios en traslado de dominio', array('class' => 'btn btn-primary')) }}
                </div>
            {{Form::close()}}

            {{ Form::model($traslado, ['url' => array('ofvirtual/notario/traslado'), 'method'=>'GET' ]) }}
            <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
              {{ Form::submit('No guardar cambios', array('class' => 'btn btn-warning')) }}
            </div>
        {{Form::close()}}



        </div>



@stop


@section('javascript')
    <script>
    $( document ).ready(function() {
          $('.vendedor-radio-persona').each(function(){
                  var chb = $(this);
                  if(chb.is(':checked')){
                     //chb.click();
                     //$('label[for="'+chb.attr("id")+'"]').click();
                      //física
                     if(chb.val() == '1'){
                         $('.vendedor-campos-fisica').show();
                         $('.vendedor-tipo_persona').val('1');
                         $('#vendedor-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                     }
                     //moral
                     else if(chb.val() == '2')
                     {
                         $('.vendedor-campos-fisica').hide();
                         $('.vendedor-tipo_persona').val('2');
                         $('#vendedor-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                     }
                   }
               });
           $('.comprador-radio-persona').each(function(){
               var chb = $(this);
               if(chb.is(':checked')){
                   //
                    // $("label[for='"+chb.attr("id")+"']").click();
                   //  $("label[for='"+chb.attr("id")+"']").click();
                   //física
                    if(chb.val() == '1'){
                        $('.comprador-campos-fisica').show();
                        $('.comprador-tipo_persona').val('1');
                        $('#comprador-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                    }
                    //mora
                    else if(chb.val() == '2')
                    {
                        $('.comprador-campos-fisica').hide();
                        $('.comprador-tipo_persona').val('1');
                         $('#comprador-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                    }

               }
           });
      });
    </script>

@append