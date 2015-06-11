<?php

class FoliosComprados extends Eloquent  {

	

	protected $fillable=['perito_id', 'numero_folio','tipo_folio','entrega_municipal','entrega_estatal','usado', 'no_oficio_historial','usuario_id', 'fecha_autorizacion', 'municipio_id'];
	protected $table = 'folios_comprados';			 


		
		public function municipio()
		{

			return $this->belongsto('Municipio');
		}

		public function usuario()
		{

			return $this->belongsTo('user');
		}

}

