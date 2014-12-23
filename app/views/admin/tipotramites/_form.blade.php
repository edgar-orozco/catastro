<div class="form-group">
    {{Form::label('name','Nombre del trámite')}}
    {{Form::text('nombre', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el nombre del trámite.</p>
</div>
<div class="form-group">
    {{Form::label('tiempo','Tiempo aproximado (días)')}}
    {{Form::input('number','tiempo', null, ['class'=>'form-control', 'min'=>'0', 'max'=>'365', 'step'=>'1'] )}}
    {{$errors->first('tiempo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el tiempo aproximado en días que dura el trámite  .</p>
</div>
<div class="form-group">
    {{Form::label('costodsmv','Costo del trámite (DSMV)')}}
    {{Form::input('number','costodsmv', null, ['class'=>'form-control','min'=>'0', 'max'=>'100', 'step'=>'1'] )}}
    {{$errors->first('tcostodsmv', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el costo del trámite en Días de Salario Mínimo Vigente.</p>
</div>


@foreach($requisitos as $requisito)

    <div class="form-group">
        <div class="requisito">
            {{Form::checkbox(
                'requisitos['.$requisito->id.'][requisito_id]',
                $requisito->id,
                ($tipotramite->id) ? in_array($requisito->id, $tipotramite->requisitos->lists('id') ) : false,
                ['id' => 'requisitos['.$requisito->id.']' ])}}
            {{Form::label('requisitos['.$requisito->id.']', $requisito->nombre)}}

            {{$errors->first('requisitos['.$requisito->id.']', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="row requisito-detalles" style="display: none;">
            <div class="col-md-12">
                <div class="input-group">
                    <span class="input-group-addon">
                        {{Form::checkbox(
                            'requisitos['.$requisito->id.'][original]',
                            true,
                            ($tipotramite->id) ? $tipotramite->requisitoEnOriginal($requisito->id) : false,
                            ['id' => 'requisitos['.$requisito->id.'][original]' ]
                        )}}
                        {{Form::label('requisitos['.$requisito->id.'][original]', 'Original')}}

                    </span>

                    {{Form::input(
                        'number',
                        'requisitos['.$requisito->id.'][copias]',
                        ($tipotramite->id) ? $tipotramite->requisitoNumeroCopias($requisito->id) : null
                        , ['class'=>'form-control', 'placeholder'=>'num. copias', 'min'=>'0', 'max'=>'100', 'step'=>'1'] )}}

                    {{$errors->first('requisitos['.$requisito->id.'][copias]', '<span class=text-danger>:message</span>')}}

                    <span class="input-group-addon">
                        {{Form::checkbox(
                            'requisitos['.$requisito->id.'][certificadas]',
                            true,
                            ($tipotramite->id) ? $tipotramite->requisitoEnCopiasCertificadas($requisito->id) : false,
                            ['id' => 'requisitos['.$requisito->id.'][certificadas]' ]
                        )}}
                        {{Form::label('requisitos['.$requisito->id.'][certificadas]', 'Certificadas')}}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endforeach


@section('javascript')
<script>
    $(function() {
        //Cuando termina de cargarse la pag, mostramos los detalles de los requisistos seleccionados
        $('.requisito input:checked').parent().siblings().show();

        //En click del checkbox del requisito muestra-oculta el detalle del requisito
        $('.requisito input').click( function(){
            if( $(this).is(':checked') ) {
                $(this).parent().siblings().show();
            }
            else {
                $(this).parent().siblings().hide();
            }
        });
    });
</script>
@endsection