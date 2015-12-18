<h3 class="header">{{$title}}</h3>
<hr>
{{Form::model($row, ['route' => array('updateAvaluoEnfoqueFisico', $row->idavaluo), 'method'=>'post', 'id'=>'formAvaluoFisico' ]) }}
{{Form::hidden('idavaluoenfoquefisico', $row->idavaluoenfoquefisico, ['id'=>'idavaluoenfoquefisico'])}}

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" id="divHeaderTerreno"><h4>Terreno</h4></div>
	<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title" id="divNuevoTerreno" style="display: none;">
		<a class="btn btn-primary nuevo" id="btnNewAefTerr" title="Nuevo Registro">
			<span class="glyphicon glyphicon-plus-sign"></span>Nuevo
		</a>
	</div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefTerrenosDataTable">
			<thead>
				<tr>
					<th rowspan="2">ID</th>
					<th rowspan="2">FRACC</th>
					<th rowspan="2">SUP.</th>
					<th colspan="6">Factores de eficiencia</th>
					<th rowspan="2">V. Aplicado</th>
					<th rowspan="2">V.U. NETO</th>
					<th rowspan="2">INDIVISO</th>
					<th rowspan="2">V. PARCIAL</th>
					<th colspan="2">Opciones</th>
				</tr>
				<tr>
					<th>IRRE.</th>
					<th>TOP</th>
					<th>FRENTE</th>
					<th>FORMA</th>
					<th>OTROS</th>
					<th>F. R.</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="8">&nbsp;</td>
					<td class="bg-default" colspan="3" style="text-align: right;">Valor del Terreno:</td>
					<td class="bg-info" colspan="3" style="text-align: right;" id="valor_terreno">{{number_format($row->valor_terreno, 2, ".", ",")}}</td>
					<td class="bg-default"></td>
				</tr>
			</tfoot>
		</table>
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12">
		{{Form::label('justificacion_valor_aplicado', 'Justificación del valor aplicado en OTROS por:')}}
		{{Form::textarea('justificacion_valor_aplicado', $row->justificacion_valor_aplicado, ['class'=>'form-control', 'maxlength'=>'500', 'rows' => '3'] )}}
	</div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-12"><h4>DE LA CONSTRUCCIÓN</h4></div>
	<div class="clearfix"></div>
	<br/>
	<br/>
	<div class="col-md-3">
		{{Form::label('idclasegeneralinmueble', 'Clase General')}}
		{{Form::select('idclasegeneralinmueble', $cat_clase_general_inmueble, $row->idclasegeneral, ['id' => 'idclasegeneralinmueble', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idtipoinmueble', 'Tipo de Inmueble')}}
		{{Form::select('idtipoinmueble', $cat_tipo_inmueble, $row->idtipoinmueble, ['id' => 'idtipoinmueble', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idestadoconservacion', 'Estado de Conservacion')}}
		{{Form::select('idestadoconservacion', $cat_estado_conservacion, $row->idestado_conservacion, ['id' => 'idestadoconservacion', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-3">
		{{Form::label('idcalidadproyecto', 'Calidad del Proyecto')}}
		{{Form::select('idcalidadproyecto', $cat_calidad_proyecto, $row->idcalidadproyecto, ['id' => 'idcalidadproyecto', 'class'=>'form-control'])}}
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-3">
		{{Form::label('edad_construccion', 'Edad de la Construcción (Años)')}}
		{{Form::number('edad_construccion', $row->edad_construccion, ['id'=>'edad_construccion','class'=>'form-control edad', 'min'=>'0', 'max' => '999'] )}}
		{{$errors->first('edad_construccion', '<span class=text-danger>:message</span>')}}
	</div>
	<div class="col-md-3">
		{{Form::label('vida_util', 'Vida Útil Remanente')}}
		{{Form::number('vida_util', $row->vida_util, ['id'=>'vida_util','class'=>'form-control edad', 'min'=>'0', 'max' => '999'] )}}
		{{$errors->first('vida_util', '<span class=text-danger>:message</span>')}}
	</div>
	<div class="col-md-3">
		{{Form::label('numero_niveles', 'Número de Niveles')}}
		{{Form::number('numero_niveles', $row->numero_niveles, ['id'=>'numero_niveles','class'=>'form-control edad', 'min'=>'0', 'max' => '999'] )}}
		<!--{{Form::select('numero_niveles', array('1'=>'1', '2'=>'2', '3'=>'3'), $row->numero_niveles, ['id' => 'numero_niveles', 'class'=>'form-control'])}}-->
	</div>
	<div class="col-md-3">
		{{Form::label('nivel_edificio_condominio', 'Nivel en Edificio (condominio)')}}
		{{Form::number('nivel_edificio_condominio', $row->nivel_edificio_condominio, ['id'=>'nivel_edificio_condominio','class'=>'form-control edad', 'min'=>'0', 'max' => '999'] )}}
		<!--
		{{Form::select('nivel_edificio_condominio', 
					array('0'=>'N/A', '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6', '7'=>'7', '8'=>'8', '9'=>'9', '10'=>'10'), 
					$row->nivel_edificio_condominio, ['id' => 'nivel_edificio_condominio', 'class'=>'form-control'])}}
		-->
	</div>
	<div class="col-md-12"><hr></div>

	@if( $superficie_construccion <= 0 )
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h4>Datos de la Construcción</h4>
		<h4>Esta sección no aplica debido a que no se especifico la "Superficie de Construcción" en el apartado "Inmueble"</h4>
	</div>
	@else
	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Datos de la Construcción</h4></div>
	<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
		<a class="btn btn-primary nuevo" id="btnNewAefCons" title="Nuevo Registro">
			<span class="glyphicon glyphicon-plus-sign"></span>Nuevo
		</a>
	</div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefConstruccionesDataTable">
			<thead>
				<tr>
					<th rowspan="2">ID</th>
					<th rowspan="2">TIPO</th>
					<th rowspan="2">EDAD</th>
					<th rowspan="2">SUPERFICIE M&sup2;</th>
					<th rowspan="2">V.R. NUEVO</th>
					<th colspan="3">Factores</th>
					<th rowspan="2">V.R. NETO</th>
					<th rowspan="2">V. PARCIAL</th>
					<th colspan="2">Opciones</th>
				</tr>
				<tr>
					<th>Edad</th>
					<th>Construcción</th>
					<th>Resultante</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="3" style="text-align: right;">Total Metros Construcción</td>
					<td class="bg-info" style="text-align: right;" id="total_metros_construccion">{{number_format($row->total_metros_construccion, 2, ".", ",")}}</td>
					<td class="bg-default" colspan="3"></td>
					<td class="bg-default" colspan="2" style="text-align: right;">Valor de la Construcción</td>
					<td class="bg-info" style="text-align: right;" id="valor_construccion">{{number_format($row->valor_construccion, 2, ".", ",")}}</td>
					<td class="bg-default" colspan="2"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	@endif
	<div class="col-md-12"><hr></div>

	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Áreas y Elementos adicionales comunes (solo en Condominios)</h4></div>
	<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
		<a class="btn btn-primary nuevo" id="btnNewAefCon" title="Nuevo Registro">
			<span class="glyphicon glyphicon-plus-sign"></span>Nuevo
		</a>
	</div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefCondominiosDataTable">
			<thead>
				<tr>
					<th rowspan="2">ID</th>
					<th rowspan="2">DESCRIPCIÓN</th>
					<th rowspan="2">UNIDAD</th>
					<th rowspan="2">CANTIDAD</th>
					<th rowspan="2">V.R. NUEVO</th>
					<th rowspan="2">VIDA UTIL</th>
					<th rowspan="2">EDAD (años)</th>
					<th colspan="3">Factores</th>
					<th rowspan="2">INDIVISO</th>
					<th rowspan="2">V. PARCIAL</th>
					<th colspan="2">Opciones</th>
				</tr>
				<tr>
					<th>F. EDAD</th>
					<th>F. CONS.</th>
					<th>F. RESUL.</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="8" style="text-align: right;">Subtotal</td>
					<td class="bg-info" colspan="2" style="text-align: right;" id="subtotal_area_condominio">{{number_format($row->subtotal_area_condominio, 2, ".", ",")}}</td>
					<td class="bg-default" colspan="2"></td>
					<td class="bg-default" colspan="2"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12"><hr style="border-width: 6px;"></div>

	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Instalaciones Especiales, Elementos, Accesorios y Obras Complementarias</h4></div>
	<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
		<a class="btn btn-primary nuevo" id="btnNewAefIns" title="Nuevo Registro">
			<span class="glyphicon glyphicon-plus-sign"></span>Nuevo
		</a>
	</div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aefInstalacionesDataTable">
			<thead>
				<tr>
					<th>ID</th>
					<th>DESCRIPCIÓN</th>
					<th>UNIDAD</th>
					<th>CANTIDAD</th>
					<th>V.R. NUEVO</th>
					<th>VIDA UTIL</th>
					<th>EDAD (años)</th>
					<th>F. EDAD</th>
					<th>F. CONS.</th>
					<th>F. RESUL.</th>
					<th>V. NETO</th>
					<th>V. PARCIAL</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-default" colspan="8" style="text-align: right;">Subtotal</td>
					<td class="bg-info" colspan="2" style="text-align: right;" id="subtotal_instalaciones_especiales">{{number_format($row->subtotal_instalaciones_especiales, 2, ".", ",")}}</td>
					<td class="bg-default" colspan="2"></td>
					<td class="bg-default" colspan="2"></td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12"><hr style="border-width: 6px;"></div>

	<div class="col-md-12"><hr></div>

	<div class="col-md-9"><h1>Enfoque Físico</h1></div>
	<div class="col-md-3"><h1 id="total_valor_fisico">{{number_format($row->total_valor_fisico, 2, ".", ",")}}</h1></div>

	<div class="col-md-12"><hr></div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-6 form-actions">
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-coveratSecondary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>
	<div class="col-md-6 form-actions">
		{{Form::submit('Guardar', ['class'=>'btn btn-coveratPrincipal'])}}
	</div>

</div>
{{Form::close()}}

<div class="modal fade bs-example-modal-lg" id="modalFormAefTerrenos" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAefTerrenosTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('storeAefTerrenos'), 'id'=>'formAefTerrenos', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAefTerrenos" id="ctrlAefTerrenos" value="" />
			<input type="hidden" name="idavaluoenfoquefisico1" id="idavaluoenfoquefisico1" value="{{$row->idavaluoenfoquefisico}}" />
			<input type="hidden" name="idaefterreno" id="idaefterreno" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<label for="fraccion">Fracción:</label>
						<input type="text" class="form-control" name="fraccion" id="fraccion" maxlength="50" required />
					</div>
					<div class="col-md-4">
						<label for="superficie">Superficie:</label>
						<input type="text" class="form-control" name="superficie" id="superficie" value="{{$superficie_total_terreno}}" disabled />
					</div>
					<div class="col-md-4">
						<label for="irregular">Irregular:</label>
						<input type="number" class="form-control clsNumeric" name="irregular" id="irregular" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>

					<div class="col-md-3">
						<label for="idfactortop">Top:</label>
						<select class="form-control" id="idfactortop" name="idfactortop">
							@foreach ($cat_factores_top as $item)
							<option value="{{$item->idfactorconservacion}}" min="{{$item->valor_minimo}}" max="{{$item->valor_maximo}}">{{$item->factor_conservacion}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="top_terrenos">Factor Top:</label>
						<input type="number" class="form-control clsNumeric" name="top_terrenos" id="top_terrenos" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-3">
						<label for="idfactorfrente">Frente:</label>
						<select class="form-control" id="idfactorfrente" name="idfactorfrente">
							@foreach ($cat_factores_frente as $item)
							<option value="{{$item->idfactorfrente}}" min="{{$item->valor_minimo}}" max="{{$item->valor_maximo}}">{{$item->factor_frente .' ['.$item->valor_minimo.'-'.$item->valor_maximo.']'}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="frente">Factor Frente:</label>
						<input type="number" class="form-control clsNumeric" name="frente" id="frente" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>

					<div class="col-md-3">
						<label for="idfactorforma">Forma:</label>
						<select class="form-control" id="idfactorforma" name="idfactorforma" >
							@foreach ($cat_factores_forma as $item)
							<option value="{{$item->idfactorforma}}">{{$item->factor_forma}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="forma">Factor Forma:</label>
						<input type="number" class="form-control clsNumeric" name="forma" id="forma" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>
					<!--
					<div class="col-md-3">
						<label for="idfactorotros">Otros:</label>
						<select class="form-control" id="idfactorotros" name="idfactorotros">
							@foreach ($cat_factores_conservacion as $item)
							<option value="{{$item->idfactorconservacion}}">{{$item->factor_conservacion}}</option>
							@endforeach
						</select>
					</div>
					-->
					<div class="col-md-6">
						<label for="otros">Factor Otro:</label>
						<input type="number" class="form-control clsNumeric" name="otros" id="otros" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>

					<div class="col-md-6">
						<label for="factor_resultante_terrenos">Factor Resultante:</label>
						<input type="text" class="form-control" name="factor_resultante_terrenos" id="factor_resultante_terrenos" disabled />
					</div>
					<div class="col-md-6">
						<label for="valor_unitario_neto">Valor Unitario Neto:</label>
						<input type="text" class="form-control" name="valor_unitario_neto" id="valor_unitario_neto" disabled />
					</div>

					<div class="col-md-6">
						<label for="indiviso_terrenos">Indiviso (%):</label>
						<input type="text" class="form-control" name="indiviso_terrenos" id="indiviso_terrenos" value="{{$indiviso_terreno}}" disabled />
					</div>
					<div class="col-md-6">
						<label for="valor_parcial_terrenos">Valor Parcial:</label>
						<input type="text" class="form-control" name="valor_parcial_terrenos" id="valor_parcial_terrenos" disabled />
					</div>
				</div>
				<hr>
				<div style="text-align: center;" id="messagesModalFormAefTerrenos"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="reset" class="btn btn-default">Limpiar</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalFormAefConstrucciones" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAefConstruccionesTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('storeAefConstrucciones'), 'id'=>'formAefConstrucciones', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAefConstrucciones" id="ctrlAefConstrucciones" value="" />
			<input type="hidden" name="idavaluoenfoquefisico2" id="idavaluoenfoquefisico2" value="{{$row->idavaluoenfoquefisico}}" />
			<input type="hidden" name="idaefconstruccion" id="idaefconstruccion" value="0" />
			<input type="hidden" name="diferencia_construccion" id="diferencia_construccion" value="{{number_format($diferencia_construccion, 2, ".", "")}}" />

			<div class="modal-body">
				<div class="row">
					<div class="col-md-3">
						<label for="idtipo">Tipo:</label>
						<select class="form-control" id="idtipo" name="idtipo">
							@foreach ($cat_tipo as $item)
							@if( $item == $row->idtipo)
							<option value="{{$item->idtipo}}" selected>{{$item->tipo}}</option>
							@else
							<option value="{{$item->idtipo}}">{{$item->tipo}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<div class="col-md-2">
						<label for="edad_construcciones">Edad:</label>
						<input type="number" class="form-control clsNumeric" name="edad_construcciones" id="edad_construcciones" min="0" max="999" step="1" valu="0" required />
					</div>
					<div class="col-md-2">
						<label for="superficie_construccion">Superficie Total:</label>
						<input type="text" class="form-control clsNumeric" name="superficie_construccion" id="superficie_construccion" value="{{$superficie_construccion}}" disabled />
					</div>
					<div class="col-md-2">
						<label for="subtotal_construccion">Subtotal:</label>
						<input type="text" class="form-control clsNumeric" name="subtotal_construccion" id="subtotal_construccion" value="{{number_format($subtotal_construccion, 2, ".", "")}}" disabled />
					</div>
					<div class="col-md-3">
						<label for="superficie_m2_construcciones">Superficie M&sup2:</label>
						<input type="number" class="form-control clsNumeric" name="superficie_m2_construcciones" id="superficie_m2_construcciones" min="0.01" max="0.01" step="0.01" value="0.01" required />
					</div>
				</div>
<br />
				<div class="row">
					<div class="col-md-3">
						<label for="valor_nuevo_construcciones">V. R. Nuevo:</label>
						<input type="number" class="form-control clsNumeric" name="valor_nuevo_construcciones" id="valor_nuevo_construcciones" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-3">
						<label for="factor_edad_construcciones">Factor Edad:</label>
						<input type="number" class="form-control clsNumeric" name="factor_edad_construcciones" id="factor_edad_construcciones" min="0.00" max="1.00" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-3">
						<label for="idfactorconservacion">Factor Conservación:</label>
						<select class="form-control" id="idfactorconservacion" name="idfactorconservacion">
							@foreach ($cat_factores_conservacion as $item)
							<option value="{{$item->idfactorconservacion}}" valor_factor="{{$item->valor_factor_conservacion}}">{{$item->factor_conservacion .' ['.$item->valor_factor_conservacion.']'}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="factor_conservacion_construcciones">&nbsp;</label>
						<input type="number" class="form-control clsNumeric" name="factor_conservacion_construcciones" id="factor_conservacion_construcciones" min="0.0000" max="1.0000" step="0.0001" value="0.0000" required />
					</div>
				</div>
<br />
				<div class="row">
					<div class="col-md-4">
						<label for="factor_resultante_construcciones">Factor Resultante:</label>
						<input type="text" class="form-control" name="factor_resultante_construcciones" id="factor_resultante_construcciones" disabled />
					</div>
					<div class="col-md-4">
						<label for="valor_neto_construccion">Valor Resultante Neto:</label>
						<input type="text" class="form-control" name="valor_neto_construccion" id="valor_neto_construccion" disabled />
					</div>
					<div class="col-md-4">
						<label for="valor_parcial_construccion">Valor Parcial:</label>
						<input type="text" class="form-control" name="valor_parcial_construccion" id="valor_parcial_construccion" disabled />
					</div>
				</div>
				<hr>
				<div style="text-align: center;" id="messagesModalFormAefConstrucciones"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalFormAefCondominios" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAefCondominiosTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('storeAefCondominios'), 'id'=>'formAefCondominios', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAefCondominios" id="ctrlAefCondominios" value="" />
			<input type="hidden" name="idavaluoenfoquefisico3" id="idavaluoenfoquefisico3" value="{{$row->idavaluoenfoquefisico}}" />
			<input type="hidden" name="idaefcondominio" id="idaefcondominio" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<label for="descripcion">Descripción:</label>
						<input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="200" required />
					</div>
					<div class="col-md-4">
						<label for="unidad">Unidad:</label>
						<input type="text" class="form-control" name="unidad" id="unidad" maxlength="10" required />
					</div>
					<div class="col-md-4">
						<label for="cantidad_condominios">Cantidad:</label>
						<input type="number" class="form-control clsNumeric" name="cantidad_condominios" id="cantidad_condominios" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>

					<div class="col-md-4">
						<label for="valor_nuevo_condominios">V. R. Nuevo:</label>
						<input type="number" class="form-control clsNumeric" name="valor_nuevo_condominios" id="valor_nuevo_condominios" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="vida_remanente">Vida Útil:</label>
						<input type="number" class="form-control clsNumeric" name="vida_remanente" id="vida_remanente" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="edad_condominios">Edad Efectiva de la Construcción:</label>
						<input type="text" class="form-control clsNumeric edad" name="edad_condominios" id="edad_condominios" required />
					</div>

					<div class="col-md-4">
						<label for="factor_edad_condominios">Factor Edad:</label>
						<input type="number" class="form-control" name="factor_edad_condominios" id="factor_edad_condominios"  min="0.00" max="99999999.99" step="0.01" value="0.00" required  />
					</div>
					<div class="col-md-4">
						<label for="factor_conservacion_condominios">Factor Conservación:</label>
						<input type="number" class="form-control clsNumeric" name="factor_conservacion_condominios" id="factor_conservacion_condominios" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="factor_resultante_condominios">Factor Resultante:</label>
						<input type="text" class="form-control" name="factor_resultante_condominios" id="factor_resultante_condominios" disabled />
					</div>

					<div class="col-md-6">
						<label for="indiviso_condominios">Indiviso (%):</label>
						<input type="number" class="form-control" name="indiviso_condominios" id="indiviso_condominios" min="0.00" max="99999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-6">
						<label for="valor_parcial_condominios">Valor Parcial:</label>
						<input type="text" class="form-control" name="valor_parcial_condominios" id="valor_parcial_condominios" disabled />
					</div>
				</div>
				<div style="text-align: center;" id="messagesModalFormAefCondominios"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="reset" class="btn btn-default">Limpiar</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg" id="modalFormAefInstalaciones" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAefInstalacionesTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('storeAefInstalaciones'), 'id'=>'formAefInstalaciones', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAefInstalaciones" id="ctrlAefInstalaciones" value="" />
			<input type="hidden" name="idavaluoenfoquefisico4" id="idavaluoenfoquefisico4" value="{{$row->idavaluoenfoquefisico}}" />
			<input type="hidden" name="idaefinstalacion" id="idaefinstalacion" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<label for="idobracomplementaria">Descripción:</label>
						<select class="form-control" id="idobracomplementaria" name="idobracomplementaria">
							@foreach ($cat_obras_complementarias as $item)
							<option value="{{$item->idobracomplementaria}}">{{$item->obra_complementaria}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-4">
						<label for="cantidad_instalaciones">Cantidad:</label>
						<input type="number" class="form-control clsNumeric" name="cantidad_instalaciones" id="cantidad_instalaciones" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="unidad_instalaciones">Unidad:</label>
						<input type="text"class="form-control" name="unidad_instalaciones" id="unidad_instalaciones" value="" maxlength="10" required />
					</div>

					<div class="col-md-4">
						<label for="valor_nuevo_instalaciones">V. R. Nuevo:</label>
						<input type="number" class="form-control clsNumeric" name="valor_nuevo_instalaciones" id="valor_nuevo_instalaciones" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="vida_util_instalaciones">Vida Útil:</label>
						<input type="number" class="form-control clsNumeric" name="vida_util_instalaciones" id="vida_util_instalaciones" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="edad_instalaciones">Edad:</label>
						<input type="text" class="form-control clsNumeric edad" name="edad_instalaciones" id="edad_instalaciones" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>

					<div class="col-md-4">
						<label for="factor_edad_instalaciones">Factor Edad:</label>
						<input type="number"class="form-control" name="factor_edad_instalaciones" id="factor_edad_instalaciones"  min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="factor_conservacion_instalaciones">Factor Conservación:</label>
						<input type="number" class="form-control clsNumeric" name="factor_conservacion_instalaciones" id="factor_conservacion_instalaciones" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-4">
						<label for="factor_resultante_instalaciones">Factor Resultante:</label>
						<input type="text" class="form-control" name="factor_resultante_instalaciones" id="factor_resultante_instalaciones" disabled />
					</div>

					<div class="col-md-6">
						<label for="valor_neto_instalaciones">V. N. Rep.:</label>
						<input type="text" class="form-control" name="valor_neto_instalaciones" id="valor_neto_instalaciones" disabled />
					</div>
					<div class="col-md-6">
						<label for="valor_parcial_instalaciones">Valor Parcial:</label>
						<input type="text" class="form-control" name="valor_parcial_instalaciones" id="valor_parcial_instalaciones" disabled />
					</div>
				</div>
				<div style="text-align: center;" id="messagesModalFormAefInstalaciones"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="reset" class="btn btn-default">Limpiar</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>

@section('javascript')
{{ HTML::script('/js/jquery/jquery.min.js') }}
{{ HTML::script('/js/jquery/jquery.mask.min.js') }}
{{ HTML::script('/js/jquery/jquery-ui.js') }}
{{ HTML::script('/js/bootstrap.min.js') }}
{{ HTML::script('/js/jquery/jquery.dataTables.min.js') }}
{{ HTML::script('/js/jquery/dataTables.bootstrap.js') }}
{{ HTML::script('/js/fileinput.min.js') }}
{{ HTML::script('/js/fileinput_locale_es.js') }}
{{ HTML::script('/js/jquery.corevat.js') }}
{{ HTML::script('/js/jquery.corevat.fisico.js') }}
@stop
