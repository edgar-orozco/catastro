<?php

class personas extends Eloquent
{
    protected $table ='personas';
    protected $primaryKey = 'id_p';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("nombres", "apellido_paterno", "apellido_materno", "nombrec", "rfc", "curp", "id_tipo", "fecha_ingr");


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

}

