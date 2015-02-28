<?php

class TiposerviciosTableSeeder extends Seeder {

	public function run()
	{

		DB::table('tiposervicios')->delete();
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'AGUA POTABLE', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'LUZ', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'DRENAJE', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'TELÉFONO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
          DB::table('tiposervicios')->insert(
            array('descripcion' => 'TV POR CABLE', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'TV SATELITAL', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'BANQUETAS', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'GUARNICIÓN', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'TRANSPORTE PÚBLICO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'ALUMBRADO PÚBLICO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'RECOLECCIÓN DE BASURA', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('tiposervicios')->insert(
            array('descripcion' => 'PAVIMENTO DE ASFALTO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );
          DB::table('tiposervicios')->insert(
            array('descripcion' => 'PAVIMENTO DE CONCRETO HIDRÁULICO', 'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s") )
        );

		
	}

}