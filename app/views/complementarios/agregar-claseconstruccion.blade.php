<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Agregar Muros</h4>
</div>
<div class="panel-body">  
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open(array('url'=> '/cargar-complementos/agregar-clase-construccion',)) }}
    <br/>
    <div style="margin-left: 20px">
        <div class="input-group">
            @foreach($const as $construccion)                
            {{ Form::hidden('gidcn',$construccion->gid_construccion) }}
            @endforeach
            <select name="id_tipoclaseconstruccion" class="form-control" autofocus="autofocus">
                @foreach($clases as $clase) 
                <option value="{{$clase>id}}">{{$clase->descripcion}}</option>
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