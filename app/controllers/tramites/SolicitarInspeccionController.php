<?php
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class tramites_SolicitarInspeccionController extends \BaseController {



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
        $clave=Input::get('clave');
        $cuenta=Input::get('cuenta');
        $tramite_id=Input::get('tramite_id');
        $tipo_predio=Input::get('tipo_predio');
		$vars = $this->catalogos();

		$JsonColindancias = json_encode([]);

        $manifestacion = $this->manifestacion;

        $vars['JsonColindancias'] = $JsonColindancias;
        $vars['manifestacion'] = $manifestacion;
        $vars['clave']=$clave;
        $vars['cuenta']=$cuenta;
        $vars['tramite_id']=$tramite_id;
        $vars['tipo_predio']=$tipo_predio;
		return View::make('tramites.inspeccion.create', $vars);
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

    private function catalogos(){

        $title = 'Manifestación Catastral';

        //Título de sección:
        $title_section = "Manifestación Catastral.";

        //Listado de municipios de tabasco
        $listaMunicipios =  Municipio::with('entidad')->where('entidad', '27')->orderBy('nombre_municipio')->lists('nombre_municipio','municipio');

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

        $oNotarias = Notaria::with('notario')->with('mpio')->with('estado')->orderBy('nombre')->remember(120)->get();
        $listaNotarias = [];
        foreach($oNotarias as $notaria){
            $listaNotarias[$notaria->id_notaria] = $notaria->nombre." ".
                $notaria->mpio['nombre_municipio'].", ".$notaria->estado['nom_ent']." ".
                $notaria->notario->nombres." ".$notaria->notario->apellido_paterno. " ".$notaria->notario->apellido_materno;
        }

        $listaEstatusFiscal = [
            'vigente' => 'Vigente',
            'exento' => 'Exento',
        ];

        $JsonColindancias = json_encode([]);

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

public function store(){
   //dd($datos_construccion);
   //print_r( $enajenanteR=Input::get('enajenante'));
   //dd(Input::get('enajenante'));


    //se agregan los de la persona (propietario)
    $persona_propietario=Input::get('enajenante');
 //  echo 'id '.$persona_propietario['id_pp'];
//dd($persona_propietario);
    if ($persona_propietario['id_pp'])
        {
             $persona_id = $persona_propietario['id_pp'];
             $persona = personas::find($persona_id);
        }else
            {
                $persona = new personas();
                $persona->fill(Input::get('enajenante', []))->save();
                $persona_id=$persona->id_p;
            }
    //dd($persona);
    //se agrega el domicilio
    $domicilio = new Domicilio();
    $domicilio->fill(Input::get('domicilioEnajenante', []))->save();
    $domicilio_id=$domicilio->id;

    //se agrega el propietario
    $propietario = new propietarios();
    $propietario->id_propietario=$persona_id;
    $propietario->tipo_propietario=1;
    $propietario->id_dom=$domicilio_id;
    $propietario->tramite_id=Input::get('tramite_id');
    $propietario->save();

    $propietario_id=$propietario->id_propietarios;

    //Se agregann los Copropietarios
    $copropietarios = Input::get('copropietario');
    if($copropietarios)
        {
            foreach($copropietarios as $cpropietario)
                {
                    if($cpropietario['id_p'])
                        {//dd($cpropietario);
                            $ex_propietarios = new propietarios();
                            $ex_propietarios->id_propietario=$cpropietario['id_p'];
                            $ex_propietarios->tipo_propietario=2;
                            $ex_propietarios->tramite_id=Input::get('tramite_id');
                            $ex_propietarios->save();
                        }else
                            {
                                $new_persona = new personas();
                                $new_persona->fill(Input::get('enajenante', []))->save();
                                $new_persona_id=$new_persona->id_p;

                                $co_propietarios = new propietarios();
                                $co_propietarios->id_propietario=$new_persona_id;
                                $co_propietarios->tipo_propietario=2;
                                $co_propietarios->tramite_id=Input::get('tramite_id');
                                $co_propietarios->save();
                            }
                }
        }
    //Se cargan los datos en la tabla manifestacion
   $man=Input::get('manifestacion',[]);
   $man['clave']=Input::get('clave');
   $man['propietario_id']=$propietario_id;
   $man['cuenta']=Input::get('cuenta');
   $man['tramite_id']=Input::get('tramite_id');
   $man['tipo_predio']=Input::get('tipo_predio');

    //$man->domicilio_id=$denajenante=$denajenante->id;
   $manifestacion = new Manifestacion();
   $manifestacion->fill($man)->save();
   $id_manifestacion= $manifestacion->id;
   //dd( $id_manifestacion);
    //se guarda bloque de construccion
    $datos_construccion =  json_decode(Input::get('datos_construccion'),true);
    if($datos_construccion)
        {
            //dd($datos_construccion['construcciones']);
            $sup_total=0;
            foreach ($datos_construccion['construcciones'] as $key  )
                {
                    $construc = new ManifestacionConstruccion();
                    $construc->manifestacion_id =  $id_manifestacion;
                    $construc->sup_construccion = $key['sup_construccion'];
                    $construc->save();
                    $sup_total= $sup_total +  $key['sup_construccion'];
                }
            $update_manifestacion =  Manifestacion::find($id_manifestacion);
   $update_manifestacion->total_sup_construccion = $sup_total;
   $update_manifestacion->superficie_alberca = $datos_construccion['sup_albercas'];
   $update_manifestacion->save();
        }
   
   $update_manifestacion =  Manifestacion::find($id_manifestacion);
   $update_manifestacion->superficie_alberca = $datos_construccion['sup_albercas'];
   $update_manifestacion->save();

   //se guardan los servicios
   $datos_construccion=Input::get('manifestacion_servicios');
   foreach ($datos_construccion as $key ) 
        {
            $servicio = new ServicioPublico();
            $servicio->manifestacion_predio_id = $id_manifestacion;
            $servicio->tipo_servicio_id = $key;
            $servicio->save();
//       echo 'id: '.$key.'</br>';
        }
//return 'listo final';
return View::make('tramites.inspeccion._form_datos_guardados', compact ('update_manifestacion','construc','manifestacion','copropietarios','propietario','domicilio','persona'));


}

public function cartografia(){

   // $dir = '/ResultadoCartografia/predios';
    //    if ( !is_dir(public_path() . $dir)) 
     //   {
     //       File::makeDirectory(public_path() . $dir, $mode = 0777, true, true);
     //   }   

   // $borrar=unlink();
    //$b= shell_exec($borrar);
    //dd($borrar);
         //$clave = '001-0048-000007';
    //obtenemos la clave catastral
    $clave_catas=Input::get('clave');
    //explodeamos la clave
    $new_clave=explode('-', $clave_catas);
    //se crea la clave_catas para la consulta la tabla predios
    $clave=$new_clave[2]."-".$new_clave[3]."-".$new_clave[4];
    //echo $arch1= sprintf("documentos/predios/%s.dbf",$clave);
    
    //$b= shell_exec($borrar);
    //dd($borrar);

    $base=  Config::get('database.connections.pgsql.database'); //Esto es importante porque el nombre de la base de datos cambia en el servidor de produccion
    //Esta es la ruta relativa a public, es decir, va a poner los archivos en /var/www/html/public/documentos/
    //Obvio hay que ver un mejor directorio para esto que el de "documentos" pero para el ejemplo es suficiente.
    $salida = 'ResultadoCartografia/predios/'.$clave;
    //checa que hace y como se usa la funcion sprintf de php es muy util para estos casos de escapes de comillas y formato de cadenas
    $predios = sprintf("select * from predios WHERE clave_catas = '%s'", $clave);
    $cmd = sprintf('pgsql2shp -f %s -u postgres -h localhost -g geom %s "%s"', $salida, $base, $predios);
    //echo $cmd;
    //Checa que hace y como se usa la funcion shell_exec, su diferencia con exec, system, passthru y escapeshellcmd
    $sal = shell_exec($cmd);
    //genera archivos geograficos para construcciones
    $salida_const = 'ResultadoCartografia/construccion/'.$clave;
    $construcciones = sprintf("select * from construcciones WHERE clave_catas = '%s'", $clave);
    $cmd_construcciones = sprintf('pgsql2shp -f %s -u postgres -h localhost -g geom %s "%s"', $salida_const, $base, $construcciones);
    //dd($cmd_construcciones);
    //Checa que hace y como se usa la funcion shell_exec, su diferencia con exec, system, passthru y escapeshellcmd
    $sal_const = shell_exec($cmd_construcciones);
    
    //genera archivos geograficos para manzanas
        $entidad=$new_clave[0];
        $municipio=$new_clave[1];
        $zona=$new_clave[2];
        $manzana=$new_clave[3];

    $salida_manzana = 'ResultadoCartografia/manzana/'.$clave;
    $manzana = sprintf("select * from manzanas WHERE entidad = '%s' and municipio = '%s' and zona = '%s' and manzana = '%s'", $entidad, $municipio, $zona, $manzana);
    $cmd_manzana = sprintf('pgsql2shp -f %s -u postgres -h localhost -g geom %s "%s"', $salida_manzana, $base, $manzana);
    //dd($cmd_manzana);
    //Checa que hace y como se usa la funcion shell_exec, su diferencia con exec, system, passthru y escapeshellcmd
    $sal_const = shell_exec($cmd_manzana);
    
    //creamos rutas de archivos para predios 
    //dd($sal);
    //ruta para el archivo de predios con extencion .dbf  
    $arch1= sprintf("ResultadoCartografia/predios/%s.dbf",$clave);
    //ruta para el archivo de predios con extencion .shp
    $arch2= sprintf("ResultadoCartografia/predios/%s.shp",$clave);
    //ruta para el archivo de predios con extencion .prj
    $arch3= sprintf("ResultadoCartografia/predios/%s.prj",$clave);
    //ruta para el archivo de predios con extencion .shx
    $arch4= sprintf("ResultadoCartografia/predios/%s.shx",$clave);

    //creamos rutas de archivos para consturcciones
    //dd($sal);
    //ruta para el archivo de consturcciones con extencion .dbf  
    $const1= sprintf("ResultadoCartografia/construccion/%s.dbf",$clave);
    //ruta para el archivo de consturcciones con extencion .shp
    $const2= sprintf("ResultadoCartografia/construccion/%s.shp",$clave);
    //ruta para el archivo de consturcciones con extencion .prj
    $const3= sprintf("ResultadoCartografia/construccion/%s.prj",$clave);
    //ruta para el archivo de consturcciones con extencion .shx
    $const4= sprintf("ResultadoCartografia/construccion/%s.shx",$clave);

    //creamos rutas de archivos para manzana
    //dd($sal);
    //ruta para el archivo de manzana con extencion .dbf  
    $manzana1= sprintf("ResultadoCartografia/manzana/%s.dbf",$clave);
    //ruta para el archivo de manzana con extencion .shp
    $manzana2= sprintf("ResultadoCartografia/manzana/%s.shp",$clave);
    //ruta para el archivo de manzana con extencion .prj
    $manzana3= sprintf("ResultadoCartografia/manzana/%s.prj",$clave);
    //ruta para el archivo de manzana con extencion .shx
    $manzana4= sprintf("ResultadoCartografia/manzana/%s.shx",$clave);
    
        //se crea el archivo .zip
        $zip = new ZipArchive();
        //parametros para el nombre
        $municipio=$new_clave[1];
        $zona=$new_clave[2];
        $manzana=$new_clave[3];
        $sufijo = date("dmyHis");
        //se crea el nombre del archivo formato D-municipio-zona-manzana-fecha
        $filename= sprintf("ResultadoCartografia/D-%s-%s-%s-%s.zip",$municipio,$zona,$manzana,$sufijo);
       //dd($filename);
       // $filename = ".zip";

        if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
        exit("cannot open <$filename>\n");
            }
        //gregamos archivos de predios al .zip          
        $zip->addFile($arch1);
        $zip->addFile($arch2);
        $zip->addFile($arch3);
        $zip->addFile($arch4);
        //agrregamos archivos de construcciones al .zip
        $zip->addFile($const1);
        $zip->addFile($const2);
        $zip->addFile($const3);
        $zip->addFile($const4);
        //agrregamos archivos de manzana al .zip
        $zip->addFile($manzana1);
        $zip->addFile($manzana2);
        $zip->addFile($manzana3);
        $zip->addFile($manzana4);

        //$zip->addFromString("testfilephp.txt" . time(), "#1 Esto es una cadena de prueba añadida como  testfilephp.txt.\n");
        //$zip->addFromString("testfilephp2.txt" . time(), "#2 Esto es una cadena de prueba añadida como testfilephp2.txt.\n");

        //echo "numficheros: " . $zip->numFiles . "\n";
        //echo "estado:" . $zip->status . "\n";
        $zip->close();

        //se borran los archivos creados  .dbf .shp .prj .shx para predios
        if(file_exists($arch1))
            {
        $borrar1=unlink($arch1);
            }
        if(file_exists($arch2))
            {
        $borrar2=unlink($arch2);
            }
        if(file_exists($arch3))
            {
        $borrar3=unlink($arch3);
            }
        if(file_exists($arch4))
            {
        $borrar4=unlink($arch4);
            }
        //se borran los archivos creados  .dbf .shp .prj .shx para construccion
        if(file_exists($const1))
            {
                $borrar1=unlink($const1);
            }
        if(file_exists($const2))
            {
                $borrar2=unlink($const2);
            }
        if(file_exists($const3))
            {
                $borrar3=unlink($const3);
            }
        if(file_exists($const4))
            {
                $borrar4=unlink($const4);
            }
        //se borran los archivos creados  .dbf .shp .prj .shx para manzana
        if(file_exists($manzana1))
            {
                $borrar1=unlink($manzana1);
            }
        if(file_exists($manzana2))
            {
                $borrar2=unlink($manzana2);
            }
        if(file_exists($manzana3))
            {
                $borrar3=unlink($manzana3);
            }
        if(file_exists($manzana4))
            {
                $borrar4=unlink($manzana4);
            }

        //return 'holaaaaaa';
        //dd($zip);
        
        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=".$filename."");
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        readfile($filename);



        //($new_calve[3]);
       //exec('pgsql2shp -f "/var/www/htm/catastro" -u postgres -g geom catastro-dev "select * from predios where clave_catas='001-0048-000007'"');
      // dd($process);
        $cuenta=Input::get('cuenta');
        $tramite_id=Input::get('tramite_id');
        $tipo_predio=Input::get('tipo_predio');
}
}
