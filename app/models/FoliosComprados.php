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
		return $this->belongsTo('User');
	}

	public function corevat()
	{
		$corevat = Perito::find($this->perito_id)->corevat;
		$input = str_pad($this->numero_folio, 4, "0", STR_PAD_LEFT);
		$tipo_folio = $this->tipo_folio;
		$anio = substr($this->fecha_autorizacion, 2, 2);

		return $corevat.'-'.$input.$tipo_folio.'-'.$anio;
	}

	static function buscarCorevat($corevat, $id_perito, $tipo_folio)
	{
		$busqueda = FoliosComprados::join('peritos', function($join) use ($corevat, $id_perito, $tipo_folio)
        {
            $join->on('folios_comprados.perito_id', '=', 'peritos.id')
                ->where('folios_comprados.perito_id', '=', $id_perito)
                ->where('folios_comprados.tipo_folio', '=', $tipo_folio);
                if ($corevat)
                {
                	$join->where(DB::raw("peritos.corevat||'-'||to_char(folios_comprados.numero_folio, 'FM0999')||folios_comprados.tipo_folio||'-15'"), 'like', "%".ltrim($corevat)."%");
                }
        })
        ->select('folios_comprados.*', 'peritos.*', 'folios_comprados.id as fc_id');

        return $busqueda;
	}

	static function getEntregaM($perito_id, $tipo_folio, $year = null, $paginate = 15)
	{
		$year = ($year==null?date('Y'):$year);
		return FoliosComprados::where('perito_id', $perito_id)
		->where('tipo_folio', $tipo_folio)
		->whereRaw("EXTRACT(YEAR FROM fecha_autorizacion) = ". $year)
		->orderBy('numero_folio', 'ASC')
		->orderBy('fecha_autorizacion', 'DESC')
		->select('*', 'id as fc_id')
		->paginate($paginate);
	}

	static function detallesFC($perito_id, $tipo_folio)
	{
		return FoliosComprados::where('perito_id', $perito_id)
		->where('tipo_folio', $tipo_folio)
		->orderBy('numero_folio', 'DESC')
		->first();
	}


}

