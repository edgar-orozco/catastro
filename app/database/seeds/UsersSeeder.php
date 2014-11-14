<?php

/**
 * Pobla la base de datos de usuarios para pruebas.
 * Class UsersSeeder
 */
class UsersSeeder extends Seeder {
    public function run()
    {
        $faker = Faker\Factory::create('es_AR');

        DB::table('users')->delete();

        //Creamos usuario generico inicial
        DB::table('users')->insert(
            array(
                'username' => 'admin',
                'password' => App::make('hash')->make('admin'),
                'email' => 'admin@test.com',
                'nombre' => 'ADMINISTRADOR',
                'apepat' => 'TEST',
                'apemat' => '',
                'confirmed' => true,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            )
        );

        foreach(range(1,500) as $idx) {

            DB::table('users')->insert(
                array(
                    'username' => mb_strtolower(str_replace(" ","",$faker->userName)),
                    'password' => App::make('hash')->make($faker->word),
                    'email' => str_ireplace(['á','é','í','ó','ú'], ['a','e','i','o','u'],$faker->safeEmail),
                    'nombre' => mb_strtoupper($faker->firstName),
                    'apepat' => mb_strtoupper($faker->lastName),
                    'apemat' => mb_strtoupper($faker->lastName),
                    'confirmed' => true,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                )
            );

        }
    }
}