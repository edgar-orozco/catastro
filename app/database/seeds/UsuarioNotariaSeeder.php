<?php

/**
 * Pobla la base de datos de usuarios para pruebas.
 * Class UsersSeeder
 */
class UsuarioNotariaSeeder extends Seeder {
    public function run()
    {
        DB::transaction(function()
        {
            //Creamos al usuario de notaría
            $id = DB::table('users')->insertGetId(
              array(
                    'username' => 'usrnotaria',
                    'password' => App::make('hash')->make('usrnotaria'),
                    'email' => 'usrnotaria1@test.sicaret.com',
                    'nombre' => 'Usuario',
                    'apepat' => 'Notaría',
                    'apemat' => 'Test',
                    'confirmed' => true,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
               )
            );

            //Asociamos el rol
            $rol_id = Role::where(['name'=>'Usuario de Notaría'])->first()->id;
            DB::table('assigned_roles')->insert(array(
                'user_id' => $id, 'role_id' => $rol_id
            ));

            //Asociamos el el usuario con la notaría
            //notaria 1
            $id_notaria = Notaria::where(['nombre'=>'NOTARIA 1', 'municipio'=> '004'])->first()->id_notaria;

            NotariaUsuario::create(['user_id' => $id, 'notaria_id'=>$id_notaria]);
        });
    }

}