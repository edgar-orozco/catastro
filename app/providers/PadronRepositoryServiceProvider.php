<?php namespace Catastro\Providers;

use Illuminate\Support\ServiceProvider;

class PadronRepositoryServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('\Catastro\Repos\Padron\PadronRepositoryInterface', '\Catastro\Repos\Padron\PadronFiscalRepository');
    }
}
