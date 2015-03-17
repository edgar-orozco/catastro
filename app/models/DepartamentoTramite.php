<?php

/**
 * Class DepartamentoTramite
 * Representa los departamentos o áreas u oficinas de gobierno que atienden un trámite o un paso de un trámite.
 */
class DepartamentoTramite extends \Eloquent {
    protected $table ='departamentos_tramites';
	protected $fillable = ['nombre','orden'];
}