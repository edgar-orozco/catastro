<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Confirme la acci&oacute;n:</h4>
</div>
<div class="panel-body">  
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open(array('url'=> '/agregar',)) }}
    <br/>
    <div style="margin-left: 20px">
        <div class="input-group">
            {{ Form::hidden('id',$datos) }}
        </div>
        <div class="input-group">
            Instalacion:</br>
            <select name="instalacion" class="form-control" autofocus="autofocus" required="required">
                @foreach($catalogo as $row) 
                <option value="{{$row->id}}">{{$row->descripcion}}</option>
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