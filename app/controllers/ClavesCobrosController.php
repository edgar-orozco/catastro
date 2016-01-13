<?php

class ClavesCobrosController extends BaseController {

    public function ObtenerValores() {
        return View::make('ClavesCobros.ClavesCobros');
    }

    public function CrearValores() {
        return View::make('ClavesCobros.create');
    }

    public function Crear() {
        $inputs = Input::all();
        $n = new Clavescobros();
        $n->idtramite = 5;
        $n->cuenta = $inputs["cuenta"];
        $n->descripcion_tramite = $inputs["descripcion_tramite"];
        $n->clave = $inputs["clave"];
        $n->save();
//        }
        $catalogo = Clavescobros::All();
        return View::make('ClavesCobros.create', compact("catalogo"));
    }

    public function getlistar() {
        $catalogo = Clavescobros::All();
//        print_r($catalogo);
        return View::make('ClavesCobros.ClavesCobros', compact("catalogo"));
    }

    public function listar() {
        $catalogo = Clavescobros::All();
        $cata = Clavescobros::All();
        return View::make('ClavesCobros.create', compact("cata", "catalogo"));
    }

    public function eliminar($id = null) {
        $elim = Clavescobros::find($id);
        $elim->delete();
        return Redirect::back();
    }

    public function update() {
//      $inputs=Clavescobros::all();
      $inputs = Input::all();
//        $inputs = Input::All();
        $id = Input::get('id');
//        dd($id);
        $datos = Clavescobros::find($id);
//        dd($datos);
       $datos->cuenta;
             $cta =$inputs['cuenta'];
        dd($cta);
//        $datos->descripcion_tramite = Input::get('descripcion_tramite');
//        $datos->clave = Input::get('clave');
//        $datos->descripcion_tramite = $inputs['descripcion_tramite'];
//        $datos->clave = $inputs['clave'];
//        $datos->save();
        $catalogo = Clavescobros::All();
        return View::make('ClavesCobros.edit', compact("catalogo", 'datos'));
    }

    public function editar($id = null) {
//        $inputs = Input::All();
//        $inputs = Clavescobros::all();
//        $id = Input::get('id');
//        $datos = Clavescobros::find($id);
//        $datos->idtramite = $id;
//        $datos->cuenta = $inputs['cuenta'];
//        $datos->descripcion_tramite = $inputs['descripcion_tramite'];
//        $datos->clave = $inputs['clave'];
//        $datos->save();
//        $catalogo = Clavescobros::All();
//        return View::make('ClavesCobros.edit', compact("catalogo", 'datos'));
    }

}
