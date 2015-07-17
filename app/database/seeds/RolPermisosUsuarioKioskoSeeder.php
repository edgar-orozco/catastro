<?php

/**
 * Class RolesKioskoSeeder
 * Crea los permisos y los roles necesarios para la ejecución y el flujo de Kioskos.
 */

class RolPermisosUsuarioKioskoSeeder extends Seeder {

	public function run()
	{

        $pi = Permission::firstOrCreate([
            'name'=>'solicitud_kioskos',
            'display_name'=>'El usuario puede crear, consultar e imprimir solicitudes de kiosko'
        ]);
        $si = Permission::firstOrCreate([
            'name'=>'seguimiento_kioskos',
            'display_name'=>'El usuario puede dar seguimiento a un documento desde kiosko'
        ]);

        //Ahora asociamos los permisos a los roles.

        $permissions = array($pi,$si);

        //1. Vemos si el rol de Usuario de kisko existe, si existe le aumentamos los dos roles.

        $un = Role::firstOrCreate([
           'name'=>'Usuario de kiosko'
        ]);

        $un->attachPermissions($permissions);

    }

}