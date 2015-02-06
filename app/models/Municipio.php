<?php
/**
 * Created by david.
 */
use LaravelBook\Ardent\Ardent;


class Municipio extends Ardent
{

    protected $fillable = ['nom_mpo'];

    protected $primaryKey = 'municipio';

    public function usuarios()
    {
        return $this->belongsToMany('User','user_municipio', 'municipio_id', 'usuario_id');
    }
}