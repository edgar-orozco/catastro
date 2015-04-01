<?php

/**
 * Class RolesTramitesSeeder
 * Crea los permisos y los roles necesarios para la ejecución y el flujo de trámites.
 */

class RolesTramitesSeeder extends Seeder {

	public function run()
	{

        //Primero damos de alta los permisos para los roles:

        //1. El usuario puede crear un tramite
        //2. El usuario puede ejecutar actividades de un trámite
        //3. El usuario puede finalizar un tramite

        $nt = Permission::firstOrCreate([
            'name'=>'crear_tramites',
            'display_name'=>'Crear nuevos trámites'
        ]);

        $ea = Permission::firstOrCreate([
            'name'=>'ejecutar_tramites',
            'display_name'=>'Ejecutar actividades'
        ]);

        $ft = Permission::firstOrCreate([
            'name'=>'finalizar_tramites',
            'display_name'=>'Finalizar trámites'
        ]);

        //Ahora asociamos los permisos a los roles.

        $permissions = array($nt, $ea, $ft);

        //1. Vemos si el rol de funcionario ventanilla existe, si existe le aumentamos los tres roles.

        $fv = Role::firstOrCreate([
           'name'=>'Funcionario ventanilla'
        ]);

        $fv->attachPermissions($permissions);

        //2. Creamos el rol de funcionario de la direccion general de catastro
        $fdc = Role::firstOrCreate([
            'name'=>'Funcionario Dirección General de Catastro'
        ]);

        $fdc->attachPermissions($permissions);

        //3. Creamos el rol del funcionario de la subdireccion de
        $fsc = Role::firstOrCreate([
            'name'=>'Funcionario Subdirección de Catastro'
        ]);

        $fsc->attachPermissions($permissions);

        //4. Creamos el rol del funcionario del departamento de administración de trámite
        $fat = Role::firstOrCreate([
            'name'=>'Funcionario Administración de Trámite'
        ]);

        $fat->attachPermissions($permissions);

        //5. Creamos el rol del funcionario del departamento de administración de trámite
        $fca = Role::firstOrCreate([
            'name'=>'Funcionario Cartografía'
        ]);

        $fca->attachPermissions($permissions);

        //6. Creamos el rol del funcionario del departamento registro y valuación
        $frv = Role::firstOrCreate([
            'name'=>'Funcionario Registro y Valuación'
        ]);

        $frv->attachPermissions($permissions);


    }

}