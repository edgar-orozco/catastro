<?php

/**
 * Crea un usuario valuador para pruebas.
 */
class UsuarioValuadorSeeder extends Seeder {
    public function run()
    {
        DB::transaction(function()
        {
            $peritos = Perito::orderBy('corevat')->get();
            $cid = 2;

            $rol_id = Role::where(['name'=>'Perito Valuador'])->first()->id;

            foreach($peritos as $perito) {
                $cid++;

                if (User::find($cid)) {
                    continue;
                }

                $cve = $perito->corevat;

                $usr = str_replace("-", "", strtolower($cve));
                $email = explode(" ", $perito->correo);

                //Creamos al usuario de perito
                $id = DB::table('users')->insertGetId(
                  array(
                    'id' => $cid,
                    'username' => $usr,
                    'password' => App::make('hash')->make($usr),
                    'email' => $email[0],
                    'nombre' =>  \ForceUTF8\Encoding::fixUTF8($perito->nombre, ""),
                    'apepat' => ' ',
                    'apemat' => '',
                    'confirmed' => true,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                  )
                );

                //Asociamos el rol
                DB::table('assigned_roles')->insert(array(
                  'user_id' => $id,
                  'role_id' => $rol_id
                ));

                $id_perito = $perito->id;

                PeritoUsuario::create([
                  'user_id' => $id,
                  'perito_id' => $id_perito
                ]);

            }
        });
    }
}