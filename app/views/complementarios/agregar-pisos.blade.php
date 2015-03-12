<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Agregar Pisos</h4>
</div>
<div class="panel-body">  
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open(array('url'=> '/cargar-complementos/agregar-pisos')) }}
    <br/>
    <div style="margin-left: 20px">
          <div class="input-group">
           @foreach($const as $construccion)                
            {{ Form::hidden('gidc',$construccion->gid_construccion) }}
            @endforeach
            <select name="id_tipopisos" class="form-control" autofocus="autofocus">
                @foreach($pisos as $piso) 
                <option value="{{$piso->id_tipopiso}}">{{$piso->descripcion}}</option>
                @endforeach
            </select>
        </div>
        <br/>   
        {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
</br>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

</div>