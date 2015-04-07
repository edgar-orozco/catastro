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

        $title = 'Administracion de catalogo de salario minimo';

        //Titulo de seccion:
        $title_section = "Administracion del catalogo de salario minimo";

        //Subtitulo de seccion:
        $subtitle_section = "Crear, modificar y eliminar salario minimo";

        //Todos los status creados actulmente
        $salarios = $this->salario->all();

        return ($format == 'json') ? $salarios : View::make('catalogos.salario.index', compact('title', 'title_section', 'subtitle_section', 'salario', 'salarios'));
    }

    public function create() {
        $salario = $this->salario;

        $title = 'Adminstración de catalagos de salario minimo';

        //Titulo de seccion:
        $title_section = "Crear nuevo salario minimo.";

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

            foreach ($fecha as $key) {
                $inicio = $key['fecha_inicio_periodo'];
                $finicio[] = $inicio;
            }
            foreach ($fecha as $fechafin) {
                $fin = $key['fecha_termino_periodo'];
                $ffin[] = $fin;
            }
            $factual = date("Y-d-m", strtotime($fechaactual));
            $ftermina = date("Y-d-m", strtotime($fechatermino));
            var_dump($finicio);

            if (in_array($factual, $finicio)) {
//                echo "Ya Existe fecha de inicio ";
//                echo '<div class="alert alert-danger">Ya Existe fecha de inicio</div>';
                 return Redirect::back()->with('error', 'Ya Existe la fecha de Inicio');
            }elseif (in_array($ftermina,$ffin)) {
//                echo " y fin ";
                return Redirect::back()->with('error', 'Ya Existe la fecha de Fin');
            }
            else{
            $n->save();
            //Se a guardado los datos y ya tengo hambreeeeeee...... jejeje lol 
            return Redirect::to('catalogos/salario/create')->with('success', '¡Se ha creado correctamente el salario minimo: ' . $this->salario->salario_minimo . " !");
            }
        }
    }

    public function edit($id) {
        //Buscamos el requisito en cuestión y lo asignamos a la instancia
        $salario = salario::find($id);

        $this->salario = $salario;

        $title = 'Administración de catálogo de salario minimo';

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
                        ('success', '¡Se ha actualizado correctamente el salario minimo: ' . $mostrar . " !");
    }

    public function destroy($id = null) {
        $salario = salario::findOrFail($id);
        $salario->delete($id);
        return Redirect::to('catalogos/salario')->with('success', '¡Se ha eliminado correctamente el tipo de trámite: ' . $salario->salario_minimo . " !");
    }

}
