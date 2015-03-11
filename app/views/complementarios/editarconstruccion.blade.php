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
                    'class'=>'form-inline'
                    )
                 )
    }}
    <div style="margin-left: 20px">
        <div class="input-group">
            {{ Form::hidden('id',$construcciones->gid_construccion) }}
            <!--{{$errors->first("instalacion")}}-->
        </div>
        <div class="input-group">
            Uso:</br>       
            {{Form::select('uso',$usos,$construcciones->uso_construccion,array('class'=>'form-control'))}}
        </div>
        <br/>
        <div class="input-group">
            Superficie: {{ Form::text('sup_const',$construcciones->sup_const, array('class' => 'form-control focus ',  'autofocus'=> 'autofocus')) }}
            <!--{{$errors->first("instalacion")}}-->
        </div>
        </br>
        <div class="input-group">
            Niveles:</br>       
            {{ Form::text('nivel',$construcciones->nivel, array('class' => 'form-control focus',  'autofocus'=> 'autofocus')) }}
        </div>
        </br>
        <div class="input-group">
            Edad:{{ Form::text('edad',$construcciones->edad_const, array('class' => 'form-control focus', 'placeholder'=>'Edad', 'autofocus'=> 'autofocus')) }}
            {{$errors->first("edad")}}
        </div>
        <br/>
        <div class="input-group">
            Clase:</br>
            {{Form::select('clase_const',$clase,$construcciones->clase_const,array('class'=>'form-control'))}}  
        </div>
        <br>
        <div class="input-group">
            Estado:</br>
            <select name="estado_const" class="form-control" autofocus="autofocus" required="required">
                <option value="1">BUENO</option>
                <option value="2">REGULAR</option>
                <option value="3">MALO</option>
                <option value="4">RUINOSO</option>
            </select>
        </div>
    </div>
    </br>
    </br>
    {{ Form::submit('Actualizar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
</div>
</br>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

</div>