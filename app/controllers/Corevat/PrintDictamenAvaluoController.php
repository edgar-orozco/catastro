<?php

use Carbon\Carbon;

class corevat_PrintDictamenAvaluoController extends \BaseController {

	protected $avaluo;

	public function __construct(Avaluos $avaluo) {
		$this->avaluo = $avaluo;
	}

	private function printAvaluosHeader($pdf, $nFont, $perito, $municipio) {
		$pdf->AddPage();
		$pdf->Image(public_path() . "/css/images/corevat/crv-01.jpg", 5, 5, 139.57, 26.20);
		$pdf->Ln(25);
		$pdf->setX(5);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(57, $nFont, utf8_decode("H. AYUNTAMIENTO DE: "), '', 0, 'L');
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(70, $nFont, utf8_decode(strtoupper( $municipio )), '', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(57, $nFont, utf8_decode("DIRECCION DE FINANZAS"), '', 1, 'L');
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Ln(2.5);
		$pdf->setX(5);
		$pdf->SetFillColor(164, 164, 164);
		if (!Auth::user()->hasRole("Perito Valuador")) {
			$pdf->Cell(269, 8, utf8_decode('Listado General de Avaluos'), 'TLBR', 1, 'C', 1);
		} else {
			$pdf->Cell(269, 8, utf8_decode('Listado de los últimos avaluos de ' . $perito->nombre . ' ' . $perito->apepat . ' ' . $perito->apemat), 'TLBR', 1, 'C', 1);
		}
	}

	private function printAvaluosHeaderColumns($pdf, $nFont) {
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(35, $nFont, utf8_decode("FOLIO"), 'LB', 0, 'L', 1);
		$pdf->Cell(20, $nFont, utf8_decode("FECHA"), 'LB', 0, 'C', 1);
		$pdf->Cell(46, $nFont, utf8_decode("SOLICITANTE"), 'LB', 0, 'L', 1);
		$pdf->Cell(66, $nFont, utf8_decode("UBICACIÓN"), 'LB', 0, 'L', 1);
		$pdf->Cell(15, $nFont, utf8_decode("PREDIAL"), 'LB', 0, 'L', 1);
		$pdf->Cell(20, $nFont, utf8_decode("TERRENO"), 'LB', 0, 'R', 1);
		$pdf->Cell(20, $nFont, utf8_decode("CONSTRUC."), 'LB', 0, 'R', 1);
		$pdf->Cell(22, $nFont, utf8_decode("CATASTRAL"), 'LB', 0, 'L', 1);
		$pdf->Cell(25, $nFont, utf8_decode("V. CONCLUIDO"), 'LBR', 1, 'L', 1);
	}

	private function printAvaluosRow($pdf, $nFont, $row) {
		$pdf->SetFont('Arial','',7);
		$pdf->setX(5);
		$pdf->Cell(35, $nFont, utf8_decode($row->foliocoretemp), 'LB', 0, 'L', 0);
		$pdf->Cell(20, $nFont, utf8_decode($row->cfecha_avaluo), 'LB', 0, 'C', 0);
		$pdf->Cell(46, $nFont, utf8_decode( trim($row->titulo_solicitante) . " " . $row->nombre_solicitante), 'LB', 0, 'L', 0);
		$pdf->Cell(66, $nFont, utf8_decode(substr(trim($row->ubicacion), 0, 50)), 'LB', 0, 'L', 0);
		$pdf->Cell(15, $nFont, utf8_decode($row->cuenta_predial), 'LB', 0, 'L', 0);
		$pdf->Cell(20, $nFont, number_format($row->superficie_terreno, 2, '.', ','), 'LB', 0, 'R', 0);
		$pdf->Cell(20, $nFont, number_format($row->superficie_construccion, 2, '.', ','), 'LB', 0, 'R', 0);
		$pdf->Cell(22, $nFont, utf8_decode($row->cuenta_catastral), 'LB', 0, 'L', 0);
		$pdf->Cell(25, $nFont, number_format($row->valor_concluido, 2, '.', ','), 'LBR', 1, 'R', 0);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function printAvaluosByValuador($id) {
		$perito = User::find(Auth::Id());
		// PARCHE: $pdf->nFont
		$nFont = 6;

		if (Auth::user()->hasRole("Perito Valuador")) {
			$rows = Avaluos::select("avaluos.*", 'municipios.municipio', 'avaluo_inmueble.superficie_terreno', 'avaluo_inmueble.superficie_construccion', 'avaluo_conclusiones.valor_concluido', 'usuarios.nombres', 'usuarios.apellidos')
					->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
					->leftJoin('avaluo_inmueble', 'avaluos.idavaluo', '=', 'avaluo_inmueble.idavaluo')
					->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
					->leftJoin('usuarios', 'avaluos.iduser', '=', 'usuarios.iduser')
					->orderBy('usuarios.nombres', 'asc')
					->orderBy('usuarios.apellidos', 'asc')
					->orderBy('avaluos.idmunicipio', 'asc')
					->orderBy('avaluos.idavaluo', 'desc')
					->where('avaluos.iduser', Auth::id())
					->get();
		} else {
			$rows = Avaluos::select("avaluos.*", 'municipios.municipio', 'avaluo_inmueble.superficie_terreno', 'avaluo_inmueble.superficie_construccion', 'avaluo_conclusiones.valor_concluido', 'usuarios.nombres', 'usuarios.apellidos')
					->leftJoin('municipios', 'avaluos.idmunicipio', '=', 'municipios.idmunicipio')
					->leftJoin('avaluo_inmueble', 'avaluos.idavaluo', '=', 'avaluo_inmueble.idavaluo')
					->leftJoin('avaluo_conclusiones', 'avaluos.idavaluo', '=', 'avaluo_conclusiones.idavaluo')
					->leftJoin('usuarios', 'avaluos.iduser', '=', 'usuarios.iduser')
					->orderBy('usuarios.nombres', 'asc')
					->orderBy('usuarios.apellidos', 'asc')
					->orderBy('avaluos.idmunicipio', 'asc')
					->orderBy('avaluos.idavaluo', 'desc')
					->get();
		}
		
		$pdf = new Fpdf('L', 'mm', 'Letter');
		$pdf->AliasNbPages();
		$pdf->SetFillColor(64, 64, 64);

		//$pdf->SetFont('Arial', '', 7);
		$line = $countRow = 0;
		$pagina = 0;
		$idmunicipio = 0;
		$idperito = 0;

		foreach ($rows as $row) {
			if ( $idmunicipio != $row->idmunicipio ) {
				$idmunicipio = $row->idmunicipio;
				$this->printAvaluosHeader($pdf, $nFont, $perito, $row->municipio);
				$this->printAvaluosHeaderColumns($pdf, $nFont);
				$line = 0;
			} else if ( $line == 0 ) {
				$this->printAvaluosHeader($pdf, $nFont, $perito, $row->municipio);
				$this->printAvaluosHeaderColumns($pdf, $nFont);
			}
			$this->printAvaluosRow($pdf, $nFont, $row);
			++$line;
			++$countRow;

			if ( $line == 20 ) {
				$line = 0;
			}
		}
		
		$pdf->setX(5);
		$pdf->Cell(244, $nFont, utf8_decode("TOTAL DE REGISTROS: "), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, $nFont, $countRow, 'TLBR', 1, 'R', 1);

		$pdf->Output();
		exit;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 * 
	 */
	public function printAvaluo($id) {
		require 'NumberToLetterConverter.php';
		$nFont = 6;
		$pagina = 0;
		$rs = Avaluos::getAvaluo($id);
		$pdf = new Fpdf('P', 'mm', 'Letter');
		$pdf->AliasNbPages();
		$pdf->SetFillColor(64, 64, 64);

		$pdf->AddPage();
		$pdf->Image(public_path() . "/css/images/corevat/crv-01.jpg", 5, 5, 139.57, 26.20);

		if ($rs->foto != "") {
			$userfoto = explode(".", $rs->foto);
			$foto = public_path() . '/corevat/files/' . $userfoto[0] . '-big.' . $userfoto[1];
			if (!file_exists($foto)) {
				$foto = public_path() . "/css/images/corevat/user-big.jpg";
			}
		} else {
			$foto = public_path() . "/css/images/corevat/user-big.jpg";
		}
		$pdf->Image($foto, 180, 5, 30.50, 26.56);
		$pdf->Ln(25);

		$pdf->setX(5);

		//*********************************************************
		//ENCABEZADO
		//*********************************************************
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(57, $nFont, utf8_decode("H. AYUNTAMIENTO DE: "), '', 0, 'L');
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(70, $nFont, utf8_decode(strtoupper($rs->municipio)), '', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 14);
		$pdf->Cell(57, $nFont, utf8_decode("DIRECCION DE FINANZAS"), '', 1, 'L');
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Ln(2.5);
		$pdf->setX(5);
		$pdf->Cell(206, 8, utf8_decode('A V A L Ú O'), 'TLBR', 1, 'C', 0);

		//*********************************************************
		//DATOS DEL VALUADOR
		//*********************************************************
		$pdf->Ln(10);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Ln(2);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, 'DATOS DEL VALUADOR', 'TLBR', 1, 'C', 1);

		// Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Fecha del Avalúo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, Carbon::parse($rs->fecha_avaluo)->formatLocalized("%d de %B de %Y"), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(86, $nFont, utf8_decode("Avalúo Número: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->foliocoretemp, 'LBR', 1, 'L'); // folio_format
		// Línea 2
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Nombre del Valuador: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, utf8_decode($rs->apellidos) . ' ' . utf8_decode($rs->nombres), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(86, $nFont, utf8_decode("Cédula Profesional del Valuador: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->cedulaprofesional, 'LBR', 1, 'L');
		// Línea 3
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Registro Estatal: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->registro, 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(86, $nFont, utf8_decode("Registro Colegio: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, $nFont, $rs->registro_colegio, 'LBR', 1, 'L');

		// /* *********************************************************
		// ** INFORMACION GENERAL DEL INMUEBLE
		// ** ********************************************************* */
		$pdf->Ln(10);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Ln(2);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, 'INFORMACION GENERAL DEL INMUEBLE', 'TLBR', 1, 'C', 1);

		// Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Propósito: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(63, $nFont, utf8_decode($rs->proposito), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(15, $nFont, utf8_decode("Finalidad: "), 'B', 0, 'L');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(102, $nFont, utf8_decode($rs->finalidad), 'LBR', 1, 'L');

		// Línea 2
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Tipo de Inmueble: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(36, $nFont, utf8_decode($rs->tipo_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(15, $nFont, utf8_decode("Ubicación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(129, $nFont, utf8_decode($rs->ubicacion), 'LBR', 1, 'L');

		// Línea 3
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Nombre del Conjunto: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26, $nFont, utf8_decode($rs->conjunto), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(15, $nFont, utf8_decode("Colonia: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(114, $nFont, utf8_decode($rs->colonia), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(10, $nFont, utf8_decode("CP: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(15, $nFont, utf8_decode($rs->cp), 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Municipio: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(83, $nFont, utf8_decode($rs->municipio), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Entidad Federativo: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(71, $nFont, utf8_decode($rs->estado), 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Coordenads Geo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(6, $nFont, '', 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(31.666666667, $nFont, utf8_decode("Longitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.666666667, $nFont, utf8_decode($rs->longitud), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(31.666666667, $nFont, utf8_decode("Latitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.666666667, $nFont, utf8_decode($rs->latitud), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30.666666667, $nFont, utf8_decode("Altitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.666666667, $nFont, utf8_decode($rs->altitud), 'LBR', 1, 'L');

		// Línea 5
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Regimen de Propiedad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(74, $nFont, utf8_decode($rs->regimen_propiedad), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Cuenta Predial: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(20, $nFont, utf8_decode($rs->cuenta_predial), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(33.3, $nFont, utf8_decode("Cuenta Catastral: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(26.7, $nFont, utf8_decode($rs->cuenta_catastral), 'LBR', 1, 'L');

		// Línea 6
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(26, $nFont, utf8_decode("Nombre del Solicitante: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(53, $nFont, utf8_decode(trim($rs->titulo_solicitante) . " " . $rs->nombre_solicitante), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(20, $nFont, utf8_decode("Propietario: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(107, $nFont, utf8_decode(trim($rs->titulo_propietario) . " " . $rs->nombre_propietario), 'LBR', 1, 'L');

		// /* *********************************************************
		// ** 3. CARACTERÍSTICAS  DE LA ZON7
		// ** ********************************************************* */
		$pdf->Ln(10);

		$zn = AvaluosZona::getAvaluosZonaByFk($id);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Ln(2);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CARACTERÍSTICAS  DE LA ZONA'), 'TLBR', 1, 'C', 1);

		// Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont * 2, utf8_decode("Servicios municipales: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Agua Potable: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_agua_potable == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Drenaje: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_drenaje == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Electrificación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_electricidad == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Pavimientación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_pavimentacion == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Alumbrado Público: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_alumbrado_publico == 1 ? 'X' : '', 'LBR', 1, 'L');

		// Línea 2
		$pdf->setX(45);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Guarniciones: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_guarniciones == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Banqueta: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_banqueta == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Teléfono: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_telefono == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Transporte Urbano: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_transporte_publico == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Otros: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_otro_servicio == 1 ? 'X' : '', 'LBR', 1, 'L');

		// Línea 3
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont * 3, utf8_decode("Equipamiento urbano: "), 'LBR', 0, 'R');

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(166, $nFont, utf8_decode($zn->cobertura), 'BR', 1, 'L');

		$pdf->setX(45);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Escuela: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_escuela == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Banco: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_banco == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Hospital: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_hospital == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Transporte: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_transporte == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Mercado: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_mercado == 1 ? 'X' : '', 'LBR', 1, 'L');

		$pdf->setX(45);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Iglesia: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_iglesia == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Comercio: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_comercio == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Parques: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_parque == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Gasolinera: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_gasolinera == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Otros: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(3.2, $nFont, $zn->is_otro_equipamiento = 1 ? 'X' : '', 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Nivel de Equiamiento: "), 'LBR', 0, 'R');

		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(10, $nFont, utf8_decode($zn->nivel_equipamiento) . '%', 'BR', 0, 'R');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Clasificacion de la Zona: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(49.6, $nFont, $zn->clasificacion_zona, 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(50, $nFont, utf8_decode("Referencia proximidad urbana: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(16.4, $nFont, $zn->proximidad_urbana, 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 40, $nFont * 3, false);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->MultiCell(40, 3.60, utf8_decode("\nConstrucciones Predominantes:"), '', 'R');

		$pdf->setY($yL);
		$pdf->Rect(45, $yL, 166, $nFont * 3, false);

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(166, 3.60, utf8_decode($zn->construc_predominante), '', 'L');

		$pdf->setX(5);
		$pdf->setY($yL + $nFont * 3);

		// Línea 4
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 40, $nFont * 3, false);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->MultiCell(40, 3.60, utf8_decode("\nVías de acceso e importancia:"), '', 'R');

		$pdf->setY($yL);
		$pdf->Rect(45, $yL, 166, $nFont * 3, false);

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(166, 3.60, utf8_decode($zn->vias_acceso_importante), '', 'L');

		$pdf->setX(5);

		// /* *********************************************************
		// ** 4. CARACTERISTICAS DEL INMUEBLE
		// ** ********************************************************* */
		$in = AvaluosInmueble::getAvaluoInmuebleByIdForPdf($id);
		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CARACTERISTÍCAS DEL INMUEBLE (1 de 2)'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(10);
		$pdf->setX(5);
		$pdf->Cell(89, $nFont, utf8_decode('C R O Q U I S'), 'TLBR', 0, 'C', 0);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(89, $nFont, utf8_decode('F A C H A D A'), 'TLBR', 1, 'C', 0);

		if ($in->croquis != "") {
			$fc = explode('.', $in->croquis);
			$archivo = public_path() . '/corevat/files/' . $in->croquis;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 5, 32, 89.0, 65.40);
			} else {
				$archivo = public_path() . '/corevat/files/' . $in->croquis;
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 5, 32, 89.0, 65.40);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 32, 89.0, 65.40);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 32, 89.0, 65.40);
		}

		if ($in->fachada != "") {
			$fc = explode('.', $in->fachada);
			$archivo = public_path() . '/corevat/files/' . $in->fachada;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 122, 32, 89.0, 65.40);
			} else {
				// public_path() . 
				$archivo = public_path() . '/corevat/files/' . $in->fachada;
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 122, 32, 89.0, 65.40);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
		}

		// Línea 1
		$pdf->Ln(75);
		
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('A) MEDIDAS Y COLINDANCIAS'), 'TLBR', 1, 'L', 0);
		
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('Según: ' . $in->segun), 'TLBR', 1, 'L', 0);
		
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFont('Arial', '', 6);
		$rstMedCol = AiMedidasColindancias::getOrientacionFromMedCol($in->idavaluoinmueble);
		foreach ($rstMedCol as $medcol) {
			$pdf->setX(5);
			$pdf->SetFont('Arial', 'B', 6);
			$pdf->Cell(20, $nFont, utf8_decode($medcol->orientacion), 'BL', 0, 'L', 0);
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(56, $nFont, utf8_decode($medcol->medida), 'BL', 0, 'L', 0);
			$pdf->Cell(130, $nFont, utf8_decode($medcol->colindancia), 'BLR', 1, 'L', 0);
		}

		// Línea 2
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Ln(10);
		$pdf->setX(5);

		if ($pdf->GetY() > 194) {
			$pdf->AddPage();
		}

		$pdf->Cell(206, $nFont, utf8_decode('B) CARACTERÍSTICAS DE LA CONSTRUCCIÓN ' . $pdf->GetY()), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Cimentación: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->cimentacion), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Estructuras: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->estructura), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Muros: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->muros), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Entrepisos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->entrepisos), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Techos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->techos), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(30, $nFont, utf8_decode("Bardas: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(176, $nFont, utf8_decode($in->bardas), 'LBR', 1, 'L');

		// Línea 3
		$pdf->Ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30, $nFont, utf8_decode("Uso de suelo: "), 'TLB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(53, $nFont, utf8_decode($in->usos_suelos), 'TLB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(25, $nFont, utf8_decode("Serv. y Restric.: "), 'TB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(98, $nFont, substr(utf8_decode($in->servidumbre_restricciones), 0, 81), 'TLBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30, $nFont, utf8_decode("Núm niveles de la Unidad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(63, $nFont, utf8_decode($in->nivel), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(30, $nFont, utf8_decode("Unidades rentables en la misma estructura: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(83, $nFont, utf8_decode($in->unidades_rentables_escritura), 'LBR', 1, 'L');

		// Línea 4
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 30, $nFont * 3, false);

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->MultiCell(30, 3.60, utf8_decode("\nDescripcion General del Inmueble:"), '', 'R');

		$pdf->setY($yL);
		$pdf->Rect(35, $yL, 176, $nFont * 3, false);

		$pdf->setX(45);
		$pdf->SetFont('Arial', '', 6);
		$pdf->MultiCell(166, 3.60, utf8_decode($in->descripcion_inmueble), '', 'L');

		// Línea 5
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CARACTERÍSTICAS DEL INMUEBLE (2 de 2)'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(10);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('C) ACABADOS'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode(""), 'LB', 0, 'R');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("PISOS"), 'LB', 0, 'C');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("MUROS"), 'LB', 0, 'C');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("PLAFONES"), 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Recámaras"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->recamaras0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->recamaras1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->recamaras2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Estancia Comedor"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estancia_comedor0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estancia_comedor1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estancia_comedor2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Baños"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->banos0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->banos1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->banos2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Escaleras"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->escaleras0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->escaleras1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->escaleras2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Cocina"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->cocina0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->cocina1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->cocina2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Patio de Servicio"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->patio_servicio0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->patio_servicio1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->patio_servicio2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Estacionamiento"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estacionamiento0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estacionamiento1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->estacionamiento2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Fachada"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->fachada0, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->fachada1, 0, 42)), 'LB', 0, 'L');
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->fachada2, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Hidráulico Sanitarias"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->hidraulico_sanitarias, 0, 42)), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode("Eléctricas"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(55.3333333333333333333, $nFont, utf8_decode(substr($in->electricas, 0, 42)), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Carpintería: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(166, $nFont, utf8_decode($in->carpinteria), 'LBR', 1, 'L');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, $nFont, utf8_decode("Herrería: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(166, $nFont, utf8_decode($in->herreria), 'LBR', 1, 'L');

		$pdf->ln(10);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('D) SUPERFICIES'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie Total del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_total_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Individo del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->indiviso_terreno) . ' %', 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Individo de Áreas Comunes"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->indiviso_areas_comunes) . ' %', 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie de Construcción"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_construccion) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Individo Accesoría"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->indiviso_accesoria) . ' %', 'LBR', 1, 'C');
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, $nFont, utf8_decode("Superficie Asentada en Escritura"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_escritura) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(75.3333333333333333333, $nFont, utf8_decode("Superficie Vendible"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(35.3333333333333333333, $nFont, utf8_decode($in->superficie_vendible) . ' m2', 'LBR', 1, 'C');

		// ** *******************************************************
		// ** 5. ENFOQUE DE MERCADO
		// ** *******************************************************
		$fm = Avaluos::find($id)->AvaluosMercado;

		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('ENFOQUE DE MERCADO'), 'TLBR', 1, 'C', 1);

		//Comparables de terrenos (aem_comp_terrenos)
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('A) VENTA DE TERRENOS'), 'BLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Cell(6, $nFont, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(90, $nFont, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'L', 1);
		$pdf->Cell(20, $nFont, utf8_decode('Precio Oferta'), 'BL', 0, 'R', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Sup. Terr.'), 'BL', 0, 'R', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Sup. Const.'), 'BL', 0, 'L', 1);
		$pdf->Cell(15, $nFont, utf8_decode('P. U./m2'), 'BL', 0, 'L', 1);
		$pdf->Cell(45, $nFont, utf8_decode('Fuente/ Antecedente/ Teléfono'), 'BLR', 1, 'L', 1);

		$rst = AemCompTerrenos::getAemCompTerrenosByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rst as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(90, $nFont, utf8_decode(substr($fila->ubicacion, 0, 80)), 'BL', 0, 'L', 0);
			$pdf->Cell(20, $nFont, number_format($fila->precio, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->superficie_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->superficie_construida, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->precio_unitario_m2_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->observaciones, 0, 29)), 'BLR', 1, 'L', 0);
		}

		$pdf->ln(10);

		//Homologación (aem_homologacion)
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(206, $nFont, utf8_decode(strtoupper('Homologación del Terreno en función del lote tipo o predominante en la zona, en caso de no existir este, en función del lote valuado')), 'TBLR', 1, 'L', 0);

		$pdf->setX(5);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Cell(6, $nFont * 2, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(102, $nFont * 2, utf8_decode('Comparable:'), 'BL', 0, 'C', 1);
		$pdf->Cell(6, $nFont * 2, utf8_decode('Sup'), 'BL', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('Valor unit'), 'BL', 0, 'C', 1);

		$pdf->setX(139);
		$pdf->Cell(50, $nFont, utf8_decode('Factores de Eficiencia'), 'BL', 0, 'C', 1);
		$pdf->Cell(22, $nFont, utf8_decode('Valor Unitario'), 'BLR', 1, 'C', 1);

		$pdf->setX(139);
		$pdf->Cell(10, $nFont, utf8_decode('Zona'), 'BL', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Ubic.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Fte.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Fma.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Sup.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(11, $nFont, utf8_decode('Neg.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(11, $nFont, utf8_decode('Rte. m2'), 'BLR', 1, 'R', 1);

		$rowsAemCompTerrenos = AemCompTerrenos::getAemHomologacionByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemCompTerrenos as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(102, $nFont, utf8_decode($fila->comparable), 'BL', 0, 'L', 0);
			$pdf->Cell(6, $nFont, '', 'BL', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_unitario, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, $nFont, number_format($fila->zona, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, $nFont, number_format($fila->ubicacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, $nFont, number_format($fila->frente, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, $nFont, number_format($fila->forma, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, $nFont, number_format($fila->superficie, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(11, $nFont, number_format($fila->valor_unitario_negociable, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(11, $nFont, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(184, $nFont, utf8_decode('Valor Unitario Promedio ($/m²)'), 'L', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(22, $nFont, number_format($fm->valor_unitario_promedio, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(184, $nFont, utf8_decode('Valor aplicado por m²'), 'BL', 0, 'R', 0);
		$pdf->Cell(22, $nFont, number_format($fm->valor_aplicado_m2, 2, '.', ','), 'BLR', 1, 'R', 0);

		//Información (aem_informacion)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(206, $nFont, utf8_decode('B) VENTA DE INMUEBLES SIMILARES EN USO AL QUE SE VALUA (sujeto)'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Cell(6, $nFont, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(130, $nFont, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'L', 1);
		$pdf->Cell(10, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(17, $nFont, utf8_decode('Teléfono'), 'BL', 0, 'L', 1);
		$pdf->Cell(43, $nFont, utf8_decode('Fuente/ Antecedentes'), 'BLR', 1, 'L', 1);

		$rowsAemInformacion = AemInformacion::getAemInformacionByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(130, $nFont, utf8_decode($fila->ubicacion), 'BL', 0, 'L', 0);
			$pdf->Cell(10, $nFont, utf8_decode($fila->edad), 'BL', 0, 'C', 0);
			$pdf->Cell(17, $nFont, utf8_decode($fila->telefono), 'BL', 0, 'L', 0);
			$pdf->Cell(43, $nFont, utf8_decode($fila->observaciones), 'BLR', 1, 'L', 0);
		}

		//Analisis (aem_analisis)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(206, $nFont, utf8_decode('Análisis por homologación'), 'TBLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(208, 208, 208);

		$pdf->Cell(6, $nFont, utf8_decode(''), 'LR', 0, 'L', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Precio de Venta'), 'BL', 0, 'C', 1);
		$pdf->Cell(29, $nFont, utf8_decode('Superficie m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(23, $nFont, utf8_decode('Valor unitario'), 'BL', 0, 'C', 1);
		$pdf->Cell(98, $nFont, utf8_decode('Factores de Homologación'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Valor unitario'), 'BLR', 1, 'C', 1);
		$pdf->setX(5);
		$pdf->Cell(6, $nFont, utf8_decode('No'), 'BLR', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Inmuebles Sim'), 'BL', 0, 'C', 1);
		$pdf->Cell(14.5, $nFont, utf8_decode('Terreno'), 'BL', 0, 'C', 1);
		$pdf->Cell(14.5, $nFont, utf8_decode('Construc.'), 'BL', 0, 'C', 1);
		$pdf->Cell(23, $nFont, utf8_decode('$/m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Zona'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Ubic'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Sup'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Neg'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Fr'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Resultante ($/m²)'), 'BLR', 1, 'C', 1);

		$rowsAemInformacion = AemInformacion::getAemAnalisisByFk($fm->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(25, $nFont, number_format($fila->precio_venta, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14.5, $nFont, number_format($fila->superficie_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14.5, $nFont, number_format($fila->superficie_construccion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(23, $nFont, number_format($fila->valor_unitario_m2, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_zona, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_ubicacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_superficie, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_negociacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor promedio:'), 'L', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($fm->promedio_analisis, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Superficie Construida del Sujeto:'), 'BL', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($fm->superficie_construida, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->Ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor comparativo de mercado:'), 'TBL', 0, 'R', 0);
		$pdf->SetFillColor(246, 229, 115);
		$pdf->Cell(25, $nFont, number_format($fm->valor_comparativo_mercado, 2, '.', ','), 'TBLR', 1, 'R', 1);

		//*********************************************************
		// ** 6. ANALISIS FISICO
		//*********************************************************
		$ff = AvaluosFisico::getAvaluoFisicoByFk($id);
		$pdf->AddPage();

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('ANÁLISIS FÍSICO'), 'TLBR', 1, 'C', 1);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('A) TERRENO'), 'BLR', 1, 'L', 0);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);

		// Analisis (aef_terrenos)
		$pdf->Cell(29, $nFont * 2, utf8_decode('Fracción'), 'LB', 0, 'L', 1);
		$pdf->Cell(29, $nFont * 2, utf8_decode('Superficie m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(84, $nFont, utf8_decode('Factores de Eficiencia'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('V. R. Neto'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Indiviso'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Valor'), 'LR', 1, 'C', 1);
		$pdf->setX(63);
		$pdf->Cell(14, $nFont, utf8_decode('Irre'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Top'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Frente'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Forma'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Otros'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Fr'), 'BL', 0, 'C', 1);
		$pdf->setX(186);
		$pdf->Cell(25, $nFont, utf8_decode('Resultante ($/m²)'), 'BLR', 1, 'C', 1);

		$rowsAefTerrenos = AefTerrenos::AefTerrenosByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAefTerrenos as $fila) {
			$pdf->setX(5);
			$pdf->Cell(29, $nFont, utf8_decode($fila->fraccion), 'LB', 0, 'L', 0);
			$pdf->Cell(29, $nFont, number_format($fila->superficie, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->irregular, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->top, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->frente, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->forma, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->otros, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_unitario_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->indiviso, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor del Terreno:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->valor_terreno, 2, '.', ','), 'BLR', 1, 'R', 0);

		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(206, $nFont, utf8_decode('B) CONSTRUCCIONES'), 'TBLR', 1, 'L', 0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('CLASIFICACIÓN DE LAS CONSTRUCCIONES'), 'BLR', 1, 'C', 0);

		//Línea 1
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, $nFont, utf8_decode("Clase General: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(20, $nFont, utf8_decode($ff->clase_general_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(10, $nFont, utf8_decode("Tipo "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(30, $nFont, utf8_decode($ff->tipo_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, $nFont, utf8_decode("Estado Conservación "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(51, $nFont, utf8_decode($ff->estado_conservacion), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, $nFont, utf8_decode("Calidad del Proyecto"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(15, $nFont, utf8_decode($ff->calidad_proyecto), 'LBR', 1, 'L');

		//Línea 2
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, $nFont, utf8_decode("Edad de las construcciones (Años): "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->edad_construccion), 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, $nFont, utf8_decode("Vida Útil Remanente "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->vida_util), 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(38, $nFont, utf8_decode("Número de niveles: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->numero_niveles), 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(48, $nFont, utf8_decode("Nivel en edificio (condominio):"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($ff->nivel_edificio_condominio), 'LBR', 1, 'C');

		//Analisis (_viAEF_Construcciones)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(50, $nFont * 2, utf8_decode('Tipo de Construcción'), 'TLB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Edad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('Superficie m²'), 'TBL', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('V.R. Nuevo'), 'TBL', 0, 'C', 1);

		$pdf->Cell(42, $nFont, utf8_decode('Factores'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont * 2, utf8_decode('V. U. Neto'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'TLR', 1, 'C', 1);

		$pdf->setX(119);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(186);
		$pdf->Cell(25, $nFont, utf8_decode('Construcciones'), 'BLR', 1, 'C', 1);

		$rowsAefConstrucciones = AefConstrucciones::AefConstruccionesByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAefConstrucciones as $fila) {
			$pdf->setX(5);
			$pdf->Cell(6, $nFont, ++$lID, 'LB', 0, 'L', 0);
			$pdf->Cell(44, $nFont, utf8_decode($fila->tipo), 'LB', 0, 'L', 0);
			$pdf->Cell(14, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->superficie_m2, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial_construccion, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(64, $nFont, utf8_decode('Total Superficie m²:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->total_metros_construccion, 2, '.', ','), 'BLR', 0, 'R', 0);
		$pdf->setX(94);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(92, $nFont, utf8_decode('Valor de las construcciones:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->valor_construccion, 2, '.', ','), 'BLR', 1, 'R', 0);

		//Analisis (aef_condominios)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(206, $nFont, utf8_decode('C1)  COMUNES, INSTALACIONES ESPECIALES Y OBRAS COMPLEMENTARIAS (SOLO EN CONDOMINIOS)'), 'TBLR', 1, 'L', 0);

		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(45, $nFont * 2, utf8_decode('Descripción'), 'TLB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Unidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont * 2, utf8_decode('Cantidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('V.R. Nuevo'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Vida'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Edad'), 'TBL', 0, 'C', 1);

		$pdf->Cell(42, $nFont, utf8_decode('Factores'), 'TBL', 0, 'C', 1);

		$pdf->Cell(15, $nFont * 2, utf8_decode('Indiviso'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'TLR', 1, 'C', 1);

		$pdf->setX(99);
		$pdf->Cell(15, $nFont, utf8_decode('Remte'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Años'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(186);
		$pdf->Cell(25, $nFont, utf8_decode('Áreas Comunes'), 'BLR', 1, 'C', 1);
		$rowsAefCondominios = AefCondominios::AefCondominiosByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		foreach ($rowsAefCondominios as $fila) {
			$pdf->setX(5);
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->descripcion, 0, 47)), 'LB', 0, 'L', 0);
			$pdf->SetFont('Arial', '', 7);
			$pdf->Cell(14, $nFont, utf8_decode($fila->unidad), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->cantidad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->vida_remanente, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->indiviso, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Subtotal Áreas Comunes:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->subtotal_area_condominio, 2, '.', ','), 'BLR', 1, 'R', 0);

		// Analisis (aef_instalaciones)
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(206, $nFont, utf8_decode('C2)  PRIVATIVAS, INSTALACIONES ESPECIALES Y OBRAS COMPLEMENTARIAS'), 'TBLR', 1, 'L', 0);

		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(45, $nFont * 2, utf8_decode('Descripción'), 'TLB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Unidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont * 2, utf8_decode('Cantidad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('V.R. Nuevo'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Vida Util'), 'TBL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Edad'), 'TBL', 0, 'C', 1);

		$pdf->Cell(42, $nFont, utf8_decode('Factores'), 'TBL', 0, 'C', 1);

		$pdf->Cell(15, $nFont, utf8_decode('V. Neto'), 'TL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'TLR', 1, 'C', 1);

		$pdf->setX(99);
		$pdf->Cell(15, $nFont, utf8_decode('Total'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Años'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(171);
		$pdf->Cell(15, $nFont, utf8_decode('Rep.'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Elem. Adic.'), 'BLR', 1, 'C', 1);

		$rowsAefInstalaciones = AefInstalaciones::AefInstalacionesByFk($ff->idavaluoenfoquefisico);
		$lID = 0;
		foreach ($rowsAefInstalaciones as $fila) {
			$pdf->setX(5);
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->descripcion, 0, 47)), 'LB', 0, 'L', 0);
			$pdf->SetFont('Arial', '', 7);
			$pdf->Cell(14, $nFont, utf8_decode($fila->unidad), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->cantidad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->vida_util, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->valor_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Subtotal Instalaciones Especiales:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($ff->subtotal_instalaciones_especiales, 2, '.', ','), 'BLR', 1, 'R', 0);

		/*
		  Analisis (aef_instalaciones)
		 */
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, $nFont, utf8_decode('Valor Físico Total:'), 'TBL', 0, 'R', 0);
		$pdf->SetFillColor(246, 229, 115);
		$pdf->Cell(25, $nFont, number_format($ff->total_valor_fisico, 2, '.', ','), 'TBLR', 1, 'R', 1);

		// *********************************************************
		// ** 7. CONCLUSIONES
		// *********************************************************
		$pdf->AddPage();
		$nFont = 12;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, 'CONCLUSIONES', 'TLBR', 1, 'C', 1);

		$cl = Avaluos::find($id)->AvaluosConclusiones;
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->Cell(100, $nFont * 2, 'RESUMEN DE VALORES', 'TL', 0, 'C', 0);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(60, $nFont, utf8_decode('Valor Comparativo de Mercado:'), 'LT', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(46, $nFont, '$ ' . number_format($cl->valor_mercado, 2, '.', ','), 'TLR', 1, 'R', 0);
		$pdf->setX(105);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(60, $nFont, utf8_decode('Valor Físico:'), 'LT', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(46, $nFont, '$ ' . number_format($cl->valor_fisico, 2, '.', ','), 'TLR', 1, 'R', 0);

		// Descripcion de la conclusión
		$pdf->setX(5);
		$xL = $pdf->GetX();
		$yL = $pdf->GetY();
		$pdf->Rect($xL, $yL, 206, $nFont * 5, false);

		$pdf->ln(10);

		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 8);
		$pdf->MultiCell(206, 3.60, utf8_decode($cl->leyenda), '', 'L');

		$pdf->ln(24);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->SetFillColor(246, 229, 115);
		//$pdf->SetDrawColor(246,229,115);
		$pdf->SetLineWidth('0.5');
		$pdf->Cell(140, $nFont, utf8_decode('Importe del Valor Comercial:'), 'TBL', 0, 'R', 1);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(66, $nFont, '$ ' . number_format($cl->valor_concluido, 2, '.', ','), 'TBLR', 1, 'R', 1);

		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 9);
		$pdf->SetFillColor(208, 208, 208);
		//$pdf->SetDrawColor(246,229,115);
		$val0 = explode('.', $cl->valor_concluido);
		$toLetter = new NumberToLetterConverter();

		$pdf->Cell(206, $nFont, trim($toLetter->to_word($val0[0])) . ' PESOS ' . $val0[1] . '/100 M.N.', 'TBLR', 1, 'R', 1);

		$pdf->SetLineWidth('0');
		$pdf->ln(10);
		$pdf->setX(5);
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->SetFillColor(246, 229, 115);
		//$pdf->SetDrawColor(246,229,115);
		$pdf->SetLineWidth('0');
		$yL = $pdf->GetY();
		$pdf->SetFillColor(255, 255, 255);

		$pdf->SetFont('Arial', '', 9);
		$nFont = 6;
		$pdf->ln(30);
		$pdf->setX(5);
		$pdf->Cell(70, $nFont, utf8_decode(trim($rs->apellidos)) . ' ' . utf8_decode(trim($rs->nombres)), '', 1, 'C', 0);
		$pdf->setX(5);
		$pdf->Cell(70, $nFont, trim($rs->registro), '', 1, 'C', 0);

		$pdf->ln(20);
		$pdf->setX(5);
		$pdf->Cell(70, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(70, $nFont, 'FIRMA', '', 0, 'C', 0);
		$pdf->Cell(66, $nFont, 'SELLO', '', 1, 'C', 0);

		$pdf->Rect(5, $yL, 70, 70, false);
		$pdf->Rect(75, $yL, 70, 70, false);
		$pdf->Rect(145, $yL, 66, 70, false);

		// *********************************************************
		// ** 7. ANEXO FOTOGRÁFICO
		// *********************************************************
		$pdf->AddPage();
		$nFont = 10;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->setX(5);
		$pdf->Cell(206, $nFont, utf8_decode('ANEXO FOTOGRÁFICO'), 'TLBR', 1, 'C', 1);

		$ft = Avaluos::find($id)->AvaluosFotos;
		$pdf->Ln(0);
		$pdf->SetFont('Arial', '', 6);
		$pdf->setX(5);

		if ($ft->foto0 != "") {
			$fc = explode('.', $ft->foto0);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 5, 22, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 5, 22, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 122, 32, 89.0, 65.40);
		}

		if ($ft->foto1 != "") {
			$fc = explode('.', $ft->foto1);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 83, 22, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 83, 22, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 22, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 22, 50.0, 50);
		}

		if ($ft->foto2 != "") {
			$fc = explode('.', $ft->foto2);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 161, 22, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 161, 22, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 22, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 22, 50.0, 50);
		}

		$nFont = 6;
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Ln(52);
		$pdf->setX(5);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo0), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo1), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo2), 0, 54)), '', 1, 'C', 1);

		$pdf->Ln(50);
		$pdf->setX(5);

		if ($ft->foto3 != "") {
			$fc = explode('.', $ft->foto3);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 5, 82, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 5, 82, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 82, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 82, 50.0, 50);
		}

		if ($ft->foto4 != "") {
			$fc = explode('.', $ft->foto4);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 83, 82, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 83, 82, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 82, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 83, 82, 50.0, 50);
		}

		if ($ft->foto5 != "") {
			$fc = explode('.', $ft->foto5);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 161, 82, 50.0, 50);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 161, 82, 50.0, 50);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 82, 50.0, 50);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 161, 82, 50.0, 50);
		}

		$pdf->Ln(3);
		$pdf->setX(5);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo3), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo4), 0, 54)), '', 0, 'C', 1);
		$pdf->Cell(28, $nFont, '', '', 0, 'C', 0);
		$pdf->Cell(50, $nFont, utf8_decode(substr(trim($ft->ftitulo5), 0, 54)), '', 1, 'C', 1);

		$pdf->Ln(5);
		$pdf->setX(5);
		$nFont = 6;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(164, 164, 164);
		$pdf->Cell(206, $nFont, utf8_decode('PLANO'), 'TLBR', 1, 'C', 1);
		$pdf->Ln(2);

		if ($ft->plano0 != "") {
			$fc = explode('.', $ft->plano0);
			$archivo = public_path() . '/corevat/files/' . $fc[0] . '.' . $fc[1];
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 5, 150, 206.0, 103);
			} else {
				$archivo = public_path() . '/corevat/files/' . $fc[0] . '-big.' . $fc[1];
				if (file_exists($archivo)) {
					$pdf->Image($archivo, 5, 150, 206.0, 103);
				} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 150, 206.0, 103);
				}
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 5, 150, 206.0, 103);
		}

		$nFont = 6;
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Ln(103);
		$pdf->setX(5);
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(206, $nFont, utf8_decode(substr(trim($ft->ptitulo0), 0, 204)), '', 0, 'C', 1);

		$pdf->Output();
		exit;
	}

}
