<?php

class corevat_AvaluosFotoController extends \BaseController {

	/**
	 * Show the form for editing the specified resource.
	 * GET /avaluosfoto/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$idavaluo = $id;
		$row = Avaluos::find($id);
		if ( $row->estatus ) {
			return Redirect::to('/corevat/Avaluos')->with('error', '¡El avalúo ya fue registrado!');
		} else {
			$opt = 'fotos';
			$title = 'Fotos y Plano: ' . $row['foliocoretemp'];
			$row = Avaluos::find($id)->AvaluosFotos;
			if (count($row) <= 0) {
				AvaluosFotos::insAvaluoFotos($id);
				$row = Avaluos::find($id)->AvaluosFotos;
			}
			$foto0 = $row->foto0 != '' ? '/corevat/files/' . $row->foto0 : '';
			$foto1 = $row->foto1 != '' ? '/corevat/files/' . $row->foto1 : '';
			$foto2 = $row->foto2 != '' ? '/corevat/files/' . $row->foto2 : '';
			$foto3 = $row->foto3 != '' ? '/corevat/files/' . $row->foto3 : '';
			$foto4 = $row->foto4 != '' ? '/corevat/files/' . $row->foto4 : '';
			$foto5 = $row->foto5 != '' ? '/corevat/files/' . $row->foto5 : '';
			$plano0 = $row->plano0 != '' ? '/corevat/files/' . $row->plano0 : '';

			return View::make('Corevat.Avaluos.avaluos', compact('opt', 'idavaluo', 'title', 'row', 'foto0', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5', 'plano0'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /avaluosfoto/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$inputs = Input::All();
		$row = Avaluos::find($id)->AvaluosFotos;

		$row->ftitulo0 = $inputs["ftitulo0"];
		$row->ftitulo1 = $inputs["ftitulo1"];
		$row->ftitulo2 = $inputs["ftitulo2"];
		$row->ftitulo3 = $inputs["ftitulo3"];
		$row->ftitulo4 = $inputs["ftitulo4"];
		$row->ftitulo5 = $inputs["ftitulo5"];
		$row->ptitulo0 = $inputs["ptitulo0"];

		$row->ip = $_SERVER['REMOTE_ADDR'];
		$row->host = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : '';
		$row->modi_por = 1;
		$row->modi_el = date('Y-m-d H:i:s');

		if (Input::hasFile('foto0')) {
			$row->foto0 = 'foto0-' . $row->idavaluo . '.' . Input::file('foto0')->guessExtension();
			Input::file('foto0')->move(public_path() . '/corevat/files/', $row->foto0);
		}
		if (Input::hasFile('foto1')) {
			$row->foto1 = 'foto1-' . $row->idavaluo . '.' . Input::file('foto1')->guessExtension();
			Input::file('foto1')->move(public_path() . '/corevat/files/', $row->foto1);
		}
		if (Input::hasFile('foto2')) {
			$row->foto2 = 'foto2-' . $row->idavaluo . '.' . Input::file('foto2')->guessExtension();
			Input::file('foto2')->move(public_path() . '/corevat/files/', $row->foto2);
		}
		if (Input::hasFile('foto3')) {
			$row->foto3 = 'foto3-' . $row->idavaluo . '.' . Input::file('foto3')->guessExtension();
			Input::file('foto3')->move(public_path() . '/corevat/files/', $row->foto3);
		}
		if (Input::hasFile('foto4')) {
			$row->foto4 = 'foto4-' . $row->idavaluo . '.' . Input::file('foto4')->guessExtension();
			Input::file('foto4')->move(public_path() . '/corevat/files/', $row->foto4);
		}
		if (Input::hasFile('foto5')) {
			$row->foto5 = 'foto5-' . $row->idavaluo . '.' . Input::file('foto5')->guessExtension();
			Input::file('foto5')->move(public_path() . '/corevat/files/', $row->foto5);
		}
		if (Input::hasFile('plano0')) {
			$row->plano0 = 'plano0-' . $row->idavaluo . '.' . Input::file('plano0')->guessExtension();
			Input::file('plano0')->move(public_path() . '/corevat/files/', $row->plano0);
		}
		$row->save();

		return Redirect::to('/corevat/AvaluoFotos/' . $id)->with('success', '¡La modificación se efectuo correctamente!');
	}

}
