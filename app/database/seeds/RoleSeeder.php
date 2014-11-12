<?php
/**
 * Info del catálogo de roles del sistema.
 * User: Edgar
 * Date: 29/10/2014
 * Time: 05:10 PM
 */

class RoleSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert(
            array('name' => 'Usuario final', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('roles')->insert(
            array('name' => 'Supervisor', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s") )
        );
        DB::table('roles')->insert(
            array('name' => 'Administrador', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s") )
        );

        DB::table('roles')->insert(
            array('name' => 'Super usuario', 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s") )
        );

    }
}