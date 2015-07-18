<div class="panel panel-default">
    <div class="panel-heading">DATOS DE LA SOLICITUD</div>
    <div class="panel-body">
        <div class="col-md-4">
            {{Form::label('tramite_id','Tipo Tramite')}}
            {{Form::select('tramite_id',$Tipotramite, null,['tabindex'=>'10','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.tramite_id', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
            {{$errors->first('tramite_id', '<span class=text-danger>:message</span>')}}
        </div> 
        <div class="col-md-4">
            {{Form::label('municipio','Municipio')}}
            {{Form::select('municipio',$Municipio, null,['tabindex'=>'11','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
            {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('clave','Cleve o Cuenta Catastral')}}
            {{Form::claveCuenta('clave', null, ['id'=>'clave','placeholder'=>'Clave o Cuenta Catastral','tabindex'=>'12','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.clave', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
            <div id="hola"></div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">DATOS DEL SOLICITANTE</div>
    <div class="panel-body">
        <div class="col-md-4">
           {{Form::label('nombres','Nombre')}} 
           {{Form::text('nombres', null, ['placeholder'=>'Nombres del Solicitante','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('apellido_paterno','Apellido Paterno')}} 
           {{Form::text('apellido_paterno', null, ['placeholder'=>'Apellido Paterno del Solicitante','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'solicitante.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('apellido_materno','Apellido Materno')}} 
           {{Form::text('apellido_materno', null, ['placeholder'=>'Apellido Materno del Solicitante','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-6">
           {{Form::label('curp','CURP')}} 
           {{Form::text('curp', null, ['placeholder'=>'CURP del Solicitante','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-6">
           {{Form::label('rfc','RFC')}} 
           {{Form::text('rfc', null, ['placeholder'=>'RFC del Solicitante','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('tipo_telefono','Tipo Telefono')}} 
           {{Form::select('tipo_telefono',$tipo_telefono, null,['tabindex'=>'6','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.tipo_telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
           {{$errors->first('tipo_telefono', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('telefono','Telefono')}} 
           {{Form::text('telefono', null, ['placeholder'=>'Telefono del Solicitante','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('telefono', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('correo','E-mail')}} 
           {{Form::email('correo', null, ['placeholder'=>'E-mail del Solicitante','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.correo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('Correo', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-12">
           {{Form::label('direccion','Dirección')}} 
           {{Form::text('direccion', null, ['placeholder'=>'Dirección del Solicitante','tabindex'=>'9','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.direccion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('direccion', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>