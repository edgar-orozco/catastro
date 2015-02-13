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
     * Obtiene un registro del padrón dado su id
     * @return mixed
     */
    public function getById($id);

    /**
     * Obtiene un registro del padron dada su clave catastral
     * @return mixed
     */
    public function getByClaveCatastral($clave);
}