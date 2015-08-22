<?php

class folios_PeritosController extends BaseController {



	protected $por_pagina = 10;

	public function index()
	{ //muestra todos los peritos

		
		$variableperito = Perito::all();

		if(Auth::user()->tipo_id == 2){

			$variableperito->where('Estado', 1);

		}

		

		return View::make('catalogos.peritos.index', ['variableperito' => $variableperito]);
	}

	public function tablaperitos()
	{ //muestra todos los peritos

		
		$variableperito = Perito::all();

		if(Auth::user()->tipo_id == 2){

			$variableperito->where('Estado', 1);

		}

		

		return View::make('catalogos.peritos.tablaperitos', ['variableperito' => $variableperito]);
	}

	public function DesPerito($id){ //activa o desactiva al perito
		
		$perito = Perito::find($id);
		
		if($perito->Estado==1)
		{
			$perito->Estado = 0;		
		}	
		else
		{
			$perito->Estado = 1;
		}
		
		$perito->save();
		 return Redirect::back();
	}

	public function get_actPerito($id){ //actualiza los datos del perito
	
		$variableperito = Perito::find($id);
		return View::make('catalogos.peritos.actPerito', ['variableperito' => $variableperito]);
	}

	public function get_nuevoPerito(){ //crea un nuevo perito
	
		$ultimocorevat = Perito::All()->last();
		if($ultimocorevat)
		{ //el ultimo es corevat-h002 
			$nuevoCorevat= substr($ultimocorevat->corevat, -3); //devuelve el numero del corevat, el -3 se refiere a las ultimas 3 posiciones
			$nuevoCorevat= (int) $nuevoCorevat+1;				//convierte el numero del corevaten entero y le suma 1
			$nuevoCorevat = str_pad($nuevoCorevat, 3, "0", STR_PAD_LEFT); //agrega los 0 faltantes al numero del corevat para que sean de 3 digitos
		}
		else
		{
			$nuevoCorevat=0;
		}
		return View::make('catalogos.peritos.nuevoPerito')->with('nuevoCorevat',$nuevoCorevat);
	}

	public function post_nuevoPerito(){//Se guarda los datos del perito
		//Obtengo el id del perito en caso de que exista
		$id=Input::get('id');
		$inputs=array
		(
			'corevat'=>Input::get('corevat'),
			'nombre'=>Input::get('nombre'),
			'direccion'=>Input::get('direccion'),
			'telefono'=>Input::get('telefono'),
			'correo'=>Input::get('correo')

		);
		//Se crean las reglas
		$reglas=array
			(
				'corevat'=>'required',
				'nombre'=>'required',
				'direccion'=>'required',
				'telefono'=>'required',
				'correo'=>'required'
			);
		//Se crean los mensajes
		$mensajes=array 
			(
				'required'=>'El campo :attribute es obligatorio'
			);

		//Se valida
		$validar=Validator::make($inputs,$reglas,$mensajes);

		//En caso de que no pase la validacion se regresa a la pagina cargando los mensajes de validacion
		if ($validar->fails())
		{
			return Redirect::to('/catalogos/peritos/index')->with('error',"No se pudo guardar el perito correctamente");
		} 
		else
		{
			//Si se obtuvo un id... Actualiza datos Perito
			if(isset($id))
			{
				//Busca al perito por id
				$perito = Perito::find($id);
				//Asigna los datos de los inputs al campo de la tabla correspondiente
    			$perito->corevat = $inputs['corevat'];
				$perito->nombre = $inputs['nombre'];
				$perito->direccion = $inputs['direccion'];
				$perito->telefono = $inputs['telefono'];
				$perito->correo = $inputs['correo'];
				//Guarda
    			$perito->save();

    			return Redirect::to('/catalogos/peritos/index')->with('success',"Perito actualizado correctamente");
			}
			else
			{
				//prepara para la inserción del nuevo registro
				$perito = new Perito;
				//Asigna los datos de los inputs al campo de la tabla correspondiente
				$perito->corevat = $inputs['corevat'];
				$perito->nombre = $inputs['nombre'];
				$perito->direccion = $inputs['direccion'];
				$perito->telefono = $inputs['telefono'];
				$perito->correo = $inputs['correo'];
				//Guarda
				$perito->save();

				return Redirect::to('/catalogos/peritos/index')->with('success',"Perito guardado correctamente");
			}
		}
	}
}