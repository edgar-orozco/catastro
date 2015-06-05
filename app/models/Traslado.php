<?php


class Traslado extends \LaravelBook\Ardent\Ardent
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

        return $this->belongsTo('Notaria', 'notaria_id', 'id_notaria');


    }

    public function comprador()
    {

        return $this->belongsTo('personas', 'comprador_id', 'id_p');


    }


    public function vendedor()
    {

        return $this->belongsTo('personas', 'vendedor_id', 'id_p');


    }

    /**
     * Scope para consultar  traslados por el nombre del solicitante, puede consultar por el nombre exacto o por nombre parcial (una fraccion del nombre)
     * @param $q
     * @param $nombre
     * @return mixed
     */
    public function scopeSolicitanteNombreCompleto($q, $nombre){
        return $q->whereHas('vendedor', function($qry) use ($nombre)
        {
            $qry->whereRaw('nombrec ~* ?', [$nombre]);
        });
    }

}