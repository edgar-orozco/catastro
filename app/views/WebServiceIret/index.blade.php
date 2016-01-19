@extends('layouts.default')

@section('title')
  {{{ $title }}} :: @parent
@stop

@section('content')

   <div class="row">
  {{-- WSI = Web Service Iret--}}
        {{ Form::open(array('id' => 'WSI')) }}
<div class="col-md-6 form-group">
       {{Form::label('volante','Folio del Volante ')}}
      {{Form::text('volante', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'maxlength' => 15, 'size' => 15] )}}
</div>
        <div class="form-actions form-group col-md-6" style="clear:both; ">
            {{ Form::submit('Consultar', array('class' => 'btn btn-primary')) }}
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::token() }}
        {{Form::close()}}

    </div>

<div id="tablaAjax"></div>
  
@stop
@section('javascript')
<script type="text/javascript">
//Guardar
    $('#WSI').bind('submit', function ()
    {
        $.ajax(
                {
                    type: 'POST',
                    data: new FormData(this), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
                    processData: false,
                    contentType: false,
                    url: '/Iret/BuscarVolante',
                    success: function (data)
                    {
                      console.log(data);
                      if(data.succes == 'succes')
                      {
                                          $('#tablaAjax').html('<div class="alert alert-danger">No existe registro para el numero de folio ingresado.</div>');

                      }

                   else{
                    $('#tablaAjax').html(data);
                  }


                    }
                });
        return false;
    });

</script>
@stop