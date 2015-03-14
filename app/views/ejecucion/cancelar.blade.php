<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Cancelación de proceso</h4>
</div>

{{ Form::open(array('url'=>'ejecucion/guardarcancelacion')) }}

<div style="margin-left: 20px">
    <div style="margin-right: 20px">
        <div class="form-group">
            {{Form::label('id','Id requerimiento')}}
            {{Form::text('id',$idrequerimiento,['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required'] )}}
            {{$errors->first('id', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>
        <div class="form-group">
            {{Form::label('fechacancelacion','Fecha Cancelación')}}
            {{Form::input('date', 'fechacancelacion', null , array( 'class'=>'form-control','required' ))}}
            {{$errors->first('fechacancelacion', '<span class=text-danger>:message</span>')}}
            <p class="help-block"></p>
        </div>

        <div class="form-group">
            {{Form::label('motivo','Motivo Cancelación')}}
            {{Form::text('motivo', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'personas.curp'] )}}
            {{$errors->first('motivo', '<span class=text-danger>:message</span>')}}
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

        <div class="form-actions form-group">
            {{ Form::submit('Guardar Datos', array('class' => 'btn btn-primary')) }} 
            {{ Form::reset('Limpiar ', ['class' => 'btn btn-warning']) }}
            <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Cancelar Registro</button>
            {{Form::close()}}
        </div>
    </div>
</div>
