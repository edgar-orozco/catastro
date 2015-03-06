<?php

class Perito extends Eloquent {

	protected $table = 'peritos';

	public function iperito(){

		return $this->hasMany('FoliosHistorial');

	}

}

