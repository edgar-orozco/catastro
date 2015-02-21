<?php

class ConsultaAjax2 extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{

	$tabla=Input::get('tabla');
		$columna=Input::get('columna');
		$valor = Input::get('valor');
		$valor1= Input::get ('valor1');
		$columna1=Input::get('columna1');
		$valor2= Input::get ('valor2');
		$columna2=Input::get('columna2');		
	#	if(empty($valor2)){
	#		$valor2 = 'nada';
	#	}else {
 	#	   $valor2 = $valor2;
	#	}
		$denominador=Input::get('denominador');
		$nombre=Input::get('nombre');
		$tipo=Input::get('tipo');
		$dbconn = pg_connect("host=127.0.0.1 dbname=catastro user=postgres") or die('No se ha podido conectar: ' . pg_last_error());
		$sql;
		
		

		if($valor2 == "1"){
			
			$sql="select a.gid,a.cve_manzana from (select gid,cve_manzana,ST_Centroid(geom) as geom from manzanas)as a, localidades_a b where ST_Contains(b.geom, a.geom) and b.nombre='$valor' order by a.cve_manzana";
		}
		elseif ($valor2 == "2"){
		
			$sql="select distinct $denominador,$nombre from $tabla where $columna = '$valor' and $columna1 = '$valor1'";
		
		}
		elseif($valor2 == "3"){
			$sql="select distinct $denominador,$nombre from $tabla where $columna = '$valor'";
		}else{
			$sql="select distinct $denominador,$nombre from $tabla ORDER BY $nombre";
		}
		
		$result = pg_query($sql) or die('La consulta fallo: ' . pg_last_error());
		
		$xml = new SimpleXMLElement('<xml/>');
		$escribes = $xml->addChild('tipos');
		
		if ($result){
		
			$count=0;
			$escribe = $escribes->addChild($tipo);
			$escribe->addAttribute('cp', '0');
			$escribe->addAttribute('nombre', 'Seleccione---');
			$escribe->addAttribute('id_col', '123');
			while ($line0 = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				$count++;
				$escribe = $escribes->addChild($tipo);
				$escribe->addAttribute('cp', $line0[$denominador]);
				$escribe->addAttribute('nombre', $line0[$nombre]);
				$escribe->addAttribute('id_col', '123');
				
			}
		}
		$escribes->saveXML();
		pg_free_result($result);
		pg_close($dbconn);
		return Response::make($escribes->asXML(), '200')->header('Content-Type', 'text/xml');


	}	


	public function create()
	{
	$hue = Input::get('huevos');
	 return "Nacos y Putos Con: $hue";

	//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$tabla=Input::get('tabla');
		$columna=Input::get('columna');
		$valor = Input::get('valor');
		$valor1= Input::get ('valor1');
		$columna1=Input::get('columna1');
		$valor2= Input::get ('valor2');
		$columna2=Input::get('columna2');		
		#if(empty($valor2)){
		#	$valor2 = 'nada';
		#}else {
 		 #  $valor2 = $valor2;
		#}
		$denominador=Input::get('denominador');
		$nombre=Input::get('nombre');
		$tipo=Input::get('tipo');
		$dbconn = pg_connect("host=127.0.0.1 dbname=catastro user=postgres") or die('No se ha podido conectar: ' . pg_last_error());
		$sql;
		
		

		if($valor2 == "1"){
		$sql="select a.gid,a.cve_manzana from (select gid,cve_manzana,ST_Centroid(geom) as geom from manzanas)as a, localidades_a b where ST_Contains(b.geom, a.geom) and b.nombre='$valor' order by a.cve_manzana";
		#	$sql="select a.gid,a.cve_manzana from (select gid,cve_manzana,ST_Centroid(geom) as the_geom from manzanas)as a, localidades_a b where ST_Contains(b.the_geom, a.the_geom) and b.nombre='$valor' order by a.cve_manzana;";
		
		}
		elseif ($valor2 == "2"){
		
			$sql="select distinct $denominador,$nombre from $tabla where $columna = '$valor' and $columna1 = '$valor1'";
		
		}
		elseif($valor2 == "3"){
			$sql="select distinct $denominador,$nombre from $tabla where $columna = '$valor'";
		}else{
			$sql="select distinct $denominador,$nombre from $tabla ORDER BY $nombre";
		}
		
		$result = pg_query($sql) or die('La consulta fallo: ' . pg_last_error());
		
		$xml = new SimpleXMLElement('<xml/>');
		$escribes = $xml->addChild('tipos');
		
		if ($result){
		
			$count=0;
			$escribe = $escribes->addChild($tipo);
			$escribe->addAttribute('cp', '0');
			$escribe->addAttribute('nombre', 'Seleccione---');
			$escribe->addAttribute('id_col', '123');
			while ($line0 = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				$count++;
				$escribe = $escribes->addChild($tipo);
				$escribe->addAttribute('cp', $line0[$denominador]);
				$escribe->addAttribute('nombre', $line0[$nombre]);
				$escribe->addAttribute('id_col', '123');
				
			}
		}
		$escribes->saveXML();
		pg_free_result($result);
		pg_close($dbconn);
		return Response::make($escribes->asXML(), '200')->header('Content-Type', 'text/xml');
	}


	/**
	 * Display the specified resource.
	 *
	 * @Input::get  int  $id
	 * @return Response
	 */

	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @Input::get  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @Input::get  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @Input::get  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
