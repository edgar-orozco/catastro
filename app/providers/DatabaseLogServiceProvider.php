<?php namespace Catastro\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;


/**
 * Provee el servicio que inyecta en el log de laravel los querys finales que ejecuta eloquent en la BD
 * Podría decirse que "renderiza" los querys de eloquent.
 *
 * Para habilitar su funcionamiento debe setearse la variable "log" a "true" en el archivo de configuración de base de datos "app/config/local/database.log"
 * Este servicio sólo funciona en el ambiente loacal, esto para no sobrecargar otros ambientes.
 */
class DatabaseLogServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (App::environment('local') && Config::get('database.log', false)) {

            Event::listen('illuminate.query', function ($query, $bindings, $time, $name) {
                $data = compact('bindings', 'time', 'name');

                // Se formatean los bindings para insertarlos en el query
                foreach ($bindings as $i => $binding) {
                    if ($binding instanceof \DateTime) {
                        $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
                    } else if (is_string($binding)) {
                        $bindings[$i] = "'$binding'";
                    }
                }

                // Se insertan los bindings en el query
                $query = str_replace(array('%', '?'), array('%%', '%s'), $query);
                $query = vsprintf($query, $bindings);
                Log::info($query, $data);
            });

        }
    }
}