<div class="form-group">
    {{Form::label('zona','Zona')}}
    {{Form::text('zona', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('zona', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Zona geografica en la que aplica el salario minimo.</p>
</div>
<div class="form-group">
    {{Form::label('anio','Año')}}
    {{Form::text('anio', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.anio'] )}}
    {{$errors->first('anio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('salario_minimo','Salario minimo')}}
    {{Form::text('salario_minimo', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.salario_minimo'] )}}
    {{$errors->first('salario_minimo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Valor del salario minimo.</p>
</div>

<div class="form-group">
    {{Form::label('fecha_inicio_periodo','Fecha inicio')}}
    {{Form::input('date','fecha_inicio_periodo', null, ['class'=>'form-control','placeholder' => 'Date','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_inicio_periodo'] )}}
    {{$errors->first('fecha_inicio_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('fecha_termino_periodo','Fecha termino')}}
    {{Form::input('date','fecha_termino_periodo', null, ['class'=>'form-control','placeholder' => 'Date','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'salario.fecha_termino_periodo'] )}}
    {{$errors->first('fecha_termino_periodo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>
