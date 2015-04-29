<?php

class folios_ConfController extends BaseController {
	public function index(){
		
		$conf = FoliosConf::first();

		return View::make('folios.configuraciones.configuraciones', ['conf' => $conf]);

	}
		public function modificar(){
			
			$modconfig = FoliosConf::find(1);
			
			$modconfig->salario_minimo = Input::get('salario_minimo');
			$modconfig->director_general = Input::get('director_general');
			$modconfig->director_catastro = Input::get('director_catastro');
			$modconfig->salario_folio_urbano = Input::get('valor_urbano');
			$modconfig->salario_folio_rustico = Input::get('valor_rustico');
			$modconfig->ano_folio = Input::get('año_folio');
			$modconfig->frase_anual = Input::get('frase_anual');
			$modconfig->save();

			return Redirect::to('/configuraciones');
	}
}
