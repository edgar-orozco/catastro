<?php
use LaravelBook\Ardent\Ardent;

class UbicacionFiscal extends Ardent
{
    protected $table = 'ubicacion_fiscal';

    public function asentamiento(){
        return $this->belongsTo('Asentamiento','id_asentamiento','id_asentamiento');
    }

}