<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Confirme la acci&oacute;n:</h4>
</div>
<div class="panel-body"> 
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
        <div style="margin-left: 20px">
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
    </div>
    </br>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

    </div>
</div>
