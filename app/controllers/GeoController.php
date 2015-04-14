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

    public function getbusquedamultiple() {
        //$clave = Input::get('dato');
        echo "hola";
        $localidad = '';
        $municipio = 'Huimanguillo';
        $multiple = DB::SELECT("SELECT coordenasdasgeoxmultiple('$localidad','$municipio')");
        foreach ($multiple as $row) {
            $mult[] = explode(',', $row->coordenasdasgeoxmultiple);
        }

        
    
        return View::make('busquedamultiple', compact('mult'));
    }

}
