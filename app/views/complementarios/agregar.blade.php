<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<div class="panel-body">  
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open
        (
                array('url'=> '/agregar',)
        )
    }}
    <br/>
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