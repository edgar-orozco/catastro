<?php

class SeguimientoHelper{
    
    function generarClave() {
        $longitud = 6;
        $key = '';
        $parametro = '237ABCDEFGHJKLMNPRSTUVWXYZ';
        $max = strlen($parametro) - 1;
        for ($i = 0; $i < $longitud; $i++)
        $key .= $parametro{mt_rand(0, $max)};
        return $key;
    }
    
}