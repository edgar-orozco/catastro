<?php

class personas extends Eloquent
{
    protected $table ='personas';
    protected $primaryKey = 'id_p';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("nombres", "apellido_paterno", "apellido_materno", "nombrec", "rfc", "curp", "id_tipo", "fecha_ingr");


    /**
     * La relacion con el catalogo de personas es de 1 a 1
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipo() {
        return $this->hasOne('TipoPersona', 'id_tipo', 'id_tipo');
    }

    /**
     * Regresa la relación de traslados de dominio como adquiriente de esta persona
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trasladosComoAdquiriente() {
        return $this->hasMany('Traslado','adquiriente_id','id_p');
    }

    /**
     * Regresa la relación de los traslados de dominio como enajenante de esta persona
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trasladosComoEnajenante() {
        return $this->hasMany('Traslado','enajenante_id','id_p');
    }

    /**
     * Regresa la relación de registros de escritura como adquiriente de esta persona
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrosEscrituraComoAdquiriente() {
        return $this->hasMany('RegistroEscritura','adquiriente_id','id_p');
    }

    /**
     * Regresa la relación de los traslados de dominio como enajenante de esta persona
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function registrosEscrituraComoEnajenante() {
        return $this->hasMany('RegistroEscritura','enajenante_id','id_p');
    }

    /**
     * Se hace override del metodo save para invocar el seteo automatico del nombre completo, ya que estamos repitiendo mucho codigo a lo tonto
     * para cumplir con la especificación de los constraints manejados en la tabla personas
     * @param array $options
     * @return bool|void
     */
    public function save(array $options = array())
    {
        //Invocamos el setter del nombre completo cada que guardamos una persona
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
        if(trim($this->nombres)) $partes[] = $this->nombres;
        if(trim($this->apellido_paterno)) $partes[] = $this->apellido_paterno;
        if(trim($this->apellido_materno)) $partes[] = $this->apellido_materno;

        $this->attributes['nombrec'] = implode(" ", $partes);
    }

    /**
     * Setter de nombres
     * @param $nombres
     */
    public function setNombresAttribute($nombres){
        $this->attributes['nombres'] = mb_strtoupper(trim($nombres));
    }

    /**
     * Setter de apellido paterno
     * @param $apellido_paterno
     */
    public function setApellidoPaternoAttribute($apellido_paterno){
        $this->attributes['apellido_paterno'] = mb_strtoupper(trim($apellido_paterno));
    }

    /**
     * Setter de apellido materno
     * @param $apellido_materno
     */
    public function setApellidoMaternoAttribute($apellido_materno){
        $this->attributes['apellido_materno'] = mb_strtoupper(trim($apellido_materno));
    }

    /**
     * Setter de rfc
     * @param $rfc
     */
    public function setRfcAttribute($rfc){
        $this->attributes['rfc'] = mb_strtoupper(trim($rfc));
    }

    /**
     * setter de curp
     * @param $curp
     */
    public function setCurpAttribute($curp){
        $this->attributes['curp'] = mb_strtoupper(trim($curp));
    }
    /**
     * relacion registro escrituras - enajenante
     */
    public function enajenantes(){
   return $this->hasMany('RegistroEscritura', 'enajenante_id', 'id_p');
}

public function adquiriente(){
   return $this->hasMany('RegistroEscritura', 'enajenante_id', 'id_p');
}

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
}

