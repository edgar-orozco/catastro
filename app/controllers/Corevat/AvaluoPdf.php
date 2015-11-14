<?php

class AvaluoPdf extends \Anouar\Fpdf\Fpdf {

	public $logo_perito;

	public function __construct($orientation = 'P', $unit = 'mm', $size = 'Letter') {
		parent::__construct($orientation, $unit, $size);
		$this->SetFillColor(164, 164, 164);
		$this->logo_perito = public_path() . "/css/images/corevat/user-big-blank.jpg";
	}

	function Header() {
		$this->Image(public_path() . "/css/images/corevat/crv-01.jpg", null, null, 130, 25);
		$this->Image($this->logo_perito, 170, 10, 30, 25);
		$this->Ln(5);
	}

	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial', 'I', 8);
		$this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
	}



}
