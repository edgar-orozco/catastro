<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Agregar Puertas</h4>
</div>
<div class="panel-body">  
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open(array('url'=> '/cargar-complementos/agregar-puertas')) }}
    <br/>
    <div style="margin-left: 20px">
        <div class="input-group">


        </div>
        <div class="input-group">
            @foreach($const as $construccion)                
            {{ Form::hidden('gidc',$construccion->gid_construccion) }}
            @endforeach
            <select name="id_tipopuerta" class="form-control" autofocus="autofocus">
                @foreach($puertas as $puerta) 
                <option value="{{$puerta->id_tipopuerta}}">{{$puerta->descripcion}}</option>
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