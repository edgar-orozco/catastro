@extends('layouts.default')

@section('styles')

.panel{
        max-width: 600px; / change according to your requirement/
}
.center {
     float: none;
     margin-left: auto;
     margin-right: auto;
}
@stop

@section('content')

  <div class="panel panel-default center">
      <div class="panel-heading">Conciliación</div>

      <div class="panel-body">
        <div class="row">
          <div class="col-md-3 col-md-offset-2"><h4>Monto total: </h4></div>
          <div class="col-md-5 col-md-offset-2"><h4>$ 2,346.76</h4></div>
        </div>
        <div class="row">
          <div class="col-md-3 col-md-offset-2"><h4>Monto inicial: </h4></div>
          <div class="col-md-5 col-md-offset-2"><h4>$ 346.76</h4></div>
        </div>
        <div class="row">
          <div class="col-md-3 col-md-offset-2"><h4>Diferencia: </h4></div>
          <div class="col-md-5 col-md-offset-2"><h4>$ 1,000.00</h4></div>
        </div>
        <br>  
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <a class="btn btn-primary" type="submit" href="/cajas/cierrePdf/">
                    <i class="glyphicon glyphicon-arrow-right"></i>
                    Generar Corte
              </a>
            </div>
        </div>
      </div>
        
  </div>
@stop