<?php
class tiposiespecialesSeeder extends Seeder {
    public function run()
    {
        DB::table('tiposiespeciales')->delete();
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'BOMBA HIDRAULICA', 'createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'POZO DE AGUA', 'createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'ALBERCA','createat' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'ESPECTACULARES','createat' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'SISTEMA DE INCENDIO','createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'SISTEMA DE ALARMAS','createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'CÁMARAS DE VIGILANCIA','createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'SISTEMA DE RIEGO','createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'ANTENA DE COMUNICACIONES','createat' => date("Y-m-d H:i:s"))
        );
        
    }
}