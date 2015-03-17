<?php

class TipoActividadTramite extends Eloquent {
    protected $table = 'tipoactividades_tramites';
	protected $fillable = ['nombre','orden'];
}