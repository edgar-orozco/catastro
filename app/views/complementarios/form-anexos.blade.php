<html>
    <head>
        <title>General PDF</title>
    </head>
    <body>
          {{ Form::open(array('url'=> '/anexospdf')) }}
           Clave:{{ Form::text('clave', null, array('class' => 'form-control focus  ', 'placeholder'=>'Clave', 'autofocus'=> 'autofocus', 'required')) }}
          {{ Form::submit('Generar PDF', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </body>
</html>