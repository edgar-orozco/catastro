<?php

/**
 * Class RolesKioskoSeeder
 * Crea los permisos y los roles necesarios para la ejecución y el flujo de Kioskos.
 */

class RolPermisosUsuarioKioskoSeeder extends Seeder {

	public function run()
	{

        $pi = Permission::firstOrCreate([
            'name'=>'kioskos',
            'display_name'=>'kioskos'
        ]);

        //Ahora asociamos los permisos a los roles.

        $permissions = array($pi);

        //1. Vemos si el rol de Usuario de kisko existe, si existe le aumentamos los dos roles.

        $un = Role::firstOrCreate([
           'name'=>'Kiosko'
        ]);

        $un->attachPermissions($permissions);

    }

}