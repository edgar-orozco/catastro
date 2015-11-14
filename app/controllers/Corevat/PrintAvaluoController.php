<?php

setlocale(LC_MONETARY, 'es_MX');

use Carbon\Carbon;

require('AvaluoPdf.php');
require 'NumberToLetterConverter.php';

class corevat_PrintAvaluoController extends \BaseController {
	
	public $page;
	
	public function printAvaluo($id) {
		$avaluo = Avaluos::getAvaluo($id);

		$pdf = new AvaluoPdf();

		$user = Auth::user();
		if ( $user->foto == '' ) {
			$pdf->logo_perito = public_path() . "/css/images/corevat/user-big-blank.jpg";
		} else {
			if ( file_exists(public_path() . '/logos/usuarios/' . $user->foto)  && is_file(public_path() . '/logos/usuarios/' . $user->foto) ) {
				$pdf->logo_perito = public_path() . '/logos/usuarios/' . $user->foto;
			} else {
				$pdf->logo_perito = public_path() . "/css/images/corevat/user-48.jpg";
			}
		}
		//$pdf->logo_perito = public_path() . "/logos/usuarios/". $user->foto;

		$pdf->AliasNbPages();
		$pdf->AddPage();
		$this->page = $pdf->page;
		
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 10, utf8_decode('A V A L Ú O'), 'TLBR', 1, 'C', 0);

		$this->avaluoPerito($pdf, $avaluo);

		$this->avaluoGeneral($pdf, $avaluo);

		$this->avaluoZona($pdf, $id);

		$pdf->AddPage();
		$this->page = $pdf->page;

		$this->avaluoInmueble($pdf, $id);

		$this->avaluoEnfoqueMercado($pdf, $id);

		$this->avaluoEnfoqueFisico($pdf, $id);

		$this->avaluoConclusion($pdf, $avaluo);
		
		$this->avaluoFotos($pdf, $id);

		$pdf->Output();
		exit;
	}

	private function avaluoPerito(&$pdf, $avaluo) {
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 8, utf8_decode('DATOS DEL VALUADOR'), 'TLBR', 1, 'C', 1);
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, 6, utf8_decode("Fecha del Avalúo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(46, 6, Carbon::parse($avaluo->fecha_avaluo)->formatLocalized("%d de %B de %Y"), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, 6, utf8_decode("Avalúo Número: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 6, $avaluo->foliocoretemp, 'LBR', 1, 'L', 0);
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, 6, utf8_decode("Nombre del Valuador: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(46, 6, utf8_decode($avaluo->apellidos) . ' ' . utf8_decode($avaluo->nombres), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, 6, utf8_decode("Cédula Profesional del Valuador: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 6, $avaluo->cedulaprofesional, 'LBR', 1, 'L');
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, 6, utf8_decode("Registro Estatal: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(46, 6, $avaluo->registro, 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, 6, utf8_decode("Registro Colegio: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 6, $avaluo->registro_colegio, 'LBR', 1, 'L');
		
	}

	private function avaluoGeneral(&$pdf, $avaluo) {
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 8, 'INFORMACION GENERAL DEL INMUEBLE', 'TLBR', 1, 'C', 1);
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Propósito: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(63, 5, utf8_decode($avaluo->proposito), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Finalidad: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(78, 5, utf8_decode($avaluo->finalidad), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Tipo de Inmueble: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($avaluo->tipo_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Ubicación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(96, 5, utf8_decode($avaluo->ubicacion), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Nombre del Conjunto: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(50, 5, utf8_decode($avaluo->conjunto=='' ? 'NO APLICA' : $avaluo->conjunto), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(15, 5, utf8_decode("Colonia: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(76, 5, utf8_decode($avaluo->colonia), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(10, 5, utf8_decode("CP: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(15, 5, utf8_decode($avaluo->cp), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Municipio: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(76, 5, utf8_decode($avaluo->municipio), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Entidad Federativo: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(60, 5, utf8_decode($avaluo->estado), 'LBR', 1, 'L');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Coordenads Geo: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(10, 5, '', 'B', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Longitud: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(27, 5, utf8_decode($avaluo->longitud), 'B', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Latitud: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(27, 5, utf8_decode($avaluo->latitud), 'B', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Altitud: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(27, 5, utf8_decode($avaluo->altitud), 'BR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Regimen de Propiedad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(40, 5, utf8_decode($avaluo->regimen_propiedad), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Cuenta Predial: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(33, 5, utf8_decode($avaluo->cuenta_predial), 'B', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Cuenta Catastral: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(38, 5, utf8_decode($avaluo->cuenta_catastral), 'BR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Nombre del Solicitante: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode(trim($avaluo->titulo_solicitante) . " " . $avaluo->nombre_solicitante), 'BR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Propietario: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode(trim($avaluo->titulo_propietario) . " " . $avaluo->nombre_propietario), 'BR', 1, 'L');
	}

	private function avaluoZona(&$pdf, $id) {
		$pdf->Ln(5);
		$zona = AvaluosZona::getAvaluosZonaByFk($id);
		
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 7, utf8_decode('CARACTERÍSTICAS DE LA ZONA'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(2);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(31, 15, utf8_decode("Servicios municipales: "), 'LRTB', 0, 'R');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Agua Potable: "), 'RBT', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_agua_potable == 1 ? 'X' : '', 'RBT', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Drenaje: "), 'RBT', 0, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_drenaje == 1 ? 'X' : '', 'RBT', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Electrificación: "), 'RBT', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_electricidad == 1 ? 'X' : '', 'RBT', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Pavimientación: "), 'RBT', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_pavimentacion == 1 ? 'X' : '', 'RBT', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Alumbrado Público: "), 'RBT', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_alumbrado_publico == 1 ? 'X' : '', 'RBT', 1, 'C');

		$pdf->setX(41);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Guarniciones: "), 'LRB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_guarniciones == 1 ? 'X' : '', 'RB', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Banqueta: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_banqueta == 1 ? 'X' : '', 'RB', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Teléfono: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_telefono == 1 ? 'X' : '', 'RB', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Transporte Urbano: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_transporte_publico == 1 ? 'X' : '', 'RB', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Recolección basura: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_recoleccion_basura == 1 ? 'X' : '', 'RB', 1, 'C');

		$pdf->setX(41);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Vigilancia privada: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_vigilancia_privada == 1 ? 'X' : '', 'BR', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Internet: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_internet == 1 ? 'X' : '', 'BR', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Otros: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_otro_servicio == 1 ? 'X' : '', 'BR', 0, 'C');
		$pdf->Cell(0, 5, $zona->otro_servicio_municipal == 1 ? 'X' : '', 'BR', 1, 'C');

		$pdf->Ln(2);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(31, 10, utf8_decode("Equipamiento urbano: "), 'LRTB', 0, 'R');

		$pdf->Cell(30, 5, utf8_decode("Escuela: "), 'RTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_escuela == 1 ? 'X' : '', 'RTB', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Iglesia: "), 'RTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_iglesia == 1 ? 'X' : '', 'RTB', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Banco: "), 'RTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_banco == 1 ? 'X' : '', 'RTB', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Comercio: "), 'RTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_comercio == 1 ? 'X' : '', 'RTB', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Hospital: "), 'RTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_hospital == 1 ? 'X' : '', 'RTB', 1, 'C');

		$pdf->setX(41);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Parque: "), 'LRB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_parque == 1 ? 'X' : '', 'RB', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Transporte: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_transporte == 1 ? 'X' : '', 'RB', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Gasolineria: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_gasolinera == 1 ? 'X' : '', 'RB', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Mercado: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_mercado == 1 ? 'X' : '', 'RB', 0, 'C');
		$pdf->Cell(33, 5, '', 'LBR', 1, 'R');


		$pdf->Ln(2);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("En un radio: "), 'LRBT', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(63, 5, utf8_decode($zona->cobertura) . ' metros', 'RBT', 0, 'L');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("Nivel de Equiamiento: "), 'RBT', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(63, 5, utf8_decode($zona->nivel_equipamiento) . '%', 'RBT', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("Clasificacion de la Zona: "), 'LRB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(63, 5, $zona->proximidad_urbana, 'RB', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("Proximidad Urbana: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(63, 5, $zona->clasificacion_zona, 'RB', 1, 'L');

		$pdf->Ln(2);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Construcciones Predominantes:"), 'LRTB', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(196, 3.5, utf8_decode($zona->construc_predominante=='' ? 'NO APLICA':$zona->construc_predominante), 'BLR', 'L');

		$pdf->Ln(2);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Vías de acceso e importancia:"), 'LBRT', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(196, 3.5, utf8_decode($zona->vias_acceso_importante=='' ? 'NO APLICA':$zona->vias_acceso_importante), 'BLR', 'L');

		$pdf->Ln(2);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Calles transversales limitrofes y orientación:"), 'LBRT', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(196, 3.5, utf8_decode($zona->calles_transversales=='' ? 'NO APLICA':$zona->calles_transversales), 'BLR', 'L');

	}
	
	private function avaluoInmueble(&$pdf, $idavaluo) {
		$in = AvaluosInmueble::getAvaluoInmuebleByIdForPdf($idavaluo);

		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 7, utf8_decode('CARACTERISTÍCAS DEL INMUEBLE (1 de 2)'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(1);
		$pdf->Cell(95, 6, utf8_decode('C R O Q U I S'), 'TLBR', 0, 'C', 1);
		$pdf->Cell(6, 6, '', '', 0, 'C', 0);
		$pdf->Cell(95, 6, utf8_decode('F A C H A D A'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(1);
		$ordenada = $pdf->GetY();
		
		if ($in->croquis != "") {
			$fc = explode('.', $in->croquis);
			$archivo = public_path() . '/corevat/files/' . $in->croquis;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, null, $ordenada, 95.0, 50);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 95.0, 50);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 95.0, 50);
		}

		if ($in->fachada != "") {
			$fc = explode('.', $in->fachada);
			$archivo = public_path() . '/corevat/files/' . $in->fachada;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 111, null, 95.0, 50);
			} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 101, $ordenada, 95.0, 50);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 101, $ordenada, 95.0, 50);
		}

		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 7, utf8_decode('A) MEDIDAS Y COLINDANCIAS'), 'TBLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode('Según: '), 'LBR', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(176, 5, utf8_decode($in->segun), 'LBR', 1, 'L', 0);

		$rstMedCol = AiMedidasColindancias::getOrientacionFromMedCol($in->idavaluoinmueble);

		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 5, utf8_decode('Detalles de Medidas y Colindancias'), 'TLR', 1, 'C', true);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode('Orientación'), 'TBL', 0, 'C', true);
		$pdf->Cell(30, 5, utf8_decode('U. M.'), 'TBL', 0, 'C', true);
		$pdf->Cell(30, 5, utf8_decode('Medidas'), 'TBL', 0, 'C', true);
		$pdf->Cell(106, 5, utf8_decode('Colindancias'), 'TLBR', 1, 'C', true);
		$i = 1;
		foreach ($rstMedCol as $medcol) {
			if ( $pdf->y > 258 ) {
				$pdf->SetFont('Arial', 'B', 7);
				$pdf->Cell(30, 5, utf8_decode('Orientación'. ','.$pdf->y), 'TLBR', 0, 'C', true);
				$pdf->Cell(30, 5, utf8_decode('U. M.'), 'TLBR', 0, 'C', true);
				$pdf->Cell(30, 5, utf8_decode('Medidas'), 'TLBR', 0, 'C', true);
				$pdf->Cell(106, 5, utf8_decode('Colindancias'), 'TLBR', 1, 'C', true);
			}
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(30, 5, utf8_decode($medcol->orientacion. ','.$pdf->y), 'BL', 0, 'L', 0);
			$pdf->Cell(30, 5, utf8_decode($medcol->unidad_medida), 'BL', 0, 'L', 0);
			$pdf->Cell(30, 5, utf8_decode($medcol->medidas), 'BL', 0, 'L', 0);
			$pdf->Cell(106, 5, utf8_decode($medcol->colindancia), 'BLR', 1, 'L', 0);
		}

		$pdf->Ln(3);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 7, utf8_decode('B) CARACTERÍSTICAS DE LA CONSTRUCCIÓN'), 'TBLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Cimentación: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode($in->cimentacion), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Estructuras: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode($in->estructura), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Muros: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode($in->muros), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Entrepisos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode($in->entrepisos), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Techos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode($in->techos), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Bardas: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode($in->bardas), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Uso de suelo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(166, 5, utf8_decode($in->usos_suelos), 'LBR', 1, 'L');

		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Servidumbres y Restricciones: "), 'TBRL', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(196, 3.5, utf8_decode($in->servidumbre_restricciones), 'BLR', 'L');


		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Niveles de la Unidad: "), 'LTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(50, 5, utf8_decode($in->nivel), 'LTB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Unidades rentables en la misma estructura: "), 'RTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(76, 5, utf8_decode($in->unidades_rentables_escritura), 'TBR', 1, 'L');

		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Descripcion General del Inmueble:"), 'LRTB', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(196, 3.5, utf8_decode($in->descripcion_inmueble), 'BLR', 'L');

		$pdf->Ln(3);

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 7, utf8_decode('C) ACABADOS'), 'TBLR', 1, 'L', 0);

		$rows = AiAcabados::select('ai_acabados.*', 'cat_acabados.nombre', 'cat_aplanados.aplanado', 'cat_pisos.piso', 'cat_plafones.plafon')
						->leftJoin('cat_acabados',  'ai_acabados.fk_cat_acabados',  '=', 'cat_acabados.id')
						->leftJoin('cat_aplanados', 'ai_acabados.fk_cat_aplanados', '=', 'cat_aplanados.idaplanado')
						->leftJoin('cat_pisos',     'ai_acabados.fk_cat_pisos',     '=', 'cat_pisos.idpiso')
						->leftJoin('cat_plafones',  'ai_acabados.fk_cat_plafones',  '=', 'cat_plafones.idplafon')
						->where('ai_acabados.idavaluoinmueble', '=', $in->idavaluoinmueble)
						->orderBy('ai_acabados.id')
						->get();
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 4, utf8_decode("Acabado"), 'TLB', 0, 'C', true);
		$pdf->Cell(50, 4, utf8_decode("Pisos"), 'TLB', 0, 'C', true);
		$pdf->Cell(50, 4, utf8_decode("Muros"), 'TLB', 0, 'C', true);
		$pdf->Cell(56, 4, utf8_decode("Plafones"), 'TLBR', 1, 'C', true);

		if ( count($rows) <= 0) {
			$pdf->SetFont('Arial', 'B', 7);
			$pdf->Cell(0, 5, utf8_decode('NO APLICA'), 'LRB', 1, 'L', false);
		} else {
			$pdf->SetFont('Arial', '', 7);
			foreach ($rows as $row) {
				$pdf->Cell(40, 4, utf8_decode($row['nombre']), 'LB', 0, 'L', false);
				$pdf->Cell(50, 4, utf8_decode($row['piso']), 'LB', 0, 'L', false);
				$pdf->Cell(50, 4, utf8_decode($row['aplanado']), 'LB', 0, 'L', false);
				$pdf->Cell(56, 4, utf8_decode($row['plafon']), 'LRB', 1, 'L', false);
			}
		}

		$pdf->ln(3);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 5, utf8_decode('OTROS DATOS'), 'TBLR', 1, 'L', false);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Hidráulico Sanitarias:"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(156, 5, utf8_decode($in->hidraulico_sanitarias), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Eléctricas:"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(156, 5, utf8_decode($in->electricas), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Carpintería:"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(156, 5, utf8_decode($in->carpinteria), 'LBR', 1, 'L');

		$pdf->Ln(1);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 10, utf8_decode("Herrería: "), 'LRTB', 0, 'R');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Ventanas: "), 'LRTB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(156, 5, $in->herreria_ventana, 'LRTB', 1, 'L');
		$pdf->setX(30);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Puertas: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(156, 5, $in->herreria_puerta, 'BR', 1, 'L');

		$pdf->Ln(1);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 10, utf8_decode("Aluminio: "), 'LRTB', 0, 'R');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Ventanas: "), 'TBR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(156, 5, $in->aluminio_ventana, 'TBR', 1, 'L');
		$pdf->setX(30);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Puertas: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(156, 5, $in->aluminio_puerta, 'BR', 1, 'L');

		$pdf->ln(3);

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 7, utf8_decode('D) SUPERFICIES'), 'TBLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie Total del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->superficie_total_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Individo del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->indiviso_terreno) . ' %', 'LBR', 1, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->superficie_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Individo de Áreas Comunes"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->indiviso_areas_comunes) . ' %', 'LBR', 1, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie de Construcción"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->superficie_construccion) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Individo Accesoría"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->indiviso_accesoria) . ' %', 'LBR', 1, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie Asentada en Escritura"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->superficie_escritura) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie Vendible"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(48, 5, utf8_decode($in->superficie_vendible) . ' m2', 'LBR', 1, 'C');
		
	}
	
	private function avaluoEnfoqueMercado(&$pdf, $idavaluo) {
		$mercado = Avaluos::find($idavaluo)->AvaluosMercado;
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 7, utf8_decode('ENFOQUE DE MERCADO'), 'TLBR', 1, 'C', 1);
		$this->aemCmpTerrenos($pdf, $mercado);
		$this->aemHomologacion($pdf, $mercado);
		$this->aemInformacion($pdf, $mercado);
		$this->aemAnalisis($pdf, $mercado);
	}

	private function aemCmpTerrenos(&$pdf, $mercado) {
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 7, utf8_decode('A) VENTA DE TERRENOS'), 'BLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(10, 5, utf8_decode('No.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(90, 5, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'C', 1);
		$pdf->Cell(20, 5, utf8_decode('Precio Oferta'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('Sup. Const.'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('P. U./m2'), 'BL', 0, 'C', 1);
		$pdf->Cell(46, 5, utf8_decode('Observaciones'), 'BLR', 1, 'C', 1);

		$rst = AemCompTerrenos::getAemCompTerrenosByFk($mercado->idavaluoenfoquemercado);
		$pdf->SetFont('Arial', '', 6);
		$lID = 0;
		foreach ($rst as $fila) {
			$pdf->Cell(10, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(90, 5, utf8_decode(substr($fila->ubicacion, 0, 80)), 'BL', 0, 'L', 0);
			$pdf->Cell(20, 5, number_format($fila->precio, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, 5, number_format($fila->superficie_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, 5, number_format($fila->precio_unitario_m2_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(46, 5, utf8_decode(substr($fila->observaciones, 0, 29)), 'BLR', 1, 'L', 0);
		}
	}
	
	private function aemHomologacion(&$pdf, $mercado) {
		$pdf->Ln(3);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 7, utf8_decode('Homologación del Terreno en función del lote tipo o predominante en la zona, en caso de no existir este, en función del lote valuado'), 'TBLR', 1, 'C', 0);

		$pdf->SetFont('Arial', 'B', 6);
		
		$pdf->Cell(6, 10, utf8_decode('No.'), 'LRB', 0, 'L', 1);
		$pdf->Cell(80, 10, utf8_decode('Comparable'), 'BL', 0, 'C', 1);
		
		$pdf->Cell(15, 5, utf8_decode('Superficie'), 'L', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('Valor Unitario'), 'L', 0, 'C', 1);

		$pdf->Cell(50, 5, utf8_decode('Factores de Eficiencia'), 'BL', 0, 'C', 1);
		$pdf->Cell(30, 5, utf8_decode('Valor'), 'BLR', 1, 'C', 1);

		$pdf->setX(96);
		$pdf->Cell(15, 5, utf8_decode('del terreno'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('Unitario'), 'BL', 0, 'C', 1);
		
		$pdf->Cell(10, 5, utf8_decode('Zona'), 'BL', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Ubic.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Fte.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Fma.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Sup.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('Negociable'), 'BLR', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('Rultante. m2'), 'BLR', 1, 'R', 1);

		$rowsAemCompTerrenos = AemCompTerrenos::getAemHomologacionByFk($mercado->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemCompTerrenos as $fila) {
			$pdf->Cell(6, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(80, 5, utf8_decode($fila->comparable), 'BL', 0, 'L', 0);
			$pdf->Cell(15, 5, $fila->superficie_terreno, 'BL', 0, 'R', 0);
			$pdf->Cell(15, 5, number_format($fila->valor_unitario, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, 5, number_format($fila->zona, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, 5, number_format($fila->ubicacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, 5, number_format($fila->frente, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, 5, number_format($fila->forma, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, 5, number_format($fila->superficie, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, 5, number_format($fila->valor_unitario_negociable, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, 5, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(166, 6, utf8_decode('Valor Unitario Promedio ($/m²)'), 'L', 0, 'R', 0);
		$pdf->Cell(30, 5, number_format($mercado->valor_unitario_promedio, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->Cell(166, 5, utf8_decode('Valor aplicado por m²'), 'BL', 0, 'R', 0);
		$pdf->Cell(30, 5, number_format($mercado->valor_aplicado_m2, 2, '.', ','), 'BLR', 1, 'R', 0);

	}

	private function aemInformacion(&$pdf, $mercado) {
		$pdf->ln(1);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 5, utf8_decode('B) VENTA DE INMUEBLES SIMILARES EN USO AL QUE SE VALUA (sujeto)'), 'TBLR', 1, 'L', 0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(6, 5, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(120, 5, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(17, 5, utf8_decode('Teléfono'), 'BL', 0, 'C', 1);
		$pdf->Cell(43, 5, utf8_decode('Fuente/ Antecedentes'), 'BLR', 1, 'C', 1);

		$rowsAemInformacion = AemInformacion::getAemInformacionByFk($mercado->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->Cell(6, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(120, 5, utf8_decode($fila->ubicacion), 'BL', 0, 'L', 0);
			$pdf->Cell(10, 5, utf8_decode($fila->edad), 'BL', 0, 'C', 0);
			$pdf->Cell(17, 5, utf8_decode($fila->telefono), 'BL', 0, 'L', 0);
			$pdf->Cell(43, 5, utf8_decode($fila->observaciones), 'BLR', 1, 'L', 0);
		}
	}

	private function aemAnalisis(&$pdf, $mercado) {
		$pdf->ln(3);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 7, utf8_decode('Análisis por homologación'), 'TBLR', 1, 'C', 0);

		$pdf->SetFont('Arial', 'B', 6);

		$pdf->Cell(6, 10, utf8_decode('No.'), 'LRB', 0, 'C', 1);
		$pdf->Cell(23, 5, utf8_decode('Precio de Venta'), 'BR', 0, 'C', 1);
		$pdf->Cell(48, 5, utf8_decode('Superficie m²'), 'BR', 0, 'C', 1);
		$pdf->Cell(24, 5, utf8_decode('Valor unitario'), 'BR', 0, 'C', 1);
		$pdf->Cell(70, 5, utf8_decode('Factores de Homologación'), 'BR', 0, 'C', 1);
		$pdf->Cell(25, 5, utf8_decode('Valor unitario'), 'BR', 1, 'C', 1);
		
		$pdf->setX(16);
		
		$pdf->Cell(23, 5, utf8_decode('Inmuebles Similares'), 'BR', 0, 'C', 1);
		$pdf->Cell(24, 5, utf8_decode('Terreno'), 'BR', 0, 'C', 1);
		$pdf->Cell(24, 5, utf8_decode('Construc.'), 'BR', 0, 'C', 1);
		$pdf->Cell(24, 5, utf8_decode('$/m²'), 'BR', 0, 'C', 1);
		
		$pdf->Cell(10, 5, utf8_decode('Zona'), 'BR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Ubic'), 'BR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Sup'), 'BR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Edad'), 'BR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Cons'), 'BR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Neg'), 'BR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Fr'), 'BR', 0, 'C', 1);
		
		$pdf->Cell(25, 5, utf8_decode('Resultante ($/m²)'), 'BR', 1, 'C', 1);

		$rowsAemInformacion = AemInformacion::getAemAnalisisByFk($mercado->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->Cell(6, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(23, 5, number_format($fila->precio_venta, 2, '.', ','), 'BR', 0, 'R', 0);
			$pdf->Cell(24, 5, number_format($fila->superficie_terreno, 2, '.', ','), 'BR', 0, 'R', 0);
			$pdf->Cell(24, 5, number_format($fila->superficie_construccion, 2, '.', ','), 'BR', 0, 'R', 0);
			$pdf->Cell(24, 5, number_format($fila->valor_unitario_m2, 2, '.', ','), 'BR', 0, 'R', 0);
			$pdf->Cell(10, 5, number_format($fila->factor_zona, 2, '.', ','), 'BR', 0, 'C', 0);
			$pdf->Cell(10, 5, number_format($fila->factor_ubicacion, 2, '.', ','), 'BR', 0, 'C', 0);
			$pdf->Cell(10, 5, number_format($fila->factor_superficie, 2, '.', ','), 'BR', 0, 'C', 0);
			$pdf->Cell(10, 5, number_format($fila->factor_edad, 2, '.', ','), 'BR', 0, 'C', 0);
			$pdf->Cell(10, 5, number_format($fila->factor_conservacion, 2, '.', ','), 'BR', 0, 'C', 0);
			$pdf->Cell(10, 5, number_format($fila->factor_negociacion, 2, '.', ','), 'BR', 0, 'C', 0);
			$pdf->Cell(10, 5, number_format($fila->factor_resultante, 2, '.', ','), 'BR', 0, 'C', 0);
			$pdf->Cell(25, 5, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(160, 5, utf8_decode('Valor promedio:'), 'L', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(36, 5, number_format($mercado->promedio_analisis, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(160, 5, utf8_decode('Superficie Construida del Sujeto:'), 'BL', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(36, 5, number_format($mercado->superficie_construida, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->Ln(1);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(160, 5, utf8_decode('Valor comparativo de mercado:'), 'TBL', 0, 'R', 0);
		$pdf->Cell(36, 5, number_format($mercado->valor_comparativo_mercado, 2, '.', ','), 'TBLR', 1, 'R', 1);

	}

	private function avaluoEnfoqueFisico(&$pdf, $idavaluo) {
		$fisico = AvaluosFisico::getAvaluoFisicoByFk($idavaluo);
		$pdf->AddPage();
		$nFont = 5;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 7, utf8_decode('ANÁLISIS FÍSICO'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(3);
		
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, $nFont, utf8_decode('A) TERRENO'), 'TBLR', 1, 'L', 0);
		$this->aefTerrenos($pdf, $fisico);

		$pdf->ln(3);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 6, utf8_decode('B) CONSTRUCCIONES'), 'TBLR', 1, 'L', 0);

		$pdf->ln(1);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, $nFont, utf8_decode('CLASIFICACIÓN DE LAS CONSTRUCCIONES'), 'LRTB', 1, 'C', 0);

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(18, $nFont, utf8_decode("Clase General: "), 'LRB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(20, $nFont, utf8_decode($fisico->clase_general_inmueble), 'RB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(8, $nFont, utf8_decode("Tipo "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(30, $nFont, utf8_decode($fisico->tipo_inmueble), 'RB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(25, $nFont, utf8_decode("Estado Conservación "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(52, $nFont, utf8_decode($fisico->estado_conservacion), 'RB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(24, $nFont, utf8_decode("Calidad del Proyecto:"), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(19, $nFont, utf8_decode($fisico->calidad_proyecto), 'LRB', 1, 'L');

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(43, $nFont, utf8_decode("Edad de las construcciones (Años):"), 'LRB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($fisico->edad_construccion), 'RB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(27, $nFont, utf8_decode("Vida Útil Remanente:"), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($fisico->vida_util), 'RB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(38, $nFont, utf8_decode("Número de niveles: "), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($fisico->numero_niveles), 'RB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(48, $nFont, utf8_decode("Nivel en edificio (condominio):"), 'RB', 0, 'R');
		$pdf->SetFont('Arial', '', 6);
		$pdf->Cell(10, $nFont, utf8_decode($fisico->nivel_edificio_condominio), 'LRB', 1, 'C');

		$this->aefConstrucciones($pdf, $fisico);
		$this->aefCondominios($pdf, $fisico);
		$this->aefInstalaciones($pdf, $fisico);

		$pdf->ln(3);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(150, 8, utf8_decode('Valor Físico Total:'), 'TBL', 0, 'R', 0);
		$pdf->SetFillColor(246, 229, 115);
		$pdf->Cell(46, 8, number_format($fisico->total_valor_fisico, 2, '.', ','), 'TBLR', 1, 'R', 1);
	}

	private function aefTerrenos(&$pdf, $fisico) {
		$nFont = 5;
		$rowsAefTerrenos = AefTerrenos::AefTerrenosByFk($fisico->idavaluoenfoquefisico);

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(25, $nFont * 2, utf8_decode('Fracción'), 'LRB', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('Superficie m²'), 'RB', 0, 'C', 1);
		
		$pdf->Cell(84, $nFont, utf8_decode('Factores de Eficiencia'), 'RB', 0, 'C', 1);
		$pdf->Cell(25, $nFont * 2, utf8_decode('V. R. Neto'), 'RB', 0, 'C', 1);
		$pdf->Cell(12, $nFont * 2, utf8_decode('Indiviso'), 'RB', 0, 'C', 1);
		$pdf->Cell(25, $nFont, utf8_decode('Valor'), 'RLB', 1, 'C', 1);

		$pdf->setX(60);

		$pdf->Cell(14, $nFont, utf8_decode('Irre'), 'RB', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Top'), 'RB', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Frente'), 'RB', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Forma'), 'RB', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Otros'), 'RB', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Fr'), 'RB', 0, 'C', 1);
		$pdf->setX(181);
		$pdf->Cell(25, $nFont, utf8_decode('Resultante ($/m²)'), 'LRB', 1, 'C', 1);

		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAefTerrenos as $fila) {
			$pdf->Cell(25, $nFont, utf8_decode($fila->fraccion), 'LB', 0, 'L', 0);
			$pdf->Cell(25, $nFont, number_format($fila->superficie, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->irregular, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->top, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->frente, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->forma, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->otros, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_unitario_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(12, $nFont, number_format($fila->indiviso, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(171, $nFont, utf8_decode('Valor del Terreno:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, $nFont, number_format($fisico->valor_terreno, 2, '.', ','), 'BLR', 1, 'R', 0);

	}
	
	private function aefConstrucciones(&$pdf, $fisico) {
		$rowsAefConstrucciones = AefConstrucciones::AefConstruccionesByFk($fisico->idavaluoenfoquefisico);
		$nFont = 5;
		$pdf->ln(3);
		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(50, $nFont * 2, utf8_decode('Tipo de Construcción'), 'TLB', 0, 'C', 1);
		$pdf->Cell(10, $nFont * 2, utf8_decode('Edad'), 'TBL', 0, 'C', 1);
		$pdf->Cell(21, $nFont * 2, utf8_decode('Superficie m²'), 'TBL', 0, 'C', 1);
		$pdf->Cell(23, $nFont * 2, utf8_decode('V.R. Nuevo'), 'TBL', 0, 'C', 1);

		$pdf->Cell(42, $nFont, utf8_decode('Factores'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont * 2, utf8_decode('V. R. Neto'), 'TBL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'TLR', 1, 'C', 1);

		$pdf->setX(114);

		$pdf->Cell(14, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(181);
		$pdf->Cell(25, $nFont, utf8_decode('Construcciones'), 'BLR', 1, 'C', 1);

		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAefConstrucciones as $fila) {
			$pdf->Cell(6, $nFont, ++$lID, 'LB', 0, 'L', 0);
			$pdf->Cell(44, $nFont, utf8_decode($fila->tipo), 'LB', 0, 'L', 0);
			$pdf->Cell(10, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(21, $nFont, number_format($fila->superficie_m2, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(23, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_neto, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial_construccion, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(68, $nFont, utf8_decode('Total Superficie m²:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(30, $nFont, number_format($fisico->total_metros_construccion, 2, '.', ','), 'BLR', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(68, $nFont, utf8_decode('Valor de las construcciones:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(30, $nFont, number_format($fisico->valor_construccion, 2, '.', ','), 'BLR', 1, 'R', 0);
		
	}
	
	private function aefCondominios(&$pdf, $fisico) {
		$rowsAefCondominios = AefCondominios::AefCondominiosByFk($fisico->idavaluoenfoquefisico);
		$nFont = 5;
		$pdf->ln(3);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 6, utf8_decode('C1)  COMUNES, INSTALACIONES ESPECIALES Y OBRAS COMPLEMENTARIAS (SOLO EN CONDOMINIOS)'), 'LRTB', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(45, $nFont * 2, utf8_decode('Descripción'), 'LB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Unidad'), 'LB', 0, 'C', 1);
		$pdf->Cell(12, $nFont * 2, utf8_decode('Cantidad'), 'LB', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('V.R. Nuevo'), 'LB', 0, 'C', 1);

		$pdf->Cell(15, $nFont, utf8_decode('Vida'), 'L', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('Edad'), 'L', 0, 'C', 1);

		$pdf->Cell(36, $nFont, utf8_decode('Factores'), 'BL', 0, 'C', 1);

		$pdf->Cell(14, $nFont * 2, utf8_decode('Indiviso'), 'BL', 0, 'C', 1);

		$pdf->Cell(25, $nFont, utf8_decode('Valor Parcial'), 'LR', 1, 'C', 1);

		$pdf->setX(101);
		$pdf->Cell(15, $nFont, utf8_decode('Remanente'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, $nFont, utf8_decode('(Años)'), 'BL', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Cons.'), 'BL', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Res.'), 'BLR', 0, 'C', 1);
		$pdf->setX(181);
		$pdf->Cell(25, $nFont, utf8_decode('Áreas Comunes'), 'BLR', 1, 'C', 1);

		$pdf->SetFont('Arial', '', 6);
		$lID = 0;
		foreach ($rowsAefCondominios as $fila) {
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->descripcion, 0, 47)), 'LB', 0, 'L', 0);
			$pdf->SetFont('Arial', '', 7);
			$pdf->Cell(14, $nFont, utf8_decode($fila->unidad), 'BL', 0, 'C', 0);
			$pdf->Cell(12, $nFont, number_format($fila->cantidad, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, $nFont, number_format($fila->vida_remanente, 4, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(15, $nFont, number_format($fila->edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(12, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(12, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(12, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, $nFont, number_format($fila->indiviso, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(25, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'BLR', 1, 'R', 0);
		}

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(166, $nFont, utf8_decode('Subtotal:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(30, $nFont, number_format($fisico->subtotal_area_condominio, 2, '.', ','), 'BLR', 1, 'R', 0);
		
	}
	
	private function aefInstalaciones(&$pdf, $fisico) {
		$rowsAefInstalaciones = AefInstalaciones::AefInstalacionesByFk($fisico->idavaluoenfoquefisico);
		$nFont = 5;
		$pdf->ln(3);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 6, utf8_decode('C2)  PRIVATIVAS, INSTALACIONES ESPECIALES Y OBRAS COMPLEMENTARIAS'), 'TBLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 6);
		$pdf->Cell(45, $nFont * 2, utf8_decode('Descripción'), 'LTB', 0, 'L', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Unidad'), 'LB', 0, 'C', 1);
		$pdf->Cell(14, $nFont * 2, utf8_decode('Cantidad'), 'LB', 0, 'C', 1);
		$pdf->Cell(20, $nFont * 2, utf8_decode('V.R. Nuevo'), 'LB', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Vida Util'), 'LB', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Edad'), 'LB', 0, 'C', 1);

		$pdf->Cell(36, $nFont, utf8_decode('Factores'), 'LB', 0, 'C', 1);

		$pdf->Cell(20, $nFont, utf8_decode('V. Neto'), 'L', 0, 'C', 1);

		$pdf->Cell(23, $nFont, utf8_decode('Valor Parcial'), 'LR', 1, 'C', 1);

		$pdf->setX(103);
		$pdf->Cell(12, $nFont, utf8_decode('Total'), 'LB', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Años'), 'LB', 0, 'C', 1);
		
		$pdf->Cell(12, $nFont, utf8_decode('Edad'), 'LB', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Cons.'), 'LB', 0, 'C', 1);
		$pdf->Cell(12, $nFont, utf8_decode('Res.'), 'LB', 0, 'C', 1);

		$pdf->setX(163);
		$pdf->Cell(20, $nFont, utf8_decode('Rep.'), 'LB', 0, 'C', 1);
		$pdf->Cell(23, $nFont, utf8_decode('Elem. Adic.'), 'LRB', 1, 'C', 1);

		$pdf->SetFont('Arial', '', 6);
		$lID = 0;
		foreach ($rowsAefInstalaciones as $fila) {
			$pdf->Cell(45, $nFont, utf8_decode(substr($fila->descripcion, 0, 47)), 'LRB', 0, 'L', 0);
			$pdf->Cell(14, $nFont, utf8_decode($fila->unidad), 'LB', 0, 'C', 0);
			$pdf->Cell(14, $nFont, number_format($fila->cantidad, 2, '.', ','), 'RB', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_nuevo, 2, '.', ','), 'RB', 0, 'R', 0);
			$pdf->Cell(12, $nFont, number_format($fila->vida_util, 4, '.', ','), 'RB', 0, 'C', 0);
			$pdf->Cell(12, $nFont, number_format($fila->edad, 2, '.', ','), 'RB', 0, 'C', 0);
			$pdf->Cell(12, $nFont, number_format($fila->factor_edad, 4, '.', ','), 'RB', 0, 'R', 0);
			$pdf->Cell(12, $nFont, number_format($fila->factor_conservacion, 2, '.', ','), 'RB', 0, 'R', 0);
			$pdf->Cell(12, $nFont, number_format($fila->factor_resultante, 2, '.', ','), 'RB', 0, 'R', 0);
			$pdf->Cell(20, $nFont, number_format($fila->valor_neto, 2, '.', ','), 'RB', 0, 'R', 0);
			$pdf->Cell(23, $nFont, number_format($fila->valor_parcial, 2, '.', ','), 'RB', 1, 'R', 0);
		}

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(166, $nFont, utf8_decode('Subtotal:'), 'LB', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(30, $nFont, number_format($fisico->subtotal_instalaciones_especiales, 2, '.', ','), 'BLR', 1, 'R', 0);
		
	}

	private function avaluoConclusion(&$pdf, $avaluo) {
		$cl = Avaluos::find($avaluo->idavaluo)->AvaluosConclusiones;
		$pdf->AddPage();
		$nFont = 12;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 7, utf8_decode('CONCLUSIONES'), 'TLBR', 1, 'C', 1);
		$pdf->Cell(90, $nFont * 2, utf8_decode('RESUMEN DE VALORES'), 'LRB', 0, 'C', 0);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(60, $nFont, utf8_decode('Valor Comparativo de Mercado:'), 'RB', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(46, $nFont, '$ ' . number_format($cl->valor_mercado, 2, '.', ','), 'LRB', 1, 'R', 0);
		$pdf->setX(100);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(60, $nFont, utf8_decode('Valor Físico:'), 'RB', 0, 'R', 0);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(46, $nFont, '$ ' . number_format($cl->valor_fisico, 2, '.', ','), 'RB', 1, 'R', 0);

		$pdf->ln(3);
		$pdf->SetFont('Arial', '', 10);
		$pdf->MultiCell(0, 4, utf8_decode($cl->leyenda), '1', 'L');

		//$pdf->SetFont('Arial', '', 8);
		//$pdf->MultiCell(0, 3.60, utf8_decode($cl->leyenda), '', 'L');

		$pdf->ln(5);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->SetFillColor(246, 229, 115);
		$pdf->SetLineWidth('0.5');
		$pdf->Cell(126, $nFont, utf8_decode('Importe del Valor Comercial:'), 'TBL', 0, 'R', 1);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(70, $nFont, '$ ' . number_format($cl->valor_concluido, 2, '.', ','), 'TBLR', 1, 'R', 1);

		$pdf->SetFont('Arial', '', 12);
		$pdf->SetFillColor(208, 208, 208);
		$val0 = explode('.', $cl->valor_concluido);
		$toLetter = new NumberToLetterConverter();

		$pdf->Cell(0, $nFont, trim($toLetter->to_word($val0[0])) . ' PESOS ' . $val0[1] . '/100 M.N.', 'TBLR', 1, 'R', 1);

		$pdf->SetLineWidth('0');

		$pdf->ln(3);
		
		$pdf->SetFont('Arial', 'B', 12);

		$pdf->Cell(65, 45, '', 'RLT', 0, 'C', 0);
		$pdf->Cell(65, 45, '', 'RLT', 0, 'C', 0);
		$pdf->Cell(66, 45, '', 'RLT', 1, 'C', 0);

		$pdf->SetX(10);
		$ordenada = $pdf->getY();
		$pdf->Cell(65, 10, utf8_decode(trim($avaluo->apellidos)) . ' ' . utf8_decode(trim($avaluo->nombres)), 'RL', 0, 'C', 0);
		$pdf->Cell(65, 20, 'FIRMA', 'RLB', 0, 'C', 0);
		$pdf->Cell(66, 20, 'SELLO', 'RLB', 1, 'C', 0);
		$pdf->SetY($ordenada + 10);
		$pdf->Cell(65, 10, trim($avaluo->registro), 'RLB', 1, 'C', 0);

	}

	private function avaluoFotos(&$pdf, $idavaluo) {
		$pdf->AddPage();
		$fotos = Avaluos::find($idavaluo)->AvaluosFotos;
		$nFont = 10;
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(0, 8, utf8_decode('8. FOTOGRAFIAS Y PLANO DEL INMUEBLE'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(3);
		$ordenada = $pdf->GetY();

		if ($fotos->foto0 != "") {
			$fc = explode('.', $fotos->foto0);
			$archivo = public_path() . '/corevat/files/' . $fotos->foto0;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, null, $ordenada, 62.0, 50.00);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 62.0, 50.00);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 62.0, 50.00);
		}

		if ($fotos->foto1 != "") {
			$fc = explode('.', $fotos->foto1);
			$archivo = public_path() . '/corevat/files/' . $fotos->foto1;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 77, $ordenada, 62.0, 50.00);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 77, $ordenada, 62.0, 50.00);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 77, $ordenada, 62.0, 50.00);
		}

		if ($fotos->foto3 != "") {
			$fc = explode('.', $fotos->foto3);
			$archivo = public_path() . '/corevat/files/' . $fotos->foto3;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 144, $ordenada, 62.0, 50.00);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 144, $ordenada, 62.0, 50.00);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 144, $ordenada, 62.0, 50.00);
		}

		$pdf->Ln(53);
		
		$ordenada = $pdf->GetY();

		if ($fotos->foto3 != "") {
			$fc = explode('.', $fotos->foto3);
			$archivo = public_path() . '/corevat/files/' . $fotos->foto3;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, null, $ordenada, 62.0, 50.00);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 62.0, 50.00);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 62.0, 50.00);
		}

		if ($fotos->foto4 != "") {
			$fc = explode('.', $fotos->foto4);
			$archivo = public_path() . '/corevat/files/' . $fotos->foto4;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 77, $ordenada, 62.0, 50.00);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 77, $ordenada, 62.0, 50.00);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 77, $ordenada, 62.0, 50.00);
		}

		if ($fotos->foto5 != "") {
			$fc = explode('.', $fotos->foto5);
			$archivo = public_path() . '/corevat/files/' . $fotos->foto5;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 144, $ordenada, 62.0, 50.00);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 144, $ordenada, 62.0, 50.00);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 144, $ordenada, 62.0, 50.00);
		}

		$pdf->Ln(53);
		
		$ordenada = $pdf->GetY();

		if ($fotos->plano0 != "") {
			$fc = explode('.', $fotos->plano0);
			$archivo = public_path() . '/corevat/files/' . $fotos->plano0;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, null, $ordenada, 196.0, 90.00);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 196.0, 90.00);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 196.0, 90.00);
		}

	}

}
