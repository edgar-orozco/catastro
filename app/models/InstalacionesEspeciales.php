<?php

class InstalacionesEspeciales Extends Eloquent
{
    protected $table = 'tipoinstalacionesespeciales';
    protected $primaryKey = 'id_tipoie';
    public $timestamps = false;

    public function cat_inst($id=null)
    {
     $selection=array();

        $instala= DB::table('instalacionesespeciales')->select('id_tipoie')->where('clave_catas', 'like', $id)->get();
        foreach ($instala as $row) 
        {
            $selection[]=$row->id_tipo_ie;
        }
        $catalogo = InstalacionesEspeciales::whereNotIn('id', $selection)->get();

        return $catalogo;
    }
    
}