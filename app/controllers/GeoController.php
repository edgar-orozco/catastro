<?php

class GeoController extends BaseController {

    public function getindex() {
        $clave = Input::get('clave');
        if ($clave) {
            $coord = DB::SELECT("SELECT coordenasdasgeoxclave('$clave')");
            foreach ($coord as $row) {
                $item = explode(',', $row->coordenasdasgeoxclave);
            }
            return View::make('pruebas', compact('item'));
        } else {
            $item[] = "Buscar datos";
            return View::make('pruebas', compact('item'));
        }
    }

    public function postlocalidades() {
        $mun = Input::get('idmun');
        $localidades = Localidad::WHERE('municipio', '=', $mun)
//                ->join('localidades_a', 'municipios.municipio', '=', 'localidades_a.municipio')
                ->lists('nombre');

//        dd($localidades);
        return Response::json($localidades);
    }

    public function getmunicipio() {
        $municipios = Municipio::orderBy('nombre_municipio')->get();
        return View::make('busquedamultiple', compact("municipios"));
    }

    public function getbusquedamultiple() {
        $municipios = Municipio::orderBy('nombre_municipio')->get();
        $localidad = Input::get('localidad');
        $municipio = Input::get('municipio');
        $paginas = Input::get('paginador');
//        $localidad='LA VENTA';
//        $municipio='Huimanguillo';
//        $paginas = '10';
        $por_pagina = 1;
        if ($municipios && $localidad && $paginas) {
            $multiple = DB::SELECT("SELECT coordenasdasgeoxmultiple('$localidad','$municipio',$paginas)");
            foreach ($multiple as $row) {
                $item[] = explode(',', $row->coordenasdasgeoxmultiple);
            }
            $datos = array_chunk($item, $por_pagina);
            return View::make('busquedamultiple', compact('datos', "municipios"));
        }
        $datos[] = "Buscar datos";
        return View::make('busquedamultiple', compact('datos',"municipios"));
    }

}
