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