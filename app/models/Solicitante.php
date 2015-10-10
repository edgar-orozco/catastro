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
        return self::where('curp', strtoupper($dato))
          ->orWhere('rfc', strtoupper($dato))->first();
    }

    /**
     * Relación de solicitante con trámites, un solicitante puede tener varios trámites.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tramites(){
        return $this->hasMany('Tramite','solicitante_id','id');
    }

    public function setNombresAttribute($val){
        $this->attributes['nombres'] = mb_strtoupper($val);
    }

    public function setApellidoPaternoAttribute($val){
        $this->attributes['apellido_paterno'] = mb_strtoupper($val);
    }

    public function setApellidoMaternoAttribute($val){
        $this->attributes['apellido_materno'] = mb_strtoupper($val);
    }

    public function setCurpAttribute($val){
        $this->attributes['curp'] = mb_strtoupper($val);
    }

    public function setRfcAttribute($val){
        $this->attributes['rfc'] = mb_strtoupper($val);
    }

    public function setDireccionAttribute($val){
        $this->attributes['direccion'] = mb_strtoupper($val);
    }

    public function setCorreoAttribute($val){
        $this->attributes['correo'] = mb_strtolower($val);
    }

    public function getNombrecAttribute(){
        $this->setNombreCompleto();
        return $this->attributes['nombrec'];
    }



    /**
     * Se hace override del metodo save
     * @param array $options
     * @return bool|void
     */
    public function save(array $options = array())
    {
        //Invocamos el setter del nombre completo cada que guardamos un solicitante
        $this->setNombreCompleto();
        //ejecutamos el codigo original del método save, el codigo original del metodo retorna bool, nosotros tambien tenemos que
        //retornar bool para conservar la funcionalidad del metodo
        return parent::save($options);
    }

    /**
     * Setea el nombre completo
     */
    public function setNombreCompleto(){
        $partes = array();
        if(trim($this->nombres)) $partes[] = trim($this->nombres);
        if(trim($this->apellido_paterno)) $partes[] = trim($this->apellido_paterno);
        if(trim($this->apellido_materno)) $partes[] = trim($this->apellido_materno);

        $this->attributes['nombrec'] = implode(" ", $partes);
    }



}