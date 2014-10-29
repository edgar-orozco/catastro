<?php
/**
 * Info del catálogo de tasa predial inicial.
 * User: Edgar
 * Date: 29/10/2014
 * Time: 05:10 PM
 */

class TasaPredialSeeder extends Seeder {
    public function run()
    {
        DB::table('tasa_predial')->delete();
        DB::table('tasa_predial')->insert(
            array('anio' => 2014, 'mes' => 1, 'limite_inferior' => 0, 'limite_superior' => 10000, 'cuota_fija' => 0, 'pct_excedente' => 0.7, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tasa_predial')->insert(
            array('anio' => 2014, 'mes' => 1, 'limite_inferior' => 10001, 'limite_superior' => 30000, 'cuota_fija' => 70, 'pct_excedente' => 0.8, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tasa_predial')->insert(
            array('anio' => 2014, 'mes' => 1, 'limite_inferior' => 30001, 'limite_superior' => 50000, 'cuota_fija' => 230, 'pct_excedente' => 0.9, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tasa_predial')->insert(
            array('anio' => 2014, 'mes' => 1, 'limite_inferior' => 50001, 'limite_superior' => 70000, 'cuota_fija' => 410, 'pct_excedente' => 1.0, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tasa_predial')->insert(
            array('anio' => 2014, 'mes' => 1, 'limite_inferior' => 70001, 'limite_superior' => 99999999.99, 'cuota_fija' => 610, 'pct_excedente' => 1.10, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"))
        );

    }
} 