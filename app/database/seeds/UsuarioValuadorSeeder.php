<?php

/**
 * Crea un usuario valuador para pruebas.
 */
class UsuarioValuadorSeeder extends Seeder {
    public function run()
    {
        DB::transaction(function()
        {
            $cve= "COREVAT-001";
            $usr = str_replace("-","",strtolower($cve));

            //Creamos al usuario de notaría
            $id = DB::table('users')->insertGetId(
              array(
                    'id'=>'1',
                    'username' => $usr,
                    'password' => App::make('hash')->make($usr),
                    'email' => 'corevat1@test.sicaret.com',
                    'nombre' => 'Usuario',
                    'apepat' => 'Valuador',
                    'apemat' => 'Test',
                    'confirmed' => true,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
               )
            );

            //Asociamos el rol
            $rol_id = Role::where(['name'=>'Perito Valuador'])->first()->id;
            DB::table('assigned_roles')->insert(array(
                'user_id' => $id, 'role_id' => $rol_id
            ));

            //Asociamos el usuario con la notaría
            //notaria 1
            $id_perito = Perito::firstOrCreate([
              'nombre'=>'Serj Adam Tankian',
              'corevat'=> $cve,
              'direccion'=>'Enrique Segoviano',
              'telefono'=>'12-34-56-78',
              'correo'=>'serj.tanian@gmail.com',
              'Estado'=>1,
            ])->id;

            PeritoUsuario::create(['user_id' => $id, 'perito_id'=>$id_perito]);
        });
    }

}