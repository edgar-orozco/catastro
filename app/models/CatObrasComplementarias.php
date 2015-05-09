<?php

class CatObrasComplementarias extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_obras_complementarias';
	protected $primaryKey = 'idobracomplementaria';
	public $timestamps = false;
}