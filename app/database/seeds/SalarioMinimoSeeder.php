<?php
class SalarioMinimo extends seeder{
     public function run()
    {
         DB::table('salario_minimo')->delete();
         $usuario =Auth::user()->id;
         
         DB::table('salario_minimo')->insert(
            array('anio' => 2015, 'fecha_inicio_periodo' => 2015-04-01, 'fecha_termino_periodo' => 2015-12-31, 'zona' => 'B', 'salario_minimo' => 68.28, 'usuario' => $usuario)
                );
    }
}