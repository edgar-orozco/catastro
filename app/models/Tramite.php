<?php
use LaravelBook\Ardent\Ardent;


class Tramite extends Ardent
{

    protected $fillable = ['clave', 'tipotramite_id', 'usuario_id', 'folio'];


    public function documentos()
    {
        return $this->hasManyThrough('Documento','RequisitoTramite','id','documentable_id');
    }

    public function usuario()
    {
        return $this->belongsTo('User','usuario_id');
    }

    public function tipotramite()
    {
        return $this->belongsTo('Tipotramite');
    }

    public function requisitos()
    {
        return $this->belongsToMany('Requisito', 'requisito_tramite')->withPivot(['usuario_id']);
    }

    public function solicitante(){
        return $this->hasOne('personas', 'id_p', 'solicitante_id');
    }
}