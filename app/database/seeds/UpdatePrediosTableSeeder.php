<?php


class UpdatePrediosTableSeeder extends Seeder {

	public function run()
	{
		DB::table('predios')
            ->update(array('municipio' => '008'));
	}

}