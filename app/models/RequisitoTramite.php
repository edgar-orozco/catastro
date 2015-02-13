<?php

class RequisitoTramite extends \Eloquent
{
    protected $table = 'requisito_tramite';
    protected $fillable = ['requisito_id', 'tramite_id', 'usuario_id'];

    public function documentos(){
        return $this->morphMany('Documento','documentable');
    }

}