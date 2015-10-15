<?php

class TipoActividadTramite extends Eloquent {
    protected $table = 'tipoactividades_tramites';
	protected $fillable = ['nombre','orden','presente','pasado','manual','callback','getter','clase','estatus_id'];
}