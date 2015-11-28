<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FconceptosMemoTableSeeder extends Seeder {

	public function run()
	{
		DB::table('fconceptos_memo')->delete();

		DB::table('fconceptos_memo')->insert(
            array('desc_concepto_memo' => 'SUBDIVISION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('fconceptos_memo')->insert(
            array('desc_concepto_memo' => 'FUSION','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );

		DB::table('fconceptos_memo')->insert(
            array('desc_concepto_memo' => 'ALTA','created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"))
        );
	}

}