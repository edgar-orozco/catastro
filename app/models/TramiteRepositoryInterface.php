<?php
namespace Catastro\Tramite;


interface TramiteRepositoryInterface {

    /**
     * Obtiene todos los trámites filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getAll($roles, $municipios);

    /**
     * Obtiene los trámites iniciados filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getIniciados($roles, $municipios);

    /**
     * Obtiene todos los trámites en proceso filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getEnproceso($roles, $municipios);

    /**
     * Obtiene todos los trámites finalizados filtrados por roles y municipios
     * @param $roles
     * @param $municipios
     * @return mixed
     */
    public function getFinalizados($roles, $municipios);

}