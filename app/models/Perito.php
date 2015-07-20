<?php

class Perito extends Eloquent {

	protected $table = 'peritos';
    protected $fillable = ['nombre','corevat','direccion','telefono','correo','Estado'];
	public function iperito(){

		return $this->hasMany('FoliosHistorial');

	}

}

