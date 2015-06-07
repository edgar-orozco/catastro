@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

{{ HTML::style('css/forms.css') }}



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
                     if(chb.val() == 'F'){
                         $('.vendedor-campos-fisica').show();
                         $('.vendedor-tipo_persona').val('F');
                         $('#vendedor-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                     }
                     else if(chb.val() == 'M')
                     {
                         $('.vendedor-campos-fisica').hide();
                         $('.vendedor-tipo_persona').val('M');
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
                    if(chb.val() == 'F'){
                        $('.comprador-campos-fisica').show();
                        $('.comprador-tipo_persona').val('F');
                        $('#comprador-rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                    }
                    else if(chb.val() == 'M')
                    {
                        $('.comprador-campos-fisica').hide();
                        $('.comprador-tipo_persona').val('M');
                         $('#comprador-rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                    }

               }
           });
      });
    </script>

@append