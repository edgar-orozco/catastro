<?php

use LaravelBook\Ardent\Ardent;

class FolioTramite extends Ardent
{

    protected $fillable = ['municipio', 'folio', 'anio'];

    /**
     * Devuelve el folio siguiente de la llave dada (puede ser una oficina o un municipio o cualquier cosa foliable
     * Si la llave no existe, entonces crea el registro, lo setea a 1 y lo devuelve.
     * @param $llave
     * @return integer
     */
    public static function actual($llave)
    {
        $anio = date("Y");

        $res = FolioTramite::whereMunicipio($llave)->whereAnio($anio)->first();

        // Si no existe registro de folio para esa llave entonces la creamos.
        if ($res == null) {

            $res = FolioTramite::create([
              'municipio' => $llave,
              'folio' => 1,
              'anio' => $anio,
            ]);
        }

        if (is_a($res, 'FolioTramite')) {
            return $res->folio;
        }

        return 0;
    }

    /**
     * Incrementa el folio de trámites para el municipio.
     * @param $llave
     * @return bool
     */
    public static function incrementar($llave)
    {
        $anio = date("Y");

        $folio = FolioTramite::whereMunicipio($llave)->whereAnio($anio)->first();

        // Si no existe registro de folio para esa llave entonces la creamos.
        if ($folio == null) {

            $folio = FolioTramite::create([
                'municipio' => $llave,
                'anio' => $anio,
                'folio' => 1
            ]);
        }

        if (is_a($folio, 'FolioTramite')) {
            $folio->folio = $folio->folio + 1;
            $folio->save();
        }

        return true;
    }
}