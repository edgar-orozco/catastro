<?php

class AefCompConstrucciones extends \Eloquent {

	protected $connection = 'corevat';
	protected $fillable = [];
	protected $table = 'aef_comp_construcciones';
	protected $primaryKey = 'idaefcompconstruccion';
	public $timestamps = false;

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function AefCompConstruccionesByFk($idavaluoenfoquefisico) {
		return AefCompConstrucciones::select('*')
						->where('idavaluoenfoquefisico', '=', $idavaluoenfoquefisico)
						->orderBy('idaefcompconstruccion')
						->get();
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function delBeforeAefCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function delAefCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function delAfterAefCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insBeforoAefCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAefCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function insAfterCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updBeforeAefCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAefCompConstrucciones() {
		
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public static function updAfterAefCompConstrucciones() {
		
	}	
	
	
	public static function getAjaxAefCompConstruccionesByFk($fk) {
		$pato = array();
		$rows = AefCompConstrucciones::select(
		'aef_comp_construcciones.idaefcompconstruccion', 
		'cat_tipo.tipo',
		'aef_comp_construcciones.caracteristicas',
		'aef_comp_construcciones.m2construido',
		'aef_comp_construcciones.precio',
		'aef_comp_construcciones.precio_unitario_m2',
		'aef_comp_construcciones.observaciones')
						->leftJoin('cat_tipo', 'aef_comp_construcciones.idtipo', '=', 'cat_tipo.idtipo')
						->where('aef_comp_construcciones.idavaluoenfoquefisico', '=', $fk)
						->orderBy('aef_comp_construcciones.idaefcompconstruccion')
						->get();
		$count = count($rows);
		 foreach ($rows as $row) {
			 $pato[] = array(
				$row['idaefcompconstruccion'], 
				$row['tipo'], 
				$row['caracteristicas'], 
				$row['m2construido'], 
				$row['precio'], 
				$row['precio_unitario_m2'], 
				$row['observaciones'], 
				'<a class="btn btn-xs btn-info btnEdit"  title="Editar" onclick="$.editAefCompConstrucciones('.$row['idaefcompconstruccion'].');"><i class="glyphicon glyphicon-pencil"></i></a>', 
				'<a class="btn btn-xs btn-danger btnDel" title="Eliminar" onclick="$.delAefCompConstrucciones('.$row['idaefcompconstruccion'].');"><i class="glyphicon glyphicon-remove"></i></a>');
		 }
		$res = array(
			"draw" => 1,
			"recordsTotal" => $count,
			"recordsFiltered" => $count,
			"data" => $pato
		);
		return $res;
	}

	
	
}
