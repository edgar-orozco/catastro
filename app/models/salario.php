<?php
class salario extends Eloquent {

    protected $table = 'salario_minimo';
    protected $primaryKey = 'id_salario_minimo';
    public $timestamps = false;

    /**
     * Regreasa el monto del salario mínimo vigente para una zona dada
     * @param $zona
     * @return float
     */
    public static function smv($zona){
        $monto = 0.00;
        $salario = self::where( 'fecha_inicio_periodo', '<=', date("Y-m-d") )
          ->where( 'fecha_termino_periodo', '>=', date("Y-m-d") )
            ->where('zona', $zona)->first();
        if($salario)
        {
            $monto = $salario->salario_minimo;
        }
        return $monto;
    }
}
