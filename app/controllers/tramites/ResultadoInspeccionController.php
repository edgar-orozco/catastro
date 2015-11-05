<?php

class tramites_ResultadoInspeccionController extends \BaseController {

protected $manifestacion;

    public function __construct(Manifestacion $manifestacion) {

        $this->manifestacion = $manifestacion;

        $this->beforeFilter('csrf',array('on' => 'post'));
        $this->afterFilter("no-cache");

    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$vars = $this->catalogos();

		$JsonColindancias = json_encode([]);

        $manifestacion = $this->manifestacion;

        $vars['JsonColindancias'] = $JsonColindancias;
        $vars['manifestacion'] = $manifestacion;

		return View::make('tramites.resultadoInspeccion.create', $vars);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	private function catalogos()
	{
		$title = 'Manifestación Catastral';

        //Título de sección:
        $title_section = "Manifestación Catastral.";


        $viasComunicacion = [
          '1'=>'Pavimentada',
          '2'=>'Terracería',
          '3'=>'Camino vecinal',
        ];
        $usoPredio = [
          '1'=>'Habitacional',
          '2'=>'Industrial',
          '3'=>'Agrícola',
        ];
        $tenenciaTierra = [
          '1'=>'Propiedad',
          '2'=>'Ejidal',
          '3'=>'Común',
          '4'=>'Posesión',
        ];

        $serviciosPublicos = [
          '1'=>'Agua',
          '2'=>'Luz',
          '3'=>'Teléfono',
          '4'=>'Banqueta',
          '5'=>'Alumbrado',
          '6'=>'Pavimento',
          '7'=>'Drenaje',
          '8'=>'Transporte',
        ];

        $serviciosPublicos = tiposervicios::orderBy('descripcion')->remember(120)->lists('descripcion', 'id_tiposervicio');

        $tiposConstruccion = [
          'Antigua' => ['A1' => 'Económica', 'A2'=>'Medio', 'A3'=>'Superior'],
          'Moderna' => ['M1' => 'Interés Social', 'M2'=>'Popular', 'M3'=>'Medio', 'M4'=>'Bueno', 'M5'=>'Superior'],
          'Edificio Habitacional' => ['H1'=>'Interés social', 'H2'=>'Medio', 'H3'=>'Superior'],
          'Construcciones Especiales' => ['C1'=>'Corriente', 'C2'=>'Medio', 'C3'=>'Bueno'],
          'Edif. Construcciones Especiales' => ['E1'=>'Medio', 'E2'=>'Bueno'],
        ];
        $t=[];
        foreach($tiposConstruccion as $k => $v){
            $s = [];
            foreach($v as $a => $b){
                $s[] = ['value'=>$a, 'text'=>$b];
            }
            $t[] = ['text'=>$k, 'children'=>$s];
        }
        $tiposConstruccion = $t;

        $techos = [
          'CC'=>'Concreto',
          'TB'=>'Teja de barro',
          'LZ'=>'Lámina de zinc',
          'LA'=>'Lámina de asbesto',
          'OT'=>'Otros',
        ];

        $t = array();
        foreach($techos as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $techos = $t;

        $muros = [
          'BT' => 'Block tabique',
          'AM' => 'Adobe madera',
        ];
        $t = array();
        foreach($muros as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $muros = $t;

        $pisos = [
          'CM' => 'Cemento',
          'MS' => 'Mosaico',
          'MR' => 'Mármol',
        ];
        $t = array();
        foreach($pisos as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $pisos = $t;

        $puertas = [
          'AL' => 'Aluminio',
          'HR' => 'Herrería',
          'MD' => 'Madera',
        ];
        $t = array();
        foreach($puertas as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }

        $ventanas = $puertas;
        $t = array();
        foreach($ventanas as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }

        $hidraulicas = [
          'OC' => 'Oculta',
          'VS' => 'Visible',
        ];
        $t = array();
        foreach($hidraulicas as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $hidraulicas = $t;

        $electricas = $hidraulicas;
        $sanitarias = $hidraulicas;

        $instEspeciales = [
          'E' => 'Elevador',
          'CC' => 'Circuito cerrado',
          'ECI' => 'Equipo contra incendios',
          'SH' => 'Sistema hidroneumático',
          'EE' => 'Escaleras electromecánicas',
          'O' => 'Otros',
        ];
        $t = array();
        foreach($instEspeciales as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $instEspeciales = $t;

        $edosConstruccion = [
          'B'=>'Bueno',
          'R'=>'Regular',
          'M'=>'Malo',
        ];
        $t = array();
        foreach($edosConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $edosConstruccion = $t;

        $usosConstruccion = [
          'CH'=>'Habitacional',
          'IN'=>'Industrial',
          'CM'=>'Comercial',
          'M'=>'Mixto',
          'GO'=>'Ofic. Serv. Gob. Fral. Mpal.',
        ];
        $t = array();
        foreach($usosConstruccion as $k => $v){
            $t[] = ['value'=>$k, 'text'=>$v];
        }
        $usosConstruccion = $t;

        $listaTiposEscritura = [
          '1'=>'Pública',
          '2'=>'Título Agrario',
          '3'=>'Privada',
          '4'=>'Derecho de posesión',
          '5'=>'Título propiedad Municipal',
          '6'=>'Título propiedad Estatal',
          '7'=>'Título propiedad Federal',
        ];

        $vars = [
          'title','title_section', 'subtitle_section',
          'manifestacion',
          'listaMunicipios', 'listaTiposPropietario',
          'vialidades', 'asentamientos', 'entidades','municipios',
          'JsonColindancias',
          'viasComunicacion', 'tenenciaTierra', 'usoPredio', 'serviciosPublicos',
          'techos', 'muros', 'pisos', 'puertas', 'ventanas', 'hidraulicas', 'electricas', 'sanitarias', 'instEspeciales',
          'edosConstruccion', 'usosConstruccion', 'tiposConstruccion',
          'listaTiposEscritura', 'listaNotarias',
          'listaEstatusFiscal',

        ];

        return compact($vars);
	}


}
