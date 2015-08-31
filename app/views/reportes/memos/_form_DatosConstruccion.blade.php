<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos de la Construcción</h3>
    </div>
<div class="panel-body">
       <div class="col-md-8"> 
        {{Form::label('area_construida','Area Construida:')}}
        {{Form::text('area_construida', null, ['class' => 'form-control'] )}}
        </div>
       <div class="col-md-4"> 
        {{Form::label('niveles','Niveles:')}}
        {{Form::text('niveles', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-8">
          {{Form::label('tipo_construccion','Tipo de Construcción:')}}
          {{Form::text('tipo_construccion', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-8">
          {{Form::label('estado_conservacion','Estado de Conservación:')}}
          {{Form::text('estado_conservacion', null, ['class' => 'form-control'] )}}
        </div>
        <div class="col-md-8">
          {{Form::label('valor_unitario','Valor Unitario de la constrcción:')}}
          {{Form::text('valor_unitario', null, ['class' => 'form-control'] )}}
        </div>
</div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"></h3>
    </div>
<div class="panel-body">
       <div class="col-md-8"> 
        {{Form::label('indicadores','Indicadores:')}}
        {{Form::select('indicadores',array('1' => '--Tipo de indicador'), null,['class'=>'form-control'])}}
      </div>
       <div class="col-md-8"> 
        {{Form::label('servicios_publicos','Servicios Publicos:')}}
        {{Form::select('servicios_publicos',array('1' => '--Tipo de servicio'), null,['class'=>'form-control'])}}
      </div>
        
</div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Datos de Control</h3>
    </div>
<div class="panel-body">
       <div class="col-md-9"> 
        {{Form::label('observacione','Observaciones:')}}
        {{Form::textarea ('observaciones', null, ['class' => 'form-control','rows'=>'4', 'cols'=>'90'])}}
      </div>
      <div class="col-md-6"> 
          {{Form::label('fecha_modificacion','Fecha de modificación:')}}
          {{Form::text('fecha_modificacion', null, ['class' => 'form-control fecha'] )}}
        </div>
      <div class="col-md-6"> 
          {{Form::label('hora_modificion','Hora de Modificación:')}}
          {{Form::input('time','hora_modificion', null, ['class' => 'form-control'] )}}
        </div>
      <div class="col-md-6"> 
          {{Form::label('usuario_modifico','Usuario Modifico:')}}
          {{Form::text('usuario_modifico', null, ['class' => 'form-control'] )}}
        </div>
      <div class="col-md-6"> 
          {{Form::label('fecha_alta','Fecha Alta:')}}
          {{Form::text('fecha_alta', null, ['class' => 'form-control fecha'] )}}
        </div>
        
</div>
</div>