<div class="form-group">
    {{Form::label('entidad','Entidad')}}
    {{Form::select('entidad',$entidades, null,['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.entidad', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('entidad', '<span class=text-danger>:message</span>')}}
    <span id="error"></span>
</div>

<div class="form-group">
    {{Form::label('municipio','Seleccione el Municipio')}}
    {{Form::select('municipio',$Municipio, null,['tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
    <span id="error"></span>
</div>

<div class="form-group">
    {{Form::label('notaria','Nombre de la Notaria')}}
    {{Form::text('notaria', null, ['placeholder'=>'Notaria','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.notaria', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('notaria', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('nombres','Nombre del Notario')}}
    {{Form::text('nombres', null, ['placeholder'=>'Nombres del Notario','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apellido_paterno','Apellido Paterno del Notario')}}
    {{Form::text('apellido_paterno', null, ['placeholder'=>'Apellido Paterno del Notario','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('apellido_materno','Apellido Materno del Notario')}}
    {{Form::text('apellido_materno', null, ['placeholder'=>'Apellido Materno del Notario','tabindex'=>'6','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('curp','CURP del Notario')}}
    {{Form::text('curp', null, ['placeholder'=>'CURP del Notario','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('rfc','RFC del Notario')}}
    {{Form::text('rfc', null, ['placeholder'=>'RFC del Notario','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('nombre','Nombre del Responsable')}}
    {{Form::text('nombre', null, ['placeholder'=>'Nombres del Responsable','tabindex'=>'9','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.nombre', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('paterno','Apellido Paterno del Responsable')}}
    {{Form::text('paterno', null, ['placeholder'=>'Apellido Paterno del Responsable','tabindex'=>'10','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('paterno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('materno','Apellido Materno del Responsable')}}
    {{Form::text('materno', null, ['placeholder'=>'Apellido Materno del Responsable','tabindex'=>'11','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('materno', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('curp1','CURP del Responsable')}}
    {{Form::text('curp1', null, ['placeholder'=>'CURP del Responsable','tabindex'=>'12','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('curp1', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('rfc1','RFC del Responsable')}}
    {{Form::text('rfc1', null, ['placeholder'=>'RFC del Responsable','tabindex'=>'13','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'Notaria.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('rfc1', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('domicilio','Domicilio')}}
    {{Form::textarea('domicilio', null, ['placeholder'=>'Domicilio','tabindex'=>'14','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.domicilio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'rows'=>'5', 'cols'=>'30'] )}}
    {{$errors->first('domicilio', '<span class=text-danger>:message</span>')}}
</div>

<div class="form-group">
    {{Form::label('telefono','Telefono')}}
    {{Form::text('telefono', null, ['placeholder'=>'Telefono','tabindex'=>'15','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'Notaria.telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('telefono', '<span class=text-danger>:message</span>')}}
</div>

