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
class ShapesHelper {

    private static $minImgSize = array( 'width' => 90, 'height' => 120);
    private static $maxImgSize = array( 'width' => 150, 'height' => 200);

    /**
     * Función para contar el numero de archivos guardados en la ruta storage/shapes
     * @return int|string
     */
    public static function countShapes() {
        $dir = __DIR__ . '/../storage/shapes';

        if (!file_exists($dir) && !is_dir($dir)) {
            return '0';
        }
        $fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);

        return iterator_count($fi);
    }

    /**
     * Función para obtener el tamaño maximo de archivos soportado por el servidor
     * @return float
     */
    public static function serverUploadSize() {

        return self::parseSize(ini_get('upload_max_filesize'));
    }

    /**
     * Función para obtener el tamaño mínimo de imágenes
     * @return float
     */
    public static function minImgUploadSize() {

        return self::$minImgSize;
    }

    /**
     * Función para obtener el tamaño máximo de imágenes
     * @return float
     */
    public static function maxImgUploadSize() {

        return self::$maxImgSize;
    }

    /**
     * Función para representar de forma mas humana los bytes
     *
     * @param $bytes
     * @param int $precision
     * @return string
     */
    public static function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Función para convertir el peso de un archivo en bytes
     *
     * @param $size
     * @return float
     */
    private static function parseSize($size) {
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
