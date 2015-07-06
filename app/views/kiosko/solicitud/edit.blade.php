{{ Form::model($solicitudGestion, ['route' => array('kiosko.solicitud.update', $solicitudGestion->id_solicitud ), 'method'=>'put' ]) }} 
    @include('kiosko.solicitud._form',compact('solicitudGestion'))

    <div class="form-actions form-group">
        {{Form::submit('Actualizar Solicitud',array('class' => 'btn btn-primary','tabindex'=>'9'))}}
        <a href="{{URL::route('kiosko.solicitud.index')}}" class="btn btn-warning" role="button"> Cancelar Edicion</a>
    </div>
{{Form::close()}}


