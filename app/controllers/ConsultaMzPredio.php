<?php

class ConsultaMzPredio extends \BaseController {
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
/**
*	public function index()
*	{
*	$predios = Predio::all();
*		return View::make('cartografia.consultas.index') -> with ('predios',$predios);
*	}
*/

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	$script_name = "DGCEF-Map.php";


	$map_path = "/var/www/html/";
	$map_file = "Tabasco.map";
	$img_path = "/tmp/";


	$zoomsize=2;
	$pan="";
	$zoomout="";
	$zoomin="CHECKED";


#	$DEM = "CHECKED";     
	$Carreteras = "CHECKED";               
	$Estado = "CHECKED";
	$Predio = "CHECKED";
	$Mz = "CHECKED";
	#$roads = "CHECKED";


	$clickx = 400;     
	$clicky = 300;          
	$clkpoint = ms_newPointObj();
	$old_extent = ms_newRectObj();


	$extent = array(380457.02, 1907997.01, 714295.56, 2062245.55);
	$max_extent = ms_newRectObj();
	$max_extent->setextent(380457.02, 1907997.01, 714295.56, 2062245.55);


	$map = ms_newMapObj($map_path.$map_file);
//	$imgx=$_POST['img_x'];
//	$imgy=$_POST['img_y'];	

//	if (( $imgx and $imgy ) 
//   	or $_POST['refresh']) {
   
/**
   		if ( $_POST['refresh'] ) { 
      			$clickx = 320;
      			$clicky = 240;

   		} else {                   
   
      			$clickx = $_POST['img_x'];
      			$clicky = $_POST['img_y'];
   		}
*/
   
   		$clkpoint->setXY($clickx,$clicky);
/**
   
   		if ( $_POST['layer'] ) {                
      			$layers = join(" ",$_POST['layer']); 
   		} else {
      			$layers = "";                        
   		}
*/
//   		$this_layer = 0;

//   		if (preg_match("/DEM/", $layers)){ 
      			//$DEM = "CHECKED";
      			//$this_layer = $map->getLayerByName('DEM');
      			//$this_layer->set('status', MS_ON);
/**  		} else { 
      			$DEM = "";
      			$this_layer = $map->getLayerByName('DEM');
      			$this_layer->set('status', MS_OFF);
   		}
*/
//   		if (preg_match("/Carreteras/", $layers)){    
      			$Carreteras = "CHECKED";
      			$this_layer = $map->getLayerByName('Carreteras');
     			$this_layer->set('status', MS_ON);
/**   		} else { 
      			$Carreteras = "";
      			$this_layer = $map->getLayerByName('Carreteras');
      			$this_layer->set('status', MS_OFF);
   		}
*/
//   		if (preg_match("/Estado/", $layers)){       
      			$Estado = "CHECKED";
      			$this_layer = $map->getLayerByName('Estado');
      			$this_layer->set('status', MS_ON);
/**   		} else {
      			$Estado = "";
      			$this_layer = $map->getLayerByName('Estado');
      			$this_layer->set('status', MS_OFF);
   		}	

*/
//		if (preg_match("/Predios/", $layers)){		
		   				$Predios = "CHECKED";
						$this_layer = $map->getLayerByName('Predios');
						$this_layer->set('status', MS_ON);
/**						} else {
						$Predios = "";
						$this_layer = $map->getLayerByName('Predios');
						$this_layer->set('status', MS_OFF);
			}

						if (preg_match("/Manzanas/", $layers)){
*/						$Mz = "CHECKED";
						$this_layer = $map->getLayerByName('Manzanas');
						$this_layer->set('status', MS_ON);
/**						} else {
						$Mz = "";
						$this_layer = $map->getLayerByName('Manzanas');
						$this_layer->set('status', MS_OFF);
						}
*/
   
/**   		if ( $_POST['extent'] ) {
      			$extent = split(" ", $_POST['extent']);
  		}
*/
   
   		$map->setExtent($extent[0],$extent[1],$extent[2],$extent[3]);

   
  		$old_extent->setextent($extent[0],$extent[1],$extent[2],$extent[3]);


/**   		$zoom_factor = $_POST['zoom']*$_POST['zsize'];


   		if ($zoom_factor == 0) {
      			$zoom_factor = 1;
      			$pan = "CHECKED";
      			$zoomout = "";
      			$zoomin = "";
   		} elseif ($zoom_factor < 0) {
      			$pan = "";
      			$zoomout = "CHECKED";
      			$zoomin = "";
   		} else {
      			$pan = "";
      			$zoomout = "";
      			$zoomin = "CHECKED";
   		}
   		$zoomsize = abs( $_POST['zsize'] );
*/
   
//   		$map->zoomPoint(0,$clkpoint,$map->width,$map->height,$old_extent,$max_extent);

	//}



	$map_id = sprintf("%0.6d",rand(0,999999));

	$image_name = "DGCEF".$map_id.".png";
	$image_url="/map_output/".$image_name;

	$ref_name = "DGCEFref".$map_id.".gif";
	$ref_url="/map_output/".$ref_name;

	$leg_name = "DGCEFleg".$map_id.".png";
	$leg_url="/map_output/".$leg_name;


	$image=$map->draw();
	$image->saveImage($img_path.$image_name);


	$ref = $map->drawReferenceMap();
	$ref->saveImage($img_path.$ref_name);


	$leg = $map->drawLegend();
	$leg->saveImage($img_path.$leg_name);


	$new_extent = sprintf("%3.6f",$map->extent->minx)." "
             	     .sprintf("%3.6f",$map->extent->miny)." "
             	     .sprintf("%3.6f",$map->extent->maxx)." "
                     .sprintf("%3.6f",$map->extent->maxy);




	list($x,$y) = img2map($map->width,$map->height,$clkpoint,$old_extent);
	$x_str = sprintf("%3.6f",$x);
	$y_str = sprintf("%3.6f",$y);

	$mapserv=array(
		"image_url" => $image_url,
		"ref_url" => $ref_url,
		"x_str" => $x_str,
		"y_str" => $y_str,
		"new_extent" => $new_extent,
		"leg_url" => $leg_url,
		"pan" => $pan,
		"zoomin" => $zoomin,
		"zoomout" => $zoomout,
		"zoomsize" => $zoomsize,
	//	"DEM" => $DEM,
		"Carreteras" => $Carreteras,
		"Estado" => $Estado,
		"Predios" => $Predios,
		"Manzanas" => $Mz,
	);
	$view = View::make('cartografia.consultas.form') -> with ('mapserv',$mapserv);
	$cookie = Cookie::make('DGCEF', 'Nuevo-Hola', 30);

	return Response::make($view)->withCookie($cookie);


	}	
	public function create()
	{
			

	
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$script_name = "DGCEF-Map.php";
		
		
		$map_path = "/var/www/html/";
		$map_file = "Tabasco.map";
		$img_path = "/tmp/";
		
		
		$zoomsize=2;
		$pan="CHECKED";
		$zoomout="";
		$zoomin="";
		
		
		#	$DEM = "CHECKED";
		$Carreteras = "CHECKED";
		$Estado = "CHECKED";
		$Predios = "CHECKED";
		$Mz = "CHECKED";
		#$roads = "CHECKED";
		
		
		$clickx = 400;
		$clicky = 300;
		$clkpoint = ms_newPointObj();
		$old_extent = ms_newRectObj();
		
		
		$extent = array(380457.02, 1907997.01, 714295.56, 2062245.55);
		$max_extent = ms_newRectObj();
		$max_extent->setextent(380457.02, 1907997.01, 714295.56, 2062245.55);
		
		
		$map = ms_newMapObj($map_path.$map_file);
		$imgx=$_POST['img_x'];
		$imgy=$_POST['img_y'];
		
				if (( $imgx and $imgy )
						or $_POST['refresh']) {
		
		
					/**	if ( $_POST['refresh'] ) {
						$clickx = 320;
							$clicky = 240;
		
						} else {
*/
		
						$clickx = $_POST['img_x'];
						$clicky = $_POST['img_y'];
						//}
		
								
							$clkpoint->setXY($clickx,$clicky);
		
								
										if ( $_POST['layer'] ) {
										$layers = join(" ",$_POST['layer']);
						} else {
						$layers = "";
						}
		
						$this_layer = 0;
						/**
								if (preg_match("/DEM/", $layers)){
								$DEM = "CHECKED";
						$this_layer = $map->getLayerByName('DEM');
						$this_layer->set('status', MS_ON);
						} else {
						$DEM = "";
						$this_layer = $map->getLayerByName('DEM');
						$this_layer->set('status', MS_OFF);
						}
						*/
						if (preg_match("/Carreteras/", $layers)){
						$Carreteras = "CHECKED";
						$this_layer = $map->getLayerByName('Carreteras');
						$this_layer->set('status', MS_ON);
						} else {
						$Carreteras = "";
						$this_layer = $map->getLayerByName('Carreteras');
						$this_layer->set('status', MS_OFF);
						}
		
						if (preg_match("/Estado/", $layers)){
						$Estado = "CHECKED";
						$this_layer = $map->getLayerByName('Estado');
								$this_layer->set('status', MS_ON);
						} else {
						$Estado = "";
						$this_layer = $map->getLayerByName('Estado');
						$this_layer->set('status', MS_OFF);
						}
						if (preg_match("/Predios/", $layers)){		
						$Predios = "CHECKED";
						$this_layer = $map->getLayerByName('Predios');
								$this_layer->set('status', MS_ON);
						} else {
						$Predios = "";
						$this_layer = $map->getLayerByName('Predios');
						$this_layer->set('status', MS_OFF);
						}

						if (preg_match("/Manzanas/", $layers)){
						$Mz = "CHECKED";
						$this_layer = $map->getLayerByName('Manzanas');
								$this_layer->set('status', MS_ON);
						} else {
						$Mz = "";
						$this_layer = $map->getLayerByName('Manzanas');
						$this_layer->set('status', MS_OFF);
						}
		
		
						if ( $_POST['extent'] ) {
						$extent = preg_split("/[\s]/", $_POST['extent']);
						}
		
						 
						$map->setExtent($extent[0],$extent[1],$extent[2],$extent[3]);
		
				 
						$old_extent->setextent($extent[0],$extent[1],$extent[2],$extent[3]);
						
						$zoom=$_POST['zoom'];
						 $zoom_factor = $_POST['zoom']*$_POST['zsize'];

						
		
		
								if ($zoom == 0) {
									$zoom_factor = 1;
						$pan = "CHECKED";
						$zoomout = "";
						$zoomin = "";
		} elseif ($zoom < 0) {

		$pan = "";
		$zoomout = "CHECKED";
		$zoomin = "";
		} else {
		$pan = "";
		$zoomout = "";
		$zoomin = "CHECKED";
		}
		$zoomsize = abs( $_POST['zsize'] );
		
		#$zoom_factor="-2"; 
		$map->zoomPoint($zoom_factor,$clkpoint,$map->width,$map->height,$old_extent,$max_extent);
		
		}
		
		
		
		$map_id = sprintf("%0.6d",rand(0,999999));
		
		$image_name = "DGCEF".$map_id.".png";
		$image_url="/map_output/".$image_name;
		
		$ref_name = "DGCEFref".$map_id.".gif";
			$ref_url="/map_output/".$ref_name;
		
			$leg_name = "DGCEFleg".$map_id.".png";
			$leg_url="/map_output/".$leg_name;
		
		
		$image=$map->draw();
			$image->saveImage($img_path.$image_name);
		
		
			$ref = $map->drawReferenceMap();
			$ref->saveImage($img_path.$ref_name);
		
		
			$leg = $map->drawLegend();
			$leg->saveImage($img_path.$leg_name);
		
		
			$new_extent = sprintf("%3.6f",$map->extent->minx)." "
			.sprintf("%3.6f",$map->extent->miny)." "
			.sprintf("%3.6f",$map->extent->maxx)." "
			.sprintf("%3.6f",$map->extent->maxy);
		
		
		
		
			list($x,$y) = img2map($map->width,$map->height,$clkpoint,$old_extent);
			$x_str = sprintf("%3.6f",$x);
			$y_str = sprintf("%3.6f",$y);
		
			$mapserv=array(
					"image_url" => $image_url,
					"ref_url" => $ref_url,
					"x_str" => $x_str,
					"y_str" => $y_str,
					"new_extent" => $new_extent,
					"leg_url" => $leg_url,
					"pan" => $pan,
					"zoomin" => $zoomin,
							"zoomout" => $zoomout,
							"zoomsize" => $zoomsize,
							//	"DEM" => $DEM,
							"zoom" => $zoom_factor,
							"Carreteras" => $Carreteras,
							"Estado" => $Estado,
							"Predios" => $Predios,
							"Manzanas" => $Mz,
							"zome" => $zoom_factor,
			);
			
			
		
					return View::make('cartografia.consultas.form') -> with ('mapserv',$mapserv);
		
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show()
	{
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
function img2map($width,$height,$point,$ext) {
		
	$minx = $ext->minx;
	$miny = $ext->miny;
	$maxx = $ext->maxx;
	$maxy = $ext->maxy;

	if ($point->x && $point->y){
		$x = $point->x;
		$y = $point->y;

		$dpp_x = ($maxx-$minx)/$width;
		$dpp_y = ($maxy-$miny)/$height;

		$x = $minx + $dpp_x*$x;
		$y = $maxy - $dpp_y*$y;
	}
	$pt[0] = $x;
	$pt[1] = $y;
	return $pt;
}
