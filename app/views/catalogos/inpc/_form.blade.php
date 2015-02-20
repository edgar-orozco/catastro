<div class="form-group">
    {{Form::label('nombre_mes','Mes')}}
    {{Form::select('nombre_mes', array(
        ''=>'Seleccione un mes',
        'Enero'=>'Enero',
        'Febrero'=>'Febrero',
        'Marzo'=>'Marzo',
        'Abril'=>'Abril',
        'Mayo'=>'Mayo',
        'Junio'=>'Junio',
        'Julio'=>'Julio',
        'Agosto'=>'Agosto',
        'Septiembre'=>'Septiembre',
        'Octubre'=>'Octubre',
        'Novimbre'=>'Novimbre',
        'Diciembre'=>'Diciembre',), 'nombre_mes', ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.nombre_mes', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('nombre_mes', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('anio','Año')}}
    {{Form::text('anio', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.anio'] )}}
    {{$errors->first('anio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('inpc','INPC')}}
    {{Form::text('inpc', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.inpc'] )}}
    {{$errors->first('inpc', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Valor del indice nacional de precios al consumidor.</p>
</div>
