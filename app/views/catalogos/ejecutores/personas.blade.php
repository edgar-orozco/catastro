<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Personas</h4>
</div>
{{ Form::open(array('url'=>'catalogos/personas')) }}
<div style="margin-left: 20px">
    <div style="margin-right: 20px">
        <div class="form-group">
            {{Form::label('apellido_paterno','Apellido Paterno')}}
            {{Form::text('apellido_paterno', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.apellido_paterno'] )}}
            {{$errors->first('apellido_paterno', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('apellido_materno','Apellido Materno')}}
            {{Form::text('apellido_materno', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.apellido_materno'] )}}
            {{$errors->first('apellido_materno', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('nombres','Nombres')}}
            {{Form::text('nombres', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.nombres'] )}}
            {{$errors->first('nombres', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('rfc','RFC')}}
            {{Form::text('rfc', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.rfc'] )}}
            {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('curp','CURP')}}
            {{Form::text('curp', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-actions form-group">
            {{ Form::submit('Guardar nombre', array('class' => 'btn btn-primary')) }} 
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
            <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            {{Form::close()}}
        </div>
    </div>
</div>    
