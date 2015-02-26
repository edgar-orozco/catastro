<?php
/**
 * Created by PhpStorm.
 *
 * Clase con helpers para la carga cartografica
 */

/**
 * Class ShapesHelper
 * Clase con helper para la carga cartografica
 */
class ShapesHelper{
    /**
     * Funcion para contar el numero de archivos guardados en la ruta storage/shapes
     * @return int|string
     */
    public static function countShapes(){
        $dir = __DIR__ . '/../storage/shapes';

        if (!file_exists($dir) && !is_dir($dir)) {
            return '0';
        }
        $fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);

        return iterator_count($fi);
    }

    /**
     * Funcion para obtener el tamaño maximo de archivos soportado por el servidor
     * @return float
     */
    public static function serverUploadSize(){

        return self::parseSize(ini_get('upload_max_filesize'));
    }

    /**
     * Funcion para convertir el peso de un archivo en bytes
     *
     * @param $size
     * @return float
     */
    private static function parseSize($size){
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9\.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * pow(1024, stripos('bkmgtpezy', $unit[0])));
        } else {
            return round($size);
        }
    }
}