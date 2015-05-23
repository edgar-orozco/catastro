<?php

class AvaluosFisico extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'avaluo_enfoque_fisico';
	protected $primaryKey = 'idavaluoenfoquefisico';
	public $timestamps = false;

	public function AefTerrenos() {
		return $this->hasOne('AefTerrenos', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	public function AefConstrucciones() {
		return $this->hasOne('AefConstrucciones', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	public function AefCondominios() {
		return $this->hasOne('AefCondominios', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	public function AefCompConstrucciones() {
		return $this->hasOne('AefCompConstrucciones', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

	public function AefInstalaciones() {
		return $this->hasOne('AefInstalaciones', 'idavaluoenfoquefisico', 'idavaluoenfoquefisico');
	}

}
