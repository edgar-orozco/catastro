@if(empty($nombres))
<div class="col-md-5">
    {{Form::label('DATOS DEL SOLICITANTE')}}
    <div class="form-group">
       {{Form::label('nombres','Nombre')}} 
       {{Form::text('nombres', null, ['placeholder'=>'Nombres del Solicitante','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_paterno','Apellido Paterno')}} 
       {{Form::text('apellido_paterno', null, ['placeholder'=>'Apellido Paterno del Solicitante','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_materno','Apellido Materno')}} 
       {{Form::text('apellido_materno', null, ['placeholder'=>'Apellido Materno del Solicitante','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('curp','CURP')}} 
       {{Form::text('curp', null, ['placeholder'=>'CURP del Solicitante','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('rfc','RFC')}} 
       {{Form::text('rfc', null, ['placeholder'=>'RFC del Solicitante','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
    </div>
</div>
@endif
@if(!empty($nombres))
<div class="col-md-5">
    {{Form::label('DATOS DEL SOLICITANTE')}}
    <div class="form-group">
       {{Form::label('nombres','Nombre')}} 
       {{Form::text('nombres', $nombres, ['placeholder'=>'Nombres del Solicitante','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_paterno','Apellido Paterno')}} 
       {{Form::text('apellido_paterno', $paterno, ['placeholder'=>'Apellido Paterno del Solicitante','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('apellido_materno','Apellido Materno')}} 
       {{Form::text('apellido_materno', $materno, ['placeholder'=>'Apellido Materno del Solicitante','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('curp','CURP')}} 
       {{Form::text('curp', $curp, ['placeholder'=>'CURP del Solicitante','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
       {{Form::label('rfc','RFC')}} 
       {{Form::text('rfc', $rfc, ['placeholder'=>'RFC del Solicitante','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
       {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
    </div>
</div>
@endif


<div class="col-md-5">
    {{Form::label('DATOS DE LA SOLICITUD')}}
    <div class="form-group">
        {{Form::label('id_tramite','Tipo Tramite')}}
        {{Form::select('id_tramite',$Tipotramite, null,['tabindex'=>'6','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.id_tramite', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
        {{$errors->first('id_tramite', '<span class=text-danger>:message</span>')}}
    </div> 
    <div class="form-group">
        {{Form::label('municipio','Municipio')}}
        {{Form::select('municipio',$Municipio, null,['tabindex'=>'7','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
        {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
    </div>
    <div class="form-group">
        {{Form::label('clave','Cleve o Cuenta Catastral')}}
        {{Form::text('clave', null, ['id'=>'clave','placeholder'=>'Clave o Cuenta Catastral','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.clave', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
        {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
        <div id="hola"></div>
    </div>
</div>

