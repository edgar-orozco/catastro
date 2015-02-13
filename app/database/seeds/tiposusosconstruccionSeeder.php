<?php
class tiposusosconstruccionSeeder extends Seeder {
    public function run()
    {
        DB::table('tiposusosconstruccion')->delete();
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'HABITACIONAL', 'createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'NO HABITACIONAL', 'createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'MIXTO','createat' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'LOTE BALDIO','createat' => date("Y-m-d H:i:s"))
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'OBRA NEGRA','createat' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposusosconstruccion')->insert(
            array('descripcion' => 'RUINOSA','createat' => date("Y-m-d H:i:s") )
        );
               
    }
}