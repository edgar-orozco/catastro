<?php
use Catastro\Repos\Padron\PadronRepositoryInterface;

class PadronFiscalRepository implements PadronRepositoryInterface
{

    /**
     * Obtiene una colección de todos los registros del padrón
     * @return mixed
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
    }

    /**
     * Obtiene una colección paginada de todos los registros del padrón
     * @return mixed
     */
    public function getAllPaginated()
    {
        // TODO: Implement getAllPaginated() method.
    }

    /**
     * Obtiene un registro del padrón dado su id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * Obtiene un registro del padron dada su clave catastral
     * @param $clave
     * @return mixed
     */
    public function getByClaveCatastral($clave)
    {
        // TODO: Implement getByClaveCatastral() method.
    }
}