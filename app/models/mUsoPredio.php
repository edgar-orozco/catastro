<?php

class mUsoPredio extends \Eloquent 
{
	protected $table = 'muso_predio';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion"];
}
