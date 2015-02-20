<?php
class tiposusosconstruccionSeeder extends Seeder {
    public function run()
    {
        DB::table('tiposusosconstruccion')->delete();
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'HABITACIONAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'NO HABITACIONAL','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'MIXTO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'LOTE BALDIO','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'OBRA NEGRA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'RUINOSA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
               
    }
}