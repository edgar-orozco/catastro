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
        $title = "Carga Cartográfica";
        // Title
        $title_section = "Carga Cartográfica";

        return View::make('admin.cargashapes.upload-shape', compact('title', 'title_section'));
    }

    /**
     * Procesa la carga cartografica
     * @return mixed
     */
    public function upload()
    {
        // Se valida que exista un archivos
        if(Input::file('shape')) {
            // Se valida el directorio para subir shapes
            $dir = __DIR__ . '/../storage/shapes';
            if (!file_exists($dir) && !is_dir($dir)) {
                mkdir($dir);
            }

            Input::file('shape')->move($dir, Input::file('shape')->getClientOriginalName());
            return Redirect::to('admin/carga-shapes')->with('success',
                '¡Se guardo correctamente el archivo: '. Input::file('shape')->getClientOriginalName() .'!');
        }

        return Redirect::to('admin/carga-shapes')->with('notice',
            'Es necesario seleccionar un archivo');
    }
}