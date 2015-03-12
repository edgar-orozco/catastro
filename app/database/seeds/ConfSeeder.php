<?php
class ConfSeeder extends Seeder {
    public function run()
    {
        DB::table('conf')->delete();
        DB::table('conf')->insert(
            array
            (
            	'salario_minimo' => 66.45,
            	'director_general' => 'L.A.E. EDUARDO ENRIQUE CANABAL RUIZ',
            	'director_catastro' => 'ING. GUSTAVO LÓPEZ SÁNCHEZ',
            	'salario_folio_urbano' => 2,
            	'salario_folio_rustico' => 1,
            	'ano_folio' => 15,
            	'frase_anual' => '"2014, AÑO DE LA CONMEMORACION DEL 150 ANIVERSARIO DE LA GESTA HEROICA DEL 27 DE FEBRERO DEL 1864"',
            	'created_at' => date("Y-m-d H:i:s"),
				'updated_at' => date("Y-m-d H:i:s")
			)
        );
        
    }
}