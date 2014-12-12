<?php

class TipotramitesController extends \BaseController
{

    /**
     * Tipotramite Model
     * @var Tipotramite
     */
    protected $tipotramite;

    /**
     * Elementos por página que se mostrarán en pantalla. Se usa en el paginador.
     * @var int
     */
    protected $por_pagina = 10;

    /**
     * Inject the model.
     * @param Tipotramite $tipotramite
     */
    public function __construct(Tipotramite $tipotramite)
    {
        $this->tipotramite = $tipotramite;
    }

    /**
     * Display a listing of the resource.
     * GET /tipotramites
     *
     * @return Response
     */
    public function index()
    {
        //La lista
        $tipotramite = $this->tipotramite;

        // Title
        $title = "Tipos de trámites.";

        //Título de sección:
        $title_section = "Tipos de trámites";

        //Subtítulo de sección:
        $subtitle_section = "Administrar, Crear y modificar.";

        //Lista
        $query = Request::get('q');
        if ($query) {
            $tipotramites = Tipotramite::where('nombre', 'ILIKE', "%$query%")->paginate($this->por_pagina);
        } else {
            $tipotramites = Tipotramite::paginate($this->por_pagina);
        }
        return View::make('admin.tipotramites.index',
            compact('tipotramites', 'tipotramite', 'title', 'title_section', 'subtitle_section'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /tipotramites/create
     *
     * @return Response
     */
    public function create()
    {
        $tipotramite = $this->tipotramite;

        $title = 'Administración de catálogo de tipo de trámites';

        //Título de sección:
        $title_section = "Crear nuevo tipo de trámite.";

        //Subtítulo de sección:
        $subtitle_section = "";

        // Todos los tipotramites creados actualmente
        $tipotramites = Tipotramite::paginate($this->por_pagina);

        //Todos los requisitos para trámites
        $requisitos = Requisito::all();

        return View::make('admin.tipotramites.create',
            compact('title', 'title_section', 'subtitle_section', 'tipotramite', 'tipotramites', 'requisitos'));

    }

    /**
     * Store a newly created resource in storage.
     * POST /tipotramites
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /tipotramites/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /tipotramites/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /tipotramites/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /tipotramites/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}