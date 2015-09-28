<?php
class PMap extends \BaseController
{

    var $map;
    var $xdelta_geo;
    var $ydelta_geo;
    var $geo_scale;
    var $old_geo_scale;
    var $geoext0;
    var $GEOEXT;
    var $mapwidth;
    var $mapheight;
    var $refW;
    var $refH;    
    var $refBoxStr;
    var $historyBack;
    var $historyFwd;
    var $msVersion;
    var $layers;    
    
    /**
     * Constructor
     */
    public function __construct($map)
    {
        $this->map = $map;
        $this->msVersion = '6.2.1'; 
    }
    
    /**
     * Main function to launch all methgods in right order
     */
    public function pmap_create()
    {
        $this->pmap_addCustomLayers();
        $this->pmap_getLayers();
        $this->pmap_setLayersOnOff();
        $this->pmap_setGeoExt();
        $this->pmap_setMapWH();
        $this->pmap_createMap();
        $this->pmap_createMapImage();
    }
    
    
    /**
     * Add custom layers (URL layer)
     */
    protected function pmap_addCustomLayers()
    {
        if (isset($_REQUEST['url_points'])) {
            if (count($_REQUEST['url_points']) > 0) {
                $urlLayer = new UrlLayer($this->map);
            }
        }
    }
    
    
    /**
     * Return the URL to map image
     */
    public function pmap_returnMapImgURL()
    {
        return $this->mapURL;
    }
    
    public function pmap_returnScalebarImgURL()
    {
        return $this->scalebarURL;
    }

    /**
     * Create JavaScript variables from PHP variables
     */
    public function pmap_returnMapJSParams()
    {
        $this->xdelta_geo = $this->GEOEXT["maxx"] - $this->GEOEXT["minx"];
        $this->ydelta_geo = $this->GEOEXT["maxy"] - $this->GEOEXT["miny"];
        
        $this->pmap_getRefBoxStr();
        
        //$no_dd = ($this->map->units != 5 ? 0 : 1);        
        $mstr['mapW'] = $this->mapwidth;
        $mstr['mapH'] = $this->mapheight;
        $mstr['refW'] = $this->refW;
        $mstr['refH'] = $this->refH;    
        $mstr['minx_geo'] = $this->GEOEXT["minx"];
        $mstr['miny_geo'] = $this->GEOEXT["miny"];
        $mstr['maxx_geo'] = $this->GEOEXT["maxx"];
        $mstr['maxy_geo'] = $this->GEOEXT["maxy"];
        $mstr['xdelta_geo'] = $this->xdelta_geo;
        $mstr['ydelta_geo'] = $this->ydelta_geo;
        $mstr['refBoxStr'] = $this->refBoxStr;

        return $mstr;
    }
    
    /**
     * Return the pan string for the reference box
     */

    public function pmap_returnMapW()
    {
        return $this->mapwidth;
    }
    
    public function pmap_returnMapH()
    {
        return $this->mapheight;
    }

    /**
     * Return the scale
     */
    public function pmap_returnGeoScale()
    {
        return number_format(round($this->geo_scale, -1), 0, '', '');
    }
    

    /**
     * SWITCH ON/OFF LAYERS (READ FROM URL || SID)
     */
    public function pmap_getLayers() 
    {
        if (isset($_REQUEST["groups"])) {
            $drawLayerStr = $_REQUEST["groups"];
            //$this->layers = explode(",", $drawLayerStr);
            $this->layers = $_REQUEST["groups"];
        } else {
            $this->layers = array("manzanas","predios","construcciones","entidades","municipios","localidades","carreteras","calles","rios","hipsografico","predio_ubicado_1");
        }
    }


    public function pmap_setLayersOnOff(){

        $conn = Config::get('database.connections.pgsql');
        $host = $conn['host'];
        $database = $conn['database'];
        $username = $conn['username'];
        $password = $conn['password'];
        $connectionString = "user='$username' password='$password' dbname='$database' host=$host port=5432";

		$numLayers = $this->map->numlayers;
		
		for ($iLayer = 0 ; $iLayer < $numLayers ; $iLayer++) {
			$msLayer = $this->map->getLayer($iLayer);
			$msLayer ->set('status', MS_OFF);
            if($msLayer->connectiontype == MS_POSTGIS){
               $msLayer->set("connection", $connectionString);
            }
		}
        
        foreach ($this->layers as $layerName){
            $msLayer = $this->map->getLayerByName($layerName);
			$msLayer ->set('status', MS_ON);
        }
    }
    

    /**
     * Set extents of geoext-object:
     * - from map file if first called
     * - from SID for next calls
     */
    protected function pmap_setGeoExt()
    {
        // 2nd or higher call
        if (isset($_REQUEST["GEOEXT"])) {
            $this->GEOEXT["minx"] = $_REQUEST["GEOEXT"][0];
            $this->GEOEXT["miny"] = $_REQUEST["GEOEXT"][1];
            $this->GEOEXT["maxx"] = $_REQUEST["GEOEXT"][2];
            $this->GEOEXT["maxy"] = $_REQUEST["GEOEXT"][3];
            
            //$this->GEOEXT = $_REQUEST["GEOEXT"];
            $this->geoext0 = ms_newrectObj();
            $this->geoext0->setExtent($this->GEOEXT["minx"],$this->GEOEXT["miny"],$this->GEOEXT["maxx"],$this->GEOEXT["maxy"]);
        
            //$this->old_geo_scale = $_REQUEST["geo_scale"];
        
        } else {
            // Extent set via URL
            if (isset($_REQUEST['zoom_extparams'])) {
                $ext = $_REQUEST['zoom_extparams'];
                $this->map->setExtent($ext[0], $ext[1], $ext[2],$ext[3]);
                
                $this->geoext0 = ms_newrectObj();
                $this->geoext0->setExtent($ext[0], $ext[1], $ext[2],$ext[3]);
            
            // Initial start
            } else {
                $this->geoext0 = $this->map->extent;
            }
            
            $this->GEOEXT["minx"] = $this->geoext0->minx;
            $this->GEOEXT["miny"] = $this->geoext0->miny;
            $this->GEOEXT["maxx"] = $this->geoext0->maxx;
            $this->GEOEXT["maxy"] = $this->geoext0->maxy;
        
            // calculate scale
            $dpi = $this->map->resolution;
            $mapW = $_REQUEST["mapW"];
            $this->old_geo_scale = ($mapW /($this->GEOEXT["maxx"] - $this->GEOEXT["minx"])) / (0.0254 / $dpi);
            
            $this->historyBack = array();
            $this->historyFwd = array();
        }
    }



    /**
     * MAP DIMENSION X/Y
     */
    protected function pmap_setMapWH()
    {
        $this->mapwidth = $_REQUEST["mapW"];
        $this->mapheight = $_REQUEST["mapH"];
        $this->map->set("width", $this->mapwidth);
        $this->map->set("height", $this->mapheight);
    }


    
    /**
     * SET HISTORY EXTENTS IN ARRAYS FOR BACK AND FORWARD 
     */
    protected function pmap_setHistory()
    {
        $maxHistory = 8; // <===== ADAPT IF NECESSARY <=====
        
        
        // Compare new with old extent (just take minx and maxy)
        // if different: add new extent to history
        if ($this->GEOEXT["minx"] != $this->OLDGEOEXT["minx"] && $this->GEOEXT["maxy"] != $this->OLDGEOEXT["maxy"] && is_array($this->OLDGEOEXT)) {
            if ($_REQUEST["zoom_type"] == "zoomback") {
                $this->historyFwd[] = $this->OLDGEOEXT;
            } else {
                $this->historyBack[] = $this->OLDGEOEXT;
            }
            
            //Limit history arrays to max value
            if (count($this->historyBack) > $maxHistory) {
                array_shift($this->historyBack);
            }
            if (count($this->historyFwd) > $maxHistory) {
                array_shift($this->historyFwd);
            }
        }
    }



    /**
     * REFERENCE MAP: ADJUST REFBOX
     */
    protected function pmap_getRefBoxStr()
    {
        // REFERENCE MAP DIMENSION X/Y
        $refMap = $this->map->reference;
        
        if ($refMap) {
            $this->refW = $refMap->width;
            $this->refH = $refMap->height;
            
            $refExtent = $refMap->extent;
            $refXmin = $refExtent->minx;
            $refYmin = $refExtent->miny;
            $refXmax = $refExtent->maxx;
            $refYmax = $refExtent->maxy;
            
            $xdelta_ref = $refXmax - $refXmin;
            $ydelta_ref = $refYmax - $refYmin;
            
            $pixSizeX = $xdelta_ref / $this->refW;
            $pixSizeY = $ydelta_ref / $this->refH;
            $refBoxL  = max(0, round((($this->GEOEXT["minx"]-$refXmin) / $pixSizeX) - 0.5));
            $refBoxT  = max(0, round((($refYmax - $this->GEOEXT["maxy"]) / $pixSizeY)) - 1);
            $refBoxW  = min(($this->refW - $refBoxL), round($this->xdelta_geo / $pixSizeX));
            $refBoxH  = min(($this->refH - $refBoxT), round($this->ydelta_geo / $pixSizeY));
        
            $this->refBoxStr = "$refBoxL,$refBoxT,$refBoxW,$refBoxH";
        } else {
            $this->refBoxStr = false;
        }
        //return $refBoxStr;
    }
    
    
    
    /**
     * CREATE MAP IMAGE
     */
    public function pmap_createMapImage()
    {
		// use layers with complex queries that are too long to select results
		$oldDatas = array();
		$numLayers = $this->map->numlayers;
		
		for ($iLayer = 0 ; $iLayer < $numLayers ; $iLayer++) {
			$msLayer = $this->map->getLayer($iLayer);
			$newdata = $msLayer->getMetaData('PM_RESULT_DATASUBSTITION');
	        if ($newdata != '') {
                $oldDatas[$msLayer->name] = $msLayer->data;
            	$msLayer->set('data', $newdata);
            }
		}
        // DRAW MAP AND SET GEO EXTENT (IN MAP UNITS) IN SID FOR SUBSEQUENT ZOOM ACTIONS //
        $mapImg = $this->map->draw();
        
        // write old geoextent to var before changing
        $this->OLDGEOEXT = $this->GEOEXT; 
        //error_log($this->OLDGEOEXT);
        
        // convert numbers for GEOEXT and geo_scale to string 
        // to avoid saving numbers as full float number in SID
        $this->GEOEXT["minx"] = strval($this->map->extent->minx);
        $this->GEOEXT["miny"] = strval($this->map->extent->miny);
        $this->GEOEXT["maxx"] = strval($this->map->extent->maxx);
        $this->GEOEXT["maxy"] = strval($this->map->extent->maxy);
        
        $this->geo_scale = $this->map->scaledenom;
        
        
        // PRODUCE MAP, REFERENCE AND SCALEBAR IMAGE //
        //$this->mapURL = $mapImg->saveWebImage();
        $this->mapURL = $this->mapSaveWebImage($this->map, $mapImg);
        
        $scalebarImg = $this->map->drawScaleBar();
        //$this->scalebarURL = $scalebarImg->saveWebImage();
        $this->scalebarURL = $this->mapSaveWebImage($this->map, $scalebarImg);
        
		// reset data tag
		foreach ($oldDatas as $layerName => $oldData) {
			$msLayer = $this->map->getLayerByName($layerName);
			if ($msLayer) {
				$msLayer->set('data', $oldData);
			}
		}
    }
    
    

    /**
     * CREATE NEW MAP
     * 
     */
    public function pmap_createMap()
    {
        
        // CHECK IF THERE ARE RESULTLAYERS (HIGHLIGHT) AND ADD THEM TO MAP
        $this->pmap_checkResultLayers();

        //
        // GET ZOOMTYPE
        // zoomrect, zoompoint, zoomscale, zoomfull, zoomextent, ref, zoomback, zoomfwd
        // Default:  start with 'zoom rect'
        if (isset($_REQUEST["zoom_type"])) {
            $zoom_type = $_REQUEST["zoom_type"];
        } else {
            $zoom_type = "zoomrect";
        }
    
        //
        // GET ZOOMFACTOR
        // <0: zoom out, 1: pan, >1: zoom in
        // Default: 1
        if (isset($_REQUEST["zoom_factor"])) {
            $this->zoom_factor = $_REQUEST["zoom_factor"];
        } else {
            $this->zoom_factor = "1";
        }
    
    
        // =================   APPLY PARAMETERS TO MAP ================= //
    
        $this->maxextent = $this->getMapMaxExtent();
    
        // ZOOM TO RECTANGLE (ZOOMBOX -> PIXEL COORDINATES) OR FULL EXTENT
        if ($zoom_type == "zoomrect") {
            $this->pmap_zoomrect();
           
        // ZOOM TO POINT -> Pan, Zoomout
        } elseif ($zoom_type == "zoompoint") {
            $this->pmap_zoompoint();
    
        // ZOOM TO SCALE
        } elseif ($zoom_type == "zoomscale") {
            $scale = $_REQUEST["scale"];
            $this->pmap_zoomscale($scale);
            
        // ZOOM TO FULL EXTENT
        } elseif ($zoom_type == "zoomfull") {
            // Get external parameters via URL (eg from links)
            if (isset($_REQUEST['zoom_extparams'])) {
                $ext = $_REQUEST['zoom_extparams'];
                //printDebug($ext);
                $this->map->setExtent($ext[0], $ext[1], $ext[2],$ext[3]);
                unset($_REQUEST['zoom_extparams']);
            } else {
                $this->map->setExtent($this->maxextent->minx, $this->maxextent->miny, $this->maxextent->maxx, $this->maxextent->maxy);
            }
    
        // ZOOM TO EXTENT (GEO-EXTENT)
        } elseif ($zoom_type == "zoomextent") {
            $this->pmap_zoomextent(); 
    
        // PAN VIA REFERENCE MAP
        } elseif ($zoom_type == "ref") {
            $this->pmap_zoomref();
    
        // ZOOM BACK TO PREVIOUS EXTENT
        } elseif ($zoom_type == "zoomback") {
            $this->pmap_zoomback();
            
        // ZOOM FORWARD 
        } elseif ($zoom_type == "zoomfwd") {
            $this->pmap_zoomfwd();
        
        // ZOOM TO GROUP 
        } elseif ($zoom_type == "zoomgroup") {
            $this->pmap_zoomgroup();
            
        }
    
    } // END OF pmap_createMap()
    
    
    /************************************************
     * ZOOM&PAN FUNCTIONS
     ************************************************/
    /**
     * Zoom to rectangle
     */
    protected function pmap_zoomrect()
    {
        if (isset($_REQUEST["imgbox"])) {
            $imgbox_str = $_REQUEST["imgbox"];
            //error_log($imgbox_str);
            if ($imgbox_str != "") {
                $imgbox_arr = explode("+", $imgbox_str);
                // New map extent in image pixel ((0,0) top-left)
                $pix_minx = $imgbox_arr[0];
                $pix_miny = $imgbox_arr[1];
                $pix_maxx = $imgbox_arr[2];
                $pix_maxy = $imgbox_arr[3];
                
                if ($pix_minx == $pix_maxx) $pix_maxx = $pix_maxx + 3;  ## increase max extent if min==max
                if ($pix_miny == $pix_maxy) $pix_maxy = $pix_maxy - 3;  ##

                $pixext = ms_newrectObj();
                
                // Modified by Thomas RAFFIN (SIRAP)
                // If the rectangle is not in the same proportions as the map,
                // To leave the coeff Y / X unghanged, we need to made $geoNewCoeff = $geo0Coeff... 
				$geo0Coeff = $this->mapheight / $this->mapwidth;
				$geoNewDeltaX = $pix_maxx - $pix_minx;
				$geoNewDeltaY = $pix_maxy - $pix_miny;
				$geoNewCoeff = $geoNewDeltaY / $geoNewDeltaX;
				if ($geoNewCoeff < $geo0Coeff) {
					$newDeltaYCorrected = $geo0Coeff * $geoNewDeltaX;
					$newDeltaYToAdd = ($newDeltaYCorrected - $geoNewDeltaY) / 2;
					$pix_miny -= $newDeltaYToAdd;
					$pix_maxy += $newDeltaYToAdd;
				} else {
					$newDeltaXCorrected = $geoNewDeltaY / $geo0Coeff;
					$newDeltaXToAdd = ($newDeltaXCorrected - $geoNewDeltaX) / 2;
					$pix_minx -= $newDeltaXToAdd;
					$pix_maxx += $newDeltaXToAdd;
				}

                $pixext->setExtent($pix_minx,$pix_miny,$pix_maxx,$pix_maxy);
            }
            
        // Zoom to full extent when starting
        } else {
            $pixext = ms_newrectObj();
            $pixext->setExtent(0, 0, $this->mapwidth, $this->mapheight);
        }
        
        $this->map->zoomrectangle($pixext, $this->mapwidth, $this->mapheight, $this->geoext0);
    }
    
    /**
     * Zoom to point
     */
    protected function pmap_zoompoint()
    {
        if (isset($_REQUEST["imgxy"])) {
            if ($_REQUEST["imgxy"] != "") {
                $imgxy_str = $_REQUEST["imgxy"];
                $imgxy_arr = explode("+", $imgxy_str);
            } else {
                $imgxy_arr = array ($this->mapwidth/2, $this->mapheight/2);
            }
        } else {
            $imgxy_arr = array ($this->mapwidth/2, $this->mapheight/2);
        }

        // Create x/y-point for zoom center
        $x_pix = $imgxy_arr[0];
        $y_pix = $imgxy_arr[1];
        $xy_pix = ms_newPointObj();
        $xy_pix->setXY($x_pix, $y_pix);
        
        $this->map->zoompoint($this->zoom_factor, $xy_pix, $this->mapwidth, $this->mapheight, $this->geoext0, $this->maxextent);
    }
    
    /**
     * Zoom to scale
     */
    protected function pmap_zoomscale($scale)
    {
        $x_pix = $this->mapwidth/2;
        $y_pix = $this->mapheight/2;
        $xy_pix = ms_newPointObj();
        $xy_pix->setXY($x_pix, $y_pix);
        $this->map->zoomscale($scale, $xy_pix, $this->mapwidth, $this->mapheight, $this->geoext0, $this->maxextent);
    }
    
    /**
     * Zoom to specified geo extent
     */
    protected function pmap_zoomextent()
    {
        $extent_str = $_REQUEST["extent"];
        $extent_arr = explode("+", $extent_str);
        $this->map->setExtent($extent_arr[0], $extent_arr[1], $extent_arr[2],$extent_arr[3]);
        if ($minscaledenom = $this->map->web->minscaledenom) {
            if ($this->map->scaledenom < $minscaledenom) {
                $f = ceil($minscaledenom/$this->map->scaledenom) ;
                $dX = ($extent_arr[2] - $extent_arr[0]) * $f * 0.5;
                $dY = ($extent_arr[3] - $extent_arr[1]) * $f * 0.5;
                $this->map->setExtent($extent_arr[0]-$dX, $extent_arr[1]-$dY, $extent_arr[2]+$dX, $extent_arr[3]+$dY);
            }
        }
    }
    
    /**
     * Zoom via reference map
     */
    protected function pmap_zoomref()
    {
        $imgxy_str = $_REQUEST["imgxy"];
        $imgxy_arr = explode("+", $imgxy_str);
        $x_pix = $imgxy_arr[0];
        $y_pix = $imgxy_arr[1];

        $refmap = $this->map->reference;
        $refmapwidth = $refmap->width;
        $refmapheight = $refmap->height;

        //$GEOEXT = $_REQUEST["GEOEXT"];
            $GEOEXT["minx"] = $_REQUEST["GEOEXT"][0];
            $GEOEXT["miny"] = $_REQUEST["GEOEXT"][1];
            $GEOEXT["maxx"] = $_REQUEST["GEOEXT"][2];
            $GEOEXT["maxy"] = $_REQUEST["GEOEXT"][3];
        $geo0DeltaX = $GEOEXT["maxx"] - $GEOEXT["minx"];
        $geo0DeltaY = $GEOEXT["maxy"] - $GEOEXT["miny"];
        $newMapExtent = $this->refMapClick ($this->map, $x_pix, $y_pix, $refmapwidth, $refmapheight, $geo0DeltaX, $geo0DeltaY);

        $this->map->setExtent($newMapExtent[0], $newMapExtent[1], $newMapExtent[2], $newMapExtent[3] );
    }
    
    
    /**
     * Set map maximum extent
     * takes values from session if set via URL (in initmap()->getMapInitURL())
     */
    public function getMapMaxExtent()
    {
        if (isset($_REQUEST['mapMaxExt'])) {
            $me = $_REQUEST['mapMaxExt'];
            $mapMaxExt = ms_newrectObj();
            $mapMaxExt->setExtent($me["minx"],$me["miny"],$me["maxx"],$me["maxy"]);
        } else {
            $mapMaxExt = $this->map->extent;
        }
        
        return $mapMaxExt;
    }
    
    
    /**
     * CHECK IF THERE ARE RESULTLAYERS TO ADD
     */
    protected function pmap_checkResultLayers()
    {
        // ADD RESULTLAYER: MARKING SHAPE(S) AND ADD AS IN NEW CREATED LAYER
        if (isset($_REQUEST["resultlayer"])) {
            $resultlayerStr = $_REQUEST["resultlayer"];
            if ($resultlayerStr == "remove") {
                unset($resultlayers);
            } else {
                $resultlayer = explode(" ", $resultlayerStr);
                $reslayname = $resultlayer[0];
                $shpindexes = explode("|", $resultlayer[1]);
                $resultlayers[$reslayname] = $shpindexes;
                $this->pmap_addResultLayer($reslayname, $shpindexes);
            }
        }
    }
    

    /**
     * FOR ZOOM TO SELECTED.
     * Adds a new layer to the map for highlighting feature
     */
    private function pmap_addResultLayer($reslayer, $shpindexes)
    {
        $resulttilelayers = null;
        $resulttilelayer = null;
    
        $qLayer = $this->map->getLayerByName($reslayer);
        $qlayType = $qLayer->type;
        $layNum = count($this->map->getAllLayerNames());
    
    
        // Test if layer has the same projection as map
        $mapProjStr = $this->map->getProjection();
        $qLayerProjStr = $qLayer->getProjection();
    
		$changeLayProj = false;
        if ($mapProjStr && $qLayerProjStr && $mapProjStr != $qLayerProjStr) {
            $changeLayProj = true;
        	$mapProjObj = new projectionObj($mapProjStr);
        	$qLayerProjObj = new projectionObj($qLayerProjStr);
        }
    
        // New result layer
            // load from template map file
            $hlDynLayer = 0;
            $hlMap = ms_newMapObj('/var/www/html/cartografia/mapfiles/template.map');
            $hlMapLayer = $hlMap->getLayerByName("highlight_$qlayType");
            $hlMapLayer->set("name", "pmapper_reslayer");
            $newResLayer = ms_newLayerObj($this->map, $hlMapLayer);
            
    
        // Add selected shape to new layer
        //# when layer is an event theme
        if ($qLayer->getMetaData("XYLAYER_PROPERTIES") != "") {
            foreach ($shpindexes as $cStr) {
                $cList = preg_split('/@/', $cStr);
                $xcoord = $cList[0];
                $ycoord = $cList[1];
                $resLine = ms_newLineObj();   // needed to use a line because only a line can be added to a shapeObj  
                $resLine->addXY($xcoord, $ycoord);
                $resShape = ms_newShapeObj(1);
                $resShape->add($resLine);
                $newResLayer->addFeature($resShape);
            }
        //# specific for PG layers  <==== required for MS >= 5.6 !!!
        } elseif ($qLayer->connectiontype == 6) {
            $newResLayer->set("connection", $qLayer->connection);
            if (method_exists($newResLayer, "setConnectionType")) {
                $newResLayer->setConnectionType($qLayer->connectiontype);
            } else {
                $newResLayer->set("connectiontype", $qLayer->connectiontype);
            }
			$data = $qLayer->data;
			// use layers with complex queries that are too long to select results 
            // cause maxscaledenom is not used...
            if ($qLayer->getMetaData("PM_RESULT_DATASUBSTITION") != "") {
                $data = $qLayer->getMetaData("PM_RESULT_DATASUBSTITION");
            }

            $newResLayer->set("data", $data);
            if ($qLayerProjStr) $newResLayer->setProjection($qLayerProjStr);
            
            $glList = $this->returnLayer($this->map,$reslayer);
            $glayer = $glList[1];
            $layerDbProperties = $glayer->getLayerDbProperties();
            $uniqueField = $layerDbProperties['unique_field'];
            $indexesStr = implode(",", $shpindexes);
            $idFilter = "($uniqueField IN ($indexesStr))";
            $newResLayer->setFilter($idFilter);
        //# 'normal' layers
        } else {
            // Add selected shape to new layer

            // Modified by Thomas RAFFIN (SIRAP)
            // use layers with complex queries that are too long to select results 
            // cause maxscaledenom is not used...
			$olddata = false;
            if ($qLayer->getMetaData("PM_RESULT_DATASUBSTITION") != "") {
                $olddata = $qLayer->data;
            	$qLayer->set("data", $qLayer->getMetaData("PM_RESULT_DATASUBSTITION"));
            }

            $qLayer->open();
            foreach ($shpindexes as $resShpIdx) {
                if (preg_match("/@/", $resShpIdx)) {
                    $idxList = explode("@", $resShpIdx);
                    $resTileShpIdx = $idxList[0];
                    $resShpIdx = $idxList[1];
                } else {
                    $resTileShpIdx = $resulttilelayer[$resShpIdx];
                }
                $resShape = $this->resultGetShape($qLayer, null, $resShpIdx, $resTileShpIdx);  // changed for compatibility with PG layers and MS >= 5.6
                
                // Change projection to map projection if necessary
                if ($changeLayProj) {
                    // If error appears here for Postgis layers, then DATA is not defined properly as:
                    // "the_geom from (select the_geom, oid, xyz from layer) AS new USING UNIQUE oid USING SRID=4258" 
                    if ($resShape) {
                        $resShape->project($qLayerProjObj, $mapProjObj);
                    }
                }
                if ($resShape) {
                    $newResLayer->addFeature($resShape);
                }
            }
            
            $qLayer->close();

            // Modified by Thomas RAFFIN (SIRAP)
	        // use layers with complex queries that are too long to select results 
    	    // cause maxscaledenom is not used...
            // reset data tag
            if ($olddata) {
            	$qLayer->set("data", $olddata);
            }

        }
        
        $newResLayer->set("status", MS_ON);
        $newResLayerIdx = $newResLayer->index;
    
        if ($hlDynLayer) {
            // SELECTION COLOR
            $iniClrStr = '0 255 255';
            $iniClrList = preg_split('/[\s,]+/', $iniClrStr);
            $iniClr0 = $iniClrList[0];
            $iniClr1 = $iniClrList[1];
            $iniClr2 = $iniClrList[2];
        
            // CREATE NEW CLASS
            $resClass = ms_newClassObj($newResLayer);
            $clStyle = ms_newStyleObj($resClass);
            $clStyle->color->setRGB($iniClr0, $iniClr1, $iniClr2);
            $clStyle->set("symbolname", "circle");
            $symSize = ($qlayType < 1 ? 10 : 5);
            $clStyle->set("size", $symSize);
        }
        
        // Move layer to top (is it working???)
        while ($newResLayerIdx < ($layNum-1)) {
            $this->map->moveLayerUp($newResLayerIdx);
        }
    }
    
    
    /**
     * RETURN NEW MAP EXTENT FOR CLICK ON REF IMAGE
     * Taken from the gMap demo by DMSolution
     */
    private function refMapClick ($map, $nClickPixX, $nClickPixY, $dfWidthPix, $dfHeightPix, $dfDeltaX, $dfDeltaY)
    {
        $dfKeyMapXMin = $map->reference->extent->minx;
        $dfKeyMapYMin = $map->reference->extent->miny;
        $dfKeyMapXMax = $map->reference->extent->maxx;
        $dfKeyMapYMax = $map->reference->extent->maxy;
    
        $nClickGeoX = $this->mapPix2Geo($nClickPixX, 0, $dfWidthPix, $dfKeyMapXMin,  $dfKeyMapXMax, 0);
        $nClickGeoY = $this->mapPix2Geo($nClickPixY, 0, $dfHeightPix, $dfKeyMapYMin, $dfKeyMapYMax, 1);
    
        $dfMiddleX = $nClickGeoX;
        $dfMiddleY = $nClickGeoY;
    
        $dfNewMinX = $dfMiddleX - ($dfDeltaX/2);
        $dfNewMinY = $dfMiddleY - ($dfDeltaY/2);
        $dfNewMaxX = $dfMiddleX + ($dfDeltaX/2);
        $dfNewMaxY = $dfMiddleY + ($dfDeltaY/2);
    
    
        // --------------------------------------------------------------------
        //      not go outside the borders (map extent as in map file).
        // --------------------------------------------------------------------
        $maxExtent = $map->extent;
        $dfMaxExtMinX = $maxExtent->minx;
        $dfMaxExtMinY = $maxExtent->miny;
        $dfMaxExtMaxX = $maxExtent->maxx;
        $dfMaxExtMaxY = $maxExtent->maxy;
    
        if ($dfNewMinX < $dfMaxExtMinX) {
            $dfNewMinX = $dfMaxExtMinX;
            $dfNewMaxX = $dfNewMinX + ($dfDeltaX);
        }
        if ($dfNewMaxX > $dfMaxExtMaxX) {
            $dfNewMaxX = $dfMaxExtMaxX;
            $dfNewMinX = $dfNewMaxX - ($dfDeltaX);
        }
        if ($dfNewMinY < $dfMaxExtMinY) {
            $dfNewMinY = $dfMaxExtMinY;
            $dfNewMaxY = $dfNewMinY + ($dfDeltaY);
        }
        if ($dfNewMaxY > $dfMaxExtMaxY) {
            $dfNewMaxY = $dfMaxExtMaxY;
            $dfNewMinY = $dfNewMaxY - ($dfDeltaY);
        }
    
        $mapExtents = array ($dfNewMinX, $dfNewMinY, $dfNewMaxX, $dfNewMaxY);
        return ($mapExtents) ;
    }
    
    
    /**
     * TRANSFORM PIXEL COORDINATE TO MAP UNITS
     * Taken from the gMap demo by DMSolution
     */
    public function mapPix2Geo($nPixPos, $dfPixMin, $dfPixMax, $dfGeoMin, $dfGeoMax, $nInversePix)
    {
        $dfWidthGeo = $dfGeoMax - $dfGeoMin;
        $dfWidthPix = $dfPixMax - $dfPixMin;
    
        $dfPixToGeo = $dfWidthGeo / $dfWidthPix;
    
        if (!$nInversePix)
            $dfDeltaPix = $nPixPos - $dfPixMin;
        else
            $dfDeltaPix = $dfPixMax - $nPixPos;
    
        $dfDeltaGeo = $dfDeltaPix * $dfPixToGeo;
        $dfPosGeo = $dfGeoMin + $dfDeltaGeo;
    
        return ($dfPosGeo);
    }


    /**
     * Workaround for Mapscript bug and temp image file names
     */
    protected function mapSaveWebImage($map, $mapImg, $refImg=false)
    {
        $now = (string)microtime();
        $now = explode(' ', $now);
        $microsec = $now[1].str_replace('.', '', $now[0]);
        unset($now);

        $imgFormat = $refImg ? substr(strtolower(trim($map->reference->image)), -3) : $map->outputformat->extension;

        $tmpImgBaseName = session_id() . $microsec . "." . $imgFormat;
        $tmpFileNameAbs = str_replace('\\', '/', $map->web->imagepath) . $tmpImgBaseName ;
        $imgURL =  $map->web->imageurl . $tmpImgBaseName ;
        $mapImg->saveImage($tmpFileNameAbs, $map);

        return $imgURL;
    }


    /**
     * Get the group to which a glayer belongs
     */
    protected function returnLayer($map, $layname)
    {
        $glayerList = $map->getLayers();
        foreach ($glayerList as $gl) {
            $glayername = $gl->getLayerName();
            if ($layname == $glayername) {
                return array($gl);
            }
        }
    }


    protected function resultGetShape($qLayer, $qRes, $resShpIdx=null, $resTileShpIdx=null)
    {
        if ($qRes) {
            return $qLayer->getShape($qRes);
        } else {
            $qLayer->open();
            $shape = $qLayer->getShape(new resultObj($resShpIdx));
            $qLayer->close();
            return $shape;
        }
    }









}



?>
