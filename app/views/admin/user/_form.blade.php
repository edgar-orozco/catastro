<div class="form-group">
    {{Form::label('username','Nombre de usuario')}}
    {{Form::text('username', null, ['class'=>'form-control', 'autofocus'=> 'autofocus'] )}}
    {{$errors->first('username', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('email','Email')}}
    {{Form::text('email', null, ['class'=>'form-control'] )}}
    {{$errors->first('email', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('nombre','Nombre')}}
    {{Form::text('nombre', null, ['class'=>'form-control'] )}}
    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apepat','Apellido paterno')}}
    {{Form::text('apepat', null, ['class'=>'form-control'] )}}
    {{$errors->first('apepat', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apemat','Apellido materno')}}
    {{Form::text('apemat', null, ['class'=>'form-control'] )}}
    {{$errors->first('apemat', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('password','Contraseña')}}
    {{Form::password('password', ['class'=>'form-control'] )}}
    {{$errors->first('password', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('password_confirmation','Confirmar Contraseña')}}
    {{Form::password('password_confirmation', ['class'=>'form-control'] )}}
    {{$errors->first('password_confirmation', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label(null,'Roles')}}
    <div>

    @foreach(Role::all() as $role)
        {{Form::checkbox('roles['.$role->id.']', $role->id, in_array($role->id, $user->roles->lists('id')), ['id' => 'roles['.$role->id.']' ])}}
        {{Form::label('roles['.$role->id.']', $role->name)}}
        <br>
    @endforeach
    {{$errors->first('roles[]', '<span class=text-danger>:message</span>')}}
    </div>
</div>



