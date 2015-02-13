<?php
/**
 * Se agrega el rol "Cartógrafo"
 */

class RoleAddCartografoSeeder extends Seeder {

    public function run()
    {
        $rol = Role::create(['name' => 'Cartógrafo', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);
        $permiso = Permission::create(['name'=>'actualizar_cartografia', 'display_name' => 'Actualizar cartografía', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s")]);

        $rol->perms()->save($permiso);

        $user_id = DB::table('users')->insertGetId(
            array(
                'username' => 'cartografo',
                'password' => App::make('hash')->make('cartografo'),
                'nombre' => 'Usurio',
                'apepat' => 'Cartógrafo',
                'apemat' => 'Test',
                'confirmed' => true,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            )
        );

        DB::table('assigned_roles')->insert(array(
            'user_id' => $user_id, 'role_id' => $rol->id
        ));
    }
}