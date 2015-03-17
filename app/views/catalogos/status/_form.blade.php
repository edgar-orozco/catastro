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

<div class="form-group">
    {{Form::label('fecha_alta2','Fecha de alta status')}}
    {{Form::text('fecha_alta', null, ['class'=>'date-picker form-control', 'id'=>'date-picker-1', 'ng-model' => 'status.fecha_alta','placeholder'=>'dd/mm/yyyyy'] )}}
    {{$errors->first('fecha_alta', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Fecha del status.</p>
</div>

<div class="form-group">
    {{Form::label('usuario_alta2','Fecha de alta usuario')}}
    {{Form::text('usuario_alta', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'status.usuario_alta','placeholder'=>'dd/mm/yyyyy'] )}}
    {{$errors->first('usuario_alta', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Fecha del usuario.</p>
</div>

<div class="form-group">
    {{Form::label('orden2','Orden')}}
    {{Form::text('orden', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'status.orden','placeholder'=>'Orden'] )}}
    {{$errors->first('orden', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Numero de orden.</p>
</div>

