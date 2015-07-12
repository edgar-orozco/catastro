<?php

class SeguimientoHelper{
    
    public static function generarClave() {
        $longitud = 6;
        $key = '';
        $parametro = '23479BCDFGHJKLMNPRSTVWXYZ';
        $max = strlen($parametro) - 1;
        for ($i = 0; $i < $longitud; $i++)
        $key .= $parametro{mt_rand(0, $max)};
        return $key;
    }
    
}