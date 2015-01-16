<?php namespace Catastro\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

/**
 * Provee el servicio al contenedor de laravel para poder implementar menú facilmente desde cualquier controlador o plantilla blade.
 */
class MenuServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Recoge todas las plantillas de menú y las convierte en views concatenados para generar el menú completo
         * @return tring Regresa el HTML de los fragmentos de menú de los partials "menu.blade.php" puestos en los directorios de vista
         */
        $this->app->bind('Menu', function () {

            //Leemos el directorio views y sus subdirectorios
            $files = File::allFiles(__DIR__ . '/../views');
            $menuTpls = [];
            $menu = '';
            foreach ($files as $file) {
                //para cada archivo vemos si su nombre empieza es menu.blade.php y si lo es lo agregamos al arreglo de plantillas menu
                if (substr_count($file->getRelativePathName(), 'menu.blade.php')) {
                    $menuTpls[] = $file->getRelativePath() . "/menu";
                }
            }

            //Si no existe el arreglo de plantillas de menú en la sesión entonces creamos el arreglo en las plantillas
            if (!Session::get('main.menu')) {
                Session::put('main.menu', $menuTpls);
            }

            //Realizamos la vista para cada plantilla en el arreglo y como regresa un fragmento html cada una, concatenamos y regresamos el resultado
            foreach (Session::get('main.menu') as $tpl) {
                $menu .= View::make($tpl)->render();
            }

            return $menu;
        });
    }
}