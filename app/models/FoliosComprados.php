<?php

class FoliosComprados extends Eloquent  {

	

	protected $fillable=['perito_id', 'numero_folio','tipo_folio','entrega_municipal','entrega_estatal','usado', 'no_oficio_historial','usuario_id'];
	protected $table = 'folios_comprados';			 


		public function usuario(){

			return $this->belongsTo('CatUsuarios');
		}
		public function municipio(){

			return $this->belongsTo('CatMunicipios');
		}
}

