<div ng-show="user.error" class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>El formulario contiene errores</strong>, corríjalos e intente nuevamente.
</div>

<div class="form-group text-right" ng-show="user.id !== undefinied">
    <input
            type="checkbox"
            bs-switch
            ng-model="user.vigente"
            switch-size="'small'"
            switch-on-text="Activo"
            switch-off-text="Inactivo"
            ng-true-value="true"
            ng-false-value="false"
            ng-change="vigencia(user)"
            >
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
    {{Form::label('rfc','RFC')}}
    {{Form::text('rfc', null, ['class'=>'form-control', 'minlength'=>'13', 'maxlength'=>'13', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})', 'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado', 'max-size' => 12, 'ng-model' => 'user.rfc'] )}}
    <span ng-repeat="error in user.errors.rfc" class=text-danger>{[{ error }]}</span>
    <span ng-if="formUser.rfc.$error.pattern" class=text-danger>
        El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado
    </span>
</div>

<div class="form-group">
    {{Form::label('curp','CURP')}}
    {{Form::text('curp', null, ['class'=>'form-control', 'minlength'=>'18', 'maxlength'=>'18', 'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2}) ', 'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado', 'ng-model' => 'user.curp'] )}}
    <span ng-repeat="error in user.errors.curp" class=text-danger>{[{ error }]}</span>
    <span ng-if="formUser.curp.$error.pattern" class=text-danger>
        El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado
    </span>
</div>

<div class="form-group">
    {{Form::label(null,'COVERAT')}}
    <select select-two="select2" placeholder="COVERTA" class="select2-select" selection="perito"  ng-model="perito">
        @foreach(Perito::all() as $perito)
            <option value="{{ $perito->id }}"> {{ $perito->corevat }} </option>
        @endforeach
    </select>
    {{$errors->first('municipios[]', '<span class=text-danger>:message</span>')}}
</div>
