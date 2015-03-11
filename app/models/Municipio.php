<?php
/**
 * Created by david.
 */
use LaravelBook\Ardent\Ardent;


class Municipio extends Ardent
{
    protected $table = 'municipios';
    
    public $timestamps = false;

    protected $fillable = ['nombre_municipio', 'municipio', 'entidad'];

    protected $primaryKey = 'gid';

    public function usuarios()
    {
        return $this->belongsToMany('User','user_municipio', 'municipio_id', 'usuario_id')->withTimestamps();
    }
}