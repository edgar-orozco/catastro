<?php

class HomeNotariaController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = "Bienvenido a SICARET";
        $subtitle = "Bienvenido a SICARET";


        return View::make('rolnotaria', compact(['title', 'subtitle']));
    }

}
