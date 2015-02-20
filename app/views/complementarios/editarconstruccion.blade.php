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
                    'url'=> '/complementos-editar',                    
                    )
                 )
    }}
    <div style="margin-left: 20px">
        <div class="input-group">
            {{ Form::hidden('id',$construcciones->gid_construccion) }}
            <!--{{$errors->first("instalacion")}}-->
        </div>
        <div class="input-group">
            Uso Construccion:</br>       
            {{Form::select('uso',$catalogo,$construcciones->uso_construccion,array('class'=>'form-control'))}}
        </div>
        <br/>
        <div class="input-group">
            Superficie Construccion {{ Form::text('sup_const',$construcciones->sup_const, array('class' => 'form-control focus',  'autofocus'=> 'autofocus')) }}
            <!--{{$errors->first("instalacion")}}-->
        </div>
        <div class="input-group">
            Niveles:</br>       
            {{ Form::text('nivel',$construcciones->nivel, array('class' => 'form-control focus',  'autofocus'=> 'autofocus')) }}
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