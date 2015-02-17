<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
@if(Session::has('mensaje'))
<h2>{{ Session::get('mensaje') }}</h2>
@endif

{{ Form::open
 ( 
array('url'=>'/agregar-condominio',
  )
 )
}}
{{ Form::hidden('id',$datos) }}

<div class="input-group">
    Propietario:{{ Form::text('id_propietarios', null, array('class' => 'form-control focus  ', 'placeholder'=>'Propietario', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Superficie Privativa:{{ Form::text('tipo_priva', null, array('class' => 'form-control focus  ', 'placeholder'=>'Tipo Priva', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Superficie Comun:{{ Form::text('sup_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Indiviso:{{ Form::text('indiviso', null, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso', 'autofocus'=> 'autofocus')) }}
    {{$errors->first("indiviso")}}
</div>
<br/>
<div class="input-group">
    Superfie Total Común:{{ Form::text('sup_total_comun', null, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Total', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    No Unidades:{{ Form::text('no_unidades', null, array('class' => 'form-control focus  ', 'placeholder'=>'No Unidades', 'autofocus'=> 'autofocus')) }}
</div>
{{ Form::submit('Guardar', array('class' => 'btn btn-primary  ')) }}
{{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning  ']) }}   
{{ Form::close() }}
