<?php

class ActividadesSistema extends Eloquent  {

    protected $fillable = [
        'id',
        'user_id',
        'modulo',
        'actividad',
        'pk_afectada',
        'created_at'
    ];
    protected $table = 'actividades_sistema';


}

