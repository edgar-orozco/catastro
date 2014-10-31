@if(!$smv->id)
{{ Form::open(['route' => 'admin.smv.store', 'method' => 'POST']) }}
@else
{{ Form::model($smv, ['route' => array('admin.smv.update', $smv->id ), 'method'=>'put' ]) }}
@endif

   <div>
    {{Form::label("Año de vigencia")}}
    {{Form::text("anio")}}
   </div>

   <div>
    {{Form::label("Área")}}
    {{Form::text("area")}}
   </div>

   <div>
    {{Form::label("Monto")}}
    {{Form::text("monto")}}
   </div>

   {{Form::submit("Guardar")}}
{{ Form::close() }}
