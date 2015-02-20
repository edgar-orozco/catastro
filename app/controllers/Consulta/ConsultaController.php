<?php
class Consulta_ConsultaController extends BaseController {

public function getIndex()
    {
    	$municipio='08';
$resultado = DB::select("select sp_get_predios('','','','','','','','','','')");
//var_dump($resultado);
//$res=_aa_sp_obtiene_predio;
//print_r($resultado);
//echo '</pre>';

foreach ($resultado as $key ) {



$vale[]= explode(',', $key->sp_get_predios);
 //	echo '<br>';
//print_r($vale);



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