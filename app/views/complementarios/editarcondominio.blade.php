<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Confirme la acci&oacute;n:</h4>
</div>
</br>
@if(Session::has('mensaje'))
<h2>{{ Session::get('mensaje') }}</h2>
@endif
<div style="margin-left: 20px">
{{ Form::open ( array('url'=>'/cargar-condominio-editar',))}}
<div class="input-group">
    Propietario:{{ Form::text('id_propietarios',$condominio->id_propietarios, array('class' => 'form-control focus  ', 'placeholder'=>'Propietario', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Entidad:{{ Form::text('entidad',$condominio->entidad, array('class' => 'form-control focus  ', 'placeholder'=>'Entidad', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Municipio:{{ Form::text('municipio',$condominio->municipio, array('class' => 'form-control focus  ', 'placeholder'=>'Municipio', 'autofocus'=> 'autofocus')) }}
</div>
<div class="input-group">
    Tipo Priva:{{ Form::text('tipo_priva',$condominio->tipo_priva, array('class' => 'form-control focus  ', 'placeholder'=>'Tipo Priva', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Superficie Comun:{{ Form::text('sup_comun',$condominio->sup_comun, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Indiviso:{{ Form::text('indiviso',$condominio->indiviso, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso', 'autofocus'=> 'autofocus')) }}
    {{$errors->first("indiviso")}}
</div>
<br/>

<div class="input-group">
    Superfie Total Común:{{ Form::text('sup_total_comun',$condominio->sup_total_comun, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Total', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    No Unidades:{{ Form::text('no_unidades',$condominio->no_unidades, array('class' => 'form-control focus  ', 'placeholder'=>'No Unidades', 'autofocus'=> 'autofocus')) }}
</div>
{{ Form::submit('Guardar', array('class' => 'btn btn-primary  ')) }}
{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning  ']) }}   
{{ Form::close() }}
</div>
</br>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

</div>