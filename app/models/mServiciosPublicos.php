<?php

class mServiciosPublicos extends Eloquent
{
    protected $table ='mserviciospublicos';
    protected $primaryKey = 'id';
    protected $fillable = ["manifestacion_predio_id", 'mtipo_servicio_id'];
}

