<?php

class mTiposServicios extends Eloquent
{
    protected $table ='mtipos_serviciospublicos';
    protected $primaryKey = 'id';
    protected $fillable = ["descripcion"];
}

