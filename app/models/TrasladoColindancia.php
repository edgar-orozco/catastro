<?php


//class TrasladosColindancia extends \LaravelBook\Ardent\Ardent
class TrasladoColindancia extends Eloquent
{

    protected $guarded =['id', 'token', 'updated_at', 'created_at'];
    protected $fillable = array('traslado_id', 'orientacion', 'superficie', 'colindancia');
    /**
     * Bandera para poblar el objeto con el request enviado desde la forma Input::all()
     * @see https://github.com/laravelbook/ardent#updates-with-unique-rules
     * @var bool
     */
    //public $autoHydrateEntityFromInput = true;

    /**
     * Bandera para purgar atributos html como el CRSF, _token, etc.
     * @see https://github.com/laravelbook/ardent#automatically-purge-redundant-form-data
     * @var bool
     */
    public $autoPurgeRedundantAttributes = true;

    public function traslado()
    {

        return $this->belongsTo('Traslado', 'traslado_id', 'id');


    }

}