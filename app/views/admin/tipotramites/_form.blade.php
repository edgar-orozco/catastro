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




<div class="form-group">
    <div class="requisito">
        <select  class="select2-select" multiple="multiple" name="requisitos[seleccionados][]" data-requisitos="[ {{ implode(',',$tipotramite->requisitos->lists('id'))  }} ]" >
            @foreach($requisitos as $requisito)
                <option value="{{ $requisito->id }}"> {{ $requisito->nombre }} </option>
            @endforeach
        </select>
        {{$errors->first('requisitos['.$requisito->id.']', '<span class=text-danger>:message</span>')}}
    </div>
    <br>
    @foreach($requisitos as $requisito)
        <div id="requisito-{{ $requisito->id }}" class="row requisito-detalles" style="display: none;">
            <label> {{ $requisito->nombre }}  </label>
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
    @endforeach
</div>


@section('javascript')
    {{ HTML::script('js/select2/select2.min.js') }}
    <script>
        $(function() {
            $(".select2-select").select2({
                placeholder: "Requisitos"
            });
            $(".select2-select").on("select2:select", function (e) {
                $('#requisito-'+ e.params.data.id).show();
            });
            $(".select2-select").on("select2:unselect", function (e) {
                $('#requisito-'+ e.params.data.id).hide();
            });
            //Cuando termina de cargarse la pag, mostramos los detalles de los requisistos seleccionados
            $(".select2-select").val($(".select2-select").data('requisitos')).trigger("change");
            $(".select2-select").data('requisitos').forEach(function(val){
                $('#requisito-'+ val).show();
            });

        });
    </script>
@append