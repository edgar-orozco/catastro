<?php

/**
 * Pobla la base de datos de usuarios para pruebas.
 * Class UsersSeeder
 */
class StatussSeeder extends Seeder {
    public function run()
    {
        $faker = Faker\Factory::create('es_AR');

        DB::table('users')->delete();

        //Creamos usuario generico inicial
        $id = DB::table('users')->insertGetId(
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

        $rol_id = Role::where(['name'=>'Administrador'])->first()->id;
        DB::table('assigned_roles')->insert(array(
            'user_id' => $id, 'role_id' => $rol_id
        ));

        foreach(range(1,1500) as $idx) {
            if($idx % 10 == 0) echo ".";
            if($idx % 50 == 0) echo " ";
            if($idx % 100 == 0) echo "\n";
            if($idx % 500 == 0) echo "\n";
            try {
                DB::table('users')->insert(
                    array(
                        'username' => str_ireplace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], (mb_strtolower(str_replace(" ", "", $faker->userName)))),
                        'password' => App::make('hash')->make($faker->word),
                        'email' => str_ireplace(['á', 'é', 'í', 'ó', 'ú'], ['a', 'e', 'i', 'o', 'u'], $faker->safeEmail),
                        'nombre' => mb_strtoupper($faker->firstName),
                        'apepat' => mb_strtoupper($faker->lastName),
                        'apemat' => mb_strtoupper($faker->lastName),
                        'confirmed' => true,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s")
                    )
                );
            }
            catch(Exception $e)
            {
                //error_log($e->getMessage());
            }
        }
    }
}