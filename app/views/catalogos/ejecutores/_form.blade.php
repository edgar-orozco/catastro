{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop

<div>
    {{Form::label('id_p','Nombre del ejecutor')}} 
    {{Form::text('nombrec',null, ['id' => 'nombrec', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.nombrec'] )}}
    {{Form::text('id_p',null, ['id' => 'response', 'hidden'] )}}
    {{$errors->first('id_p', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('titulo','Titulo')}}
    {{Form::text('titulo', null, ['class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.titulo'] )}}
    {{$errors->first('titulo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('cargo','Cargo')}}
    {{Form::text('cargo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.cargo'] )}}
    {{$errors->first('cargo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('f_nombramiento','Fecha de nombramiento')}}
    {{Form::input('date','f_nombramiento', null, ['class'=>'form-control','placeholder' => 'Date','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.f_nombramiento'] )}}
    {{$errors->first('f_nombramiento', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('id_p_otorga_nombramiento','Quien lo nombra')}}
    {{Form::text('nombre', null, ['id'=>'nombre', 'class'=>'form-control', 'autofocus'=> 'autofocus','ng-model' => 'ejecutores.nombre'] )}}
    {{Form::text('id_p_otorga_nombramiento',null, ['id' => 'response2', 'hidden'] )}}
    {{$errors->first('id_p_otorga_nombramiento', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

@section('javascript')
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

</script>
@append
