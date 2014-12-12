<div class="form-group">
    {{Form::label('name','Nombre del permiso')}}
    {{Form::text('name', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'permission.name', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('name', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el nombre de referencia para fines programáticos. Debe ser sin espacios, en minúsculas, sin caracteres especiales mas que guión bajo.</p>
</div>

<div class="form-group">
    {{Form::label('display_name','Descripción del permiso')}}
    {{Form::text('display_name', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'permission.display_name'] )}}
    {{$errors->first('display_name', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es un texto descriptivo del permiso, así se identificará para los usuarios.</p>
</div>
