<div class="form-group">
    {{Form::label('cve_status','Clave del status')}}
    {{Form::text('cve_status', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'status.cve_status', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','placeholder'=>'ES','maxlength'=>'2'] )}}
    {{$errors->first('cve_status', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Dos letras mayusculas para indetifacar el estatus del proceso de ejecucion fiscal.</p>
</div>

<div class="form-group">
    {{Form::label('descrip','Descripción del status')}}
    {{Form::text('descrip', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'status.descrip','placeholder'=>'Ejemplo Status'] )}}
    {{$errors->first('descrip', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es un texto descriptivo del estatus de ejecución, así se identificará para los usuarios.</p>
</div>
