<div ng-show="user.error" class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>El formulario contiene errores</strong>, corríjalos e intente nuevamente.
</div>

<div class="form-group">
    {{Form::label('username','Nombre de usuario')}}
    {{Form::text('username', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'user.username', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    <span ng-repeat="error in user.errors.username" class=text-danger>{[{ error }]}</span>
</div>

<div class="form-group">
    {{Form::label('email','Email')}}
    {{Form::text('email', null, ['class'=>'form-control', 'ng-model' => 'user.email'] )}}
    <span ng-repeat="error in user.errors.email" class=text-danger>{[{ error }]}</span>
</div>

<div class="form-group">
    {{Form::label('nombre','Nombre')}}
    {{Form::text('nombre', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'user.nombre'] )}}
    <span ng-repeat="error in user.errors.nombre" class=text-danger>{[{ error }]}</span>
</div>

<div class="form-group">
    {{Form::label('apepat','Apellido paterno')}}
    {{Form::text('apepat', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'user.apepat'] )}}
    <span ng-repeat="error in user.errors.apepat" class=text-danger>{[{ error }]}</span>
</div>

<div class="form-group">
    {{Form::label('apemat','Apellido materno')}}
    {{Form::text('apemat', null, ['class'=>'form-control', 'ng-model' => 'user.apemat'] )}}
    <span ng-repeat="error in user.errors.apemat" class=text-danger>{[{ error }]}</span>
</div>

<div class="form-group">
    {{Form::label('password','Contraseña')}}
    {{Form::password('password', ['class'=>'form-control', 'ng-required' => '(user.id === undefined) ? true : false', 'ng-model' => 'user.password'] )}}
    <span ng-repeat="error in user.errors.password" class=text-danger>{[{ error }]}</span>
</div>

<div class="form-group">
    {{Form::label('password_confirmation','Confirmar Contraseña')}}
    {{Form::password('password_confirmation', ['class'=>'form-control', 'ng-required' => '(user.id === undefined) ? true : false', 'ng-model' => 'user.password_confirmation'] )}}
    <span class=text-danger ng-show="checkPassword()">
        No coincide la confirmación de la contraseña, favor de reingresar la constraseña y su confirmación.
    </span>
    <span ng-repeat="error in user.errors.password_confirmation" class=text-danger>{[{ error }]}</span>
</div>

<div class="form-group">
    {{Form::label(null,'Roles')}}
    <div>

        @foreach(Role::all() as $role)
            {{Form::checkbox('roles['.$role->id.']', $role->id, in_array($role->id, $user->roles->lists('id')), ['id' => 'roles['.$role->id.']', 'ng-model' => 'roles.role'.$role->id ])}}
            {{Form::label('roles['.$role->id.']', $role->name)}}
            <br>
        @endforeach
        {{$errors->first('roles[]', '<span class=text-danger>:message</span>')}}
    </div>
</div>



