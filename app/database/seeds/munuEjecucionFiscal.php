<?php
class menuEjecucionFiscal extends Seeder {
    public function run()
{
        
      DB::table('permissions')->insert(
            array('name' => 'ejecucion_fiscal','display_name' => 'Ejecucion fiscal')
                );

      DB::table('roles')->insert(
            array('name' => 'Ejecucion fiscal')
                );
        
        
}

}