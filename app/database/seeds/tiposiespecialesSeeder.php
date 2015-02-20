<?php
class tiposiespecialesSeeder extends Seeder {
    public function run()
    {
        DB::table('tiposiespeciales')->delete();
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'BOMBA HIDRAULICA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'POZO DE AGUA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'ALBERCA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'ESPECTACULARES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'SISTEMA DE INCENDIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'SISTEMA DE ALARMAS','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'CÁMARAS DE VIGILANCIA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'SISTEMA DE RIEGO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposiespeciales')->insert(
            array('descripcion' => 'ANTENA DE COMUNICACIONES','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        
    }
}