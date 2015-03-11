<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Datos Entrega</h4>
</div>

{{ Form::open(array('url'=>'ejecucion/guardar')) }}

<div style="margin-left: 20px">
    <div style="margin-right: 20px">
        <div class="form-group">
            {{Form::label('id','Id requerimiento')}}
            {{Form::text('id',$idrequerimiento,['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required'] )}}
            {{$errors->first('id', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('fechanotificacion','Fecha Notificacion')}}
            {{Form::input('date', 'fechanotificacion', null , array( 'class'=>'form-control','required' ))}}
            {{$errors->first('fechanotificacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('nombre_ejecutor','Notificador')}}
             <select name="ejecutores" class="form-control">
            @foreach($catalogo as $row)
            <option value="{{$row->id}}">{{$row->nombre}}</option>
            @endforeach
    </select>
            {{$errors->first('nombre_ejecutor', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('notificacion','Via Notificación')}}
            {{Form::text('notificacion', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.nombres'] )}}
            {{$errors->first('notificacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('nombre','Nombre Persona')}}
            {{Form::text('nombre', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.rfc'] )}}
            {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('identificacion','Tipo Identificacion')}}
            {{Form::text('identificacion', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('identificacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('clave','Clave Identificacion')}}
            {{Form::text('clave', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('observaciones','Observaciones')}}
            {{Form::text('observaciones', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('observaciones', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-actions form-group">
            {{ Form::submit('Guardar Datos', array('class' => 'btn btn-primary')) }} 
            {{ Form::reset('Limpiar ', ['class' => 'btn btn-warning']) }}
            <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Cancelar Registro</button>
            {{Form::close()}}
        </div>
    </div>
</div>
