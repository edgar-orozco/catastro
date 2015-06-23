
{{ HTML::style('css/select2.min.css') }}
<div class="col-md-4">
{{Form::label('NOTARIA')}}
<div class="form-group">
    {{Form::label('entidad','Entidad')}}
    {{Form::select('entidad',$entidades, null,['tabindex'=>'1','class'=>'','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.entidad', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('entidad', '<span class=text-danger>:message</span>')}}
    <span id="error"></span>
</div>

<div class="form-group">
    {{Form::label('municipio','Seleccione el Municipio')}}
    {{Form::select('municipio',$Municipio, null,['tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
    <span id="error"></span>
</div>

<div class="form-group">
    {{Form::label('nombre','Nombre de la Notaria')}}
    {{Form::text('nombre', null, ['placeholder'=>'Notaria','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.nombre', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('domicilio','Domicilio')}}
    {{Form::textarea('domicilio', null, ['placeholder'=>'Domicilio','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.domicilio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'rows'=>'5', 'cols'=>'30'] )}}
    {{$errors->first('domicilio', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('telefono','Telefono')}}
    {{Form::text('telefono', null, ['placeholder'=>'Telefono','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('telefono', '<span class=text-danger>:message</span>')}}
</div>
</div>
@if(empty($nombre))
<div class="col-md-4">
    {{Form::label('DATOS DEL NOTARIO')}}
<div class="form-group">
    {{Form::label('nombres','Nombre')}}
    {{Form::text('nombres', null, ['placeholder'=>'Nombres del Notario','tabindex'=>'6','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apellido_paterno','Apellido Paterno')}}
    {{Form::text('apellido_paterno', null, ['placeholder'=>'Apellido Paterno del Notario','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apellido_materno','Apellido Materno')}}
    {{Form::text('apellido_materno', null, ['placeholder'=>'Apellido Materno del Notario','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('curp','CURP')}}
    {{Form::text('curp', null, ['placeholder'=>'CURP del Notario','tabindex'=>'9','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('rfc','RFC')}}
    {{Form::text('rfc', null, ['placeholder'=>'RFC del Notario','tabindex'=>'10','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
</div>
</div>
@endif
@if(!empty($nombre))
<div class="col-md-4">
    {{Form::label('DATOS DEL NOTARIO')}}
<div class="form-group">
    {{Form::label('nombres','Nombre')}}
    {{Form::text('nombres', $nombre, ['placeholder'=>'Nombres del Notario','tabindex'=>'6','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apellido_paterno','Apellido Paterno')}}
    {{Form::text('apellido_paterno', $paterno, ['placeholder'=>'Apellido Paterno del Notario','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apellido_materno','Apellido Materno')}}
    {{Form::text('apellido_materno', $materno, ['placeholder'=>'Apellido Materno del Notario','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('curp','CURP')}}
    {{Form::text('curp', $curp, ['placeholder'=>'CURP del Notario','tabindex'=>'9','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('rfc','RFC')}}
    {{Form::text('rfc', $rfc, ['placeholder'=>'RFC del Notario','tabindex'=>'10','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
</div>
</div>
@endif

@if(empty($nombre1))
<div class="col-md-4">
    {{Form::label('DATOS DEL RESPONSABLE')}}
<div class="form-group">
    {{Form::label('nombrer','Nombre')}}
    {{Form::text('nombrer', null, ['placeholder'=>'Nombres del Responsable','tabindex'=>'11','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.nombrer', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombrer', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('paterno','Apellido Paterno')}}
    {{Form::text('paterno', null, ['placeholder'=>'Apellido Paterno del Responsable','tabindex'=>'12','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('paterno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('materno','Apellido Materno')}}
    {{Form::text('materno', null, ['placeholder'=>'Apellido Materno del Responsable','tabindex'=>'13','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('materno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('curp1','CURP')}}
    {{Form::text('curp1', null, ['placeholder'=>'CURP del Responsable','tabindex'=>'14','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('curp1', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('rfc1','RFC')}}
    {{Form::text('rfc1', null, ['placeholder'=>'RFC del Responsable','tabindex'=>'15','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('rfc1', '<span class=text-danger>:message</span>')}}
</div>
</div>
@endif
@if(!empty($nombre1))
<div class="col-md-4">
    {{Form::label('DATOS DEL RESPONSABLE')}}
<div class="form-group">
    {{Form::label('nombrer','Nombre')}}
    {{Form::text('nombrer', $nombre1, ['placeholder'=>'Nombres del Responsable','tabindex'=>'11','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.nombrer', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombrer', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('paterno','Apellido Paterno')}}
    {{Form::text('paterno', $paterno1, ['placeholder'=>'Apellido Paterno del Responsable','tabindex'=>'12','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('paterno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('materno','Apellido Materno')}}
    {{Form::text('materno', $materno1, ['placeholder'=>'Apellido Materno del Responsable','tabindex'=>'13','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('materno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('curp1','CURP')}}
    {{Form::text('curp1', $curp1, ['placeholder'=>'CURP del Responsable','tabindex'=>'14','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('curp1', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('rfc1','RFC')}}
    {{Form::text('rfc1', $rfc1, ['placeholder'=>'RFC del Responsable','tabindex'=>'15','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('rfc1', '<span class=text-danger>:message</span>')}}
</div>
</div>
@endif


@section('javascript')
{{ HTML::script('js/select2/select2.min.js') }}
{{ HTML::script('js/select2/i18n/es.js') }}
 <script>

        $(function () {

            $("#entidad").select2({
                language: "es",
                placeholder: "Seleccione una notaría",
                allowClear: true
            });

            //Cuando hay cambios en los radio buttons de los requisitos
            $('.radio-persona').change(function (ev) {
                var radio = $(this);
                if(radio.val() == 'F'){
                    $('.campos-fisica').show();
                    $('#rfc').attr('pattern', '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})');
                    $('.tipo_persona').val('F');
                }
                else if(radio.val() == 'M')
                {
                    $('.campos-fisica').hide();
                    $('#rfc').attr('pattern', '([A-Za-z]{3})([0-9]{6})([A-Za-z0-9]{3})');
                    $('.tipo_persona').val('M');
                }
            });

        });
    </script>
@stop