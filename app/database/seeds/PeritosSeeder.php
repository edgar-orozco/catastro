<?php

/**
 * Crea un usuario valuador para pruebas.
 */
class PeritosSeeder extends Seeder 
{
    public function run()
    {
        DB::connection()->statement("COPY peritos FROM '/var/www/html/sources/peritosfin2.csv' DELIMITER '|'");
    }
}