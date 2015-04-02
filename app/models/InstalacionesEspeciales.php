<?php

class InstalacionesEspeciales Extends Eloquent
{
    protected $table = 'tipoinstalacionesespeciales';
    protected $primaryKey = 'id_tipoie';
    public $timestamps = false;

    public function cat_inst($id=null)
    {
     $selection=array();

        $instala= DB::table('instalaciones_especiales')->select('id_tipo_ie')->where('clave', 'like', $id)->get();
        foreach ($instala as $row) 
        {
            $selection[]=$row->id_tipo_ie;
        }
        $catalogo = InstalacionesEspeciales::whereNotIn('id', $selection)->get();

        return $catalogo;
    }
    
}