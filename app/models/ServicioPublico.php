<?php
class ServicioPublico extends Eloquent {
    protected $table = 'servicios_publicos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function tipo()
    {
       return $this->hasOne('tiposervicios', 'id_tiposervicio', 'id');
    }
}
