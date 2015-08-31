{{ HTML::style('js/jquery/jquery-ui.css') }}
 {{ HTML::style('css/datepicker3.css') }}
  {{ HTML::style('css/select2.min.css') }}
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos Fiscales</h3>
    </div>
<div class="panel-body">
        <!--<div class="row">-->
        <div class="col-md-4">
          {{Form::label('estatus_fiscal','Estatus Fiscal:')}}
          {{Form::text('estatus_fiscal', null, ['class' => 'form-control'] )}}
      </div>
        <div class="col-md-4">
          {{Form::label('valor_terreno','Valor del Terreno :')}}
          {{Form::text('valor_terreno', null, ['class' => 'form-control'] )}}
      </div>
        <div class="col-md-4">
          {{Form::label('valor_construccion','Valor de Construción:')}}
          {{Form::text('valor_construccion', null, ['class' => 'form-control'] )}}
      </div>

      <div class="col-md-4">
          {{Form::label('valor_catastral','Valor Catastral:')}}
          {{Form::text('valor_catastral', null, ['class' => 'form-control'] )}}
        </div>
      <div class="col-md-4">
          {{Form::label('impuesto_predial','Impuesto Predial:')}}
          {{Form::text('impuesto_predial', null, ['class' => 'form-control'] )}}
        </div>
      <div class="col-md-4">
          {{Form::label('fecha_revaluacion','Fecha revaluación:')}}
           {{Form::input('text', 'fecha_revaluacion', null, ['class'=>'form-control fecha' ] )}}
        </div>

</div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos del Registro Público de la Propiedad</h3>
    </div>
<div class="panel-body">
 <div class="col-md-7">
          {{Form::label('tipo_escritura','Tipo de Escritura:')}}
          {{Form::select('tipo_escritura',array('1' => 'Escritura Publica', '2' => 'Escritura Privada'), null,['class'=>'form-control'])}}

        </div>
 <div class="col-md-7">
          {{Form::label('fecha_escritura','Fecha de Escritura:')}}
          {{Form::input('text', 'fecha_escritura', null, ['class'=>'form-control fecha' ] )}}
        </div>
 <div class="col-md-7">
          {{Form::label('numero_registro','Número de Registro:')}}
          {{Form::text('numero_registro', null, ['class' => 'form-control'] )}}
        </div>
 <div class="col-md-7">
          {{Form::label('numero de predio','Número de  Predio:')}}
          {{Form::text('numero de predio', null, ['class' => 'form-control'] )}}
        </div>
 <div class="col-md-7">
          {{Form::label('numero_folio','Número de Folio:')}}
          {{Form::text('numero_folio', null, ['class' => 'form-control'] )}}
        </div>
 <div class="col-md-7">
          {{Form::label('volumen_asentamiento','Volumen de Asentamiento:')}}
          {{Form::text('volumen_asentamiento', null, ['class' => 'form-control'] )}}
        </div>
  </div>
</div>


