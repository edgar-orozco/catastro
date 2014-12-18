<?php

class RequisitoTipotramite extends \Eloquent {
    protected $table = 'requisito_tipotramite';
	protected $fillable = ['requisito_id', 'tipotramite_id', 'original', 'copias'];
}