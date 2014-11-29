<?php

class RequisitosController extends \BaseController {
    /**
     * Requisito Model
     * @var Requisito
     */
    protected $requisito;

    /**
     * Elementos por página que se mostrarán en pantalla. Se usa en el paginador.
     * @var int
     */
    protected $por_pagina = 10;

    /**
     * Inject the model.
     * @param Requisito $requisito
     */
    public function __construct(Requisito $requisito)
    {
        $this->requisito = $requisito;
    }

	/**
	 * Display a listing of the resource.
	 * GET /requisitos
	 *
	 * @return Response
	 */
	public function index()
	{
        //La lista
        $requisito = $this->requisito;

        // Title
        $title = "Administriación de catálogo de requisitos.";

        //Título de sección:
        $title_section = "Administración requisitos de trámites";

        //Subtítulo de sección:
        $subtitle_section = "Crear y modificar.";

        //Lista de requisitos

        $query = Request::get('q');
        if($query) {
            $requisitos = Requisito::where('nombre','ILIKE',"%$query%")->paginate($this->por_pagina);
        }
        else {
            $requisitos = Requisito::paginate($this->por_pagina);
        }
        return View::make('admin.requisitos.index', compact('requisitos', 'requisito', 'title', 'title_section', 'subtitle_section'));

	}

	/**
	 * Show the form for creating a new resource.
	 * GET /requisitos/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $requisito = $this->requisito;

        $title = 'Administración de catálogo de requisitos';

        //Título de sección:
        $title_section = "Crear nuevo requisito.";

        //Subtítulo de sección:
        $subtitle_section = "";

        // Todos los requisitos creados actualmente
        $requisitos = Requisito::paginate($this->por_pagina);

        return View::make('admin.requisitos.create', compact('title', 'title_section', 'subtitle_section', 'requisito','requisitos'));

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /requisitos
	 *
	 * @return Response
	 */
	public function store()
	{
        //Asignamos los valores del post a la instancia.
        $this->requisito = new Requisito;

        //Si no es posible guardar la instancia mandamos errores
        if( ! $this->requisito->save() )
        {
            //dd($this->requisito->errors()->all());
            return Redirect::back()->withErrors($this->requisito->errors());
        }

        //Se han guardado los valores, expresamos al usuario nuestra felicidad al respecto.
        return Redirect::to('admin/requisitos/create')->with('success','¡Se ha creado correctamente el requisito: '. $this->requisito->name. " !");

	}

	/**
	 * Display the specified resource.
	 * GET /requisitos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /requisitos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        //Buscamos el requisito en cuestión y lo asignamos a la instancia
        $requisito = Requisito::find($id);

        $this->requisito = $requisito;

        $title = 'Administración de catálogo de requisitos';

        //Título de sección:
        $title_section = "Editar requisito: ";

        //Subtítulo de sección:
        $subtitle_section = $this->requisito->nombre;

        // Todos los permisos creados actualmente
        $requisitos = Requisito::paginate($this->por_pagina);

        //ID del permiso
        $id = $requisito->id;
        return View::make('admin.requisitos.edit', compact('title', 'title_section', 'subtitle_section', 'requisito','requisitos','id'));

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /requisitos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $requisito = requisito::find($id);
        $requisito->fill(Input::all());
        $this->requisito = $requisito;

        //Si no es posible guardar la instancia mandamos errores
        if( ! $this->requisito->updateUniques() )
        {
            return Redirect::back()->withErrors($this->requisito->errors());
        }

        //Se han actualizado los valores
        return Redirect::to('admin/requisitos/'.$this->requisito->id.'/edit')->with('success','¡Se ha actualizado correctamente el permiso: '. $this->requisito->nombre. " !");

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /requisitos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}