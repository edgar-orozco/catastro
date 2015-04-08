<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Confirme la acci&oacute;n:</h4>
</div>
</br>
@if(Session::has('mensaje'))
<h2>{{ Session::get('mensaje') }}</h2>
@endif

{{ Form::open
 (
array('url'=>'/agregar-condominio', 'name'=>'construcciones'
  )
 )
}}
{{ Form::hidden('id',$datos) }}
<div style="margin-left: 20px">

<div class="input-group">
    Superficie Privativa:{{ Form::text('tipo_priva', null, array('class' => 'form-control focus  ', 'placeholder'=>'Tipo Priva', 'autofocus'=> 'autofocus', 'required')) }}
</div>
<br/>
<div class="input-group">
    Superficie Comun:{{ Form::text('sup_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun', 'autofocus'=> 'autofocus', 'required')) }}
</div>
<br/>
<div class="input-group">
    Indiviso:{{ Form::text('indiviso', null, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso', 'autofocus'=> 'autofocus', 'required')) }}
    {{$errors->first("indiviso")}}
</div>
<br/>
<div class="input-group">
    Superfie Total Común:{{ Form::text('sup_total_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Total', 'autofocus'=> 'autofocus', 'required')) }}
</div>
<br/>
<div class="input-group">
    No Unidades:{{ Form::text('no_unidades', null, array('class' => 'form-control focus  ', 'placeholder'=>'No Unidades', 'autofocus'=> 'autofocus', 'required')) }}
</div>
<br/>
{{ Form::submit('Guardar', array('class' => 'btn btn-primary  ')) }}
{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning  ']) }}   
{{ Form::close() }}
</div>

</br>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

</div>