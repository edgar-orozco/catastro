{{ Form::open(array('class' => 'macro', 'role' => 'form', 'method' => 'get', 'url' => '/macro-personas', 'name' => 'macro', 'id' => 'macro')) }}
  
  {{Form::label('tipo','Tipo de persona:') }}
  {{Form::select('tipo', array('0' => '--Seleccio Tipo de Persona', '1' => 'Persona Fisica', '2' => 'Persona Moral'));}}
  

  {{ Form::submit('Capturar Datos', array('class' => 'btn btn-primary', 'name' => 'boton', 'id' => 'boton')) }}

{{Form::close()}}