<?php

class catalogos_salarioController extends \BaseController {

    /**
     * Instancia del status
     * @var status
     */
    protected $salario;

    public function __construct(salario $salario) {
        $this->salario = $salario;
    }

    public function index($format = 'html') {
        $salario = $this->salario;

        $title = 'Catálogo de salario mínimo';

        //Titulo de seccion:
        $title_section = "Catálogo de Salario Mínimo";

        //Subtitulo de seccion:
        $subtitle_section = "";

        //Todos los status creados actulmente
        $salarios = $this->salario->all();

        return ($format == 'json') ? $salarios : View::make('catalogos.salario.index', compact('title', 'title_section', 'subtitle_section', 'salario', 'salarios'));
    }

    public function create() {
        $salario = $this->salario;

        $title = 'Adminstración de catalagos de salario minimo';

        //Titulo de seccion:
        $title_section = "Crear salario minimo.";

        //subtitulo de seccion:
        $subtitle_section = "";

        //Select del los años 
        for ($i = date('o'); $i >= 1910; $i--) {
            if ($i == date('o'))
                $anio[$i] = $i;
            else
                $anio[$i] = $i;;
        }


        //Todos los status creados actualmente
        $salarios = $this->salario->all();
        return View::make('catalogos.salario.create', compact('title', 'title_section', 'subtitle_section', 'salario', 'salarios', 'anio'));
    }

    public function store($format = 'html') {
        //obtengo el id del salario en caso de que exista 
        $id = Input::get('id');
        //Obtengo todos los datos del formulario
        $inputs = Input::All();
        //reglas
        $reglas = array(
            'anio' => 'required',
            'fecha_inicio_periodo' => 'required',
            'fecha_termino_periodo' => 'required',
            'zona' => 'required',
            'salario_minimo' => 'required',
        );
        //Mensaje
        $mensajes = array(
            "required" => "*",
        );
        //valida
        $validar = Validator::make($inputs, $reglas, $mensajes);
        //en caso que no pesa la validacion se regresa a la pagina cargando los mensajes de validacion
        if ($validar->fails()) {
            return Redirect::back()->withErrors($validar);
        } else {
            $n = new salario;
            //$n->id_salario_minimo=10;
            $n->zona = $inputs["zona"];
            $n->anio = $inputs["anio"];
            $n->salario_minimo = $inputs["salario_minimo"];
            $fechaactual = $inputs['fecha_inicio_periodo'];
            $n->fecha_inicio_periodo = $fechaactual;
            $fechatermino = $inputs["fecha_termino_periodo"];
            $n->fecha_termino_periodo = $fechatermino;
            $fecha = salario::select('fecha_inicio_periodo', 'fecha_termino_periodo')->get();

//           
            $factual =$fechaactual;
            $ftermina=$fechatermino;
            foreach ($fecha as $f1) {

                $fecha1 = $f1['fecha_inicio_periodo'];
                $fecha2 = $f1['fecha_termino_periodo'];
                if (FechasHelper::check_in_range($fecha1, $fecha2, $factual)) {
//                  return Redirect::back()->with('error', 'Traslape de rango de fecha ');                    
                    return Response::json(array('id' => 'Traslape de rango de fecha'));
                }
                if (FechasHelper::check_in_range($fecha1, $fecha2, $ftermina)) {
                    return Response::json(array('id' => 'Traslape de rango de fecha'));
//                    return Redirect::back()->with('id', 'Traslape de rango de fecha ');
                }
            }

            $n->save();
            return Redirect::to('catalogos/salario/create')->with('success', '¡Los datos se han creado correctamente: ' . $this->salario->salario_minimo . " !");
//            }
        }
    }

    public function edit($id) {
        //Buscamos el requisito en cuestión y lo asignamos a la instancia
        $salario = salario::find($id);

        $this->salario = $salario;

        $title = 'Catálogo de salario minimo';

        //Título de sección:
        $title_section = "Editar salario minimo: ";

        //Select del los años 
        for ($i = date('o'); $i >= 1910; $i--) {
            if ($i == date('o'))
                $anio[$i] = $i;
            else
                $anio[$i] = $i;;
        }

        //Subtítulo de sección:
        $subtitle_section = $this->salario->salario;

        // Todos los permisos creados actualmente
        $salarios = $this->salario->all();


        //ID del permiso
        $id = $salario->id;
        return View::make('catalogos.salario.edit', compact('title', 'title_section', 'subtitle_section', 'salario', 'salarios', 'id', 'anio'));
    }

    public function update($id, $format = 'html') {
        $inputs = Input::All();
        $datos = salario::find($id);
        $datos->zona = $inputs["zona"];
        $datos->anio = $inputs["anio"];
        $datos->salario_minimo = $inputs["salario_minimo"];
        $datos->fecha_inicio_periodo = $inputs["fecha_inicio_periodo"];
        $datos->fecha_termino_periodo = $inputs["fecha_termino_periodo"];
        $mostrar = $inputs["salario_minimo"];
        $datos->save();
        //Se han actualizado los valores expresamos la felicidad que se logro Wiiiii....
        return Redirect::to('catalogos/salario/' . $id . '/edit')->with
                        ('success', 'Los datos se han actualizado correctamente ');
    }

    public function destroy($id = null) {
        $salario = salario::findOrFail($id);
        $salario->delete($id);
        return Redirect::to('catalogos/salario')->with('success', 'Se han eliminado los datos correctamente'." ");
    }

}
