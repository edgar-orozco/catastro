<?php
/**
 * Created by PhpStorm.
 */

class CargaShapesController extends BaseController
{

    /**
     * Muestra la pantalla principal para la carga de shapes
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Title
        $title = "Actualización Cartográfica";
        // Title
        $title_section = "Actualización Cartográfica";

        return View::make('admin.cargashapes.upload-shape', compact('title', 'title_section'));
    }

    /**
     * Procesa la carga cartografica
     * @return mixed
     */
    public function upload()
    {
        // Se valida que exista un archivo
        if(Input::file('shape')) {

            // Se valida el directorio para subir shapes
            $dir = __DIR__ . '/../storage/shapes';
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }

            // Se valida la extensión del archivo
            error_log(Input::file('shape')->getClientMimeType());
            if(in_array(strtolower(Input::file('shape')->getClientMimeType()), array('application/x-gzip', 'application/zip', 'application/x-tar', 'application/octet-stream')))
            {
                Input::file('shape')->move($dir, Input::file('shape')->getClientOriginalName());

                return Redirect::to('admin/carga-shapes')->with('success',
                    '¡Se guardo correctamente el archivo: '. Input::file('shape')->getClientOriginalName() .'!');
            }

            return Redirect::to('admin/carga-shapes')->with('error',
                'Extensión de archivo invalida en "'.Input::file('shape')->getClientOriginalName().'", los formatos validos son .zip, .rar, .tar, .tgz y .gz.');

        }

        return Redirect::to('admin/carga-shapes')->with('notice',
            'Es necesario seleccionar un archivo');
    }
}