<?php

error_reporting(E_ERROR | E_WARNING);

class complementarios_ComplementariosController extends BaseController {

    protected $por_pagina = 10;

    public function index() {
        $predio = Input::get('b');
        $predio = Str::upper($predio);
        $busqueda = predios::WHERE('clave', 'LIKE', '%' . $predio . '%')
                ->orWhere('clave_ori', $predio)
                ->orderBy('gid', 'ASC')
                ->paginate($this->por_pagina);
        return View::make('complementarios.complementarios', compact("busqueda"));
    }

    public function getPredio($id = null) {
        $predios = predios::find($id);
        return View::make('complementarios.complementarios', compact("predios"));
    }

   public function getInstalacion($id = null) {
        $gid = Input::get('gidc');
        $datos = instalaciones::WHERE('instalaciones_especiales.clave', '=', $id)
                ->join('tiposiespeciales', 'tiposiespeciales.id', '=', 'instalaciones_especiales.id_tipo_ie')
//                ->orderBy('id_ie', 'ASC')
                ->get();
        $const = construcciones::WHERE('clave', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
//      $predios = predios::find($id);

        $predios = predios::WHERE('predios.clave', '=', $id)
                ->join('municipios', 'predios.municipio', '=', 'municipios.municipio')
                ->join('entidades', 'predios.entidad', '=', 'entidades.entidad')
                ->get();

        $condominio = condominios::WHERE('clave', 'LIKE', '%' . $id . '%')
                ->orderBy('id_condominio', 'ASC')
                ->get();
//      $prop = predios::WHERE('predios.clave', '=', '002-0007-000008')
//                ->join('propietarios', 'propietarios.clave', '=', 'predios.clave')
//                ->join('personas', 'personas.id_p', '=', 'propietarios.id_propietario')
//                ->select()
//                ->get();
        $cat = tiposervicios::All();

        $asociados = servicios::WHERE('gid_predio', '=', '2')
                ->orderBy('id_tiposerviciopredio', 'ASC')
                ->get();
        $nombre = tiposervicios::WHERE('id', '=', $id);
        $servicios = servicios::
                join('tiposervicios', 'serviciospredio.id_tiposerviciopredio', '=', 'tiposervicios.id')
                ->orderBy('tiposervicios.id', 'ASC')
                ->get();
        $techos= TechosConstruccion::WHERE('gid_construccion', '=', 1)
                ->join('tipostecho', 'tipostecho.Id', '=', 'techosconstruccion.id_tipotecho')
                ->orderBy('id', 'ASC')
                ->get();
        return View::make('complementarios.cargar', compact("datos", "const", "predios", "condominio", "prop", "cat", "servicios", "asociados", "nombre","techos"));
    }
    /**
     * Cargar Instalaciones Especiales
     * @param type $id
     * @return type
     */
    public function getAgregar($id = null) {
        $catalogo = InstalacionesEspeciales::All();
        return View::make('complementarios.agregar', ['datos' => $id], compact("catalogo"));
    }

    public function post_agregar() {

        $inputs = Input::All();
        $reglas = array
            (
            'instalacion' => 'required',
        );
        $mensajes = array
            (
            "required" => "este campo es obligatorio",
            "min" => "debe tener como minimo 5 caracteres"
        );
        $validar = Validator::make($inputs, $reglas, $mensajes);
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $id = Input::get('id');
            $input = $inputs["instalacion"];
            $n = new instalaciones();
            $n->clave = $id;
            $n->id_tipo_ie = $input;
            $n->save();
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
            //return Redirect::to('complementarios/agregar');
            return Redirect::back();
        }
    }

    public function getCargar($id) {
        $catalogo = InstalacionesEspeciales::All()->lists('descripcion', 'id');
        $datos = instalaciones::find($id);
        return View::make('complementarios.editar', compact("datos", "catalogo"));
    }

    public function getEditar() {
        $inputs = Input::All();
        $id = Input::get('id');
        $datos = instalaciones::find($id);
        $datos->id_tipo_ie = $inputs["instalacion"];
        $datos->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }

    public function getEliminar($id = null) {
        $elim = instalaciones::find($id);
        $elim->delete();
        return Redirect::back();
    }

    //construcciones
    public function getConstruccion($id = null) {
        $const = construcciones::WHERE('clave', 'LIKE', '%' . $id . '%')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        return View::make('complementarios.cargar', compact("const"));
    }

    public function getCargarconstruccion($id) {
        $construcciones = construcciones::find($id);
        $catalogo = UsoConstruccion::All()->lists('descripcion', 'id');
        return View::make('complementarios.editarconstruccion', compact("construcciones", "catalogo"));
    }

    public function getEditarConstruccionConstruccion() {
        $inputs = Input::All();
        $id = Input::get('id');
        $datos = construcciones::find($id);
        $datos->uso_construccion = $inputs["uso"];
        $datos->sup_const = $inputs["sup_const"];
        $datos->nivel = $inputs["nivel"];
        $datos->edad_const = $inputs["edad"];
        $datos->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }

    public function getEliminarConstruccion($id = null) {
        $eliminar = construcciones::find($id);
        $eliminar->delete();
        return Redirect::back();
    }

    public function getAgregarConstruccion($id = null) {
        $catalogo = UsoConstruccion::All();
        return View::make('complementarios.agregarconstruccion', ['datos' => $id], compact("catalogo"));
    }

    public function post_AgregarAgregarConstruccion() {
        $inputs = Input::All();
        $reglas = array
            (
            'uso' => 'required',
            'sup_const' => 'numeric|required',
            'nivel' => 'numeric|required',
            'edad' => 'numeric|required'
        );
        $mensajes = array
            (
            "numeric" => "Es numerico",
            "required" => "este campo es obligatorio",
        );
        $validar = Validator::make($inputs, $reglas, $mensajes);
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $id = Input::get('id');
            $n = new construcciones();
            $n->clave = $id;
            $n->uso_construccion = $inputs["uso"];
            $n->sup_const = $inputs["sup_const"];
            $n->nivel = $inputs["nivel"];
            $n->edad_const = $inputs["edad"];
            $n->save();
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
            return Redirect::back();
        }
    }

    public function getAgregarCondominio($id = null) {
        return View::make('complementarios.agregarcondominio', ['datos' => $id]);
    }

    public function post_addcondominio() {
        $id = Input::get('id');
        $inputs = Input::All();
        $max_id = condominios::where('clave', 'LIKE', '%' . $id . '%')->max('no_condominal');
        $no_condominal = $max_id + 1;
        $n = new condominios();
        $n->id_propietarios = $inputs["id_propietarios"];
        $n->clave = $id;
        $n->no_condominal = $no_condominal;
        $n->tipo_priva = $inputs["tipo_priva"];
        $n->sup_comun = $inputs["sup_comun"];
        $n->indiviso = $inputs["indiviso"];
        $n->sup_total_comun = $inputs["sup_total_comun"];
        $n->no_unidades = $inputs["no_unidades"];

        $n->save();
        return Redirect::back();
    }

    public function getEliminarCondominio($id = null) {
        $eliminar = condominios::find($id);
        $eliminar->delete();
        return Redirect::back();
    }

    public function getEditarCondominio($id = null) {
        $condominio = condominios::find($id);
        return View::make('complementarios.editarcondominio', compact("condominio"));
    }

    public function getCondominio() {
        $inputs = Input::All();
        $id = Input::get('id');
        $n = condominios::find($id);
        $n->entidad = $inputs["entidad"];
        $n->municipio = $inputs["municipio"];
        $n->no_condominal = $inputs["no_condominal"];
        $n->tipo_priva = $inputs["tipo_priva"];
        $n->sup_comun = $inputs["sup_comun"];
        $n->indiviso = $inputs["indiviso"];
        $n->sup_comun_magno = $inputs["superf_comun_magno"];
        $n->indiviso_magno = $inputs["indiviso_magno"];
        $n->cve_magno = $inputs["cve_magno"];
        $n->sup_total_comun = $inputs["sup_total_comun"];
        $n->no_unidades = $inputs["no_unidades"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }

    public function get_servicios() {
        $cat = tiposervicios::All();
        return View::make('complementarios.complementos.servicio', compact("cat"));
    }

    public function post_agregarservicio() {
        $inputs = Input::All();
        //print_r($inputs);
       $gid = Input::get('gid');
        $actuales = $inputs['serv'];
        $opcion = $inputs['opcion'];
        $fuera = $inputs['fuera'];
        $contar = count($actuales);
        $confuera = count($fuera);

        if ($confuera>=1) {
        foreach ($fuera as $key)
        {
            $id=$key;
             $eliminar = servicios::where('id_tiposerviciopredio', '=', $id);
             $eliminar->delete();
             return Redirect::back();
        }
    }
      if (!$contar) {
            if (sizeof($actuales) == 0) {
                $count = count($opcion);
                for ($x = 0; $x < $count; $x++) {
                    $n = new servicios();
                    $n->gid_predio = $gid;
                    $n->id_tiposerviciopredio = $opcion[$x];
                    $n->save();

                }
                return Redirect::back();
            }
        } else {

            foreach ($opcion as $id) {
                if (in_array($id, $actuales)) {

                } else {
                    $total[] = $id;
                }
            }
            $count = count($total);
            for ($x = 0; $x < $count; $x++) {
                $n = new servicios();
//                $id = 2;
                $n->gid_predio = $gid;
                $n->id_tiposerviciopredio = $total[$x];
                $n->save();
            }
//        return View::make('complementarios.agregar-servicios');
            return Redirect::back();
//        }
        }
    }

    public
            function getEliminarServicio($id = null) {

          $eliminar = servicios::find($id);
        $eliminar->delete();
        return Redirect::back();
    }

}
