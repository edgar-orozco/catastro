<?php
/**
 * Modelo del Salario Mínimo Vigente
 * User: Edgar
 * Date: 30/10/2014
 * Time: 12:35 AM
 */

class Smv extends Eloquent {

    protected $table = 'smv';
    protected $fillable = ['anio', 'entidad', 'municipio', 'area', 'monto'];
}