<?php

class ManifestacionCatastralController extends \BaseController
{

    /**
     * Muestra el listado de manifestaciones y el botón de crear nueva manifestación catastral
     * @return \Illuminate\View\View
     */
    public function index(){
        $title = 'Manifestación Catastral';

        //Título de sección:
        $title_section = "Manifestación Catastral.";

        //Subtítulo de sección:
        $subtitle_section = "Crear, modificar, buscar, imprimir";


        return View::make('ofvirtual.notario.manifestacion.index',comptact('title','title_section', 'subtitle_section'));

    }


    /**
     * Muestra la forma para crear nuevos registros de manifestacion catastral
     * @return \Illuminate\View\View
     */
    public function create(){

        $title = 'Manifestación Catastral';

        //Título de sección:
        $title_section = "Manifestación Catastral.";

        //Listado de municipios de tabasco
        $listaMunicipios =  Municipio::where('entidad', '27')->orderBy('nombre_municipio')->remember(120)->lists('nombre_municipio','municipio');

        //En lo que se sabe que hacer con los catalogos...
        $listaTiposPropietario =  [
          '1'=>'Particular',
          '2'=>'Municipal',
          '3'=>'Estatal',
          '4'=>'Federal',
        ];

        $vialidades= TipoVialidad::orderBy('descripcion')->remember(120)->lists('descripcion', 'id');
        $asentamientos= TipoAsentamiento::orderBy('descripcion')->remember(120)->lists('descripcion', 'id');
        $entidades= Entidad::orderBy('nom_ent')->remember(120)->lists('nom_ent', 'gid');
        $municipios = $listaMunicipios;

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

        $JsonColindancias = json_encode([]);

        $vars = [
            'title','title_section', 'subtitle_section',
            'listaMunicipios', 'listaTiposPropietario',
            'vialidades', 'asentamientos', 'entidades','municipios',
            'JsonColindancias',
            'viasComunicacion', 'tenenciaTierra', 'usoPredio', 'serviciosPublicos',
            'techos', 'muros', 'pisos', 'puertas', 'ventanas', 'hidraulicas', 'electricas', 'sanitarias', 'instEspeciales',
            'edosConstruccion', 'usosConstruccion', 'tiposConstruccion'

        ];

        return View::make('ofvirtual.notario.manifestacion.create',compact($vars));
    }




}