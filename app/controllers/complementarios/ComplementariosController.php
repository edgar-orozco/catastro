<?php

error_reporting(E_ERROR | E_WARNING);

class complementarios_ComplementariosController extends BaseController {

    protected $por_pagina = 10;

    public function index() {

        if (Request::ajax()) {
            $predio = Input::get('data');
            $municipio = Input::get('municipio');
            $predio = Str::upper($predio);
            $consul = array(
                'clave_catas' => $predio,
                'municipio' => $municipio);
            $busqueda = predios::WHERE($consul)
//                ->orWhere('clave_ori', $predio)
                    ->orderBy('gid', 'ASC')
                    ->get();
//                ->paginate($this->por_pagina);
            $size = count($busqueda);



            return Response::json(array
                        (
                        'busqueda' => $busqueda,
                        'size' => $size,
                        'municipio' => $municipio
            ));
        } else {
            $municipios = Municipio::orderBy('nombre_municipio', 'ASC')->lists('nombre_municipio', 'municipio');
            $municipios = $municipios;
            return View::make('complementarios.complementarios', compact('municipios'));
        }
    }

    public function getConstruccion() {
        $gid = (integer) Input::get('gid');
        $datos_construcciones = construcciones::where('gid', '=', $gid)->get();



        return Response::json(array(
                    'gid' => $datos_construcciones[0]->gid,
                    'nivel' => $datos_construcciones[0]->nivel,
                    'sup_const' => $datos_construcciones[0]->sup_const,
                    'edad_const' => $datos_construcciones[0]->edad_const,
                    'id_tuc' => $datos_construcciones[0]->id_tuc,
                    'id_tcc' => $datos_construcciones[0]->id_tcc,
                    'id_ttc' => $datos_construcciones[0]->id_ttc,
                    'id_tec' => $datos_construcciones[0]->id_tec,
                    'id_tmc' => $datos_construcciones[0]->id_tmc,
                    'id_tpic' => $datos_construcciones[0]->id_tpic,
                    'id_tpuc' => $datos_construcciones[0]->id_tpuc,
                    'id_tvc' => $datos_construcciones[0]->id_tvc
        ));
    }

    public function postConstruccion() {

        $inputs = Input::all();
        $gid_construccion = Input::get('gid_construccion');
        $gid_predio = Input::get('gid');
        $entidad = input::get('estado');
        $municipio = input::get('municipio');
        $clave_cata = input::get('clave_cata');
        $nivel = input::get('nivel');
        $sup_const = input::get('superficie_construccion');
        $edad_const = input::get('edad_construccion');
        $edad = input::get('edad');
        $uso_constru = input::get('uso_construccion');
        $clase_constru = input::get('clase_construccion');
        $techo_constru = input::get('techo_construccion');
        $estado_conser = input::get('estado_conservacion');
        $muro_constru = input::get('muro_construccion');
        $piso_constru = input::get('piso_construccion');
        $puerta_constru = input::get('puerta_construccion');
        $venta_constru = input::get('ventana_construccion');



        $reglas = array
            (
            'nivel' => 'required|integer',
            'superficie_construccion' => 'required',
            'edad_construccion' => 'required|integer',
            'uso_construccion' => 'required',
            'clase_construccion' => 'required',
            'techo_construccion' => 'required',
            'estado_conservacion' => 'required',
            'muro_construccion' => 'required',
            'piso_construccion' => 'required',
            'puerta_construccion' => 'required',
            'ventana_construccion' => 'required',
        );
        $mensajes = array
            (
            'required' => 'este campo es obligatorio'
        );
        $validar = Validator::make($inputs, $reglas, $mensajes);


        if ($validar->fails()) {

            return Response::json($validar->messages()->toArray());
        }






        if ((integer) $gid_construccion == 0) {


            $gid = construcciones::orderBy('gid', 'DESC')->first()->gid + 1;
            $constru = new construcciones();
        } else {
            $constru = construcciones::where(['gid' => $gid_construccion])->get();
            $gid = $constru[0]->gid;
            $constru = construcciones::find($gid);
        }
        $constru->gid = $gid;
        $constru->entidad = $entidad;
        $constru->municipio = $municipio;
        $constru->clave_catas = $clave_cata;
        $constru->gid_predio = $gid_predio;
        $constru->nivel = $nivel;
        $constru->sup_const = $sup_const;
        $constru->edad_const = $edad_const;
        $constru->id_tuc = $uso_constru;
        $constru->id_tcc = $clase_constru;
        $constru->id_ttc = $techo_constru;
        $constru->id_tec = $estado_conser;
        $constru->id_tmc = $muro_constru;
        $constru->id_tpic = $piso_constru;
        $constru->id_tpuc = $puerta_constru;
        $constru->id_tvc = $venta_constru;
        $constru->save();


        $clase_constru = TiposClaseConstruccion::Find($clase_constru)->descripcion;


        return Response::json(array
                    (
                    'estado' => 'success',
                    'gid_construccion' => $gid_construccion,
                    'gid_construccion2' => $gid,
                    'nivel' => $nivel,
                    'sup_const' => $sup_const,
                    'edad_const' => $clase_constru
        ));
    }

    public function eliminarConstruccion() {
        $gid_construccion = Input::get('gid_construccion');
        $elim = construcciones::find($gid_construccion);
        $elim->delete();

        return Response::json(array
                    (
                    'gid_construccion' => $gid_construccion
        ));
    }

//Guardar en la tabla Predio
    public function getPredio($id = null) {
        $predios = predios::find($id);
        return View::make('complementarios.complementarios', compact("predios"));
    }

    public function postPredio() {

        $tipo_predio = Input::get('tipo_predio');
        $tipo_propiedad = input::get('tipo_propiedad');
        $niveles = input::get('niveles');
        $folio = input::get('folio');
        $super_terreno = input::get('superficie_terreno');
        $uso_constru = input::get('uso_construccion');
        $gid = input::get('gid');
        $entidad = input::get('entidad');
        $municipio = input::get('municipio');
        $clave_cata = input::get('clave_catas');


        $predios = predios::find($gid);
        $predios->tipo_predio = $tipo_predio;
        $predios->tipo_propiedad = $tipo_propiedad;
        $predios->niveles = $niveles;
        $predios->folio = $folio;
        $predios->superficie_terreno = $super_terreno;
       
            
        $predios->uso_construccion = $uso_constru;
        $predios->save();

        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');



        return Response::json(array
                    (
                    'tipo_predio' => $tipo_predio,
                    'tipo_propiedad' => $tipo_propiedad,
                    'niveles' => $niveles,
                    'folio' => $folio,
                    'super_terreno' => $super_terreno,
                    'uso_constru' => $uso_constru
        ));
    }

    public function getInstalacion($id = null) {
        $predios = predios::WHERE('predios.gid', '=', $id)
                ->join('municipios', 'predios.municipio', '=', 'municipios.municipio')
                ->join('entidades', 'predios.entidad', '=', 'entidades.entidad')
                ->get();

        $clave_catas = $predios[0]->clave_catas;

        $const = construcciones::WHERE('clave_catas', '=', '"' . $clave_catas . '"')->get();

        $tuc = ['' => '--seleccione una opción--'] + UsoConstruccion::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tuc');
        $tcc = ['' => '--seleccione una opción--'] + TiposClaseConstruccion::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tcc');
        $ttc = ['' => '--seleccione una opción--'] + TiposTechos::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_ttc');
        $tec = ['' => '--seleccione una opción--'] + TiposEstadosConservacion::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tec');
        $tmc = ['' => '--seleccione una opción--'] + TiposMuros::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tmc');
        $tpic = ['' => '--seleccione una opción--'] + TiposPisos::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tpic');
        $tpuc = ['' => '--seleccione una opción--'] + TiposPuertas::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tpuc');
        $tvc = ['' => '--seleccione una opción--'] + TiposVentana::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tvc');
        $catalogo = ['' => '--seleccione una opción--'] + InstalacionesEspeciales::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tipoie');
        $gid = $id;
        $estado = $predios[0]->entidad;
        $municipio = $predios[0]->municipio;
        $cat = tiposervicios::orderBy('descripcion', 'ASC')->get();
        $asociados = servicios::WHERE('gid_predio', '=', '4219')
                ->orderBy('id_serviciopredio', 'ASC')
                ->get();
        $giros = TipoGiros::orderBy('descripcion', 'ASC')->get();
        $girosasociados = Giros::WHERE('gid_predio', '=', '4219')
                ->orderBy('id_tipogiro', 'ASC')
                ->get();

        $datos = instalaciones::WHERE('instalacionesespeciales.gid_predio', '=', $id)
                ->join('tipoinstalacionesespeciales', 'tipoinstalacionesespeciales.id_tipoie', '=', 'instalacionesespeciales.id_tipoie')
                ->get();

        $condominio = condominios::WHERE('gid_predio', '=', $id)->get();

        $const = construcciones::WHERE('clave_catas', '=', '"' . $clave_catas . '"')->get();

        $tuc = ['' => '--seleccione una opción--'] + UsoConstruccion::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tuc');
        $tus = ['' => '--seleccione una opción--'] + TipoSuelo::orderBy('descripcion', 'ASC')->lists('descripcion', 'id');
        $tcc = ['' => '--seleccione una opción--'] + TiposClaseConstruccion::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tcc');
        $ttc = ['' => '--seleccione una opción--'] + TiposTechos::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_ttc');
        $tec = ['' => '--seleccione una opción--'] + TiposEstadosConservacion::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tec');
        $tmc = ['' => '--seleccione una opción--'] + TiposMuros::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tmc');
        $tpic = ['' => '--seleccione una opción--'] + TiposPisos::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tpic');
        $tpuc = ['' => '--seleccione una opción--'] + TiposPuertas::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tpuc');
        $tvc = ['' => '--seleccione una opción--'] + TiposVentana::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tvc');
//$catalogo = ['' => '--seleccione una opción--'] + InstalacionesEspeciales::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tipoie');
        $gid = $id;
        $catalogo = InstalacionesEspeciales::orderBy('descripcion', 'ASC')->get();
        $ieasociados = instalaciones::WHERE('gid_predio', '=', $gid)
                ->orderBy('id_tipoie', 'ASC')
                ->get();

        $estado = $predios[0]->entidad;
        $municipio = $predios[0]->municipio;
        $cat = tiposervicios::orderBy('descripcion', 'ASC')->get();
        $asociados = servicios::WHERE('gid_predio', '=', $gid)
                ->orderBy('id_serviciopredio', 'ASC')
                ->select('id_tiposervicio')
                ->get();
        $giros = TipoGiros::orderBy('descripcion', 'ASC')->get();
        $girosasociados = Giros::WHERE('gid_predio', '=', $gid)
                ->orderBy('id_tipogiro', 'ASC')
                ->get();

        $datos = instalaciones::WHERE('instalacionesespeciales.gid_predio', '=', $id)
                ->join('tipoinstalacionesespeciales', 'tipoinstalacionesespeciales.id_tipoie', '=', 'instalacionesespeciales.id_tipoie')
                ->get();

        $condominio = condominios::WHERE('gid_predio', '=', $id)->get();



        $servicios = servicios::
                join('tiposervicios', 'serviciospredio.id_tiposervicio', '=', 'tiposervicios.id_tiposervicio')
                ->orderBy('tiposervicios.id_tiposervicio', 'ASC')
                ->get();

        $tta =['' => '--seleccione una opción--'] + TiposTomasAgua::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tipotoma');

        $datos_construcciones = construcciones::where('gid_predio', '=', $id)
        ->join('tiposclasesconstruccion', 'construcciones.id_tcc', '=', 'tiposclasesconstruccion.id_tcc')
        ->get();


        foreach ($predios as $predio) {
            $muni = $predio->municipio;
            $entid = $predio->entidad;
        }
        $datos_predios = DB::select("select sp_get_datos_pre('$clave_catas', '$muni', '$entid')");
        foreach ($datos_predios as $keys) {
            $datos_p[] = explode(',', $keys->sp_get_datos_pre);
        }

        $tomas_agua = TomasAgua::where('gid_predio', '=', $id)->get()->toArray();
        $entrevistados = Entrevistado::where('gid_predio', '=', $id)->get()->toArray();


        //IMAGENES
        $imagenes = ImagenesLevantamiento::where('gid_predio', '=', $id)->select('nombre_archivo', 'id_il', 'id_tipoimagen')->get();
        $file = [];
        $tipo_imagen = TipoImagenes::lists('descripcion', 'id_tipoimagen');
        //For para recorrer cada imagen
        foreach ($imagenes as $imagen) 
        {
            $select_opc = '';
            $select_opcFooter = '';
            $extension = split('[.]', $imagen->nombre_archivo);
            foreach ($tipo_imagen as $key => $descripcion) 
            {
                if ($key==$imagen->id_tipoimagen) 
                {
                    $select_opc = $select_opc."<option selected = 'selected' value='".$key."'>".$descripcion."</option>";
                }
                else
                {
                    $select_opc = $select_opc."<option value='".$key."'>".$descripcion."</option>";
                }
                $select_opcFooter = $select_opcFooter."<option value='".$key."'>".$descripcion."</option>";
            }
            $select = "<select name='select-instalaciones' class='form-control' id='instalaciones'><option selected='selected' value=''>--Seleccione una opción--</option>".print_r($select_opc, true)."</select>";
            $eliminar = "<button type='button' class='kv-file-remove btn btn-xs btn-default' title='Remove file' data-url='/eliminar-anexo/".$imagen->id_il."' data-key='1'><i class='glyphicon glyphicon-trash text-danger'></i></button>";
            $download = "<a href='".$imagen->nombre_archivo."' download='".$extension[0]."' class='btn btn-xs btn-default' title='Descargar'><i class='glyphicon glyphicon-download'></i></a>";
            if(in_array(strtolower($extension[1]), array('png','jpeg','gif','bmp','vnd.microsoft.icon', 'jpg')))
            {
                $file[] = "<img src='" . $imagenes[0]->nombre_archivo . "' class='file-preview-image' >" . $select . $eliminar . $download;
            }
            else
            {
                $file[] = "<span class='glyphicon glyphicon-file' ></span>" . $select . $eliminar . $download;
            }
        }
        $select_opcFooter = '';
        foreach ($tipo_imagen as $key => $descripcion) 
            {
                $select_opcFooter = $select_opcFooter."<option value='".$key."'>".$descripcion."</option>";
            }
        return View::make('complementarios.cargar', compact("tus", "entrevistados", "tomas_agua", "datos_p", "predios", "const", "tuc", "tcc", "ttc", "tec", "tmc", "tpic", "tpuc", "tvc", "catalogo", "gid", "clave_catas", "estado", "municipio", "cat", "asociados", "giros", "girosasociados", "datos", "condominio", "tta", "datos_construcciones", "file", "ieasociados","select_opcFooter"));
    }

    /**
     * Cargar Instalaciones Especiales
     * @param type $id
     * @return type
     */
    public function getAgregar($id = null) {
        $catalogo = ['' => '--seleccione una opción--'] + InstalacionesEspeciales::orderBy('descripcion', 'ASC')->lists('descripcion', 'id_tipoie');

        return View::make('complementarios.agregar', ['datos' => $id], compact("catalogo"));
    }

    public function post_agregar() {
        $inputs = Input::All();
        $entidad = $inputs['entidad'];
        $municipio = $inputs['municipio'];
        $clave_cata = $inputs['clave_cata'];
        $gid_predio = $inputs['gid_predio'];
        $id_tipoie = $inputs['instalaciones'];
//mio
        $eliminar = $inputs['eliminar'];
        $actuales = $id_tipoie;
//$contar = count($actuales);
        $confuera = count($eliminar);

        if ($confuera >= 1) {
            foreach ($eliminar as $key) {
                $id = $key;
                DB::delete("DELETE FROM instalacionesespeciales WHERE id_tipoie =$id AND clave_catas='$clave_cata'");
            }
        }
        if (count($id_tipoie) > 0) {

            $count = count($id_tipoie);
            for ($x = 0; $x < $count; $x++) {
                $n = new instalaciones();
                $n->entidad = $entidad;
                $n->municipio = $municipio;
                $n->clave_catas = $clave_cata;
                $n->gid_predio = $gid_predio;
                $n->id_tipoie = $id_tipoie[$x];
                $n->created_at = date('Y-m-d');
                $n->updated_at = date('Y-m-d');
                $n->save();
            }
            unset($id_tipoie);
        } else {
            foreach ($id_tipoie as $id) {
                if (in_array($id, $id_tipoie)) {
                    
                } else {
                    $total[] = $id;
                }
            }
            $count = count($total);
            for ($x = 0; $x < $count; $x++) {
                $n = new instalaciones();
                $n->entidad = $entidad;
                $n->municipio = $municipio;
                $n->clave_catas = $clave_cata;
                $n->gid_predio = $gid_predio;
                $n->id_tipoie = $total[$x];
                $n->created_at = date('Y-m-d');
                $n->updated_at = date('Y-m-d');
                $n->save();
                return Response::json(array
                            (
                            'mensaje' => 'guardo'
                ));
            }
        }
    }

    public function getCargar($id) {
        $catalogo = InstalacionesEspeciales::All()->lists('descripcion', 'id');
        $datos = instalaciones::find($id);
        return View::make('complementarios.editar', compact("datos", "catalogo"));
    }

//nuevo hoy
    public function postAgua() {
        $gid_p = Input::get('gid_p');
        $gid = Input::get('gid');
        $estado = Input::get('estado');
        $municipio = Input::get('municipio');
        $clave_cata = Input::get('clave_cata');
        $medidor_instalado = Input::get('medidor_instalado');
        $num_medidor = Input::get('num_medidor');
        $num_contrato = Input::get('num_contrato');
        $tipo_toma = Input::get('tipo_toma');
        $id_usuariotoma = Input::get('id_p');

        if ($gid_p == '') {

            $agua = new TomasAgua();
            $agua->entidad = $estado;
            $agua->municipio = $municipio;
            $agua->clave_catas = $clave_cata;
            $agua->gid_predio = $gid;
            $agua->medidor_instalado = $medidor_instalado;
            $agua->num_medidor = $num_medidor;
            $agua->num_contrato = $num_contrato;
            $agua->id_tipotoma = $tipo_toma;
            $agua->id_usuariotoma = $id_usuariotoma;
            $agua->save();
            return Response::json(array
                        (
                        'medidor_instalado' => $medidor_instalado,
                        'num_medidor' => $num_medidor,
                        'num_contrato' => $num_contrato,
                        'tipo_toma' => $tipo_toma,
                        'total_datos' => $total_datos,
                        'total_datos' => $total_datos
            ));
        } else {
            $aguas = TomasAgua::find($gid_p);
            $aguas->medidor_instalado = $medidor_instalado;
            $aguas->num_medidor = $num_medidor;
            $aguas->num_contrato = $num_contrato;
            $aguas->id_tipotoma = $tipo_toma;
            $aguas->id_usuariotoma = $id_usuariotoma;
            $aguas->save();
            return Response::json(array
                        (
                        'medidor_instalado' => $medidor_instalado,
                        'num_medidor' => $num_medidor,
                        'num_contrato' => $num_contrato,
                        'tipo_toma' => $tipo_toma
            ));
        }
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

    public function eliminar_instalacion() {
        $id_ie = Input::get('id_ie');
        $elim = instalaciones::find($id_ie);
        $elim->delete();

        return Response::json(array
                    (
                    'id_ie' => $id_ie
        ));
    }

    public function getAgregarCondominio($id = null) {
        return View::make('complementarios.agregarcondominio', ['datos' => $id]);
    }

    public function post_addcondominio() {
        $id_condominio = Input::get('id_condominio');
        if ($id_condominio != '') {
            $inputs = Input::All();
// print_r($inputs);
            $id = Input::get('id');
            $n = condominios::find($id_condominio);
            $n->tipo_priva = $inputs["tipo_priva"];
            $n->sup_comun = $inputs["sup_comun"];
            $n->indiviso = $inputs["indiviso"];
            $n->sup_total_comun = $inputs["sup_total_comun"];
            $n->no_condominal = $inputs["no_condominal"];
            $n->no_unidades = 0;
            $n->save();
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
           // $no_condominal1 = condominios::where('id_condominio', $id_condominio)->pluck('no_condominal');
            return Response::json(array
                        (
                        'valor' => 1,
                        'id_condominio' => $id_condominio,
                        'tipo_priva' => $inputs["tipo_priva"],
                        'sup_comun' => $inputs["sup_comun"],
                        'indiviso' => $inputs["indiviso"],
                        'sup_total_comun' => $inputs["sup_total_comun"],
                        'no_unidades' => $inputs["no_unidades"],
                        'no_condominal' => $inputs["no_condominal"]
            ));
        } else {
            $id = Input::get('id');
            $clave_catas = predios::where('gid', $id)->pluck('clave_catas');
            $entidad = predios::where('gid', $id)->pluck('entidad');
            $municipio = predios::where('gid', $id)->pluck('municipio');

            $inputs = Input::All();
            $max_id = condominios::where('gid_predio', '=', $id)->max('no_condominal');
            //$no_condominal = $max_id + 1;
            $n = new condominios();
            $n->entidad = $entidad;
            $n->municipio = $municipio;
            $n->clave_catas = $clave_catas;
            $n->no_condominal = $inputs["no_condominal"];
            $n->tipo_priva = $inputs["tipo_priva"];
            $n->sup_comun = $inputs["sup_comun"];
            $n->indiviso = $inputs["indiviso"];
            $n->sup_comun_magno = 0;
            $n->indiviso_magno = 0;
            $n->cve_magno = '0';
            $n->sup_total_comun = $inputs["sup_total_comun"];
            $n->no_unidades = $inputs["no_unidades"];
            $n->gid_predio = $id;
            $n->sup_privativa = '0';
            $n->clave_INEGI_cond = '0';
            $n->no_unidades = 0;
            $n->save();

            $id_condominio = condominios::orderBy('id_condominio', 'DESC')->first()->id_condominio;
            $no_condominal1 = condominios::where('id_condominio', $id_condominio)->pluck('no_condominal');
            return Response::json(array
                        (
                        'valor' => 0,
                        'id_condominio' => $id_condominio,
                        'no_condominal' => $no_condominal1,
                        'tipo_priva' => $inputs["tipo_priva"],
                        'sup_comun' => $inputs["sup_comun"],
                        'indiviso' => $inputs["indiviso"]
            ));
//Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
//return Redirect::back();
        }
    }

    public function getEliminarCondominio() {
        $id = Input::get('id_condominio');
        $eliminar = condominios::find($id);
        $eliminar->delete();
        return Response::json(array
                    (
                    'id_condominio' => $id
        ));
//  return Redirect::back();
    }

    public function getEditarCondominio() {
        $id_condominio = Input::get('id_condominio');
        $condominios = condominios::find($id_condominio);

        return Response::json(array
                    (
                    'id_condominio' => $condominios->id_condominio,
                    'entidad' => $condominios->entidad,
                    'municipio' => $condominios->municipio,
                    'tipo_priva' => $condominios->tipo_priva,
                    'sup_comun' => $condominios->sup_comun,
                    'indiviso' => $condominios->indiviso,
                    'sup_total_comun' => $condominios->sup_total_comun,
                    'no_unidades' => $condominios->no_unidades,
                    'no_condominal' => $condominios->no_condominal
        ));
//return View::make('complementarios.complementos.condominio', compact("condominios"));
    }

    public function getCondominio() {
        $inputs = Input::All();
// print_r($inputs);
        $id = Input::get('id');
        $n = condominios::find($id);
        $n->entidad = $inputs["entidad"];
        $n->municipio = $inputs["municipios"];
        $n->tipo_priva = $inputs["tipo_priva"];
        $n->sup_comun = $inputs["sup_comun"];
        $n->indiviso = $inputs["indiviso"];
        $n->sup_total_comun = $inputs["sup_total_comun"];
        $n->no_unidades = $inputs["no_unidades"];
        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');

        return Redirect::back();
    }

    public function get_servicios() {
//$cat = tiposervicios::All();
        return View::make('complementarios.complementos.servicio', compact("cat"));
    }

    public function post_agregarservicio() {

        $inputs = Input::All();
        $entidad = $inputs['entidad'];
        $municipio = $inputs['municipio'];
        $clave_cata = $inputs['clave_cata'];
        $gid_predio = $inputs['gid_predio'];
        $id_tiposervicio = $inputs['servicios'];
//mios  
        $eliminar = $inputs['eliminar'];
        $actuales = $inputs['serv'];
        $contar = count($actuales);
        $confuera = count($eliminar);


        if ($confuera >= 1) {
            foreach ($eliminar as $key) {
                $id = $key;
                DB::delete("DELETE FROM serviciospredio WHERE id_tiposervicio=$id AND clave_catas='$clave_cata'");
            }
        }
        if (!$contar) {
            if (sizeof($actuales) == 0) {
                $count = count($id_tiposervicio);
                for ($x = 0; $x < $count; $x++) {
                    $n = new servicios();
                    $n->entidad = $entidad;
                    $n->municipio = $municipio;
                    $n->clave_catas = $clave_cata;
                    $n->gid_predio = $gid_predio;
                    $n->id_tiposervicio = $id_tiposervicio[$x];
                    $n->created_at = date('Y-m-d');
                    $n->updated_at = date('Y-m-d');
                    $n->save();
                }
            }
        } else {
            foreach ($id_tiposervicio as $id) {
                if (in_array($id, $actuales)) {
                    
                } else {
                    $total[] = $id;
                }
            }
            $count = count($total);
            for ($x = 0; $x < $count; $x++) {
                $n = new servicios();
                $n->entidad = $entidad;
                $n->municipio = $municipio;
                $n->clave_catas = $clave_cata;
                $n->gid_predio = $gid_predio;
                $n->id_tiposervicio = $id_tiposervicio[$x];
                $n->created_at = date('Y-m-d');
                $n->updated_at = date('Y-m-d');
                $n->save();
            }
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
        $entidad = $inputs['entidad'];
        $municipio = $inputs['municipio'];
        $clave_cata = $inputs['clave_cata'];
        $gid_predio = $inputs['gid_predio'];
        $id_tipogiro = $inputs['giros'];
        $sup_terreno = $inputs['superficie_terreno'];
        $sup_constru = $inputs['superficie_construccion'];
//mios 
        $eliminar = $inputs['eliminar'];
        $actuales = $inputs['select'];
        $contar = count($actuales);
        $confuera = count($eliminar);

        if ($confuera >= 1) {
            foreach ($eliminar as $key) {
                $id = $key;
                DB::delete("DELETE FROM giros WHERE id_tipogiro=$id AND clave_catas='$clave_cata'");
            }
        }
//        if (!$contar) {
//            if (sizeof($actuales) == 0) {
//                $count = count($id_tipogiro);
////                for ($x = 0; $x < $count; $x++) {
//                    for ($x = 0; $x <1; $x++) {
//                    $n = new Giros();
//                    $n->entidad = $entidad;
//                    $n->municipio = $municipio;
//                    $n->clave_catas = $clave_cata;
//                    $n->gid_predio = $gid_predio;
//                    $n->gid_predio = $gid_predio;
//                    $n->id_tipogiro = $id_tipogiro[$x];
//                    $n->superficie_terreno = '000';
//                    $n->superficie_construccion = '000';
//                    $n->created_at = date('Y-m-d');
//                    $n->updated_at = date('Y-m-d');
//                    $n->save();
//                }
//            }
//        } else {
            foreach ($id_tipogiro as $id) {
                if (in_array($id, $actuales)) {
                    
                } else {
                    $total[] = $id;
                }
            }
//            $count = count($total);
//            for ($x = 0; $x < $count; $x++) {
              for ($x = 0; $x<1; $x++) {
                $n = new Giros();
                $n->entidad = $entidad;
                $n->municipio = $municipio;
                $n->clave_catas = $clave_cata;
                $n->gid_predio = $gid_predio;
                $n->gid_predio = $gid_predio;
                $n->id_tipogiro = $total[$x];
                $n->superficie_terreno = '000';
                $n->superficie_construccion = '000';
                $n->created_at = date('Y-m-d');
                $n->updated_at = date('Y-m-d');
                $n->save();
            }
//        }
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

    /*
     * Personas Entrevistada
     */

    public function personasEntrevistada() {
        return View::make('complementarios.complementos.personaEntrevistada');
    }

    public function autocomplete() {

        $term = Str::upper(Input::get('term'));
//ARRAY DONDE CARGA LOS DATOS
        $results = array();

        $id_p = array();
//CONSULTA A LA TABLA PERSONAS
        $queries = DB::select(DB::raw("SELECT * FROM personas WHERE nombres || ' '||apellido_paterno || ' ' ||  apellido_materno LIKE '%" . $term . "%' limit 5"));
//DONDE LLAMA LOS DATOS Y LOS PASA A LAS VARIABLES CORRESPONDIENTES
        foreach ($queries as $query) {
//ARRAY DONDE CARGA LOS DATOS
            $id_p[] = ['id_p' => $query->id_p];
            $results[] = ['value' => $query->nombres . ' ' . $query->apellido_paterno . ' ' . $query->apellido_materno, 'id' => $query->id_p];
        }
        if ($results) {
//SI EXITE LA PERSONA            
            return Response::json($results);
        } else {
//            //SI NO EXITE LA PAERSONA
//            $mensaje[] = ['id' => 0];
            $mensaje[] = "NO EXISTE LA PERSONAS";
            return Response::json($mensaje);
        }
    }

    public function postEntrevista() {
        $entidad = Input::get('entidad');
        $municipio = Input::get('municipio');
        $clave_catas = Input::get('clave_cata');
        $gid_predio = Input::get('gid_predio');
        $id_p = Input::get('id_p');

        $n = new Entrevistado();
        $n->entidad = $entidad;
        $n->municipio = $municipio;
        $n->clave_catas = $clave_catas;
        $n->gid_predio = $gid_predio;
        $n->id_p = $id_p;
        $n->created_at = date('Y-m-d');
        $n->updated_at = date('Y-m-d');

        $n->save();
        Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
        return Redirect::back();
    }

    public function postPersonas() {

        $inputs = Input::All();
//Reglas 
        $reglas = array(
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombres' => 'required',
        );

        $apellido_paterno = Input::get('apellido_paterno');
        $apellido_materno = Input::get('apellido_materno');
        $nombres = Input::get('nombres');
        $term = $nombres . ' ' . $apellido_paterno . ' ' . $apellido_materno;
//echo $nombrec=$apellido_materno." ".$apellido_paterno." ".$nombres ; 
//Mensaje
        $mensajes = array(
            "required" => "*",
        );
//valida
        $validar = Validator::make($inputs, $reglas, $mensajes);
//en caso no pase la validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $n = new personas();
            $n->apellido_paterno = $inputs["apellido_paterno"];
            $n->apellido_materno = $inputs["apellido_materno"];
            $n->nombres = $inputs["nombres"];
            $n->nombrec = $apellido_paterno . " " . $apellido_materno . " " . $nombres;
            $n->rfc = $inputs["rfc"];
            $n->curp = $inputs["curp"];
            $n->save();
            $queries = DB::select(DB::raw("SELECT id_p FROM personas WHERE nombres || ' ' || apellido_paterno || ' ' ||  apellido_materno LIKE '%" . $term . "%' limit 1"));
//Se han guardado los valores
            foreach ($queries as $key) {
                $id = $key->id_p;
            }
            Session::flash('mensaje', 'El registro ha sido ingresado exitosamente');
            return Response::json(array('id_p' => $id));
// return Redirect::back();
        }
    }

   public function guardar_anexo()
    {
        $entidad = Input::get('entidad');
        $municipio = Input::get('municipio');
        $clave_catas = Input::get('clave_catas');
        $gid_predio = Input::get('gid_predio');
        $id_tipoimagen = Input::get('tomas');
        $files = Input::file('file');
        $id_tipoimagen2 = explode(',', $id_tipoimagen);
        $array_clave = explode('-', $clave_catas);
        $fileFooter = [];
        $opciones = [''];
        //for para contar los archivos a cargar
        for ($i = 0; $i < count($files); $i++)
        {
            //se toma la imagen
            $file2 = $files[$i];
            // Se valida que exista un archivo
            if($file2) 
            {
                // Se valida el directorio para subir shapes
                $dir =  '/complementarios/anexos/'.$entidad.'/'.$municipio.'/'.$array_clave[0].'/'.$array_clave[1].'/'.$clave_catas.'/';
                $nombre_archivo = $gid_predio.'-'.$id_tipoimagen2[$i].'-'.$file2->getClientOriginalName();
                if (!file_exists(public_path().$dir) && !is_dir(public_path().$dir)) 
                {
                    File::makeDirectory(public_path().$dir, $mode = 0777, true, true);
                }
                // Se valida la extensión del archivo
                if(!file_exists($dir.$nombre_archivo) && in_array(strtolower($file2->getClientMimeType()), array('image/png','image/jpeg','image/jpeg','image/jpeg','image/gif','image/bmp','image/vnd.microsoft.icon', 'text/plain', 'application/vnd.ms-excel', 'application/msword', 'application/pdf')))
                {
                    $file2->move(public_path().$dir, $gid_predio.'-'.$id_tipoimagen2[$i].'-'.$file2->getClientOriginalName());
                    $imagenes = new ImagenesLevantamiento();
                    $imagenes->entidad = $entidad;
                    $imagenes->municipio = $municipio;
                    $imagenes->clave_catas=$clave_catas;
                    $imagenes->gid_predio=$gid_predio;
                    $imagenes->id_tipoimagen=$id_tipoimagen2[$i];
                    $imagenes->nombre_archivo= $dir.$nombre_archivo;
                    $imagenes->save();
                    $imagenes = ImagenesLevantamiento::where('nombre_archivo', '=', $dir.$nombre_archivo)->select('nombre_archivo', 'id_il', 'id_tipoimagen')->get();
                    $tipo_imagen = TipoImagenes::lists('descripcion', 'id_tipoimagen');
                    $select_opc = '';
                    $extension = split('[.]', $imagenes[0]->nombre_archivo);
                    //for para saber opcion elegida
                    foreach ($tipo_imagen as $key => $descripcion) 
                    {
                    
                        if ($key==$imagenes[0]->id_tipoimagen) 
                        {
                            $select_opc = $select_opc."<option selected = 'selected' value='".$key."'>".$descripcion."</option>";
                        }
                        else
                        {
                            $select_opc = $select_opc."<option value='".$key."'>".$descripcion."</option>";
                        }
                    }
                    
                    $select = "<select name='select-instalaciones' class='form-control' id='instalaciones'><option selected='selected' value=''>--Seleccione una opción--</option>".print_r($select_opc, true)."</select>";
                    $eliminar = "<button type='button' class='kv-file-remove btn btn-xs btn-default' title='Remove file' data-url='/eliminar-anexo/".$imagenes[0]->id_il."' data-key='1'><i class='glyphicon glyphicon-trash text-danger'></i></button>";
                    $download = "<a href='".$dir.$nombre_archivo."' download='".$extension[0]."' class='btn btn-xs btn-default' title='Descargar'><i class='glyphicon glyphicon-download'></i></a>";
                    //Condicion para saber si es imagen o archivo
                    if(in_array(strtolower($file2->getClientMimeType()), array('image/png','image/jpeg','image/gif','image/bmp','image/vnd.microsoft.icon')))
                    {
                        $file_footer[] = "<img src='" . $imagenes[0]->nombre_archivo . "' class='file-preview-image' >" . $select . $eliminar . $download;
                    }
                    else
                    {
                        $file_footer[] = "<span class='glyphicon glyphicon-file' ></span>" . $select . $eliminar . $download;
                    }
                    $respuesta[]  =   '¡Se guardo correctamente el archivo: '. $file2->getClientMimeType();
                }
                else
                {
                    $error[]  =   '¡Extension de archivo invalida: '. $file2->getClientMimeType();
                }      
            }
            else
            {
                $error[]  =   '¡Es necesario seleccionar un archivo!'; 
            }
        }
        return Response::json(array
                        (
                            'respuesta'         =>  $respuesta,
                            'initialPreview'    =>  $file_footer,
                            'error'             =>  $error      
                        ));
    }

    public function eliminar_anexo($id = null)
    {
        $archivo = ImagenesLevantamiento::find($id);
        if (File::exists(public_path().$archivo->nombre_archivo))
        {
            File::delete(public_path().$archivo->nombre_archivo);
        }
        $archivo->delete();
        return Response::json(
            [
                'filebatchuploadsuccess' => 'se guardo'
            ]);
    }

    public function getPersonas($format = 'html', $id = null) {
        $title = 'Crar nueva perosana';
        //Titulo de seccion:
        $title_section = "";
        //Subtitulo de seccion:
        $subtitle_section = "Crear nueva persona";
        return View::make('complementarios.complementos.personas', compact('title', 'title_section', 'subtitle_section'));
    }

     public function getPersonas2($format = 'html', $id = null) {
        $title = 'Crar nueva perosana';
        //Titulo de seccion:
        $title_section = "";
        //Subtitulo de seccion:
        $subtitle_section = "Crear nueva persona";
        return View::make('complementarios.complementos.personas2', compact('title', 'title_section', 'subtitle_section'));
    }
    
}
