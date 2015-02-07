<?php
/**
 * Created by PhpStorm.
 *
 * Clase con helpers para la carga cartografica
 */

class ShapesHelper{

    public static function countShapes(){
        $dir = __DIR__ . '/../storage/shapes';

        if (!file_exists($dir) && !is_dir($dir)) {
            return '0';
        }
        $fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);

        return iterator_count($fi);
    }
}