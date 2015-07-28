<?php
class RegistroEscritura extends Eloquent  {
    protected $table ='registro_escrituras';
    protected $primaryKey = 'id';
    
    protected $fillable = array("*");


     public function enajenante()
    {

        return $this->belongsTo('personas', 'enajenante_id', 'id_p');


    }

       public function adquiriente()
    {

        return $this->belongsTo('personas', 'adquiriente_id', 'id_p');


    }

     public function adquirienteDomicilio()
    {

        return $this->belongsTo('Domicilio', 'dir_adquiriente_id', 'id');


    }

    public function enajenanteDomicilio()
    {

        return $this->belongsTo('Domicilio', 'dir_enajenante_id', 'id');


    }

    public function notaria()
    {

        return $this->belongsTo('Notaria', 'notaria_id', 'id_notaria');


    }

    public function municipio()
    {

        return $this->belongsTo('Municipio', 'municipio_id', 'municipio');


    }

    public function colindancia()
    {

        return $this->hasMany('RegistroColindancias', 'registro_id', 'id');


    }
}