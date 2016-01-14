<?php

class propietarios extends Eloquent
{
    protected $table ='propietarios';
    protected $primaryKey = 'id_propietarios';
    public $timestamps=false;
    protected $guarded = array("*");
   protected $fillable = array("id_propietario, clave");

    public function propietario() {
        return $this->hasOne('personas', 'id_p', 'id_propietario');
    }

    public function domicilio () {
    	return $this->hasOne('Domicilio', 'id', 'id_dom');
    }
}

