<?php
class Solicitante extends Eloquent {

    protected $table = 'solicitante';
    protected $primaryKey = 'id';
    protected $guarded = array("id");
    protected $fillable = array('nombres','apellido_paterno', 'apellido_materno', 'nombrec', 'rfc', 'curp', 'direccion', 'telefono', 'tipo_telefono', 'correo', 'fecha_ingr', 'id_tipo');
    public $timestamps = false;

    /**
     * Consulta los registros de solicitante dado un fragmento de cadena curp o rfc
     * @param $dato
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getPorCurpRFC($dato){
        return self::where('curp', 'ilike', $dato.'%')
        ->orWhere('rfc','ilike', $dato.'%')->get();
    }

    /**
     * Retorna un registro de solicitante si se ha consultado ya sea por curp o por rfc, Si no existe regresa null
     * @param $dato
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public static function findPorCurpRFC($dato){
        return self::where('curp', $dato)
          ->orWhere('rfc', $dato)->first();
    }

    /**
     * Relación de solicitante con trámites, un solicitante puede tener varios trámites.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tramites(){
        return $this->hasMany('Tramite','solicitante_id','id');
    }
}