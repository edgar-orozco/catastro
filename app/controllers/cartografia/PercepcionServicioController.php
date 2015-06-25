<?php

class PercepcionServicioController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('cartografia/percepcionservicio');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('cartografia/percepcionservicio');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array('created_at' => new DateTime()));
		Input::merge(array('updated_at' => new DateTime()));
		$input = Input::all(); 

		
		$validation = Validator::make($input, PercepcionServicio::$rules);
	 
		if ($validation->passes())
		{

		
		PercepcionServicio::create($input);
		return Redirect::route('percepcionservicio');
		}

		return Redirect::route('percepcionservicio')
		->withInput()
		->withErrors($validation);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('unico');
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
