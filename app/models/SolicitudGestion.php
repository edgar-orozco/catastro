<?php
class SolicitudGestion extends Eloquent {

    protected $table = 'solicitud_gestion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function solicitante () {
        return $this->hasOne('solicitante','id','solicitante_id');
    }
    
    public function tramite() {
        return $this->hasOne('Tipotramite', 'id','tramite_id');
    }
    
    public function mupio() {
        return $this->hasOne('Municipio','gid','municipio');
    }
}