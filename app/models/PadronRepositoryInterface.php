<?php namespace Catastro\Repos\Padron;

interface PadronRepositoryInterface
{
    /**
     * Obtiene una colección de todos los registros del padrón
     * @return mixed
     */
    public function getAll();

    /**
     * Obtiene una colección paginada de todos los registros del padrón
     * @return mixed
     */
    public function getAllPaginated();

    /**
     * Obtiene un registro del padron dada su clave catastral
     * @param $clave
     * @return mixed
     */
    public function getByClaveCatastral($clave);

    /**
     * Obtiene un registro del padrón dado su número de cuenta
     * @param $cuenta
     * @return mixed
     */
    public function getByCuenta($cuenta);


    /**
     * Obtiene un registro del padrón ya sea por su clave o por su cuenta
     * @param $identificador
     * @return mixed
     */
    public function getByClaveOCuenta($identificador);

}