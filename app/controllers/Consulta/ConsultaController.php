<?php
class Consulta_ConsultaController extends BaseController {

public function getIndex()
    {
$resultado = DB::select("select _aa_sp_obtiene_predio('08', '')");
//var_dump($resultado);
//$res=_aa_sp_obtiene_predio;
//print_r($resultado);
//echo '</pre>';

foreach ($resultado as $key ) {



$vale[]= explode(',', $key->_aa_sp_obtiene_predio);
 //	echo '<br>';
//print_r($val);



//$nueva_cadena = str_replace('()','', $vale);


//$val= str_replace('(', '',$vale);
//$val= str_replace(')', '',$vale);
//var_dump($nueva_cadena);

}


//echo 'hola'.$resultado[0];

//
 //p($res);
 return View::make('consulta.consulta', compact('vale'));
	}
}