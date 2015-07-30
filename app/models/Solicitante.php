<?php
class Solicitante extends Eloquent {

    protected $table = 'solicitante';
    protected $primaryKey = 'id';
    protected $guarded = array("id");
    protected $fillable = array('nombres','apellido_paterno', 'apellido_materno', 'nombrec', 'rfc', 'curp', 'direccion', 'telefono', 'tipo_telefono', 'correo', 'fecha_ingr', 'id_tipo');
    public $timestamps = false;

    /**
     * Consulta los registros de solicitante dada una cadena curp o rfc
     * @param $dato
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function getPorCurpRFC($dato){
        return self::where('curp', 'ilike', $dato.'%')
        ->orWhere('rfc','ilike', $dato.'%')->get();
    }

    /**
     * Relación de solicitante con trámites, un solicitante puede tener varios trámites.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tramites(){
        return $this->hasMany('Tramite','solicitante_id','id');
    }
}