<div class="panel panel-default">
    <div class="panel-heading">DATOS DE LA SOLICITUD</div>
    <div class="panel-body">
        <div class="col-md-4">
            {{Form::label('tramite_id','Tipo Trámite')}}
            {{Form::select('tramite_id',$Tipotramite, null,['tabindex'=>'1','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.tramite_id', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
            {{$errors->first('tramite_id', '<span class=text-danger>:message</span>')}}
        </div> 
        <div class="col-md-4">
            {{Form::label('municipio','Municipio')}}
            {{Form::select('municipio',$Municipio, null,['tabindex'=>'2','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
            {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('clave','Cuenta predial o Clave catastral')}}
            {{Form::claveCuenta('clave', null, ['id'=>'clave','placeholder'=>'Clave o Cuenta Catastral','tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitudGestion.clave', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
            {{Form::text('id',null, ['id'=>'solicitud','hidden'])}}
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">DATOS DEL SOLICITANTE</div>
    <div class="panel-body">
        <div class="col-xs-6">
           {{Form::label('solicitante[curp]','CURP')}} 
           {{Form::text('solicitante[curp]', null, ['id'=>'curp','placeholder'=>'CURP del Solicitante','tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.curp', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[curp]', '<span class=text-danger>:message</span>')}}
           {{Form::text('solicitante_id',null, ['id' => 'response','hidden'])}}
        </div>
        <div class="col-xs-6">
           {{Form::label('solicitante[rfc]','RFC')}} 
           {{Form::text('solicitante[rfc]', null, ['id'=>'rfc','placeholder'=>'RFC del Solicitante','tabindex'=>'5','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[rfc]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('solicitante[nombres]','Nombre')}} 
           {{Form::text('solicitante[nombres]', null, ['id'=>'nombres','placeholder'=>'Nombres del Solicitante','tabindex'=>'6','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.nombres', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[nombres]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('solicitante[apellido_paterno]','Apellido Paterno')}} 
           {{Form::text('solicitante[apellido_paterno]', null, ['id'=>'apellido_paterno','placeholder'=>'Apellido Paterno del Solicitante','tabindex'=>'7','class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'solicitante.apellido_paterno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[apellido_paterno]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('solicitante[apellido_materno]','Apellido Materno')}} 
           {{Form::text('solicitante[apellido_materno]', null, ['id'=>'apellido_materno','placeholder'=>'Apellido Materno del Solicitante','tabindex'=>'8','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.apellido_materno', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[apellido_materno]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('solicitante[tipo_telefono]','Tipo Telefono')}} 
           {{Form::select('solicitante[tipo_telefono]',$tipo_telefono, null,['id'=>'tipo_telefono','tabindex'=>'9','class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.tipo_telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
           {{$errors->first('solicitante[tipo_telefono]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('solicitante[telefono]','Telefono')}} 
           {{Form::text('solicitante[telefono]', null, ['id'=>'telefono','placeholder'=>'Telefono del Solicitante','tabindex'=>'10','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.telefono', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[telefono]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
           {{Form::label('solicitante[correo]','E-mail')}} 
           {{Form::email('solicitante[correo]', null, ['id'=>'correo','placeholder'=>'E-mail del Solicitante','tabindex'=>'11','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.correo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[correo]', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-12">
           {{Form::label('solicitante[direccion]','Dirección')}} 
           {{Form::text('solicitante[direccion]', null, ['id'=>'direccion','placeholder'=>'Dirección del Solicitante','tabindex'=>'12','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'solicitante.direccion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
           {{$errors->first('solicitante[direccion]', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>
