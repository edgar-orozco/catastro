<?php

class CatConstrucciones extends \Eloquent {
	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'cat_construcciones';
	protected $primaryKey = 'idconstruccion';
	public $timestamps = false;
}