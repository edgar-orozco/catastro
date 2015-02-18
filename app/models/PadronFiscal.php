<?php

use LaravelBook\Ardent\Ardent;

class PadronFiscal extends Ardent
{
    protected $table = 'fiscal';

    public function ubicacionFiscal() {
        return $this->hasOne('UbicacionFiscal', 'id_ubicacion', 'id_ubicacion_fiscal');
    }

    public function propietarios() {
        return $this->hasMany('propietarios', 'id_propietarios', 'id_propietarios');
    }
}