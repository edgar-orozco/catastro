<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<div class="panel-body">  
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open
        (
                array('url'=> '/agregar-construccion',)
        )
    }}
    <br/>
    {{ Form::hidden('id',$datos) }}
    <div class="input-group">
        Uso Construccion:</br>
        <select name="uso" class="form-control" autofocus="autofocus" required="required">
            @foreach($catalogo as $row) 
            <option value="{{$row->id}}">{{$row->descripcion}}</option>
            @endforeach
        </select>
    </div>
    <br/>
    <div class="input-group">
        Superficie Construccion:{{ Form::text('sup_const',null, array('class' => 'form-control focus', 'placeholder'=>'Superficie Construccion', 'autofocus'=> 'autofocus')) }}
        {{$errors->first("sup_const")}}
    </div>
    </br>
     <div class="input-group">
        Nivel:{{ Form::text('nivel',null, array('class' => 'form-control focus', 'placeholder'=>'Niveles', 'autofocus'=> 'autofocus')) }}
        {{$errors->first("nivel")}}
    </div>
    <br/>
    {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
