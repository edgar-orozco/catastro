@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

{{ HTML::style('css/forms.css') }}

   <div class="row">

    <table class="table table-striped">
                                                                  <tr>
                                                                      <th class="text-right"><b>Clave catastral:</b></th>
                                                                      <td>{{$predio->clave}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th class="text-right"><b>Cuenta catastral:</b></th>
                                                                      <td>{{$predio->cuenta}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th class="text-right"><b>Tipo predio:</b></th>
                                                                      <td>{{$predio->tipo_predio}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th class="text-right"><b>Ubicacion:</b></th>
                                                                      <td>{{$predio->ubicacionFiscal->ubicacion}}</td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th class="text-right"><b>Superficie terreno:</b></th>
                                                                      <td>{{number_format($predio->superficie_terreno,2, '.', ',')}} m<sup>2</sup></td>
                                                                  </tr>
                                                                  <tr>
                                                                      <th class="text-right"><b>Superficie construcción:</b></th>
                                                                      <td>{{number_format($predio->superficie_construccion,2, '.', ',')}} m<sup>2</sup></td>
                                                                  </tr>
                                                                  </table>

</div>
        <div class="row">

            {{ Form::open(array('url' => 'ofvirtual/notario/traslado/create', 'method' => 'POST')) }}

                @include('ofvirtual.notario.traslado._form', compact('traslado'))

                <div class="form-actions form-group col-md-4" style="clear:both; float: right;">
                  {{ Form::submit('Crear nuevo traslado de dominio', array('class' => 'btn btn-primary')) }}
                  {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
                </div>
            {{Form::close()}}




        </div>


</div>


@stop


@section('javascript')
    {{ HTML::script('js/select2/select2.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}

    <script>

        $(function () {
            //Cuando hay cambios en los radio buttons de los requisitos
            $('.radio-persona').change(function (ev) {
                var radio = $(this);
                if(radio.val() == 'F'){
                    $('.campos-fisica').show();
                    $('.tipo_persona').val('F');
                }
                else if(radio.val() == 'M')
                {
                    $('.campos-fisica').hide();
                    $('.tipo_persona').val('M');
                }
            });

        });
    </script>

@stop