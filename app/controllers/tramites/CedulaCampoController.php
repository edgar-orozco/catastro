<?php

class CedulaCampoController extends \BaseController {



public function index()
	{
		return View::make('corevat/cedulacampo');
	}

	
	public function imprimirCedulaCampo()
	{
	

$pdf = new Fpdf();
$pdf->AddPage();
		$pdf->Image(public_path() . '/css/images/home/banner_cedula.png',28,10,155);
		$pdf->SetMargins(28, 20, 28);
		$pdf->Ln(20);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(155,15,utf8_decode('S O L I C I T U D   D E   I N S P E C C I Ó N'),0,0,'C',0);
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,5,'',0,0,'L',0);
		$pdf->Cell(55,5,utf8_decode('NÚMERO DE CUENTA CATASTRAL:'),0,0,'R',0);
		$pdf->Cell(50,5,'',1,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(20,5,'',0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(20,5,'',0,0,'L',0);
		$pdf->Cell(55,5,'CLAVE CATASTRAL:',0,0,'R',0);
		$pdf->Cell(50,5,'',1,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(20,5,'',0,0,'L',0);
		$pdf->Cell(10,5,'',0,0,'L',0);
		$pdf->Cell(20,5,'',0,0,'L',0);
		$pdf->Cell(55,5,'TIPO PREDIO:',0,0,'R',0);
		$pdf->Cell(50,5,'',1,0,'L',0);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(25,4,'PROPIETARIO:',0,0,'L',0);
		$pdf->Cell(130,4,'',1,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(25,4,utf8_decode('UBICACIÓN:'),0,0,'L',0);
		$pdf->Cell(130,4,'',1,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(25,4,utf8_decode('SUP. TERRENO:'),0,0,'L',0);
		$pdf->Cell(45,4,'',1,0,'L',0);
		$pdf->Cell(5,4,'M2',0,0,'L',0);
		$pdf->Cell(5,4,'',0,0,'L',0);
		$pdf->Cell(25,4,utf8_decode('SUP. CONSTR.:'),0,0,'L',0);
		$pdf->Cell(45,4,'',1,0,'L',0);
		$pdf->Cell(5,4,'M2',0,0,'L',0);
		$pdf->Ln();
		$pdf->Cell(25,4,utf8_decode('USO SUELO:'),0,0,'L',0);
		$pdf->Cell(50,4,'',1,0,'L',0);
		$pdf->Cell(5,4,'',0,0,'L',0);
		$pdf->Cell(25,4,utf8_decode('USO CONSTR.:'),0,0,'L',0);
		$pdf->Cell(50,4,'',1,0,'L',0);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(155,15,utf8_decode('CUERPOS DE CONSTRUCCIÓN'),0,0,'C',0);
		$pdf->Ln();
		$pdf->SetFillColor(200);
		$pdf->Cell(10,6,utf8_decode('Bloque'),1,0,'C',true);
		$pdf->Cell(10,6,utf8_decode('Sup'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Tipo'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Techo'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Muro'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Piso'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Prtas'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Vent'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('I.\nH.'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('I.S.'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('I.El.'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('I.Es.'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Ant'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Edo'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Av'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Uso'),1,0,'C',true);
		$pdf->Cell(9,6,utf8_decode('Niv'),1,0,'C',true);
		$pdf->Ln();
		$pdf->Cell(10,6,'1',1,0,'C',0);
		$pdf->Cell(10,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Cell(9,6,'',1,0,'C',0);
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(30,4,utf8_decode('OBSERVACIONES:'),0,0,'L',0);
		$pdf->Cell(125,20,'',1,0,'C',0);

		$pdf->SetY(250);
		$pdf->Cell(30,10,'Fecha',0,0,'C',0);
		$pdf->Cell(5,10,'',0,0,'C',0);
		$pdf->Cell(65,10,'Nombre',0,0,'C',0);
		$pdf->Cell(5,10,'',0,0,'C',0);
		$pdf->Cell(50,10,'Firma',0,0,'C',0);
		$pdf->Ln();
		$pdf->Cell(30,10,'',1,0,'C',0);
		$pdf->Cell(5,10,'',0,0,'C',0);
		$pdf->Cell(65,10,'',1,0,'C',0);
		$pdf->Cell(5,10,'',0,0,'C',0);
		$pdf->Cell(50,10,'',1,0,'C',0);



		$pdf->AddPage();

$pdf->Image(public_path() . '/css/images/home/banner_cedula.png',28,10,155);

 $pdf->Ln(10);
 $pdf->SetFont('Arial','B',12);
$pdf->Cell(155,15,utf8_decode('C É D U L A      D E      R E G I S T R O       C A T A S T R A L'),0,0,'C',0); 
$pdf->Ln(); 
$pdf->SetFont('Arial','B',8);
$pdf->Cell(20,5,'BRIGADA:',0,0,'L',0);
$pdf->Cell(10,5,'',1,0,'L',0); 
$pdf->Cell(20,5,'',0,0,'L',0); 
$pdf->Cell(55,5,utf8_decode('NÚMERO DE CUENTA CATASTRAL:'),0,0,'R',0); 
$pdf->Cell(50,5,'',1,0,'L',0); 
$pdf->Ln();
$pdf->Cell(20,5,'',0,0,'L',0); 
$pdf->Cell(10,5,'',0,0,'L',0); 
$pdf->Cell(20,5,'',0,0,'L',0); 
$pdf->Cell(55,5,'CLAVE CATASTRAL:',0,0,'R',0); 
$pdf->Cell(50,5,'',1,0,'L',0); 
$pdf->Ln();
$pdf->Cell(20,5,'',0,0,'L',0); 
$pdf->Cell(10,5,'',0,0,'L',0); 
$pdf->Cell(20,5,'',0,0,'L',0); 
$pdf->Cell(55,5,'FOLIO REAL:',0,0,'R',0); 
$pdf->Cell(50,5,'',1,0,'L',0); 
$pdf->Ln();
$pdf->Cell(20,5,'',0,0,'L',0); 
$pdf->Cell(10,5,'',0,0,'L',0); 
$pdf->Cell(20,5,'',0,0,'L',0); 
$pdf->Cell(55,5,'TIPO DE PREDIO:',0,0,'R',0); 
$pdf->Cell(50,5,'  [   ]  SI     [   ]  NO',0,0,'L',0); 
$pdf->Ln();


$pdf->SetFont('Arial','',8);
$pdf->Cell(22,4,'PROPIETARIO:',0,0,'L',0); 
$pdf->Cell(78,4,'________________________________________________',0,0,'L',0); 
$pdf->Cell(10,4,'CURP:',0,0,'L',0); 
$pdf->Cell(45,4,'___________________________',0,0,'L',0); 
$pdf->Ln();
$pdf->Cell(28,4,'TIPO DE VIALIDAD: ',0,0,'L',0); 
$pdf->Cell(45,4,'___________________________',0,0,'L',0); 
$pdf->Cell(35,4,'NOMBRE DE VIALIDAD: ',0,0,'L',0); 
$pdf->Cell(47,4,'____________________________',0,0,'L',0); 
$pdf->Ln();

$pdf->Cell(22,4,utf8_decode('N° EXTERIOR:'),0,0,'L',0); 
$pdf->Cell(20,4,'__________',0,0,'L',0); 
$pdf->Cell(22,4,utf8_decode('N° INTERIOR:'),0,0,'L',0); 
$pdf->Cell(20,4,'___________',0,0,'L',0); 
$pdf->Cell(33,4,'TIPO ASENTAMIENTO:',0,0,'L',0); 
$pdf->Cell(38,4,'______________________',0,0,'L',0); 

$pdf->Ln();
$pdf->Cell(45,4,'NOMBRE DE ASENTAMIENTO:',0,0,'L',0); 
$pdf->Cell(110,4,'____________________________________________________________________',0,0,'L',0); 

$pdf->Ln();
$pdf->Cell(8,4,'C.P.',0,0,'L',0); 
$pdf->Cell(27,4,'_______________ ',0,0,'L',0); 
$pdf->Cell(32,4,'NOMBRE LOCALIDAD: ',0,0,'L',0); 
$pdf->Cell(88,4,'______________________________________________________',0,0,'L',0); 
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B',9);
$pdf->Cell(155,5,utf8_decode('C O N S T R U C C I Ó N      P R E P O N D E R A N T E'),1,0,'C',0); 
$pdf->Ln();
$pdf->SetFont('Arial','B',6);
$pdf->Cell(20,3,'', 'LRT',0,'C',0);
$pdf->Cell(30,3,'','LRT',0,'C',0);
$pdf->Cell(20,3,'TIPOS DE ','LRT',0,'C',0);
$pdf->Cell(40,3,'','LRT',0,'C',0);  
$pdf->Cell(20,3,'TIPOS DE','LRT',0,'C',0);
$pdf->Cell(25,3,'','LRT',0,'C',0);
$pdf->Ln();
$pdf->Cell(20,3,'NIVELES', 'LRB',0,'C',0);
$pdf->Cell(30,3,'TIPOS DE TECHOS','LRB',0,'C',0);
$pdf->Cell(20,3,'MURO','LRB',0,'C',0);
$pdf->Cell(40,3,'TIPOS DE PISOS','LRB',0,'C',0);  
$pdf->Cell(20,3,'PUERTAS','LRB',0,'C',0);
$pdf->Cell(25,3,'TIPOS DE VENTANAS','LRB',0,'C',0);
$pdf->Ln();
$pdf->SetFont('Arial','',6);

$pdf->Cell(20,4,'[   ]  1 ', 'LR',0,'L',0);
$pdf->Cell(30,4,'[   ]  LOZA ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  LADRILLO ', 'LR',0,'L',0);
$pdf->Cell(40,4,'[   ]  CEMENTO ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  MADERA ', 'LR',0,'L',0);
$pdf->Cell(25,4,'[   ]  MADERA ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(20,4,'[   ]  2', 'LR',0,'L',0);
$pdf->Cell(30,4,'[   ]  LAMINA ZINC ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  BLOCK ', 'LR',0,'L',0);
$pdf->Cell(40,4,'[   ]  LOSETA CERAMICA ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  HERRERIA ', 'LR',0,'L',0);
$pdf->Cell(25,4,'[   ]  HERRERIA ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(20,4,'[   ]  3 ', 'LR',0,'L',0);
$pdf->Cell(30,4,'[   ]  LAMINA ASBESTO  ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  LAMINA ', 'LR',0,'L',0);
$pdf->Cell(40,4,'[   ]  MOSAICO ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  ALUMINIO ', 'LR',0,'L',0);
$pdf->Cell(25,4,'[   ]  ALUMINIO ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(20,4,'[   ]  OTROS___ ', 'LR',0,'L',0);
$pdf->Cell(30,4,'[   ]  LAMINA TRASLUCIDA ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  TABLA ', 'LR',0,'L',0);
$pdf->Cell(40,4,'[   ]  TERRENO NATURAL ', 'LR',0,'L',0);
$pdf->Cell(20,4,'', 'LR',0,'L',0);
$pdf->Cell(25,4,'', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(20,4,'', 'LR',0,'L',0);
$pdf->Cell(30,4,'[   ]  POLICARBONATO ', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  CEMENTO ', 'LR',0,'L',0);
$pdf->Cell(40,4,'[   ]  MADERA ', 'LR',0,'L',0);
$pdf->Cell(20,4,'', 'LR',0,'L',0);
$pdf->Cell(25,4,'', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(20,4,'', 'LR',0,'L',0);
$pdf->Cell(30,4,'', 'LR',0,'L',0);
$pdf->Cell(20,4,'[   ]  ADOBE ', 'LR',0,'L',0);
$pdf->Cell(40,4,'[   ]  LOSETA VINILICA O SIMILAR ', 'LR',0,'L',0);
$pdf->Cell(20,4,'', 'LR',0,'L',0);
$pdf->Cell(25,4,'', 'LR',0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',6);
$pdf->Cell(40,4,'USO DE SUELO', 1,0,'C',0);
$pdf->Cell(60,4,'USO DE CONSTRUCCION',1,0,'C',0);
$pdf->Cell(55,4,'GIRO',1 ,0,'C',0);
$pdf->Ln();
$pdf->SetFont('Arial','',6);

$pdf->Cell(40,4,'[   ]  HABITACIONAL ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  HABITACIONAL ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  COMERCIO ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  NO HABITACIONAL ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  NO HABITACIONAL ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  GOBIERNO ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  MIXTO ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  MIXTO ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  SERVICIOS ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  SIN USO ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  LOTE BALDIO ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  EDUCATIVOS (ESCUELAS) ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  OBRA NEGRA ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  SERVICIOS MEDICOS (HOSPITALES ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'', 'LR',0,'L',0);
$pdf->Cell(60,4,'', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  BANCO ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',6);
$pdf->Cell(40,4,utf8_decode('CLASES DE CONSTRUCCIÓN'), 1,0,'C',0);
$pdf->Cell(60,4,'SERVICIOS', 1,0,'C',0);
$pdf->SetFont('Arial','',6);
$pdf->Cell(55,4,'[   ]  HOTEL ', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  PRECARIA ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  AGUA POTABLE  ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  IGLESIA', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  ECONOMICA ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  LUZ ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  RESTAURANTE', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  MEDIA ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  DRENAJE ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  ESTACIONAMIENTO', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  ALTA ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  TELEFONO ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  CINE', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  TV POR CABLE  ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  CLUB', 'LR',0,'L',0);
$pdf->Ln();
$pdf->SetFont('Arial','B',6);
$pdf->Cell(40,4,' INSTALACIONES ESPECIALES ', 1,0,'C',0);
$pdf->SetFont('Arial','',6);
$pdf->Cell(60,4,'[   ]  TV SATELITAL ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  PASTIZAL', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  BOMBA HIDRAULICA ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  BANQUETAS ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  OFICINA DE SERVICIOS PROFESIONALES', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  POZO DE AGUA ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  GUARNICION ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  INDUSTRIAL', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  ALBERCA ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  TRANSPORTE PUBLICO  ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  GANADERIA', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  ESPECTACULARES ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  ALUMBRADO PUBLICO  ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  AGRICOLA', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  SISTEMA DE INCENDIO ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  RECOLECCION DE BASURA ', 'LR',0,'L',0);
$pdf->Cell(55,4,'[   ]  SERVICIOS PUBLICOS', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  CAMARA DE VIGILANCIA  ', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  PAVIMENTO DE CONCRETO HIDRAULICO ', 'LR',0,'L',0);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(55,4,'AGUA', 1,0,'C',0);
$pdf->SetFont('Arial','',6);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  SISTEMA DE RIEGO ', 'LR',0,'L',0);
$pdf->Cell(60,4,'', 'LR',0,'L',0);
$pdf->Cell(55,4,'TIENE MEDIDOR:  [   ]  SI     [   ]  NO', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'[   ]  ANTENA DE COMUNICACIONES  ', 'LR',0,'L',0);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(60,4,utf8_decode('ESTADO DE CONSERVACIÓN '), 1,0,'C',0);
$pdf->SetFont('Arial','',6);
$pdf->Cell(55,4,'NO. MEDIDOR: ________________________________', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  BUENO ', 'LR',0,'L',0);
$pdf->Cell(55,4,'NO. CONTRATO: ______________________________', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'EDAD', 1,0,'C',0);
$pdf->Cell(60,4,'[   ]  REGULAR ', 'LR',0,'L',0);
$pdf->Cell(55,4,'TIPO TOMA:  [   ]  PRINCIPAL     [   ]  DERIVADA', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'', 'LR',0,'L',0);
$pdf->Cell(60,4,'[   ]  MALO ', 'LR',0,'L',0);
$pdf->Cell(55,4,'USUARIO TOMA: ______________________________', 'LR',0,'L',0);
$pdf->Ln();
$pdf->Cell(40,4,'', 'LRB',0,'L',0);
$pdf->Cell(60,4,'[   ]  RUINOSO, SUSCEPTIBLES DE REPARACION ', 'LRB',0,'L',0);
$pdf->Cell(55,4,'_____________________________________________', 'LRB',0,'L',0);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('Arial','B',8);
$pdf->Cell(28,4,'OBSERVACIONES',0,0,'L',0);  
$pdf->Cell(127,4,'________________________________________________________________________________',0,0,'L',0);  
$pdf->Ln();
$pdf->Cell(155,4,'__________________________________________________________________________________________________
',0,0,'L',0);  
$pdf->Ln();

$pdf->SetFont('Arial','B',8);
$pdf->Cell(155,6,'DOMICILIO PARA RECIBIR NOTIFICACIONES',0,0,'C',0);  
$pdf->Ln();
$pdf->SetFont('Arial','',6);
$pdf->Cell(20,4,'CALLE Y NUMERO',0,0,'L',0);  
$pdf->Cell(65,4,'____________________________________________________ ',0,0,'L',0);  
$pdf->Cell(15,4,'COLONIA ',0,0,'L',0);  
$pdf->Cell(55,4,' ____________________________________________',0,0,'L',0);  
$pdf->Ln();

$pdf->Cell(13,4,'MUNICIPIO ',0,0,'L',0);  
$pdf->Cell(102,4,'_____________________________________________________________________________________',0,0,'L',0);  
$pdf->Cell(5,4,'C.P.',0,0,'L',0);  
$pdf->Cell(35,4,'____________________________',0,0,'L',0);  
$pdf->Ln();
$pdf->Cell(30,4,'PERSONA ENTREVISTADA ',0,0,'L',0);  
$pdf->Cell(125,4,'________________________________________________________________________________________________________',0,0,'L',0);  
$pdf->Ln();

$pdf->Cell(30,4,'NOMBRE DE TOPOGRAFO',0,0,'L',0);  
$pdf->Cell(80,4,'__________________________________________________________________ ',0,0,'L',0);  
$pdf->Cell(10,4,'FIRMA',0,0,'L',0);  
$pdf->Cell(35,4,'___________________________',0,0,'L',0);  

$pdf->Ln();
$pdf->Cell(30,4,'NOMBRE DE SUPERVISOR',0,0,'L',0);  
$pdf->Cell(80,4,'__________________________________________________________________',0,0,'L',0);  
$pdf->Cell(10,4,'FIRMA',0,0,'L',0);  
$pdf->Cell(35,4,'___________________________',0,0,'L',0);  
$pdf->Ln();

$pdf->SetFont('Arial','',8);
$pdf->Cell(125,4,utf8_decode('FECHA DE ELABORACIÓN '),0,0,'R',0);  
$pdf->Cell(30,4,'______/______/ 2015',0,0,'R',0);  

$pdf->Ln();


$pdf->Output("CEDULA REGISTRO CATASTRAL 2015b.pdf", "I");
		exit;	

	}

}
