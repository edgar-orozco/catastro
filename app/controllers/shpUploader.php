<?php 
error_reporting(E_ERROR);

use \ShapeFile;

class shpUploader extends \BaseController
{

	var $logUpload;
	var $logUpOk;
	var $logUpError;
	var $logUpWarning;
	var $countOk;
	var $countErr;
	var $countWar;
	var $status;
	var $municipio_name;

	public function uploadShape($municipio, $manzana, $dirzip, $dirtmp, $zipfile){

		$this->municipio_name = $this->num2str($municipio);
		$logHead = "Actualizando Cartografia de la manzana [".$municipio."-".$manzana."] Municipio ".$this->municipio_name." 
				 (".date('l jS \of F Y h:i:s A').") 
				";
		//$dirzip = "/var/www/html/app/storage/shapes/";

		$zip = new ZipArchive;
		$res = $zip->open($dirzip.$zipfile);
		if ($res === TRUE) {
		  $zip->extractTo($dirtmp);
		  $zip->close();

		  	$countOk = 0;
		  	$countErr = 0;
		  	$countWar = 0;

		  	$logUpError = "";
		  	$logUpWarning = "";
		  	$logUpOk = "";

			$this->countErr=0;
			$this->countWar=0;
			$this->countOk=0;

			$query = "select count(*) as cuantos from construcciones where clave_catas like '".$manzana."%' and geom is NULL";

			$result = DB::select($query);
	        	$logHead .= "Existen ".$result[0]->cuantos." registros de construcción sin geometria";

			$this->status = true;
			$this->shp2db($municipio,$manzana,$dirtmp,"M",array('/^[0-9]{3,3}-[0-9]{4,4}$/'), array('cve','clave'));
				$countOk += $this->countOk; $countErr += $this->countErr; $countWar += $this->countWar;
				if($this->countErr > 0) $logUpError = "Errores MANZANA [".$this->countErr."]\n".$this->logUpError; $this->logUpError = "";
				if($this->countWar > 0) $logUpWarning = "Avisos MANZANA [".$this->countWar."]\n".$this->logUpWarning; $this->logUpWarning = "";
				$this->countErr=0; $this->countWar=0; $this->countOk=0;

			$this->shp2db($municipio,$manzana,$dirtmp,"P",array('/^[0-9]{3,3}-[0-9]{4,4}-[0-9]{6,6}$/','/^[0-9]{1,6}$/'), array('cve','clave'));
				$countOk += $this->countOk; $countErr += $this->countErr; $countWar += $this->countWar;
				if($this->countErr > 0) $logUpError .= "Errores PREDIOS [".$this->countErr."]\n".$this->logUpError; $this->logUpError = "";
				if($this->countWar > 0) $logUpWarning .= "Avisos PREDIOS [".$this->countWar."]\n".$this->logUpWarning; $this->logUpWarning = "";
				$this->countErr=0; $this->countWar=0; $this->countOk=0;

			$this->shp2db($municipio,$manzana,$dirtmp,"C",array('/^[0-9]{1,3}$/'), array('nivel'));
				$countOk += $this->countOk; $countErr += $this->countErr; $countWar += $this->countWar;
				if($this->countErr > 0) $logUpError .= "Errores CONSTRUCCIONES [".$this->countErr."]\n".$this->logUpError; $this->logUpError = "";
				if($this->countWar > 0) $logUpWarning .= "Avisos CONSTRUCCIONES [".$this->countWar."]\n".$this->logUpWarning; $this->logUpWarning = "";
				$this->countErr=0; $this->countWar=0; $this->countOk=0;

		} else {
		  $this->updateLog(1,"No se puede abrir el archivo ".$zipFile,true);
		}



		$logCount = "Movimientos Correctos [".$countOk."]\n";
		$logCount .= "Errores [".$countErr."]\n";
		$logCount .= "Avisos [".$countWar."]\n";

		$result = DB::select($query);
        	//if ($result[0]->cuantos != 0) 
        		$logCount .= "Quedan ".$result[0]->cuantos." registros de construcción sin geometria \n";

		$logUpload = $logHead."\n".$logCount."\n";

		//if(strlen($logUpError) > 0) $logUpload.= "\n".$logUpError;
		//if(strlen($logUpWarning) > 0) $logUpload.= "\n".$logUpWarning;
		//$logUpload.= "\n";

		$logFile = fopen($dirzip."logUpload.log", "a+");
		fwrite($logFile,  PHP_EOL . PHP_EOL . $logHead. PHP_EOL);
		fwrite($logFile,  "[".$zipfile."]". PHP_EOL);
		fwrite($logFile,  $this->logUpload. PHP_EOL ."------------------------------------------------------------------------------------");
		fclose($logFile);

		return array($logUpload, $logUpError, $logUpWarning);

	}

	public function shp2db($municipio,$manzana,$dirtmp, $layer, $expReg, $fieldNames){
		if($this->status == false) return;

		$shapeName = $manzana."-".$layer.".shp";
		$shape_File = $dirtmp.$shapeName;

		$this->updateLog(0,"Procesando ".$shapeName,true);

		if (!file_exists($shape_File)) {
			$this->updateLog(1,"No se Encontró ".$shape_File,false);
			return;
		}

		$shp = new ShapeFile($shape_File); 

		if($shp->shp_type != 5) {
			$this->updateLog(1,"No se encontraron elementos cerrados en ".$shapeName,false);
			return;
		}

		set_time_limit(160);
		$field_num = $shp->dbf->dbf_num_field;
		$num_campo = -1;
		$validaciones = count($fieldNames);

		for($j=0; $j<$field_num; $j++){
			$nombre_campo = $shp->dbf->dbf_names[$j]['name'];
			for($field=0;$field < $validaciones; $field++){
				if(strstr(strtolower($nombre_campo),$fieldNames[$field])){
					$num_campo = $j;					
					$atributo = $nombre_campo;					
					break;
				} 
			}
		}

		if($num_campo == -1) {
			$this->updateLog(1,"No se encontro un atributo valido en la tabla de datos",false);
			return;
		}

		for($RECID=0;$RECID < $shp->dbf->dbf_num_rec;$RECID++){

		    $row = $shp->dbf->getRow($RECID);
		    $valor_campo = $row[$num_campo];
		    $valid = true;

			if ($valor_campo == "0" || $valor_campo == "" || empty($valor_campo)) {
				$this->updateLog(1,"[".$RECID."] El Valor del atributo, no puede estar vacio ni ser 0.",true);
	    		$valid = false;
			}
			if($valid){
				$valid = false;
				for($v = 0; $v < count($expReg); $v++){
					if (preg_match($expReg[$v], $valor_campo)) {
			    		$valid = true;
			    		break;
					}
				}
				if(!$valid) $this->updateLog(1,"[".$RECID."] La estructura del campo ".$atributo." [".$valor_campo."] no es correcto.",true);
			}

			if($valid && $layer != "C"){
				if(!strstr($valor_campo, $manzana)){
					$this->updateLog(1,"[".$RECID."] La clave de manzana en el atributo [".$valor_campo."] no corresponde a la manzana [".$manzana."] que se está actualizando.",true);
		    		$valid = false;
				}
			}

			if($valid){
				$geometria =  $this->extractGeom($shp->records[$RECID],$valor_campo);
				if($geometria[1]== "ok"){
					$geom = $geometria[0];
					$centroide = $geometria[2];
					if($layer == "M") $this->dbManzana($municipio,$valor_campo,$geom, $manzana, $centroide);
					if($layer == "P") $this->dbPredio($municipio,$valor_campo,$geom, $manzana, $centroide);
					if($layer == "C") $this->dbConstruccion($municipio,$valor_campo,$geom, $manzana, $centroide);
				}else{
					$this->updateLog(1,"[".$RECID."] ".$geometria[1],true);
				}
		    }

		    $shp->fetchNextRecord();
		}

	}	    


	protected function extractGeom($record,$valor_campo){
		$centroide = 0;
		$mensaje = "ok";
		$cshp = $record->shp_data;
		$wkt = array();
		$wkt[] = '('.ImplodeParts($cshp['parts']).')';
		$geom = 'MULTIPOLYGON('.implode(', ', $wkt).')';

		try {
			$result = DB::select('select st_astext(ST_PointOnSurface(?)) as centroide', array($geom));
	        if (count($result) == 0) {
				$mensaje ="No se logró calcular un punto dentro del elemento, probablemente haya un error en la topologia";
			}else{
	        	$centroide = $result[0]->centroide;
			}
		}catch(\Exception $e){
			$mensaje ="[".$valor_campo."] Se produjo el siguiente error al validar la topologia del elemento: ".$e->getMessage();
		}

		return array($geom, $mensaje, $centroide);

	}

	protected function updateLog($tipo,$msg,$status){
		$tipos = array('','ERROR: ','AVISO: ', '');
		$cadena = $tipos[$tipo].$msg."\n";

		$logFile = fopen("/var/www/html/app/storage/logs/logshape.log", "a+");
		fwrite($logFile,  $cadena. PHP_EOL);
		fclose($logFile);


		$this->status = $status;
		$this->logUpload .= $cadena;

		switch ($tipo){
			case 1:
				$this->logUpError .= "     ".$cadena;
				$this->countErr++;
				break;
			case 2:
				$this->logUpWarning .= "     ".$cadena;
				$this->countWar++;
				break;
			case 3:
				$this->logUpOk .= "     ".$cadena;
				$this->countOk++;
		}

	}

	protected function dbManzana($municipio, $clave, $geom, $manzana, $centroide){
		$tabla = "manzanas";

		$geoDatos = $this->getDatabyCentroide('municipios', 'nombre_municipio', $centroide);
		$gid = $geoDatos[0];
		$claveTb = $geoDatos[1];
		$municipioTb = $geoDatos[2];

		if($gid != 0 && strcmp($municipio, $municipioTb) != 0){

			$this->updateLog(1,"Geográficamente la Manzana se localiza en el municipio '".$claveTb."'",false);
			return;
		}

		$gid = $this->getGidbyClave('manzanas',$municipio, 'cve_manzana', $clave);

		if ($gid != 0){
			$result = DB::update('update manzanas set geom =  ST_GeomFromText(?,32615) where gid = ?', array($geom,$gid));
			if(!$result){
				$this->updateLog(1,"No se logró actualizar la manzana",false);
			}else{
				$this->updateLog(3,"Manzana ".$clave." Actualizada.",true);
			}
		}else{
			$result = DB::update('insert into manzanas (municipio, cve_manzana, geom) VALUES (?,?,ST_GeomFromText(?,32615))', array($municipio,$manzana,$geom));
			if(!$result){
				$this->updateLog(1,"No se logró actualizar la manzana",false);
			}else{
				$this->updateLog(3,"Se agregó la Manzana ".$clave.".",true);
			}
		}

	}

	protected function dbPredio($municipio, $clave, $geom, $manzana, $centroide){
		$continuar = true;
	    $localizado = false;
	    $clave_catas = $clave;

		// buscamos por clave catastral	
			$gid = $this->getGidbyClave('predios',$municipio, 'clave_catas', $clave);
		//si se localizó, se actualiza geometria 
			if($gid != 0){
				$result = DB::update('update predios set geom =  ST_GeomFromText(?,32615), fecha_umod = current_timestamp where gid = ?', array($geom,$gid));
				if(!$result){
					$this->updateLog(1,"No se logró actualizar el predio [".$clave."]",false);
				}else{
					$this->updateLog(3,"Predio ".$clave." Actualizado.",true);
				}
				return;
			}

		// Si no se encontró por clave catastral, Buscamos por centroide
			$geoDatos = $this->getDatabyCentroide('predios', 'clave_catas', $centroide);
			$gid = $geoDatos[0];
			$claveTb = $geoDatos[1];
			$municipioTb = $geoDatos[2];

		//si se localizó, se actualiza geometria y clave_catas
			if($gid != 0){
				$sql = 'update predios set clave_catas = ? , municipio = ?, geom =  ST_GeomFromText(?,32615), fecha_umod = current_timestamp where gid = ?';
				$result = DB::update($sql, array($clave, $municipio, $geom,$gid));
				$this->updateLog(0,"[".$sql."]-[".$clave."],[".$municipio."],[".$geom."],[".$gid."]",true);

				if(!$result){
					$this->updateLog(1,"No se logró actualizar el predio [".$clave."]",false);
				}else{
					$msg = "Predio ".$clave." Actualizado por Ubicación.";
					$alerta = 2;
					if($clave != $claveTb) {
						$msg .= " - Clave Catastral [".$claveTb."] sustituida.";
					}
					if($municipio != $municipioTb) {
						$msg .= " - Municipio [".$municipioTb."] sustituido.";
					}

					$this->updateLog($alerta,$msg,true);
				}
				return;
			}

		//si no se localizó, lo insertamos	
			$result = DB::insert('insert into predios (municipio, clave_catas, geom, fecha_ingr) VALUES (?,?,ST_GeomFromText(?,32615),current_timestamp)', array($municipio,$clave,$geom));
			if(!$result){
				$this->updateLog(1,"No se logró agregar el predio [".$clave."]",false);
			}else{
				$msg = "Predio ".$clave." Agregado.";
				$this->updateLog(3,$msg,true);
			}

	}	

	protected function dbConstruccion($municipio, $nivel, $geom, $manzana, $centroide){
		$continuar = true;
	    $localizado = false;
	    $geomnull = false;
	    $clave_catas = "";

        //revisamos si existe la construcción
		$geoDatos = $this->getDatabyCentroide('construcciones', 'clave_catas', $centroide);
		$gid = $geoDatos[0];
		$clave_catas = $geoDatos[1];

		if($gid == 0){
			$geoDatos = $this->getDatabyCentroide('predios', 'clave_catas', $centroide);
			$gid_predio = $geoDatos[0];
			$clave_catas = $geoDatos[1];
	
			$result = DB::select('select gid from construcciones where gid_predio = ? and nivel = ? and geom is NULL', array($gid_predio,$nivel));
	        if (count($result) != 0) {
				$gid = $result[0]->gid;
				$localizado = true;
				$geomnull = true;
			}
		}else $localizado = true;

	    //Calculamos superficie de construccion
	    $superficie = $this->getArea($geom);

		if ($localizado){
			$result = DB::update('update construcciones set nivel = ?, sup_const = ?, geom =  ST_GeomFromText(?,32615), updated_at = current_timestamp where gid = ?', array($nivel, $superficie, $geom,$gid));
			if(!$result){
				$this->updateLog(1,"No se logró actualizar la construción  [".$nivel."] del predio [".$clave_catas."]->[".$result."]",true);
				//$this->updateLog(0,"gid= [".$gid."] superficie [".$superficie."] geom [".$geom."]",true);
			}else{
				$alerta = 3;
				$mensaje = "Construcción con nivel [".$nivel."] del predio [".$clave_catas."] Actualizado.";
				if($geomnull){
					$alerta = 2;
					$mensaje .= " [GEOM = null -> actualizado]";
				}
				$this->updateLog($alerta,$mensaje,true);
			}
			return;
		}

		$sql="insert into construcciones (entidad, municipio, clave_catas, gid_predio, nivel, sup_const, edad_const, id_tuc, id_tcc, id_ttc, id_tec, id_tmc, id_tpic, id_tpuc, id_tvc, created_at, updated_at, geom)";
		$sql.=" VALUES ('27',?,?,?,?,?,0,1,1,1,1,1,1,1,1,current_timestamp,current_timestamp,ST_GeomFromText(?,32615))";

		if($gid_predio != 0){
			$result = DB::insert($sql, array($municipio,$clave_catas,$gid_predio,$nivel,$superficie,$geom));
			if(!$result){
				$this->updateLog(1,"No se logró agregar la constrúcción de nivel [".$nivel."] del predio [".$clave_catas."]",false);
			}else{
				$msg = "Construcción [".$nivel."] del predio [".$clave_catas."] Agregada.";
				$this->updateLog(3,$msg,true);
			}
		}else{
			$this->updateLog(1,"No se localizó predio que contenga la Construcción con nivel [".$nivel."].",false);
		}

	}

	protected function getArea($geom){
		$area = 0.0;
		$result = DB::select('select st_area(ST_GeomFromText(?,32615)) as area', array($geom));
        if (count($result) != 0) {
        	$area = $result[0]->area;
		}
		return $area;
	}

	protected function getGidbyClave($tabla,$municipio, $campoClave, $valor){
		$gid = 0;
		$seed = 'select gid from TABLE where CAMPOCLAVE = ? and municipio = ?';
		$searched = array('TABLE','CAMPOCLAVE');
		$replaced = array($tabla,$campoClave);
		$sql = str_replace($searched, $replaced, $seed);
		$result = DB::select($sql, array($valor,$municipio));
        if (count($result) == 0) {
			$this->updateLog(2,"No se encontro [".$valor."] en la tabla [".$tabla."] en el municipio[".$municipio."]",true);
		}else{
        	$gid = $result[0]->gid;
		}
		return $gid;
	}

	protected function getDatabyCentroide($tabla, $campoClave, $centroide){
		$gid = 0;
		$clave = "";
		$municipio = "";

		$seed = 'select gid, CAMPOCLAVE as clave, municipio from TABLE where ST_Contains(geom, ST_SetSRID(st_geomfromtext(?),32615))';
		$searched = array('TABLE','CAMPOCLAVE');
		$replaced = array($tabla,$campoClave);
		$sql = str_replace($searched, $replaced, $seed);

		$result = DB::select($sql, array($centroide));
        if (count($result) == 0) {
			$this->updateLog(0,"No encontraron elementos que contengan este centroide en la tabla [".$tabla."]",true);
		}else{
        	$gid = $result[0]->gid;
        	$clave = $result[0]->clave;
        	$municipio = $result[0]->municipio;
			//$this->updateLog(3,implode(",",array($gid,$clave,$municipio)),true);
		}
		return array($gid,$clave,$municipio);
	}

	protected function num2str($municipio){
		$municipio_name = "Desconocido";
		switch ($municipio){
			case "001":
				$municipio_name = "Balancán";
				break;
			case "002":
				$municipio_name = "Cárdenas";
				break;
			case "003":
				$municipio_name = "Centla";
				break;
			case "004":
				$municipio_name = "Centro";
				break;
			case "005":
				$municipio_name = "Comalcalco";
				break;
			case "006":
				$municipio_name = "Cunduacán";
				break;
			case "007":
				$municipio_name = "Emiliano Zapata";
				break;
			case "008":
				$municipio_name = "Huimanguillo";
				break;
			case "009":
				$municipio_name = "Jalapa";
				break;
			case "010":
				$municipio_name = "Jalpa de Méndez";
				break;
			case "011":
				$municipio_name = "Jonuta";
				break;
			case "012":
				$municipio_name = "Macuspana";
				break;
			case "013":
				$municipio_name = "Nacajuca";
				break;
			case "014":
				$municipio_name = "Paraíso";
				break;
			case "015":
				$municipio_name = "Tacotalpa";
				break;
			case "016":
				$municipio_name = "Teapa";
				break;
			case "017":
				$municipio_name = "Tenosique";
				break;
		}
		return $municipio_name;
	}


}

		function ImplodeParts($parts)
		{
			$wkt = array();
			foreach ($parts as $part) {
				$wkt[] = ImplodePoints($part['points']);
			}
			return implode(', ', $wkt);
		}

		function ImplodePoints($points)
		{
			$wkt = array();
			foreach ($points as $point) {
				$wkt[] = $point['x'].' '.$point['y'];
			}
			return '('.implode(', ', $wkt).')';
		}


?>