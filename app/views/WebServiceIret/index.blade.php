@extends('layouts.default')
@section('styles')
.spinner {
    position: fixed;
    top: 50%;
    left: 50%;
    margin-left: -50px; /* half width of the spinner gif */
    margin-top: -50px; /* half height of the spinner gif */
    text-align:center;
    z-index:1234;
    overflow: auto;
    width: 100px; /* width of the spinner gif */
    height: 102px; /*hight of the spinner gif +2px to fix IE8 issue */
}
@stop
@section('title')
  {{{ $title }}} :: @parent
@stop

@section('content')

   <div class="row">
  {{-- WSI = Web Service Iret--}}
        {{ Form::open(array('id' => 'WSI')) }}
<div class="col-md-6 form-group">
       {{Form::label('volante','Folio del Volante ')}}
      {{Form::text('volante', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'maxlength' => 15, 'size' => 10, 'placeholder' => '00000'] )}}
</div>
        <div class="form-actions form-group col-md-6" style="clear:both; ">
            {{ Form::submit('Consultar', array('class' => 'btn btn-primary')) }}
            {{ Form::reset('Limpiar formato', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::token() }}
        {{Form::close()}}

    </div>

<div id="tablaAjax"></div>
  <div id ="ajaxloading" class="spinner" style="display:none;">
      <img id="img-spinner" src="/css/images/folios/spinner.gif" alt="Loading" width="70%" height="70%" />
      Cargando...
    </div>
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
var $loading = $('#ajaxloading').hide();
  $(document)
    .ajaxStart(function () {
      $loading.show();
    })
    .ajaxStop(function () {
      $loading.hide();
    });


 $(document).ready(function () {
        $("#volante").keydown(function (event) {
            if (event.shiftKey)
            {
                event.preventDefault();
            }

            if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 189 || event.keyCode == 109) {
            }
            else {
                if (event.keyCode < 95) {
                    if (event.keyCode < 48 || event.keyCode > 57) {
                        event.preventDefault();
                    }
                }
                else {
                    if (event.keyCode < 96 || event.keyCode > 105) {
                        event.preventDefault();
                    }
                }
            }
        });
    });
</script>
@stop