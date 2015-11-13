<?php

setlocale(LC_MONETARY, 'es_MX');

use Carbon\Carbon;

require('AvaluoPdf.php');
require 'NumberToLetterConverter.php';

class corevat_PrintAvaluoController extends \BaseController {

	public function printAvaluo($id) {
		$avaluo = Avaluos::getAvaluo($id);
		$pdf = new AvaluoPdf();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 6, utf8_decode('A V A L Ú O'), 'TLBR', 1, 'C', 0);

		$this->avaluoPerito($pdf, $avaluo);

		$this->avaluoGeneral($pdf, $avaluo);

		$this->avaluoCaracteristicasZona($pdf, $id);

		$this->avaluoInmueble($pdf, $id);

		$this->avaluoEnfoqueMercado($pdf, $id);

		$this->avaluoEnfoqueFisico($pdf, $id);

		$this->avaluoConclusion($pdf, $id);
		
		$this->avaluoFotos($pdf, $id);

/*
		$pdf->Ln(2);
		$pdf->SetFont('Arial', '', 22);
		for ($i = 1; $i <= 400; $i++) {
			$pdf->Cell(0, 10, 'Line ' . $i, 0, 1);
		}
*/



		$pdf->Output();
		exit;
	}

	private function avaluoPerito(&$pdf, $avaluo) {
		$pdf->Ln(2);
		$pdf->Cell(0, 6, utf8_decode('DATOS DEL VALUADOR'), 'TLBR', 1, 'C', 1);
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, 6, utf8_decode("Fecha del Avalúo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, 6, Carbon::parse($avaluo->fecha_avaluo)->formatLocalized("%d de %B de %Y"), 'LB', 0, 'L');
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, 6, utf8_decode("Avalúo Número: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 6, $avaluo->foliocoretemp, 'LBR', 1, 'L', 0);
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, 6, utf8_decode("Nombre del Valuador: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, 6, utf8_decode($avaluo->apellidos) . ' ' . utf8_decode($avaluo->nombres), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, 6, utf8_decode("Cédula Profesional del Valuador: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 6, $avaluo->cedulaprofesional, 'LBR', 1, 'L');
		
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(40, 6, utf8_decode("Registro Estatal: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(40, 6, $avaluo->registro, 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(60, 6, utf8_decode("Registro Colegio: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(50, 6, $avaluo->registro_colegio, 'LBR', 1, 'L');
		
	}

	private function avaluoGeneral(&$pdf, $avaluo) {
		$pdf->Ln(2);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 6, 'INFORMACION GENERAL DEL INMUEBLE', 'TLBR', 1, 'C', 1);
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Propósito: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(60, 5, utf8_decode($avaluo->proposito), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Finalidad: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(75, 5, utf8_decode($avaluo->finalidad), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Tipo de Inmueble: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($avaluo->tipo_inmueble), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Ubicación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(90, 5, utf8_decode($avaluo->ubicacion), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Nombre del Conjunto: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(50, 5, utf8_decode($avaluo->conjunto), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(15, 5, utf8_decode("Colonia: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(70, 5, utf8_decode($avaluo->colonia), 'LBR', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(10, 5, utf8_decode("CP: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(15, 5, utf8_decode($avaluo->cp), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Municipio: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(70, 5, utf8_decode($avaluo->municipio), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Entidad Federativo: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(60, 5, utf8_decode($avaluo->estado), 'LBR', 1, 'L');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Coordenads Geo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(10, 5, '', 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Longitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(25, 5, utf8_decode($avaluo->longitud), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Latitud: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(25, 5, utf8_decode($avaluo->latitud), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Altitud: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(25, 5, utf8_decode($avaluo->altitud), 'BR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Regimen de Propiedad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(40, 5, utf8_decode($avaluo->regimen_propiedad), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Cuenta Predial: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(30, 5, utf8_decode($avaluo->cuenta_predial), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(25, 5, utf8_decode("Cuenta Catastral: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(35, 5, utf8_decode($avaluo->cuenta_catastral), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Nombre del Solicitante: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode(trim($avaluo->titulo_solicitante) . " " . $avaluo->nombre_solicitante), 'LB', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Propietario: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode(trim($avaluo->titulo_propietario) . " " . $avaluo->nombre_propietario), 'LBR', 1, 'L');
	}

	private function avaluoCaracteristicasZona(&$pdf, $id) {
		$pdf->Ln(2);
		$zona = AvaluosZona::getAvaluosZonaByFk($id);
		
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 6, utf8_decode('CARACTERÍSTICAS DE LA ZONA'), 'TLBR', 1, 'C', 1);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5 * 3, utf8_decode("Servicios municipales: "), 'LBR', 0, 'R');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Agua Potable: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_agua_potable == 1 ? 'X' : '', 'BR', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Drenaje: "), 'B', 0, 'BR');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_drenaje == 1 ? 'X' : '', 'LBR', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Electrificación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_electricidad == 1 ? 'X' : '', 'LBR', 0, 'L');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Pavimientación: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_pavimentacion == 1 ? 'X' : '', 'LBR', 0, 'L');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Alumbrado Público: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_alumbrado_publico == 1 ? 'X' : '', 'LBR', 1, 'L');
		
		$pdf->setX(45);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Guarniciones: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_guarniciones == 1 ? 'X' : '', 'LBR', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Banqueta: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_banqueta == 1 ? 'X' : '', 'LBR', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Teléfono: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_telefono == 1 ? 'X' : '', 'LBR', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Transporte Urbano: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_transporte_publico == 1 ? 'X' : '', 'LBR', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Recolección basura: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_recoleccion_basura == 1 ? 'X' : '', 'LBR', 1, 'C');

		$pdf->setX(45);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Vigilancia privada: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_vigilancia_privada == 1 ? 'X' : '', 'LBR', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Internet: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_internet == 1 ? 'X' : '', 'LBR', 0, 'C');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Otros: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_otro_servicio == 1 ? 'X' : '', 'LBR', 0, 'L');
		$pdf->Cell(0, 5, $zona->otro_servicio_municipal == 1 ? 'X' : '', 'LBR', 1, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5 * 2, utf8_decode("Equipamiento urbano: "), 'LBR', 0, 'R');

		$pdf->Cell(28, 5, utf8_decode("Escuela: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_escuela == 1 ? 'X' : '', 'LBR', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Iglesia: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_iglesia == 1 ? 'X' : '', 'LBR', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Banco: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_banco == 1 ? 'X' : '', 'LBR', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Comercio: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_comercio == 1 ? 'X' : '', 'LBR', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Hospital: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_hospital == 1 ? 'X' : '', 'LBR', 1, 'L');

		$pdf->setX(45);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Parque: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_parque == 1 ? 'X' : '', 'LBR', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Transporte: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_transporte == 1 ? 'X' : '', 'LBR', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Gasolineria: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_gasolinera == 1 ? 'X' : '', 'LBR', 0, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(28, 5, utf8_decode("Mercado: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(3, 5, $zona->is_mercado == 1 ? 'X' : '', 'LBR', 0, 'C');
		$pdf->Cell(31, 5, '', 'LBR', 1, 'R');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("En un radio: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(60, 5, utf8_decode($zona->cobertura) . ' metros', 'BR', 0, 'L');
		
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("Nivel de Equiamiento: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(60, 5, utf8_decode($zona->nivel_equipamiento) . '%', 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("Clasificacion de la Zona: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(60, 5, $zona->proximidad_urbana, 'LB', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(35, 5, utf8_decode("Proximidad Urbana: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(60, 5, $zona->clasificacion_zona, 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Construcciones Predominantes:"), 'LBRT', 1, 'L');

		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(190, 3.5, utf8_decode($zona->construc_predominante), 'BLR', 'L');
//

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Vías de acceso e importancia:"), 'LBRT', 1, 'L');

		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(190, 3.5, utf8_decode($zona->vias_acceso_importante), 'BLR', 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Calles transversales limitrofes y orientación:"), 'LBRT', 1, 'L');

		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(190, 3.5, utf8_decode($zona->calles_transversales), 'BLR', 'L');




/*
123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_ */








		//$pdf->Ln(15);

	}
	
	private function avaluoInmueble(&$pdf, $idavaluo) {
		$in = AvaluosInmueble::getAvaluoInmuebleByIdForPdf($idavaluo);

		$pdf->Ln(2);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 5, utf8_decode('CARACTERISTÍCAS DEL INMUEBLE (1 de 2)'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(1);
		$pdf->Cell(90, 6, utf8_decode('C R O Q U I S'), 'TLBR', 0, 'C', 1);
		$pdf->Cell(10, 6, '', '', 0, 'C', 0);
		$pdf->Cell(90, 6, utf8_decode('F A C H A D A'), 'TLBR', 1, 'C', 1);

		$pdf->Ln(1);
		$ordenada = $pdf->GetY();
		
		if ($in->croquis != "") {
			$fc = explode('.', $in->croquis);
			$archivo = public_path() . '/corevat/files/' . $in->croquis;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, null, $ordenada, 90.0, 50);
			} else {
				$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 90.0, 50);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', null, $ordenada, 90.0, 50);
		}

		if ($in->fachada != "") {
			$fc = explode('.', $in->fachada);
			$archivo = public_path() . '/corevat/files/' . $in->fachada;
			if (file_exists($archivo)) {
				$pdf->Image($archivo, 110, null, 90.0, 50);
			} else {
					$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 100, $ordenada, 90.0, 50);
			}
		} else {
			$pdf->Image(public_path() . '/css/images/corevat/blank.gif', 100, $ordenada, 90.0, 50);
		}

		$ordenada = $pdf->GetY();
		if ( $ordenada < 265 ) {
			$pdf->AddPage();
		}
/*
		$ordenada = $pdf->GetY();
$pdf->Cell(0, 10, 'Line ' . $ordenada, 1, 1);
		$ordenada = $pdf->GetY();
$pdf->Cell(0, 10, 'Line ' . $ordenada, 1, 1);
		$ordenada = $pdf->GetY();
$pdf->Cell(0, 10, 'Line ' . $ordenada, 1, 1);
*/
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 6, utf8_decode('A) DETALLES DE MEDIDAS Y COLINDANCIAS'), 'TBLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode('Según: '), 'LBR', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(170, 5, utf8_decode($in->segun), 'LBR', 1, 'L', 0);

		$rstMedCol = AiMedidasColindancias::getOrientacionFromMedCol($in->idavaluoinmueble);
		$pdf->Ln(1);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode('Orientación'), 'TLBR', 0, 'C', true);
		$pdf->Cell(30, 5, utf8_decode('U. M.'), 'TLBR', 0, 'C', true);
		$pdf->Cell(30, 5, utf8_decode('Medidas'), 'TLBR', 0, 'C', true);
		$pdf->Cell(100, 5, utf8_decode('Colindancias'), 'TLBR', 1, 'C', true);
		$i = 1;
		foreach ($rstMedCol as $medcol) {
			if ($i > 44 ) {
				$i = 1;
				$pdf->AddPage();
				$pdf->SetFont('Arial', 'B', 7);
				$pdf->Cell(30, 5, utf8_decode('Orientación'), 'TLBR', 0, 'C', true);
				$pdf->Cell(30, 5, utf8_decode('U. M.'), 'TLBR', 0, 'C', true);
				$pdf->Cell(30, 5, utf8_decode('Medidas'), 'TLBR', 0, 'C', true);
				$pdf->Cell(100, 5, utf8_decode('Colindancias'), 'TLBR', 1, 'C', true);
			}
			$pdf->SetFont('Arial', '', 6);
			$pdf->Cell(30, 5, utf8_decode($medcol->orientacion), 'BL', 0, 'L', 0);
			$pdf->Cell(30, 5, utf8_decode($medcol->unidad_medida), 'BL', 0, 'L', 0);
			$pdf->Cell(30, 5, utf8_decode($medcol->medidas), 'BL', 0, 'L', 0);
			$pdf->Cell(100, 5, utf8_decode($medcol->colindancia), 'BLR', 1, 'L', 0);
			$i++;
		}

		$pdf->Ln(1);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 6, utf8_decode('B) CARACTERÍSTICAS DE LA CONSTRUCCIÓN'), 'TBLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Cimentación: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode($in->cimentacion), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Estructuras: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode($in->estructura), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Muros: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode($in->muros), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Entrepisos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode($in->entrepisos), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Techos: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode($in->techos), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Bardas: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode($in->bardas), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Uso de suelo: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(160, 5, utf8_decode($in->usos_suelos), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Servidumbres y Restricciones: "), 'TBRL', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(190, 3.5, utf8_decode($in->servidumbre_restricciones), 'BLR', 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Niveles de la Unidad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(50, 5, utf8_decode($in->nivel), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Unidades rentables en la misma estructura: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(70, 5, utf8_decode($in->unidades_rentables_escritura), 'LBR', 1, 'L');


		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Servidumbres y Restricciones:"), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(190, 3.5, utf8_decode($in->servidumbre_restricciones), 'BLR', 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Niveles de la Unidad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(50, 5, utf8_decode($in->nivel), 'LB', 0, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Unidades rentables en la misma estructura: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(80, 5, utf8_decode($in->unidades_rentables_escritura), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode("Descripcion General del Inmueble:"), 'LBR', 1, 'L');
		$pdf->SetFont('Arial', '', 7);
		$pdf->MultiCell(190, 3.5, utf8_decode($in->descripcion_inmueble), 'BLR', 'L');

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 6, utf8_decode('CARACTERÍSTICAS DEL INMUEBLE (2 de 2)'), 'TLBR', 1, 'C', 1);

		$pdf->Cell(0, 6, utf8_decode('C) ACABADOS'), 'TBLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 4, utf8_decode("Acabado"), 'TLB', 0, 'C', true);
		$pdf->Cell(50, 4, utf8_decode("Pisos"), 'TLB', 0, 'C', true);
		$pdf->Cell(50, 4, utf8_decode("Muros"), 'TLB', 0, 'C', true);
		$pdf->Cell(50, 4, utf8_decode("Plafones"), 'TLBR', 1, 'C', true);

		$rows = AiAcabados::select('ai_acabados.*', 'cat_acabados.nombre', 'cat_aplanados.aplanado', 'cat_pisos.piso', 'cat_plafones.plafon')
						->leftJoin('cat_acabados',  'ai_acabados.fk_cat_acabados',  '=', 'cat_acabados.id')
						->leftJoin('cat_aplanados', 'ai_acabados.fk_cat_aplanados', '=', 'cat_aplanados.idaplanado')
						->leftJoin('cat_pisos',     'ai_acabados.fk_cat_pisos',     '=', 'cat_pisos.idpiso')
						->leftJoin('cat_plafones',  'ai_acabados.fk_cat_plafones',  '=', 'cat_plafones.idplafon')
						->where('ai_acabados.idavaluoinmueble', '=', $in->idavaluoinmueble)
						->orderBy('ai_acabados.id')
						->get();
		$pdf->SetFont('Arial', '', 7);
		foreach ($rows as $row) {
			$pdf->Cell(40, 4, utf8_decode($row['nombre']), 'LB', 0, 'L', false);
			$pdf->Cell(50, 4, utf8_decode($row['piso']), 'LB', 0, 'L', false);
			$pdf->Cell(50, 4, utf8_decode($row['aplanado']), 'LB', 0, 'L', false);
			$pdf->Cell(50, 4, utf8_decode($row['plafon']), 'LRB', 1, 'L', false);
		}

		$pdf->ln(1);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 5, utf8_decode('OTROS DATOS'), 'TBLR', 1, 'L', false);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Hidráulico Sanitarias:"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(150, 5, utf8_decode($in->hidraulico_sanitarias), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Eléctricas:"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(150, 5, utf8_decode($in->electricas), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Carpintería:"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(150, 5, utf8_decode($in->carpinteria), 'LBR', 1, 'L');





		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 10, utf8_decode("Herrería: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Ventanas: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(150, 5, '', 'BR', 1, 'L');
		$pdf->setX(30);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Puertas: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(150, 5, '', 'BR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 10, utf8_decode("Aluminio: "), 'LBR', 0, 'R');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Ventanas: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(150, 5, '', 'BR', 1, 'C');
		$pdf->setX(30);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Puertas: "), 'BR', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(150, 5, '', 'BR', 1, 'C');




		$pdf->ln(1);

		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(0, 5, utf8_decode('D) SUPERFICIES'), 'TBLR', 1, 'L', false);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie Total del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->superficie_total_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Individo del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->indiviso_terreno) . ' %', 'LBR', 1, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie del Terreno"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->superficie_terreno) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Individo de Áreas Comunes"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->indiviso_areas_comunes) . ' %', 'LBR', 1, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie de Construcción"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->superficie_construccion) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Individo Accesoría"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->indiviso_accesoria) . ' %', 'LBR', 1, 'C');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie Asentada en Escritura"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->superficie_escritura) . ' m2', 'LB', 0, 'C');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(50, 5, utf8_decode("Superficie Vendible"), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(45, 5, utf8_decode($in->superficie_vendible) . ' m2', 'LBR', 1, 'C');
		
	}
	
	private function avaluoEnfoqueMercado(&$pdf, $idavaluo) {
		$mercado = Avaluos::find($idavaluo)->AvaluosMercado;
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(0, 5, utf8_decode('ENFOQUE DE MERCADO'), 'TLBR', 1, 'C', 1);
		$this->aemCmpTerrenos($pdf, $mercado);
		$this->aemHomologacion($pdf, $mercado);
		$this->aemInformacion($pdf, $mercado);
		$this->aemAnalisis($pdf, $mercado);
	}

	private function aemCmpTerrenos(&$pdf, $mercado) {
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(0, 5, utf8_decode('A) VENTA DE TERRENOS'), 'BLR', 1, 'L', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(10, 5, utf8_decode('No.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(90, 5, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'C', 1);
		$pdf->Cell(20, 5, utf8_decode('Precio Oferta'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('Sup. Const.'), 'BL', 0, 'C', 1);
		$pdf->Cell(15, 5, utf8_decode('P. U./m2'), 'BL', 0, 'C', 1);
		$pdf->Cell(40, 5, utf8_decode('Observaciones'), 'BLR', 1, 'C', 1);

		$rst = AemCompTerrenos::getAemCompTerrenosByFk($mercado->idavaluoenfoquemercado);
		$pdf->SetFont('Arial', '', 6);
		$lID = 0;
		foreach ($rst as $fila) {
			$pdf->Cell(10, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(90, 5, utf8_decode(substr($fila->ubicacion, 0, 80)), 'BL', 0, 'L', 0);
			$pdf->Cell(20, 5, number_format($fila->precio, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, 5, number_format($fila->superficie_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(15, 5, number_format($fila->precio_unitario_m2_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(40, 5, utf8_decode(substr($fila->observaciones, 0, 29)), 'BLR', 1, 'L', 0);
		}
	}
	
	private function aemHomologacion(&$pdf, $mercado) {
		$pdf->Cell(0, 5, utf8_decode('Homologación del Terreno en función del lote tipo o predominante en la zona, en caso de no existir este, en función del lote valuado'), 'BLR', 1, 'C', 0);

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(6, 10, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(102, 10, utf8_decode('Comparable:'), 'BL', 0, 'C', 1);
		$pdf->Cell(6, 10, utf8_decode('Sup'), 'BL', 0, 'C', 1);
		$pdf->Cell(20, 10, utf8_decode('Valor unit'), 'BL', 0, 'C', 1);

		$pdf->setX(139);
		$pdf->Cell(50, 5, utf8_decode('Factores de Eficiencia'), 'BL', 0, 'C', 1);
		$pdf->Cell(22, 5, utf8_decode('Valor Unitario'), 'BLR', 1, 'C', 1);

		$pdf->setX(139);
		$pdf->Cell(10, 5, utf8_decode('Zona'), 'BL', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Ubic.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Fte.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Fma.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(10, 5, utf8_decode('Sup.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(11, 5, utf8_decode('Neg.'), 'BLR', 0, 'C', 1);
		$pdf->Cell(11, 5, utf8_decode('Rte. m2'), 'BLR', 1, 'R', 1);

		$rowsAemCompTerrenos = AemCompTerrenos::getAemHomologacionByFk($mercado->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 5);
		foreach ($rowsAemCompTerrenos as $fila) {
			$pdf->Cell(6, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(102, 5, utf8_decode($fila->comparable), 'BL', 0, 'L', 0);
			$pdf->Cell(6, 5, '', 'BL', 0, 'R', 0);
			$pdf->Cell(20, 5, number_format($fila->valor_unitario, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, 5, number_format($fila->zona, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, 5, number_format($fila->ubicacion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, 5, number_format($fila->frente, 2, '.', ','), 'BL', 0, 'R', 0);

			$pdf->Cell(10, 5, number_format($fila->forma, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(10, 5, number_format($fila->superficie, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(11, 5, number_format($fila->valor_unitario_negociable, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(11, 5, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(160, 6, utf8_decode('Valor Unitario Promedio ($/m²)'), 'L', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(30, 5, number_format($mercado->valor_unitario_promedio, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(160, 5, utf8_decode('Valor aplicado por m²'), 'BL', 0, 'R', 0);
		$pdf->Cell(30, 5, number_format($mercado->valor_aplicado_m2, 2, '.', ','), 'BLR', 1, 'R', 0);

	}

	private function aemInformacion(&$pdf, $mercado) {
		$pdf->ln(1);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(206, 5, utf8_decode('B) VENTA DE INMUEBLES SIMILARES EN USO AL QUE SE VALUA (sujeto)'), 'TBLR', 1, 'L', 0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(208, 208, 208);
		$pdf->Cell(6, 5, utf8_decode('No.'), 'BLR', 0, 'L', 1);
		$pdf->Cell(130, 5, utf8_decode('Ubicación de la oferta (comparables)'), 'BL', 0, 'L', 1);
		$pdf->Cell(10, 5, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(17, 5, utf8_decode('Teléfono'), 'BL', 0, 'L', 1);
		$pdf->Cell(43, 5, utf8_decode('Fuente/ Antecedentes'), 'BLR', 1, 'L', 1);

		$rowsAemInformacion = AemInformacion::getAemInformacionByFk($mercado->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 6);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->Cell(6, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(130, 5, utf8_decode($fila->ubicacion), 'BL', 0, 'L', 0);
			$pdf->Cell(10, 5, utf8_decode($fila->edad), 'BL', 0, 'C', 0);
			$pdf->Cell(17, 5, utf8_decode($fila->telefono), 'BL', 0, 'L', 0);
			$pdf->Cell(43, 5, utf8_decode($fila->observaciones), 'BLR', 1, 'L', 0);
		}
	}

	private function aemAnalisis(&$pdf, $mercado) {
		$pdf->ln(1);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(206, 4, utf8_decode('Análisis por homologación'), 'TBLR', 1, 'L', 0);
		$pdf->SetFont('Arial', 'B', 8);

		$pdf->Cell(6, 5, utf8_decode(''), 'LR', 0, 'L', 1);
		$pdf->Cell(25, 5, utf8_decode('Precio de Venta'), 'BL', 0, 'C', 1);
		$pdf->Cell(29, 5, utf8_decode('Superficie m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(23, 5, utf8_decode('Valor unitario'), 'BL', 0, 'C', 1);
		$pdf->Cell(98, 5, utf8_decode('Factores de Homologación'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, 5, utf8_decode('Valor unitario'), 'BLR', 1, 'C', 1);
		$pdf->Cell(6, 5, utf8_decode('No'), 'BLR', 0, 'C', 1);
		$pdf->Cell(25, 5, utf8_decode('Inmuebles Sim'), 'BL', 0, 'C', 1);
		$pdf->Cell(14.5, 5, utf8_decode('Terreno'), 'BL', 0, 'C', 1);
		$pdf->Cell(14.5, 5, utf8_decode('Construc.'), 'BL', 0, 'C', 1);
		$pdf->Cell(23, 5, utf8_decode('$/m²'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode('Zona'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode('Ubic'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode('Sup'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode('Edad'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode('Cons'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode('Neg'), 'BL', 0, 'C', 1);
		$pdf->Cell(14, 5, utf8_decode('Fr'), 'BL', 0, 'C', 1);
		$pdf->Cell(25, 5, utf8_decode('Resultante ($/m²)'), 'BLR', 1, 'C', 1);

		$rowsAemInformacion = AemInformacion::getAemAnalisisByFk($mercado->idavaluoenfoquemercado);
		$lID = 0;
		$pdf->SetFont('Arial', '', 7);
		foreach ($rowsAemInformacion as $fila) {
			$pdf->Cell(6, 5, ++$lID, 'BLR', 0, 'C', 0);
			$pdf->Cell(25, 5, number_format($fila->precio_venta, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14.5, 5, number_format($fila->superficie_terreno, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14.5, 5, number_format($fila->superficie_construccion, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(23, 5, number_format($fila->valor_unitario_m2, 2, '.', ','), 'BL', 0, 'R', 0);
			$pdf->Cell(14, 5, number_format($fila->factor_zona, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, 5, number_format($fila->factor_ubicacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, 5, number_format($fila->factor_superficie, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, 5, number_format($fila->factor_edad, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, 5, number_format($fila->factor_conservacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, 5, number_format($fila->factor_negociacion, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(14, 5, number_format($fila->factor_resultante, 2, '.', ','), 'BL', 0, 'C', 0);
			$pdf->Cell(25, 5, number_format($fila->valor_unitario_resultante_m2, 2, '.', ','), 'BLR', 1, 'R', 0);
		}
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, 5, utf8_decode('Valor promedio:'), 'L', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, 5, number_format($mercado->promedio_analisis, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, 5, utf8_decode('Superficie Construida del Sujeto:'), 'BL', 0, 'R', 0);
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(25, 5, number_format($mercado->superficie_construida, 2, '.', ','), 'BLR', 1, 'R', 0);
		$pdf->Ln(1);
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->Cell(181, 5, utf8_decode('Valor comparativo de mercado:'), 'TBL', 0, 'R', 0);
		$pdf->Cell(25, 5, number_format($mercado->valor_comparativo_mercado, 2, '.', ','), 'TBLR', 1, 'R', 1);

	}

	private function avaluoEnfoqueFisico(&$pdf, $idavaluo) {
		
	}

	private function avaluoConclusion(&$pdf, $idavaluo) {
		
	}

	private function avaluoFotos(&$pdf, $idavaluo) {
		
	}

	private function inmuebleSeccionE() {
		
	}

	private function inmuebleSeccionF() {
		
	}

}
