<?php
class SolicitudGestion extends Eloquent {

    protected $table = 'solicitud_gestion';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function solicitante () {
        return $this->hasOne('solicitante','id','solicitante_id');
    }
    
    public function tramite() {
        return $this->hasOne('Tipotramite', 'id','tramite_id');
    }
    
    public function mupio() {
        return $this->hasOne('Municipio','gid','municipio');
    }

    /**
     * Regresa una cadena de seguimiento unica dentro del rango de tiempo de expiración predeterminado (un año)
     * @param null $cadena
     * @return string
     */
    public static function cadenaSeguimientoUnica($cadena = null){

        //Si la cadena es nula, es decir se ha llamado SolicitudGestion::cadenaSeguimientoUnica() entonces generamos una cadena.
        if(!$cadena)
        {
            $cadena = SeguimientoHelper::generarClave();
        }

        //Consultamos si es que ya existe un registro con la misma cadena dentro del rango de un año
        $haceunanio = "";

        //Hacemos la consulta a ver si ya existe:
        $solicitud = SolicitudGestion::where('seguimiento',$cadena)
          // Aqui se debe consultar desde hoy hasta un año atras
          ->where('created_at' > $haceunanio)
          ->first();

        //Si existe una solicitud con la misma clave dentro del rango de tiempo del año pasado, entonces volvemos a crear una nueva cadena
        //y volvemos a preguntar si existe:
        if($solicitud)
        {
            $cadena = SeguimientoHelper::generarClave();
            return SolicitudGestion::cadenaSeguimientoUnica($cadena);
        }
        else
        {
            //Si no existe la solicitud con la misma cadena de segumiento, entonces regresamos la cadena.
            return $cadena;
        }
    }
}