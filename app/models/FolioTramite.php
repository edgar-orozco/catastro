<?php

use LaravelBook\Ardent\Ardent;

class FolioTramite extends Ardent {

    protected $fillable = ['municipio', 'folio'];

    /**
     * Devuelve el folio siguiente de la llave dada (puede ser una oficina o un municipio o cualquier cosa foliable
     * Si la llave no existe, entonces crea el registro, lo setea a 1 y lo devuelve.
     * @param $llave
     * @return integer
     */
    public static function siguiente($llave) {

        $res = FolioTramite::where('municipio',$llave)->first();
        // Si no existe registro de folio para esa llave entonces la creamos.
        if ($res == null) {
            $res = FolioTramite::create(['municipio'=>$llave, 'folio' => 1]);
        }

        if( is_a($res, 'FolioTramite' ) ) {
            return $res->folio;
        }

        return 0;
    }
}