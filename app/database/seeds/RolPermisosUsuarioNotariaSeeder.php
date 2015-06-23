<?php

/**
 * Class RolesTramitesSeeder
 * Crea los permisos y los roles necesarios para la ejecución y el flujo de trámites.
 */

class RolPermisosUsuarioNotariaSeeder extends Seeder {

	public function run()
	{

        /*Se debe crear el Rol **Usuario de Notaría**
             Crear los permisos:
             1. Precaptura de trámites por internet (con la llave ***precaptura_internet***)
             2. Seguimiento de trámites  por internet (con la llave ***seguimiento_internet***)
         */

        $pi = Permission::firstOrCreate([
            'name'=>'precaptura_internet',
            'display_name'=>'Precaptura de trámites por internet '
        ]);

        $si = Permission::firstOrCreate([
            'name'=>'seguimiento_internet',
            'display_name'=>'Seguimiento de trámites  por internet'
        ]);

        //Ahora asociamos los permisos a los roles.

        $permissions = array($pi, $si);

        //1. Vemos si el rol de Usuario de Notaría existe, si existe le aumentamos los dos roles.

        $un = Role::firstOrCreate([
           'name'=>'Usuario de Notaría'
        ]);

        $un->attachPermissions($permissions);



    }

}