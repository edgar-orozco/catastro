<?php

/**
 * Class RolPermisosUsuarioValuadorSeeder
 * Crea los permisos y los roles necesarios para la ejecución y el flujo de avalúos.
 */

class RolPermisosUsuarioValuadorSeeder extends Seeder {

	public function run()
	{

        /*Se debe crear el Rol **Perito Valuador**
             Crear los permisos:
             1. Captura de avalúos (con la llave ***captura_avaluos***)
             2. Seguimiento de avalúos (con la llave ***seguimiento_avaluos***)
         */

        $pi = Permission::firstOrCreate([
            'name'=>'captura_avaluos',
            'display_name'=>'Captura de avalúos'
        ]);

        $si = Permission::firstOrCreate([
            'name'=>'seguimiento_avaluos',
            'display_name'=>'Seguimiento de avalúos'
        ]);

        //Ahora asociamos los permisos a los roles.

        $permissions = array($pi, $si);

        //1. Vemos si el rol de Perito Valuador existe, si existe le aumentamos los dos roles.

        $un = Role::firstOrCreate([
           'name'=>'Perito Valuador'
        ]);

        $un->attachPermissions($permissions);
    }
}