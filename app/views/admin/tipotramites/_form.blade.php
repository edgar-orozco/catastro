<div class="form-group">
    {{Form::label('name','Nombre del trámite')}}
    {{Form::text('nombre', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el nombre del trámite.</p>
</div>
<div class="form-group">
    {{Form::label('tiempo','Tiempo aproximado (días)')}}
    {{Form::input('number','tiempo', null, ['class'=>'form-control'] )}}
    {{$errors->first('tiempo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el tiempo aproximado en días que dura el trámite  .</p>
</div>
<div class="form-group">
    {{Form::label('tiempo','Costo del trámite (DSMV)')}}
    {{Form::input('number','tiempo', null, ['class'=>'form-control'] )}}
    {{$errors->first('tiempo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el costo del trámite en Días de Salario Mínimo Vigente.</p>
</div>

<div class="form-group">
@foreach($requisitos as $requisito)
    {{Form::checkbox('requisitos['.$requisito->id.']', $requisito->id, in_array($tipotramite->id, $requisitos->lists('id')), ['id' => 'requisitos['.$requisito->id.']' ])}}
    {{Form::label('requisitos['.$requisito->id.']', $requisito->nombre)}}
    {{Form::input('number','tiempo', null, ['class'=>'form-control'] )}}
    <br>
@endforeach
</div>