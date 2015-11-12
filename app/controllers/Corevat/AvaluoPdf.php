<?php

class AvaluoPdf extends \Anouar\Fpdf\Fpdf {

	public function __construct($orientation = 'P', $unit = 'mm', $size = 'A4') {
		parent::__construct($orientation, $unit, $size);
		$this->SetFillColor(164, 164, 164);
	}
	function Header() {
		$this->Image(public_path() . "/css/images/corevat/crv-01.jpg", 5, 5, 139.57, 26.20);
		$this->Ln(25);
	}

	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
	}
}
