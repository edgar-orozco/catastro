<h3 class="header">{{$title}}</h3>
<hr>
{{Form::model($row, ['route' => array('updateAvaluoEnfoqueMercado', $idavaluo), 'method'=>'post', 'id'=>'formAvaluoMercado' ]) }}
{{Form::hidden('idavaluoenfoquemercado', $row->idavaluoenfoquemercado, ['id'=>'idavaluoenfoquemercado'])}}
<div class="row">
	<div class="col-md-12"><h2>Venta de Terrenos</h2></div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-10 col-sm-10 col-xs-10"><h4>Investigación de Terrenos Comparables</h4></div>
	<div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
		<a class="btn btn-primary nuevo" id="btnNewAemComp" title="Nuevo Registro">
			<span class="glyphicon glyphicon-plus-sign"></span> Nuevo
		</a>
	</div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemCompTerrenosDataTable">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>UBICACIÓN</th>
					<th>PRECIO</th>
					<th>SUP. TERRENO</th>
					<th>P.U. M&sup2;</th>
					<th>OBSERVACIÓN</th>
					<th style="width:5%;">OPCIONES</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h3>Homologación del Terreno en función del lote tipo o predominante en la zona...</h3></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemHomologacionDataTable">
			<thead>
				<tr>
					<th rowspan="2" style="width: 5px;">#</th>
					<th rowspan="2" style="width: 5px;">ID</th>
					<th rowspan="2">COMPARABLE</th>
					<th rowspan="2">SUP.</th>
					<th rowspan="2">Valor Unitario</th>
					<th colspan="5">Factores de homologación</th>
					<th colspan="2">Valor unitario</th>
					<th rowspan="2" style="width: 5px;">OPCIONES</th>
				</tr>
				<tr>
					<th>ZONA</th>
					<th>UBICACIÓN</th>
					<th>FRENTE</th>
					<th>FORMA</th>
					<th>SUPERFICIE</th>
					<th>Negociación</th>
					<th>Resultante ($/m&sup2;)</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="6">&nbsp;</td>
					<td class="bg-primary" colspan="4" style="text-align: right;">Valor Unitario Promedio ($/m&sup2;)</td>
					<td class="bg-info" colspan="2" id="valor_unitario_promedio" style="text-align: right; font-size: 18px; font-weight: bold;">{{number_format($row->valor_unitario_promedio, 2, '.', ',' )}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-primary" colspan="6">&nbsp;</td>
					<td class="bg-primary" colspan="4" style="text-align: right;">Valor Aplicado por M&sup2;</td>
					<td class="bg-info" colspan="2" id="valor_aplicado_m2" style="text-align: right; font-size: 2.5em; font-weight: bold;">{{number_format($row->valor_aplicado_m2, 2, '.', ',' )}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h2>Venta de Inmuebles</h2></div>
	<div class="col-md-12">&nbsp;</div>
    <div class="col-md-10 col-sm-10 col-xs-10"><h4>Venta de inmuebles similares en uso al que se valua(sujeto)</h4></div>
    <div class="col-md-2 col-sm-2 col-xs-2 btn-beside-title">
        <a class="btn btn-primary nuevo" id="btnNewAemInf" title="Nuevo Registro">
            <span class="glyphicon glyphicon-plus-sign"></span> Nuevo
        </a>
    </div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemInformacionDataTable">
			<thead>
				<tr>
					<th colspan="6"></th>
					<th colspan="2">OPCIONES</th>
				</tr>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>UBICACIÓN</th>
					<th>EDAD</th>
					<th>TELÉFONO</th>
					<th>OBSERVACIONES</th>
					<th style="width:5%;"></th>
					<th style="width:5%;"></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>

	<div class="col-md-12"><h3>Análisis por Homologación de Mercado</h3></div>
	<div class="col-md-12">
		<table cellpadding="0" cellspacing="0" border="0" class="table datatable table-striped" id="aemAnalisisDataTable">
			<thead>
				<tr>
					<th>#</th>
					<th>ID</th>
					<th>PRECIO</th>
					<th>SUP. TERR.</th>
					<th>SUP. CONS.</th>
					<th>V.U. ($/m&sup2;)</th>
					<th>ZONA</th>
					<th>UBIC.</th>
					<th>F. SUP.</th>
					<th>F. EDAD</th>
					<th>F. CONS.</th>
					<th>F. NEGA.</th>
					<th>F. FR.</th>
					<th>RESULT. ($/m&sup2;</th>
					<th>&nbsp;</th>
			</thead>
			<tbody>
			</tbody>
			<tfoot>
				<tr>
					<td class="bg-primary" colspan="8">&nbsp;</td>
					<td class="bg-primary" colspan="5" style="text-align: right;">Promedio:</td>
					<td class="bg-info" id="promedio_analisis" style="text-align: right; font-weight: bold;">{{number_format($row->promedio_analisis, 2, '.', ',' )}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-primary" colspan="8">&nbsp;</td>
					<td class="bg-primary" colspan="5" style="text-align: right;">Superficie Construida del Sujeto:</td>
					<td class="bg-info" id="superficie_construida" style="text-align: right; font-weight: bold;">{{number_format($row->superficie_construida, 2, '.', ',' )}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
				<tr>
					<td class="bg-primary" colspan="8">&nbsp;</td>
					<td class="bg-primary" colspan="5" style="text-align: right;">Valor comparativo de mercado:</td>
					<td class="bg-info" id="valor_comparativo_mercado" style="text-align: right; font-weight: bold;">{{number_format($row->valor_comparativo_mercado, 2, '.', ',' )}}</td>
					<td class="bg-primary">&nbsp;</td>
				</tr>
			</tfoot>
		</table>
	</div>
	<div class="col-md-12">&nbsp;</div>
	<div class="col-md-12 form-actions">
		<a href="{{URL::route('indexAvaluos')}}" class="btn btn-primary" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
	</div>

</div>
{{Form::close()}}

<div class="modal fade bs-example-modal-lg" id="modalFormAemCompTerrenos" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAemCompTerrenosTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('setAemCompTerrenos'), 'id'=>'formAemCompTerrenos', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAemCompTerrenos" id="ctrlAemCompTerrenos" value="" />
			<input type="hidden" name="idavaluoenfoquemercado1" id="idavaluoenfoquemercado1" value="{{$row->idavaluoenfoquemercado}}" />
			<input type="hidden" name="idaemcompterreno" id="idaemcompterreno" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label for="ubicacion_aemcompterreno">Ubicación:</label>
						<input type="text" class="form-control" name="ubicacion_aemcompterreno" id="ubicacion_aemcompterreno" maxlength="200" required />
					</div>
					<div class="col-md-6">
						<label for="precio">Precio de oferta:</label>'
						<input type="number" class="form-control clsNumeric" name="precio" id="precio" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-6">
						<label for="superficie_terreno_aemcompterreno">Superficie del Terreno:</label>
						<input type="number" class="form-control clsNumeric" name="superficie_terreno_aemcompterreno" id="superficie_terreno_aemcompterreno" min="0.00" max="9999999999.99" step="0.01" value="0.00" required />
					</div>
					<div class="col-md-6">
						<label for="precio_unitario_m2_terreno">Precio Unitario M&sup2; Terreno:</label>
						<input type="text" class="form-control" name="precio_unitario_m2_terreno" id="precio_unitario_m2_terreno" disabled />
					</div>
					<div class="col-md-6">
						<label for="observaciones_aemcompterreno">Fuentes:</label>
						<input type="text" class="form-control" name="observaciones_aemcompterreno" id="observaciones_aemcompterreno" maxlength="200" required />
					</div>
				</div>
				<div style="text-align: center;" id="messagesModalFormAemCompTerrenos"></div>
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

<div class="modal fade bs-example-modal-lg" id="modalFormAemHomologacion" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAemHomologacionTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('setAemHomologacion'), 'id'=>'formAemHomologacion', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAemHomologacion" id="ctrlAemHomologacion" value="" />
			<input type="hidden" name="idavaluoenfoquemercado2" id="idavaluoenfoquemercado2" value="{{$row->idavaluoenfoquemercado}}" />
			<input type="hidden" name="idaemhomologacion" id="idaemhomologacion" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<label for="comparable">Comparable:</label>
						<input type="text" class="form-control" name="comparable" id="comparable" disabled />
					</div>
					<div class="col-md-4">
						<label for="superficie_terreno_aemhomologacion">Superficie del Terreno:</label>
						<input type="text" class="form-control" name="superficie_terreno_aemhomologacion" id="superficie_terreno_aemhomologacion" disabled />
					</div>
					<div class="col-md-4">
						<label for="valor_unitario">Valor Unitario:</label>
						<input type="text" class="form-control" name="valor_unitario" id="valor_unitario"  disabled />
					</div>

					<div class="col-md-3">
						<label for="idfactorzona_aemhomologacion">Zona:</label>
						<select class="form-control" id="idfactorzona_aemhomologacion" name="idfactorzona_aemhomologacion" required >
							@foreach ($cat_factores_zonas as $item)
							<option value="{{$item->idfactorzona}}" min="{{$item->valor_minimo}}" max="{{$item->valor_maximo}}">{{$item->factor_zona .' ['.$item->valor_minimo.'-'.$item->valor_maximo.']'}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="zona_aemhomologacion">Factor Zona:</label>
						<input type="number" class="form-control clsNumeric" name="zona_aemhomologacion" id="zona_aemhomologacion" min="0.00" max="9999999999.99" step="0.01" required />
					</div>
					<div class="col-md-3">
						<label for="idfactorubicacion_aemhomologacion">Ubicación:</label>
						<select class="form-control" id="idfactorubicacion_aemhomologacion" name="idfactorubicacion_aemhomologacion">
							@foreach ($cat_factores_ubicacion as $item)
							<option value="{{$item->idfactorubicacion}}" min="{{$item->valor_minimo}}" max="{{$item->valor_maximo}}">{{$item->factor_ubicacion .' ['.$item->valor_minimo.'-'.$item->valor_maximo.']'}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="ubicacion_aemhomologacion">Factor Ubicación:</label>
						<input type="number" class="form-control clsNumeric" name="ubicacion_aemhomologacion" id="ubicacion_aemhomologacion" min="0.00" max="9999999999.99" step="0.01" required />
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
						<input type="number" class="form-control" name="frente" id="frente" min="0.00" max="9999999999.99" step="0.01" required />
					</div>
					<div class="col-md-3">
						<label for="idfactorforma">Forma:</label>
						<select class="form-control" id="idfactorforma" name="idfactorforma">
							@foreach ($cat_factores_forma as $item)
							<option value="{{$item->idfactorforma}}">{{$item->factor_forma}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="forma">Factor Forma:</label>
						<input type="number" class="form-control clsNumeric" name="forma" id="forma" min="0.00" max="9999999999.99" step="0.01" required />
					</div>

					<div class="col-md-4">
						<label for="superficie_aemhomologacion">Superficie:</label>
						<input type="text" class="form-control" name="superficie_aemhomologacion" id="superficie_aemhomologacion" disabled />
					</div>
					<div class="col-md-6">
						<label for="valor_unitario_negociable">Negociación:</label>
						<input type="number" class="form-control clsNumeric" name="valor_unitario_negociable" id="valor_unitario_negociable" min="0.00" max="1.00" step="0.01" required />
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<label for="valor_unitario_resultante_m2_aemhomologacion">Resultante ($/m&sup2;):</label>
						<input type="text"class="form-control" name="valor_unitario_resultante_m2_aemhomologacion" id="valor_unitario_resultante_m2_aemhomologacion" disabled />
					</div>
					<div class="col-md-4 col-md-offset-2 checkbox-inline" style="padding-top: 2em;">
						<input type="checkbox" style="width:10px !important;"  name="in_promedio_aemhomologacion" id="in_promedio_aemhomologacion" />
						<label for="in_promedio_aemhomologacion">Interviene en el Promedio</label>
					</div>
				</div>
				<div style="text-align: center;" id="messagesModalFormAemHomologacion"></div>
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

<div class="modal fade bs-example-modal-lg" id="modalFormAemInformacion" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAemInformacionTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('setAemInformacion'), 'id'=>'formAemInformacion', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAemInformacion" id="ctrlAemInformacion" value="" />
			<input type="hidden" name="idavaluoenfoquemercado3" id="idavaluoenfoquemercado3" value="{{$row->idavaluoenfoquemercado}}" />
			<input type="hidden" name="idaeminformacion" id="idaeminformacion" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label for="ubicacion_aeminformacion">Ubicacion:</label>
						<input type="text" class="form-control" name="ubicacion_aeminformacion" id="ubicacion_aeminformacion" maxlength="200" required />
					</div>
					<div class="col-md-6">
						<label for="edad">Edad:</label>
						<input type="number" class="form-control clsNumeric" name="edad" id="edad" min="0" max="99" step="1" required />
					</div>
					<div class="col-md-6">
						<label for="telefono">Teléfono:</label>
						<input type="text"class="form-control" name="telefono" id="telefono" maxlength="100" required />
					</div>
					<div class="col-md-12">
						<label for="observaciones_aeminformacion">Fuentes:</label>
						<input type="text"class="form-control" name="observaciones_aeminformacion" id="observaciones_aeminformacion" maxlength="100" required />
					</div>
				</div>
				<div style="text-align: center;" id="messagesModalFormAemInformacion"></div>
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

<div class="modal fade bs-example-modal-lg" id="modalFormAemAnalisis" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modalFormAemAnalisisTitle"></h4>
			</div>
			{{Form::model($row, ['route' => array('setAemAnalisis'), 'id'=>'formAemAnalisis', 'method'=>'post' ]) }}
			<input type="hidden" name="ctrlAemAnalisis" id="ctrlAemAnalisis" value="" />
			<input type="hidden" name="idavaluoenfoquemercado4" id="idavaluoenfoquemercado4" value="{{$row->idavaluoenfoquemercado}}" />
			<input type="hidden" name="idaemanalisis" id="idaemanalisis" value="0" />
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label for="precio_venta">Precio de Venta:</label>
						<input type="number" class="form-control clsNumeric" name="precio_venta" id="precio_venta" min="0.00" max="9999999999999.99" step="0.01" required />
					</div>
					<div class="col-md-6">
						<label for="superficie_terreno_aemanalisis">Superficie del Terreno:</label>
						<input type="number" class="form-control clsNumeric" name="superficie_terreno_aemanalisis" id="superficie_terreno_aemanalisis" min="0.00" max="9999999999999.99" step="0.01" required />
					</div>
					
					<div class="col-md-6">
						<label for="superficie_construccion_aemanalisis">Superficie de la Construcción:</label>
						<input type="number" class="form-control clsNumeric" name="superficie_construccion_aemanalisis" id="superficie_construccion_aemanalisis" min="0.00" max="9999999999999.99" step="0.01" required />
					</div>
					<div class="col-md-6">
						<label for="valor_unitario_m2_aemanalisis">Valor Unitario ($/m&sup2;):</label>
						<input type="text" class="form-control" name="valor_unitario_m2_aemanalisis" id="valor_unitario_m2_aemanalisis" disabled />
					</div>
					
					<div class="col-md-3">
						<label for="idfactorzona_aemanalisis">Zona:</label>
						<select class="form-control" name="idfactorzona_aemanalisis" id="idfactorzona_aemanalisis">
							@foreach ($cat_factores_zonas as $item)
							<option value="{{$item->idfactorzona}}" min="{{$item->valor_minimo}}" max="{{$item->valor_maximo}}">{{$item->factor_zona .' ['.$item->valor_minimo.'-'.$item->valor_maximo.']'}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="factor_zona">Factor Zona:</label>
						<input type="number" class="form-control clsNumeric" name="factor_zona" id="factor_zona" min="0.00" max="9999999.99" step="0.01" required />
					</div>
					<div class="col-md-3">
						<label for="idfactorubicacion_aemanalisis">Ubicación:</label>
						<select class="form-control" id="idfactorubicacion_aemanalisis" name="idfactorubicacion_aemanalisis">
							@foreach ($cat_factores_ubicacion as $item)
							<option value="{{$item->idfactorubicacion}}" min="{{$item->valor_minimo}}" max="{{$item->valor_maximo}}">{{$item->factor_ubicacion .' ['.$item->valor_minimo.'-'.$item->valor_maximo.']'}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="factor_ubicacion">Factor Ubicación</label>
						<input type="number" class="form-control clsNumeric" name="factor_ubicacion" id="factor_ubicacion" min="0.00" max="9999999.99" step="0.01" required />
					</div>

					<div class="col-md-6">
						<label for="factor_superficie">Factor Superficie:</label>
						<input type="text" class="form-control" name="factor_superficie" id="factor_superficie" disabled />
					</div>
					<div class="col-md-6">
						<label for="factor_edad">Factor Edad:</label>
						<input type="number" class="form-control integer3" name="factor_edad" id="factor_edad" min="0.00" max="9999999.99" step="0.01" required />
					</div>

					<div class="col-md-3">
						<label for="idfactorconservacion">Conservación:</label>
						<select class="form-control" name="idfactorconservacion" id="idfactorconservacion">
							@foreach ($cat_factores_conservacion as $item)
							<option value="{{$item->idfactorconservacion}}">{{$item->factor_conservacion . ' [' . $item->valor_factor_conservacion . ']'}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<label for="factor_conservacion">Factor Conservación:</label>
						<input type="number" class="form-control clsNumeric" name="factor_conservacion" id="factor_conservacion" min="0.00" max="9999999.99" step="0.01" required />
					</div>
					<div class="col-md-6">
						<label for="factor_negociacion">Negociación:</label>
						<input type="number" class="form-control clsNumeric" name="factor_negociacion" id="factor_negociacion" min="0.00" max="9999999.99" step="0.01" required />
					</div>

					<div class="col-md-6">
						<label for="factor_resultante">Factor Resultante:</label>
						<input type="text" class="form-control" name="factor_resultante" id="factor_resultante" disabled />
					</div>
					<div class="col-md-6">
						<label for="valor_unitario_resultante_m2_aemanalisis">Resultante ($/m&sup2;):</label>
						<input type="text" class="form-control" name="valor_unitario_resultante_m2_aemanalisis" id="valor_unitario_resultante_m2_aemanalisis" disabled />
					</div>
					<div class="col-md-10 col-md-offset-1 checkbox-inline" style="margin-top: 1.5em;">
						<input type="checkbox" style="width:10px !important;" name="in_promedio_aemanalisis" id="in_promedio_aemanalisis" />
						<label for="in_promedio_aemanalisis">Interviene en el Promedio:</label>
					</div>
				</div>
				<div style="text-align: center;" id="messagesModalFormAemAnalisis"></div>
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
{{ HTML::script('/js/jquery.corevat.mercado.js') }}
@stop
