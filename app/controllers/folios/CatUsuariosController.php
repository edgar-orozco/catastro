<?php

class folios_CatUsuariosController extends BaseController {

	public function index(){

		$usuarios = CatUsuarios::all();

		return View::make('catalogos.usuarios.index')->withUsuarios($usuarios);

	}

	public function create(){
		$municipios = CatMunicipios::lists('municipio', 'id');
		$tipos = CatUsuariosTipos::lists('tipo', 'id');

		return View::make('catalogos.usuarios.nuevo')
		->withTipos($tipos)
		->withMunicipios($municipios);

	}

	public function store(){

		$inputs = Input::all();

		$reglas = [

			'usuario'	=>	'required|unique:cat_usuarios',
			'nombre'	=>	'required',
			'password'	=>	'required|confirmed'

		];

		$validar = Validator::make($inputs, $reglas);

		if($validar->fails()){

			return Redirect::back()
			->withErrors($validar)
			->withInput();

		} else {

			$usuario = new CatUsuarios;
			$usuario->usuario = $inputs['usuario'];
			$usuario->password = Hash::make($inputs['password']);
			$usuario->nombre = $inputs['nombre'];
			$usuario->tipo_id = $inputs['tipo_id'];
			$usuario->municipio_id = $inputs['municipio_id'];
			$usuario->save();

			return Redirect::to('/catalogos/usuarios');

		}

	}

	public function edit($id){

		$usuario = CatUsuarios::find($id);
		$municipios = CatMunicipios::lists('municipio', 'id');
		$tipos = CatUsuariosTipos::lists('tipo', 'id');

		return View::make('catalogos.usuarios.editar')
		->withUsuario($usuario)
		->withTipos($tipos)
		->withMunicipios($municipios);

	}

	public function update($id){

		$inputs = Input::all();

		$reglas = [

			'usuario'	=>	'required|unique:cat_usuarios,usuario,'.$id,
			'nombre'	=>	'required',
			'password'	=>	'confirmed'

		];

		$validar = Validator::make($inputs, $reglas);

		if($validar->fails()){

			return Redirect::back()
			->withErrors($validar)
			->withInput();

		} else {

			$usuario = CatUsuarios::find($id);
			$usuario->usuario = $inputs['usuario'];

			if($inputs['password']){

				$usuario->password = Hash::make($inputs['password']);

			}

			$usuario->nombre = $inputs['nombre'];
			$usuario->tipo_id = $inputs['tipo_id'];
			$usuario->municipio_id = $inputs['municipio_id'];
			$usuario->save();

			return Redirect::to('/catalogos/usuarios');

		}

	}

	public function status($id){

		$usuario = CatUsuarios::find($id);

		if($usuario->status == "Activo"){

			$usuario->status = "Inactivo";

		} else {

			$usuario->status = "Activo";

		}

		$usuario->save();

		return Redirect::to('/catalogos/usuarios');

	}

}