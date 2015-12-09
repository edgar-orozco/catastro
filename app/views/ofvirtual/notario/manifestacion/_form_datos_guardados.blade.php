{{ HTML::style('js/jquery/jquery-ui.css') }}

{{ HTML::style('css/bootstrap.css') }}
    <!-- css general de la app -->
    {{ HTML::style('css/general.css') }}
    {{ HTML::style('css/geoCatastro.css') }}

    {{--ver el componente de selección de fechas aún cuando no esté usando chrome--}}



    {{ HTML::style('css/select2.min.css') }}
    {{ HTML::style('css/datepicker3.css') }}


<div class="row">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Respuesta Del Sistema</h3>
    </div>

     <div class="row-fluid panel-body">    
      <div class="col-md-12">
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 <h2>Los datos se guardaron correctamente.</h2>
</div>
</div>
</div>
 <div class="row-fluid panel-body">
     <div class="col-md-12">
    <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
 <h2>EL ID de la manifestación es: {{ $idm }}.</h2>
</div>
</div>
</div>
</div>
</div>





