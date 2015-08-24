<div class="form-group">
    {{Form::label('name','Rol')}}
    {{Form::text('name', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('name', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
  
</div>