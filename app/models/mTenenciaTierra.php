<?php

class mTenenciaTierra extends \Eloquent 
{
	protected $table = 'mtenencia_tierra';
	protected $primaryKey = 'id';
	public $timestamps = true;
	protected $fillable = ["descripcion"];
}
