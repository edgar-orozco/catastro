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
                ->get();
        $const = construcciones::WHERE('clave', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->join('tipoclasesconstruccion', 'tipoclasesconstruccion.id', '=', 'construccion.clase_const')
                ->orderBy('gid_construccion', 'ASC')
                ->select('construccion.gid_construccion AS gid_construccion', 'tiposusosconstruccion.descripcion AS DescripcionUso', 'construccion.sup_const AS Superficie', 'construccion.nivel AS Nivel', 'construccion.edad_const AS Edad', 'tipoclasesconstruccion.descripcion AS DescripcionClase', 'construccion.estado_const AS Estado')
                ->get();

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
        $cat = tiposervicios::orderBy('descripcion', 'ASC') ->get();

        $asociados = servicios::WHERE('gid_predio', '=', '2')
                ->orderBy('id_tiposerviciopredio', 'ASC')
                ->get();
        $nombre = tiposervicios::WHERE('id', '=', $id);

        $servicios = servicios::
                join('tiposervicios', 'serviciospredio.id_tiposerviciopredio', '=', 'tiposervicios.id_tiposervicio')
                ->orderBy('tiposervicios.id_tiposervicio', 'ASC')
                ->get();

        $techos = construcciones::WHERE('clave', '=', $id, 'and', 'gid_construccion', 'IN', $const)
                ->join('techosconstruccion', 'construccion.gid_construccion', '=', 'techosconstruccion.gid_construccion')
                ->join('tipostecho', 'techosconstruccion.id_tipotecho', '=', 'tipostecho.id')
                ->get();

        $muros = construcciones::WHERE('clave', '=', $id, 'and', 'gid_construccion', 'IN', $const)
                ->join('murosconstruccion', 'construccion.gid_construccion', '=', 'murosconstruccion.gid_construccion')
                ->join('tipomuros', 'murosconstruccion.id_tipomuro', '=', 'tipomuros.id')
                ->get();

        $clases = construcciones::WHERE('clave', '=', $id, 'and', 'gid_construccion', 'IN', $const)
                ->join('clasesconstruccion', 'construccion.gid_construccion', '=', 'clasesconstruccion.gid_construccion')
                ->join('tipoclasesconstruccion', 'clasesconstruccion.id_tipoclaseconstruccion', '=', 'tipoclasesconstruccion.id')
                ->get();

        $ventanas = construcciones::WHERE('clave', '=', $id, 'and', 'gid_construccion', 'IN', $const)
                ->join('ventanasconstruccion', 'construccion.gid_construccion', '=', 'ventanasconstruccion.gid_construccion')
                ->join('tiposventana', 'ventanasconstruccion.id', '=', 'tiposventana.id')
                ->get();
        $puertas = construcciones::WHERE('clave', '=', $id, 'and', 'gid_construccion', 'IN', $const)
                ->join('puertaspredio', 'construccion.gid_construccion', '=', 'puertaspredio.gid_construccion')
                ->join('TiposPuertas', 'puertaspredio.id_tipopuerta', '=', 'TiposPuertas.id_tipopuerta')
                ->get();
         $pisos = construcciones::WHERE('clave', '=', $id, 'and', 'gid_construccion', 'IN', $const)
                ->join('pisospredio', 'construccion.gid_construccion', '=', 'pisospredio.gid_construccion')
                ->join('tipopisos', 'pisospredio.id_pisopredio', '=', 'tipopisos.id_tipopiso')
                ->get();
        $giros = TipoGiros::orderBy('descripcion', 'ASC') ->get();
        $girosasociados = Giros::WHERE('gid_construccion', '=', '2')
                ->orderBy('id', 'ASC')
                ->get();
        return View::make('complementarios.cargar', compact("datos", "const", "predios", "condominio", "prop", "cat", "servicios", "asociados", "nombre", "techos", "muros", "clases", "ventanas", "giros", "girosasociados","puertas","pisos"));
    }

    /**
     * Cargar Instalaciones Especiales
     * @param type $id
     * @return type
     */
    public function getAgregar($id = null) {
        $catalogo = InstalacionesEspeciales::cat_inst($id);
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
        $usos = UsoConstruccion::All()->lists('descripcion', 'id');
        $clase = TiposClaseConstruccion::All()->lists('descripcion', 'id');
        $const = construcciones::WHERE('clave', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        $clases = construcciones::WHERE('clave', '=', $id, 'and', 'gid_construccion', 'IN', $const)
                ->join('clasesconstruccion', 'construccion.gid_construccion', '=', 'clasesconstruccion.gid_construccion')
                ->join('tipoclasesconstruccion', 'clasesconstruccion.id_tipoclaseconstruccion', '=', 'tipoclasesconstruccion.id')
                ->get();
        return View::make('complementarios.editarconstruccion', compact("construcciones", "usos", "techos", "clases", "clase"));
    }

    public function getEditarConstruccionConstruccion() {
        $inputs = Input::All();
        $id = Input::get('id');
        $datos = construcciones::find($id);
        $datos->uso_construccion = $inputs["uso"];
        $datos->sup_const = $inputs["sup_const"];
        $datos->nivel = $inputs["nivel"];
        $datos->edad_const = $inputs["edad"];
        $datos->clase_const = $inputs["clase_const"];
        $datos->estado_const = $inputs["estado_const"];
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
        $clases = TiposClaseConstruccion::All();
        return View::make('complementarios.agregarconstruccion', ['datos' => $id], compact("catalogo", "clases"));
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
            $n->clase_const = $inputs["clase_const"];
            $n->estado_const = $inputs["estado_const"];
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
        $gid = Input::get('gid');
        $actuales = $inputs['serv'];
        $opcion = $inputs['opcion'];
        $fuera = $inputs['fuera'];
        $contar = count($actuales);
        $confuera = count($fuera);

        if ($confuera >= 1) {
            foreach ($fuera as $key) {
                $id = $key;
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

    public function getEliminarServicio($id = null) {

        $eliminar = servicios::find($id);
        $eliminar->delete();
        return Redirect::back();
    }

    public function getAgregarTechos($id = null) {
        $techos = TiposTechos::All();
        $const = construcciones::WHERE('gid_construccion', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        return View::make('complementarios.agregar-techos', compact("techos", "const"));
    }

    public function postAgregarTechos($id = null) {
        $gidc = Input::get('gidc');
        $inputs = Input::All();
        $n = new TechosConstruccion();
        $n->gid_construccion = $gidc;
        $n->id_tipotecho = $inputs["id_tipotecho"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
//        return View::make('complementarios.agregar-techos', ['datos' => $id], compact("techos"));
    }

    public function getEliminarTechos($id = null, $gid = null) {

        DB::delete('delete from techosconstruccion where gid_construccion= ' . $gid . ' AND ' . 'id_tipotecho=' . $id);
        return Redirect::back();
    }

    public function getAgregarMuros($id = null) {
        $muros = TiposMuros::All();
        $const = construcciones::WHERE('gid_construccion', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        return View::make('complementarios.agregar-muros', compact("muros", "const"));
    }

    public function postAgregarMuros() {
        $gidm = Input::get('gidm');
        $inputs = Input::All();
        $n = new MurosConstruccion();
        $n->gid_construccion = $gidm;
        $n->id_tipomuro = $inputs["id_tipomuros"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }

    public function getEliminarMuros($id = null, $gid = null) {
        DB::delete('DELETE FROM murosconstruccion WHERE gid_construccion= ' . $gid . ' AND ' . 'id_tipomuro=' . $id);
        return Redirect::back();
    }

    public function getAgregarClaseConstruccion($id = null) {
        $const = construcciones::WHERE('gid_construccion', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        return View::make('complementarios.agregar-claseconstruccion', compact("const"));
    }

    public function postAgregarClaseConstruccion() {
        $gidcn = Input::get('gidcn');
        $inputs = Input::All();
        $n = new ClaseConstruccion();
        $n->gid_construccion = $gidcn;
        $n->id_tipoclaseconstruccion = $inputs["id_tipoclaseconstruccion"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }

    public function getEliminarClases($id = null, $gid = null) {
        DB::delete('DELETE FROM clasesconstruccion WHERE gid_construccion= ' . $gid . ' AND ' . 'id_tipoclaseconstruccion=' . $id);
        return Redirect::back();
    }

    public function getAgregarVentanas($id = null) {
        $ventanas = tiposventana::All();
        $const = construcciones::WHERE('gid_construccion', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        return View::make('complementarios.agregar-ventanas', compact("ventanas", "const"));
    }

    public function postAgregarVentanas($id = null) {
        $gidv = Input::get('gidv');
        $inputs = Input::All();
        $n = new VentanasConstruccion();
        $n->gid_construccion = $gidv;
        $n->id_tipoventana = $inputs["id_tipoventana"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
//        return View::make('complementarios.agregar-techos', ['datos' => $id], compact("techos"));
    }

    public function getEliminarVentanas($id = null, $gid = null) {
        DB::delete('DELETE FROM ventanasconstruccion WHERE gid_construccion= ' . $gid . ' AND ' . 'id_tipoventana=' . $id);
        return Redirect::back();
    }

    public function post_agregargiros() {
        $inputs = Input::All();
        $gid = Input::get('gid');
        $actuales = $inputs['select'];
        $giros = $inputs['giros'];
        $eliminar = $inputs['eliminar'];
        $contar = count($actuales);
        $confuera = count($eliminar);

        if ($confuera >= 1) {
            foreach ($eliminar as $key) {
                $id = $key;
                $eliminar = Giros::where('id_giroconstruccion', '=', $id);
                $eliminar->delete();
                return Redirect::back();
            }
        }
        if (!$contar) {
            if (sizeof($actuales) == 0) {
                $count = count($giros);
                for ($x = 0; $x < $count; $x++) {
                    $n = new Giros();
                    $n->gid_construccion = $gid;
                    $n->id_giroconstruccion = $giros[$x];
                    $n->save();
                }
                return Redirect::back();
            }
        } else {
            foreach ($giros as $id) {
                if (in_array($id, $actuales)) {
                    
                } else {
                    $total[] = $id;
                }
            }
            $count = count($total);
            for ($x = 0; $x < $count; $x++) {
                $n = new Giros();
                $n->gid_construccion = $gid;
                $n->id_giroconstruccion = $total[$x];
                $n->save();
            }
//        return View::make('complementarios.agregar-servicios');
            return Redirect::back();
//        }
        }
    }
     public function getMostrarPuertas($id = null) {
        $puertas = TiposPuertas::All();
        $const = construcciones::WHERE('gid_construccion', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        return View::make('complementarios.agregar-puertas', compact("puertas", "const"));
    }

    public function postAgregarPuertas() {
        $gidc = Input::get('gidc');
        $inputs = Input::All();
        $n = new PuertasPredio();
        $n->gid_construccion = $gidc;
        $n->id_tipopuerta = $inputs["id_tipopuerta"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }
    public function getEliminarPuertas($id = null, $gid = null) {
        DB::delete('DELETE FROM puertaspredio WHERE gid_construccion= ' . $gid . ' AND ' . 'id_tipopuerta=' . $id);
        return Redirect::back();
    }
    
     public function getMostrarPisos($id = null) {
        $pisos = TiposPiso::All();
        $const = construcciones::WHERE('gid_construccion', '=', $id)
                ->join('tiposusosconstruccion', 'tiposusosconstruccion.id', '=', 'construccion.uso_construccion')
                ->orderBy('gid_construccion', 'ASC')
                ->get();
        return View::make('complementarios.agregar-pisos', compact("pisos","const"));
    }
     public function postAgregarPisos() {
        $gidc = Input::get('gidc');
        $inputs = Input::All();
        $n = new PisosPredio();
        $n->gid_construccion = $gidc;
        $n->id_tipopiso = $inputs["id_tipopisos"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }
     public function getEliminarPisos($id = null, $gid = null) {
        DB::delete('DELETE FROM pisospredio WHERE gid_construccion= ' . $gid . ' AND ' . 'id_tipopiso=' . $id);
        return Redirect::back();
    }

}
