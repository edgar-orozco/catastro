<?php namespace Catastro\Repos\Padron;

use \PadronFiscal;

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
     * Obtiene un registro del padron dada su clave catastral
     * @param $clave
     * @return mixed
     */
    public function getByClaveCatastral($clave)
    {
        return PadronFiscal::where('clave', $clave)->first();
    }

    /**
     * Obtiene un registro del padrón dado su número de cuenta
     * @param $cuenta
     * @return mixed
     */
    public function getByCuenta($cuenta)
    {
        return PadronFiscal::where('cuenta', $cuenta)->first();
    }

    /**
     * Obtiene un registro del padrón ya sea por su clave o por su cuenta
     * @param $identificador
     * @return mixed
     */
    public function getByClaveOCuenta($identificador)
    {
        return PadronFiscal::where('clave',$identificador)->orWhere('cuenta', $identificador)->first();
    }
}