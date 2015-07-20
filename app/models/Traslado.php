<?php

//class Traslado extends \LaravelBook\Ardent\Ardent
class Traslado extends Eloquent
{

    protected $guarded =['id', 'token', 'updated_at', 'created_at'];
    /**
     * Bandera para poblar el objeto con el request enviado desde la forma Input::all()
     * @see https://github.com/laravelbook/ardent#updates-with-unique-rules
     * @var bool
     */
    public $autoHydrateEntityFromInput = true;

    /**
     * Bandera para purgar atributos html como el CRSF, _token, etc.
     * @see https://github.com/laravelbook/ardent#automatically-purge-redundant-form-data
     * @var bool
     */
    public $autoPurgeRedundantAttributes = true;


    public function usuario()
    {

        return $this->belongsTo('User', 'usuario_id', 'id');


    }


    public function notaria()
    {

        return $this->belongsTo('Notaria', 'notaria_escritura_id', 'id_notaria');


    }

    public function notario()
    {

        return $this->belongsTo('Notaria', 'notario_escritura_id', 'id_notario');


    }

    public function adquiriente()
    {

        return $this->belongsTo('personas', 'adquiriente_id', 'id_p');


    }


    public function enajenante()
    {

        return $this->belongsTo('personas', 'enajenante_id', 'id_p');


    }

   /* public function colindancia()
    {

        return $this->hasMany('TrasladoColindancia', 'traslado_id', 'id');


    }*/

    /**
     * Regresa una cadena de seguimiento unica dentro del rango de tiempo de expiración predeterminado (un año)
     * @param null $cadena
     * @return string
     */
    public static function cadenaSeguimientoUnica($cadena = null){

        //Si la cadena es nula, es decir se ha llamado SolicitudGestion::cadenaSeguimientoUnica() entonces generamos una cadena.
        if(!$cadena)
        {
            $cadena = SeguimientoHelper::generarClave();
        }

        //Consultamos si es que ya existe un registro con la misma cadena dentro del rango de un año
        $haceunanio = date("Y-m-d", strtotime('-1 year'));

        //Hacemos la consulta a ver si ya existe:
        $solicitud = SolicitudGestion::where('seguimiento',$cadena)
            // Aqui se debe consultar desde hoy hasta un año atras
            ->where('create_at', '>', $haceunanio)
            ->first();

        //Si existe una solicitud con la misma clave dentro del rango de tiempo del año pasado, entonces volvemos a crear una nueva cadena
        //y volvemos a preguntar si existe:
        if($solicitud)
        {
            $cadena = SeguimientoHelper::generarClave();
            return SolicitudGestion::cadenaSeguimientoUnica($cadena);
        }
        else
        {
            //Si no existe la solicitud con la misma cadena de segumiento, entonces regresamos la cadena.
            return $cadena;
        }
    }

    /**
     * Scope para consultar  traslados por el nombre del vendedor, puede consultar por el nombre exacto o por nombre parcial (una fraccion del nombre)
     * @param $q
     * @param $nombre
     * @return mixed
     */
    public function scopeEnajenanteNombreCompleto($q, $nombre){
        return $q->whereHas('enajenante', function($qry) use ($nombre)
        {
            $qry->whereRaw('nombrec ~* ?', [$nombre]);
        });
    }


    /**
     * Scope para consultar  traslados por el nombre del comprador, puede consultar por el nombre exacto o por nombre parcial (una fraccion del nombre)
     * @param $q
     * @param $nombre
     * @return mixed
     */
    public function scopeAdquirienteNombreCompleto($q, $nombre){
        return $q->whereHas('adquiriente', function($qry) use ($nombre)
        {
            $qry->whereRaw('nombrec ~* ?', [$nombre]);
        });
    }



    /**
     * Scope para consultar  traslados por el nombre del vendedor, puede consultar por el nombre exacto o por nombre parcial (una fraccion del nombre)
     * @param $q
     * @param $nombre
     * @return mixed
     */
    public function scopeUbicacion($q, $ubicacion){
            return DB::table('traslados')
                ->join('fiscal', 'traslados.clave', '=', 'fiscal.clave')
                ->join('ubicacion_fiscal', 'fiscal.id_ubicacion_fiscal', '=', 'ubicacion_fiscal.id_ubicacion')
                ->select('traslados.id')
                ->whereRaw("ubicacion_fiscal.ubicacion like '%" . $ubicacion . "%'");

    }
}