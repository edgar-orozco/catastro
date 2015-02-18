<?php

class propietarios extends Eloquent
{
    protected $table ='propietarios';
    protected $primaryKey = 'id_propietarios';
    public $timestamps=false;
    protected $guarded = array("*");
   protected $fillable = array("id_propietario, clave");

    public function propietario() {
        return $this->hasOne('Personas', 'id_p', 'id_propietario');
    }
}

