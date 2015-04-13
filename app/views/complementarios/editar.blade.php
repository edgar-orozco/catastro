<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Confirme la acci&oacute;n:</h4>
</div>
<div class="panel-body">
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open(
                array(
                    'url'=> '/cargar-complementos-editar',
                    )
                 )
    }}
    <div style="margin-left: 20px">
        <div class="input-group">
            {{ Form::hidden('id',$datos->id_ie) }}
            ID:{{ Form::text('id_ie',$datos->id_ie , array('class' => 'form-control focus', 'readonly' => 'readonly', 'autofocus'=> 'autofocus')) }}
            <!--{{$errors->first("instalacion")}}-->
        </div>

        <br/>
        <div class="input-group">
            Clave:{{ Form::text('clave',$datos->clave , array('class' => 'form-control focus', 'readonly' => 'readonly', 'autofocus'=> 'autofocus')) }}
            <!--{{$errors->first("instalacion")}}-->
        </div>

        <br/>
        <div class="input-group">

            {{Form::select('instalacion',$catalogo,$datos->id_tipo_ie,array('class'=>'form-control'))}}
        </div>
        <br/>
        {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
</br>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

</div>