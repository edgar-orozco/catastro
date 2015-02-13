<div class="form-group">
    {{Input::get('id')}}
    {{Form::label('mes','Mes')}}
    {{Form::select('mes', array(
        ''=>'Seleccione un mes',
        '1'=>'Enero',
        '2'=>'Febrero',
        '3'=>'Marzo',
        '4'=>'Abril',
        '5'=>'Mayo',
        '6'=>'Junio',
        '7'=>'Julio',
        '8'=>'Agosto',
        '9'=>'Septiembre',
        '10'=>'Octubre',
        '11'=>'Novimbre',
        '12'=>'Diciembre',), 'mes', ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.mes', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('mes', '<span class=text-danger>:message</span>')}}
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
