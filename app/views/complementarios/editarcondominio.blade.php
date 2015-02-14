<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
@if(Session::has('mensaje'))
<h2>{{ Session::get('mensaje') }}</h2>
@endif

{{ Form::open
 ( 
array('url'=>'/cargar-condominio-editar',
  )
 )
}}
{{ Form::hidden('id',$condominio->id_condominio) }}
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

<!--<div class="input-group">
    No Condominio:{{ Form::text('no_condominal',$condominio->no_condominal, array('class' => 'form-control focus  ', 'placeholder'=>'No Condominial', 'autofocus'=> 'autofocus')) }}
</div>
<br/>-->
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
    Superficie Común Magno:{{ Form::text('superf_comun_magno',$condominio->sup_comun_magno, array('class' => 'form-control focus  ', 'placeholder'=>'Superficie Comun Magno', 'autofocus'=> 'autofocus')) }}
</div>
<br/>
<div class="input-group">
    Indiviso Magno:{{ Form::text('indiviso_magno',$condominio->indiviso_magno, array('class' => 'form-control focus  ', 'placeholder'=>'Indiviso Magno', 'autofocus'=> 'autofocus')) }}
</div>
<br>
<div class="input-group">
    Clave Magno:{{ Form::text('cve_magno',$condominio->cve_magno, array('class' => 'form-control focus  ', 'placeholder'=>'Clave Magno', 'autofocus'=> 'autofocus')) }}
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
