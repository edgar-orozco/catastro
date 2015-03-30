<?php
/**
 * Created by PhpStorm.
 * User: Edgar
 * Date: 21/03/2015
 * Time: 09:42 PM
 */

namespace Catastro\Tramite;


class TramiteRepository implements TramiteRepositoryInterface{


    /**
     * Obtiene todos los trámites filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getAll($roles, $municipios)
    {
        Tramite::where();
        if(!empty($roles)){

        }
    }

    /**
     * Obtiene los trámites iniciados filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getIniciados($roles, $municipios)
    {
        // TODO: Implement getIniciados() method.
    }

    /**
     * Obtiene todos los trámites en proceso filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getEnproceso($roles, $municipios)
    {
        // TODO: Implement getEnproceso() method.
    }

    /**
     * Obtiene todos los trámites finalizados filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getFinalizados($roles, $municipios)
    {
        // TODO: Implement getFinalizados() method.
    }


}