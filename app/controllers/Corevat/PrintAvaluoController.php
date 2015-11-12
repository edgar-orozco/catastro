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
		$pdf->Cell(70, 5, utf8_decode(trim($avaluo->titulo_solicitante) . " " . $avaluo->nombre_solicitante), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(20, 5, utf8_decode("Propietario: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(70, 5, utf8_decode(trim($avaluo->titulo_propietario) . " " . $avaluo->nombre_propietario), 'LBR', 1, 'L');

		$this->avaluoCaracteristicasZona($pdf, $id);






		$pdf->Ln(2);
		$pdf->SetFont('Arial', '', 22);
		for ($i = 1; $i <= 400; $i++) {
			$pdf->Cell(0, 10, 'Line ' . $i, 0, 1);
		}
		$pdf->Output();
		exit;
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

		// INMUEBLE
		$in = AvaluosInmueble::getAvaluoInmuebleByIdForPdf($id);

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
		$pdf->Cell(65, 5, utf8_decode($in->usos_suelos), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Serv. y Restric.: "), 'TB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(65, 5, substr(utf8_decode($in->servidumbre_restricciones), 0, 81), 'LBR', 1, 'L');

		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(30, 5, utf8_decode("Niveles de la Unidad: "), 'LB', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(50, 5, utf8_decode($in->nivel), 'LB', 0, 'L');
		$pdf->SetFont('Arial', 'B', 7);
		$pdf->Cell(40, 5, utf8_decode("Unidades rentables en la misma estructura: "), 'B', 0, 'R');
		$pdf->SetFont('Arial', '', 7);
		$pdf->Cell(70, 5, utf8_decode($in->unidades_rentables_escritura), 'LBR', 1, 'L');







/*
123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_123456789_ */








		//$pdf->Ln(15);

	}
	
}
