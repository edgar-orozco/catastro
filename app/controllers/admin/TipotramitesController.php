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
        $tipoTramite = new Tipotramite();
        //$tipoTramite->fill(Input::all());

        if(!$tipoTramite->save()) {

            return Redirect::back()->withErrors($tipoTramite->errors());
        }

        $requisitos = [];
        foreach(Input::get('requisitos') as $requisito_id => $requisito) {
            //dd($requisito);
            if(isset($requisito['requisito_id'])){
                unset($requisito['requisito_id']);
                if($requisito['copias'] === null or $requisito['copias'] === ''){
                    unset($requisito['copias']);
                }
                $requisitos[$requisito_id] = $requisito;
            }
        }

        $tipoTramite->guardaRequisitos($requisitos);

        return Redirect::to('admin/tipotramites')->with('success',
            '¡Se ha creado correctamente el tipo de trámite: ' . $tipoTramite->nombre . " !");
        //dd(Input::all());
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
        $tipotramite = Tipotramite::findOrFail($id);

        $title = 'Administración de catálogo de tipo de trámites';

        //Título de sección:
        $title_section = "Modificar tipo de trámite.";

        //Subtítulo de sección:
        $subtitle_section = $tipotramite->nombre;

        // Todos los tipotramites creados actualmente
        $tipotramites = Tipotramite::paginate($this->por_pagina);

        //Todos los requisitos para trámites
        $requisitos = Requisito::all();

        return View::make('admin.tipotramites.edit',
            compact('title', 'title_section', 'subtitle_section', 'tipotramite', 'tipotramites', 'requisitos'));


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


        $tipoTramite = Tipotramite::findOrFail($id);
        $tipoTramite->fill(Input::all());
        if(!$tipoTramite->updateUniques()) {

            return Redirect::back()->withErrors($tipoTramite->errors());
        }

        $requisitos = [];
        foreach(Input::get('requisitos') as $requisito_id => $requisito) {
            //dd($requisito);
            if(isset($requisito['requisito_id'])){
                unset($requisito['requisito_id']);
                if(!$requisito['copias']){
                    unset($requisito['copias']);
                }
                $requisitos[$requisito_id] = $requisito;
            }
        }

        $tipoTramite->guardaRequisitos($requisitos);

        return Redirect::to('admin/tipotramites')->with('success',
            '¡Se ha actualizado correctamente el tipo de trámite: ' . $tipoTramite->nombre . " !");

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
        $tipotramite = Tipotramite::findOrFail($id);
        $tipotramite->delete($id);
        return Redirect::to('admin/tipotramites')->with('success',
            '¡Se ha eliminado correctamente el tipo de trámite: ' . $tipotramite->nombre . " !");

    }

}