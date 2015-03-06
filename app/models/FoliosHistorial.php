<?php

class FoliosHistorial extends Eloquent{

	protected $table = 'folios_historial';

	public function perito(){

		return $this->belongsTo('Perito');

	}
}


