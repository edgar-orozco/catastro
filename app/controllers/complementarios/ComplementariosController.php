<?php

error_reporting(E_ERROR | E_WARNING);

class complementarios_ComplementariosController extends BaseController {

    protected $por_pagina = 10;

    public function index() {

         if(Request::ajax())
        {
            $predio = Input::get('data');
            $municipio = Input::get('municipio');
            $predio = Str::upper($predio);
            $consul = array(
                            'clave_catas'   =>  $predio,
                            'municipio'     =>  $municipio);
            $busqueda = predios::WHERE($consul)
//                ->orWhere('clave_ori', $predio)
                ->orderBy('gid', 'ASC')
                ->get();
//                ->paginate($this->por_pagina);
                $size = count($busqueda);


                
            return Response::json(array
                (
                    'busqueda'  =>  $busqueda,
                    'size'      =>  $size,
                    'municipio' =>  $municipio
                ));

        }
        else
        {
            $municipios = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio','municipio');
            $municipios = $municipios;
            return View::make('complementarios.complementarios', compact('municipios'));
        }
        
    }

    public function getPredio($id = null) 
    {
        $predios = predios::find($id);
        return View::make('complementarios.complementarios', compact("predios"));
    }


    public function postConstruccion()
    {

        $gid            =   Input::get('gid');
        $entidad        =   input::get('estado');
        $municipio      =   input::get('municipio');
        $clave_cata     =   input::get('clave_cata');
        $nivel          =   input::get('nivel');
        $sup_const      =   input::get('superficie_construccion');
        $edad_const     =   input::get('edad_construccion');
        $edad           =   input::get('edad');
        $uso_constru    =   input::get('uso_construccion');
        $clase_constru  =   input::get('clase_construccion');





        return Response::json(array
            (
                'entra' =>  'siii'
            ));


    }
    //Guardar en la tabla Predio

    public function postPredio()
    {

        $tipo_predio    =   Input::get('tipo_predio');
        $tipo_propiedad =   input::get('tipo_propiedad');
        $niveles        =   input::get('niveles');
        $folio          =   input::get('folio');
        $super_terreno  =   input::get('superficie_terreno');
        $uso_constru    =   input::get('uso_construccion');
        $gid            =   input::get('gid');

        
            
        $predios = predios::find($gid);
        $predios->tipo_predio = $tipo_predio;
        $predios->tipo_propiedad = $tipo_propiedad;
        $predios->niveles = $niveles;
        $predios->folio = $folio;
        $predios->superficie_terreno = $super_terreno;
        $predios->uso_construccion_gen = $uso_constru;
        $predios->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
       
       

        return Response::json(array
            (
                'tipo_predio'       =>  $tipo_predio,
                'tipo_propiedad'    =>  $tipo_propiedad,
                'niveles'           =>  $niveles,
                'folio'             =>  $folio,
                'super_terreno'     =>  $super_terreno,
                'uso_constru'       =>  $uso_constru
            ));




    }

    public function getInstalacion($id = null) 
    {
        $predios = predios::WHERE('predios.gid', '=', $id)
                ->join('municipios', 'predios.municipio', '=', 'municipios.municipio')
                ->join('entidades', 'predios.entidad', '=', 'entidades.entidad')
                ->get();

        $clave_catas = $predios[0]->clave_catas;
        $const = construcciones::WHERE('clave_catas', '=', '"'.$clave_catas.'"')->get();

        $tuc            = ['' => '--seleccione una opción--'] +     UsoConstruccion::orderBy('descripcion', 'ASC')->lists('descripcion','id_tuc');
        $tcc            = ['' => '--seleccione una opción--'] +     TiposClaseConstruccion::orderBy('descripcion', 'ASC')->lists('descripcion','id_tcc');
        $ttc            = ['' => '--seleccione una opción--'] +     TiposTechos::orderBy('descripcion', 'ASC')->lists('descripcion','id_ttc');
        $tec            = ['' => '--seleccione una opción--'] +     TiposEstadosConservacion::orderBy('descripcion', 'ASC')->lists('descripcion','id_tec');
        $tmc            = ['' => '--seleccione una opción--'] +     TiposMuros::orderBy('descripcion', 'ASC')->lists('descripcion','id_tmc');
        $tpic           = ['' => '--seleccione una opción--'] +     TiposPisos::orderBy('descripcion', 'ASC')->lists('descripcion','id_tpic');
        $tpuc           = ['' => '--seleccione una opción--'] +     TiposPuertas::orderBy('descripcion', 'ASC')->lists('descripcion','id_tpuc');
        $tvc            = ['' => '--seleccione una opción--'] +     TiposTechos::orderBy('descripcion', 'ASC')->lists('descripcion','id_ttc');
        $catalogo       = ['' => '--seleccione una opción--'] +     InstalacionesEspeciales::orderBy('descripcion', 'ASC')->lists('descripcion','id_tipoie');
        $gid            = $id;
        $estado         = $predios[0]->entidad;
        $municipio      = $predios[0]->municipio;
        $cat            = tiposervicios::orderBy('descripcion', 'ASC')->get();
        $asociados      = servicios::WHERE('gid_predio', '=', '2')
                            ->orderBy('id_serviciopredio', 'ASC')
                            ->get();
        $giros          = TipoGiros::orderBy('descripcion', 'ASC')->get();
        
        $datos          = instalaciones::WHERE('instalacionesespeciales.gid_predio', '=', $id)
                            ->join('tipoinstalacionesespeciales', 'tipoinstalacionesespeciales.id_tipoie', '=', 'instalacionesespeciales.id_tipoie')
                            ->get();

        /*
        

        $condominio = condominios::WHERE('clave', 'LIKE', '%' . $id . '%')
                ->orderBy('id_condominio', 'ASC')
                ->get();
//      $prop = predios::WHERE('predios.clave', '=', '002-0007-000008')
//                ->join('propietarios', 'propietarios.clave', '=', 'predios.clave')
//                ->join('personas', 'personas.id_p', '=', 'propietarios.id_propietario')
//                ->select()
//                ->get();
        
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
        
        return View::make('complementarios.cargar', compact("datos", "const", "predios", "condominio", "prop", "cat", "servicios", "asociados", "nombre", "techos", "muros", "clases", "ventanas", "giros", "girosasociados", "puertas", "pisos"));
        */


        return View::make('complementarios.cargar', compact("predios","const", "tuc" ,"tcc", "ttc", "tec", "tmc", "tpic", "tpuc", "tvc", "catalogo", "gid", "clave_catas", "estado", "municipio", "cat", "asociados", "giros", "girosasociados", "datos"));
    }

    /**
     * Cargar Instalaciones Especiales
     * @param type $id
     * @return type
     */
    public function getAgregar($id = null) {
        $catalogo = ['' => '--seleccione una opción--'] +InstalacionesEspeciales::orderBy('descripcion', 'ASC')->lists('descripcion','id_tipoie');

        return View::make('complementarios.agregar', ['datos' => $id], compact("catalogo"));
    }

    public function post_agregar() {

        $inputs = Input::get('instalaciones');
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
            return Response::json(array
                (
                    "estado" => $validar
                ));
        } 
        else 
        {
        
            $id = Input::get('id');
            
            $n = new instalaciones();
            $n->clave = $id;
            $n->id_tipo_ie = $input;
            $n->save();
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
            //return Redirect::to('complementarios/agregar');
            return Response::json(array
                (
                    'instalaciones' => '' 
                ));
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
        $max_id = condominios::where('gid_predio', '=',  $id )->max('no_condominal');
        $no_condominal = $max_id+1;
        $n = new condominios();
         $n->entidad='27';
        $n->municipio='008';
        //$n->id_propietarios = $inputs["id_propietarios"]
        $n->clave_catas = $id;
        $n->no_condominal = $no_condominal;
        $n->tipo_priva = $inputs["tipo_priva"];
        $n->sup_comun = $inputs["sup_comun"];
        $n->indiviso = $inputs["indiviso"];
        $n->sup_comun_magno=0;
        $n->indiviso_magno=0;
        $n->cve_magno='0';
        $n->sup_total_comun = $inputs["sup_total_comun"];
        $n->no_unidades = $inputs["no_unidades"];
        $n->gid_predio=$id;
        $n->sup_privativa='0';
        $n->clave_INEGI_cond='0';
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
        return View::make('complementarios.agregar-pisos', compact("pisos", "const"));
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

    public function getRedireccionar() {
        return View::make('complementarios.cargar');
    }

}
