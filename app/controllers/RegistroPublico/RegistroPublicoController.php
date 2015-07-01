<?php
class RegistroPublico_RegistroPublicoController extends BaseController {
	public function index(){
		return View::make('RegistroPublico.form');
	}
 public function upload(){
      
      //solicitamos el archivo 
      $file = Input::file('file');
      
      //agregamos el nombre del archivo a una variable
      $name_file=$file->getClientOriginalName();
      
      //dividimos el nombre de la extension y validamos el tipo de extencion
      $extension = explode('.', $name_file);
      $num = count($extension)-1;
      
      if($extension[$num] == 'csv'||$extension[$num] == 'CSV'){
	       
	      //valida el peso del archivo
	      
	      if(filesize($file) <= 10485760){ //filesize($file) te da el tamño del archivo en bytes
	    
	        //Se carga el archivo
	        $destionPath = public_path().'/registro/'; 
	        $up = $file->move($destionPath,$file->getClientOriginalName());
	        
	        if($up){

		         return Response::json(array('filebatchuploadsuccess'=>'El archivo se cargo correctamente'));
			   }
		      return Response::json(array('error'=>'El archivo no se cargo correctamente'));
		   }
		   return Response::json(array('error'=>'Exede el tamaño de los 10Mb'));
		}
		return Response::json(array('error'=>'Extensión de archivo invalida"'.Input::File('file')->getClientOriginalName().'", los formatos validos son .CSV, .csv'));
   }
}
