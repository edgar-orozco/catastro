{{ Form::model($solicitudGestion, ['url' => array('/kiosko/solicitud', $solicitudGestion->id), 'method'=>'POST','id'=>'form']) }}
    @include('kiosko.solicitud._form',compact('solicitudGestion'))
    <div class="form-actions form-group">
        {{Form::submit('Editar solicitud',array('class' => 'btn btn-primary', 'tabindex'=>'13', 'data-toggle'=>'modal', 'data-target'=>'#myModal'))}}
        <a href="{{URL::route('kiosko.solicitud.index')}}" class="btn btn-warning" role="button" tabindex="14"> Cancelar Edicion</a>
    </div>
{{Form::close()}}
