@if(empty($solicitante))
<div class="col-md-5">
    {{Form::label('DATOS DEL SOLICITANTE')}}
    <div class="form-group">
       {{Form::label('nombres','Nombre')}} 
       {{Form::text('nombres', null, ['placeholder'=>'Nombres del Solicitante','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_paterno','Apellido Paterno')}} 
       {{Form::text('apellido_paterno', null, ['placeholder'=>'Apellido Paterno del Solicitante','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'solicitante.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_materno','Apellido Materno')}} 
       {{Form::text('apellido_materno', null, ['placeholder'=>'Apellido Materno del Solicitante','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('curp','CURP')}} 
       {{Form::text('curp', null, ['placeholder'=>'CURP del Solicitante','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('rfc','RFC')}} 
       {{Form::text('rfc', null, ['placeholder'=>'RFC del Solicitante','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('tipo_telefono','Tipo Telefono')}} 
       {{Form::select('tipo_telefono',$tipo_telefono, null,['tabindex'=>'6','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.tipo_telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
       {{$errors->first('tipo_telefono', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('telefono','Telefono')}} 
       {{Form::text('telefono', null, ['placeholder'=>'Telefono del Solicitante','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('telefono', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('correo','E-mail')}} 
       {{Form::email('correo', null, ['placeholder'=>'E-mail del Solicitante','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.correo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('Correo', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('direccion','Dirección')}} 
       {{Form::textarea('direccion', null, ['placeholder'=>'Dirección del Solicitante','tabindex'=>'9','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.direccion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('direccion', '<span class=text-danger>:message</span>')}}
    </div>
</div>
@endif

@if(!empty($solicitante))
<div class="col-md-5">
    {{Form::label('DATOS DEL SOLICITANTE')}}
    <div class="form-group">
       {{Form::label('nombres','Nombre')}} 
       {{Form::text('nombres', $solicitante->nombres, ['placeholder'=>'Nombres del Solicitante','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_paterno','Apellido Paterno')}} 
       {{Form::text('apellido_paterno', $solicitante->apellido_paterno, ['placeholder'=>'Apellido Paterno del Solicitante','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_materno','Apellido Materno')}} 
       {{Form::text('apellido_materno', $solicitante->apellido_materno, ['placeholder'=>'Apellido Materno del Solicitante','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('curp','CURP')}} 
       {{Form::text('curp', $solicitante->curp, ['placeholder'=>'CURP del Solicitante','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('rfc','RFC')}} 
       {{Form::text('rfc', $solicitante->rfc, ['placeholder'=>'RFC del Solicitante','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('tipo_telefono','Tipo Telefono')}} 
       {{Form::select('tipo_telefono',$tipo_telefono, $solicitante->tipo_telefono,['tabindex'=>'6','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.tipo_telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
       {{$errors->first('tipo_telefono', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('telefono','Telefono')}} 
       {{Form::text('telefono', $solicitante->telefono, ['placeholder'=>'Telefono del Solicitante','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('telefono', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('correo','E-mail')}} 
       {{Form::email('correo', $solicitante->correo, ['placeholder'=>'E-mail del Solicitante','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.correo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('Correo', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('direccion','Dirección')}} 
       {{Form::textarea('direccion', $solicitante->direccion, ['placeholder'=>'Dirección del Solicitante','tabindex'=>'9','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.direccion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('direccion', '<span class=text-danger>:message</span>')}}
    </div>
</div>
@endif
<div class="col-md-5">
    {{Form::label('DATOS DE LA SOLICITUD')}}
    <div class="form-group">
        {{Form::label('tramite_id','Tipo Tramite')}}
        {{Form::select('tramite_id',$Tipotramite, null,['tabindex'=>'10','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.tramite_id', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
        {{$errors->first('tramite_id', '<span class=text-danger>:message</span>')}}
    </div> 
    <div class="form-group">
        {{Form::label('municipio','Municipio')}}
        {{Form::select('municipio',$Municipio, null,['tabindex'=>'11','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
        {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
        {{Form::label('clave','Cleve o Cuenta Catastral')}}
        {{Form::claveCuenta('clave', null, ['id'=>'clave','placeholder'=>'Clave o Cuenta Catastral','tabindex'=>'12','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.clave', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
        {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
        <div id="hola"></div>
    </div>
</div>

