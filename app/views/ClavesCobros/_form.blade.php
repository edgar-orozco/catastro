<?php
//foreach ($catalogo as $cat) {
//var_dump($datos);
//echo $datos->cuenta;
//var_dump($catalogo);
//echo $cat->cuenta;
//}
?>

    <div class="form-group">
        {{Form::label('cuenta','Cuenta')}}
        {{Form::text('cuenta', ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
        {{$errors->first('name', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
        {{Form::label('descripcion','Descripcion')}}
        {{Form::text('descripcion_tramite', ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
        {{$errors->first('name', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
        {{Form::label('clave','Clave')}}
        {{Form::text('clave', ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
        {{$errors->first('name', '<span class=text-danger>:message</span>')}}
    </div>

