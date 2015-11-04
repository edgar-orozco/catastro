<fieldset><legend>Propietario</legend>
    <div class="row">
        <div class="col-md-4">
            {{Form::label('tipo_persona','Tipo de Persona')}}
            <br>
            {{Form::label('PersonaFisica','Física')}}
            {{Form::radio('id_tipo', '1', null, ['class'=>'-radio-persona-1 radio-persona']) }}
            {{Form::label('PersonaMoral','Moral')}}
            {{Form::radio('id_tipo', '2', null, ['class'=>'-radio-persona-2 radio-persona']) }}
        </div>
        <div class="col-md-4">
            {{Form::label('CURP','CURP del Propietario')}}
            {{Form::text('curp', null, [
                            'class' => "form-control",
                            'placeholder'=>'CURP',
                            'minlength'=>'18',
                            'maxlength'=>'18',
                            'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})',
                            'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado',
                            'tabindex'=>'1'
                            ]
                        )}}
            {{$errors->first('tramite_id', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('rfc','RFC del Propietario')}}  
            {{Form::text('rfc', null, [
                            'class' => 'form-control',

                            'placeholder'=>'RFC',
                            'minlength'=> '12',
                            'maxlength'=> '13',
                            'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})',
                            'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado',
                            'tabindex'=>'2'
                            ]
                        )}}
            {{$errors->first('tramite_id', '<span class=text-danger>:message</span>')}}            
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            {{Form::label('nombres','Nombre')}}
            {{Form::text('nombres', null, ['id'=>'nombres','placeholder'=>'Nombres del Solicitante','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('apellido_paterno','Apellido Paterno')}}
            {{Form::text('apellido_paterno', null, ['id'=>'apellido_paterno','placeholder'=>'Apellido Paterno del Solicitante','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'solicitante.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('apellido_materno','Apellido Materno')}}
            {{Form::text('apellido_materno', null, ['id'=>'apellido_materno','placeholder'=>'Apellido Materno del Solicitante','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
    <h4>Domicilio</h4>
    <div class="row">
        <div class="col-md-4">
          {{Form::label('tipo_vialidad_id','Tipo de Vilaidad')}}  
          {{Form::select('tipo_vialidad_id', $vialidad, null,['class'=>'form-control select2','tabindex'=>'6'] )}}
          {{$errors->first('tipo_vilaidad_id', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('vialidad','Vialidad')}}
            {{Form::text('vialidad', null, ['id'=>'vilidad','placeholder'=>'Vialidad','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('num_ext','Numero Exterior')}}
            {{Form::text('num_ext', null, ['id'=>'num_ext','placeholder'=>'Numero Exterior','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('num_ext', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('num_int','Numero Interior')}}
            {{Form::text('num_int', null, ['id'=>'num_int','placeholder'=>'Numero Exterior','tabindex'=>'9','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('num_int', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('tipo_asentamiento_id','Tipo de Asentamiento')}}
            {{Form::select('tipo_vialidad_id', $asentamiento, null,['class'=>'form-control select2','tabindex'=>'10'] )}}
            {{$errors->first('tipo_asentamiento_id', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('asentamiento','Asentamiento')}}
            {{Form::text('asentamiento', null, ['id'=>'asentamiento','placeholder'=>'Asentamiento','tabindex'=>'11','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('asentamiento', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('entidad','Entidad')}}
            {{Form::select('entidad', $entidad, null,['class'=>'form-control select2','tabindex'=>'12'] )}}
            {{$errors->first('entidad', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('municipio','Municipio')}}
            {{Form::select('municipio', $municipio, null,['class'=>'form-control select2','tabindex'=>'13'] )}}
            {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('cp','C.P.')}}
            {{Form::text('cp', null, ['id'=>'cp','placeholder'=>'C.P.','tabindex'=>'14','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('cp', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('localidad','Localidad')}}
            {{Form::text('localidad', null, ['id'=>'localidad','placeholder'=>'Localidad','tabindex'=>'15','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('localidad', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</fieldset>


@section('javascript')
    {{ HTML::script('js/select2/select2.full.min.js') }}
    {{ HTML::script('js/select2/i18n/es.js') }}
    {{ HTML::style('css/select2.min.css') }}
<script>
//Selectores autocompletables
    $(".select2").select2({
        language: "es",
        placeholder: "-- Seleccione",
        allowClear: true,
        dropdownAutoWidth: true,
        width: 'resolve'
    });

    $(".select2-multiple").select2({
        language: "es",
        allowClear: true,
        dropdownAutoWidth: true,
        width: 'resolve'
    });
</script>
@stop