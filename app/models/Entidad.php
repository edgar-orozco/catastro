<?php

use LaravelBook\Ardent\Ardent;


class Entidad extends Ardent
{
    protected $table = 'entidades';

    public $timestamps = false;

    protected $fillable = ['gid', 'nom_ent', 'entidad'];

    protected $primaryKey = 'gid';
}