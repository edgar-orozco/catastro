<div class="form-group">
    {{Form::label('name','Nombre del requisito')}}
    {{Form::text('nombre', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el nombre del requisito documental.</p>
</div>
<div class="form-group">
    {{Form::label('tipo','Tipo de documento')}}
    {{Form::text('tipo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('tipo', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es el tipo de documento, (plano, documento, etc)  .</p>
</div>
<div class="form-group">
    {{Form::label('tipo','Descripción del requisito')}}
    {{Form::text('descripcion', null, ['class'=>'form-control'] )}}
    {{$errors->first('descripcion', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es un texto descriptivo del requisito documental.</p>
</div>
