@extends('layouts.default')
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
@section('title')
	{{{ 'Encuesta de Percepción de Servicios'}}} :: @parent
@stop

@section('content')

<style type="text/css">


.modal-header  {
 color: white;
}
.modal-content {
  background-color: #0480be;
}
.modal-body {
  background-color: #EEE;
}
.modal-footer {
  background-color: #CCCCCC;
}



</style>
<script>
   $(function () { 
   		$('#myModal').modal('show');
   	}
   	);
</script>


	<h1>Encuesta de Percepción de Servicios</h1>
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" 
   aria-labelledby="myModalLabel" aria-hidden="true" >
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header ">
            <button type="button" class="close" data-dismiss="modal" 
               aria-hidden="false">×
            </button>
            <h4 class="modal-title " id="myModalLabel">
               Encuesta de Percepción de Servicios
            </h4>
         </div>

         {{ Form::open(array('url' => 'storepercepcionservicio', 'method' => 'POST')) }}
         {{ Form::hidden('id_tramite', '3') }}
         <div class="modal-body">
            <div class="row">
				

				<div class="col-md-12">
					<div class="form-group">
						{{Form::label('evaluacion_ventanilla','¿Cómo evaluaría la ventanilla de servicios?')}}
						<br>&nbsp;&nbsp;
						{{ Form::label('rdoEvaluacionVentanilla5', 'Excelente') }}
					{{ Form::radio('evaluacion_ventanilla', '5', false, array('id'=>'rdoEvaluacionVentanilla5')) }}
					 &nbsp;&nbsp;
					{{ Form::label('rdoEvaluacionVentanilla4', 'Bueno') }}
					{{ Form::radio('evaluacion_ventanilla', '4', false, array('id'=>'rdoEvaluacionVentanilla4')) }}
					 &nbsp;&nbsp;
					{{ Form::label('rdoEvaluacionVentanilla3', 'Regular') }}
					{{ Form::radio('evaluacion_ventanilla', '3', false, array('id'=>'rdoEvaluacionVentanilla3')) }}
					 &nbsp;&nbsp;
					{{ Form::label('rdoEvaluacionVentanilla2', 'Malo') }}
					{{ Form::radio('evaluacion_ventanilla', '2', false, array('id'=>'rdoEvaluacionVentanilla2')) }}
					&nbsp;&nbsp;
					{{ Form::label('rdoEvaluacionVentanilla1', 'Pésimo') }}
					{{ Form::radio('evaluacion_ventanilla', '1', false, array('id'=>'rdoEvaluacionVentanilla1')) }}
					<br>
					<div class="alert alert-danger alert-dismissable {{$errors->first("evaluacion_ventanilla") == ''?'hide':'show'}}">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
						  {{$errors->first("evaluacion_ventanilla")}}
					</div>
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						{{Form::label('solucion_dudas','¿El personal de ventanilla resolvió todas sus dudas?')}}
						<br>&nbsp;&nbsp;
						{{ Form::label('rdoSolucionDudas1', 'Si') }}
					{{ Form::radio('solucion_dudas', '1', false, array('id'=>'rdoSolucionDudas1')) }}
						&nbsp;&nbsp;
						{{ Form::label('rdoSolucionDudas2', 'No') }}
					{{ Form::radio('solucion_dudas', '2', false, array('id'=>'rdoSolucionDudas2')) }}
						<br> 
					<div class="alert alert-danger alert-dismissable {{$errors->first("solucion_dudas") == ''?'hide':'show'}}">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
						  {{$errors->first("solucion_dudas")}}
					</div>
					</div>
				</div>
			</div>
				<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						{{Form::label('trato_personal','¿Cómo fue el trato que recibió del personal que lo atendió?')}}
						<br>&nbsp;&nbsp;
						{{ Form::label('rdoTratoPersonal5', 'Excelente') }}
					{{ Form::radio('trato_personal', '5', false, array('id'=>'rdoTratoPersonal5')) }}
						&nbsp;&nbsp;
					{{ Form::label('rdoTratoPersonal4', 'Bueno') }}
					{{ Form::radio('trato_personal', '4', false, array('id'=>'rdoTratoPersonal4')) }}
					&nbsp;&nbsp;
					{{ Form::label('rdoTratoPersonal3', 'Regular') }}
					{{ Form::radio('trato_personal', '3', false, array('id'=>'rdoTratoPersonal3')) }}
					&nbsp;&nbsp;
					{{ Form::label('rdoTratoPersonal2', 'Malo') }}
					{{ Form::radio('trato_personal', '2', false, array('id'=>'rdoTratoPersonal2')) }}
					&nbsp;&nbsp;
					{{ Form::label('rdoTratoPersonal1', 'Pésimo') }}
					{{ Form::radio('trato_personal', '1', false, array('id'=>'rdoTratoPersonal1')) }}
					<br>
					<div class="alert alert-danger alert-dismissable {{$errors->first("trato_personal") == ''?'hide':'show'}}">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
						  {{$errors->first("trato_personal")}}
					</div>
					</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						{{Form::label('tramite_satisfactorio','¿Realizó su trámite satisfactoriamente?')}}
						<br>&nbsp;&nbsp;
						{{ Form::label('rdoTramiteSatisfactorio1', 'Si') }}
					{{ Form::radio('tramite_satisfactorio', '1', false, array('id'=>'rdoTramiteSatisfactorio1')) }}
						&nbsp;&nbsp;
						{{ Form::label('rdoTramiteSatisfactorio2', 'No') }}
					{{ Form::radio('tramite_satisfactorio', '2', false, array('id'=>'rdoTramiteSatisfactorio2')) }}
						<br> 				
					<div class="alert alert-danger alert-dismissable {{$errors->first("tramite_satisfactorio") == ''?'hide':'show'}}">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
						  {{$errors->first("tramite_satisfactorio")}}
					</div>

					</div>
				</div>	

				</div>
				<div class="row">		
				<div class="col-md-12">
					<div class="form-group">
							{{Form::label('conocimiento_requisitos','¿Sabía que tenía que cumplir con algún requisito o llevar algún documento?')}}
						<br>&nbsp;&nbsp;
						{{ Form::label('rdoConocimientoSatisfactorio1', 'Si') }}
					{{ Form::radio('conocimiento_requisitos', '1', false, array('id'=>'rdoConocimientoSatisfactorio1')) }}
					&nbsp;&nbsp;
						{{ Form::label('rdoConocimientoSatisfactorio2', 'No') }}
					{{ Form::radio('conocimiento_requisitos', '2', false, array('id'=>'rdoConocimientoSatisfactorio2')) }}
						<br> 
						<div class="alert alert-danger alert-dismissable {{$errors->first("conocimiento_requisitos") == ''?'hide':'show'}}">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
						 {{$errors->first("conocimiento_requisitos")}}
					</div>

					
					</div>
					 
				</div>
				</div>
				<div class="row">

				<div class="col-md-12">
					<div class="form-group">
							{{Form::label('cumplimiento_requisitos','¿Cumplió con todos los requisitos y/o documentos?')}}
						<br>&nbsp;&nbsp;
						{{ Form::label('rdoCumplimientoRequisitos1', 'Si') }}
					{{ Form::radio('cumplimiento_requisitos', '1', false, array('id'=>'rdoCumplimientoRequisitos1')) }}
					&nbsp;&nbsp;
						{{ Form::label('rdoCumplimientoRequisitos2', 'No') }}
					{{ Form::radio('cumplimiento_requisitos', '2', false, array('id'=>'rdoCumplimientoRequisitos2')) }}
						<br> 
					<div class="alert alert-danger alert-dismissable {{$errors->first("cumplimiento_requisitos") == ''?'hide':'show'}}">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
						  {{$errors->first("cumplimiento_requisitos")}}
					</div>
					</div>					 
				</div>

				</div>
				<div class="row">
				<div class="col-md-12">
					<div class="form-group">
							{{Form::label('sugerencias_quejas','Tiene alguna sugerencia al respecto para mejorar el servicio')}}
						<br>
					{{ Form::textarea('sugerencias_quejas', '', array('cols'=>'70', 'rows'=>'3'), ['class'=>'form-control'])}} 
						<br> 
					<div class="alert alert-danger alert-dismissable {{$errors->first("sugerencias_quejas") == ''?'hide':'show'}}">
					   <button type="button" class="close" data-dismiss="alert" 
					      aria-hidden="true">
					      &times;
					   </button>
						  {{$errors->first("sugerencias_quejas")}}
					</div>
					</div>					 
				</div>
         </div>
         <div class="modal-footer">

 			<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar
            </button>
					 <input class="btn btn-warning" type="reset" value="Limpiar">
  
					  <input class="btn btn-success" type="submit" value="Guardar">
 
 <!--
            <button type="button" class="btn btn-default" 
               data-dismiss="modal">Close
            </button>
            <button type="button"  data-toggle="modal" class="btn btn-primary">
               Save
            </button>
        -->
         </div>
         {{Form::close()}}
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




 
 
@stop