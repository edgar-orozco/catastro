<?php

class Domicilio extends Eloquent {

    protected $fillable = ['tipo_vialidad_id', 'vialidad', 'num_ext', 'num_int', 'tipo_asentamiento_id', 'asentamiento', 'cp', 'localidad', 'municipio', 'entidad', 'referencia'];
    public $timestamps = false;

    public function tipoVialidad(){
        return $this->belongsTo('TipoVialidad', 'tipo_vialidad_id');
    }

    public function tipoAsentamiento(){
        return $this->belongsTo('TipoAsentamiento', 'tipo_asentamiento_id');
    }

    public function mpio(){
        return $this->belongsTo('Municipio','municipio', 'municipio');
    }

    public function edo(){
        return $this->belongsTo('Entidad','entidad', 'entidad');
    }

    public function adquirienteDomicilio(){
        return $this->hasMany('RegistroEscritura', 'dir_adquiriente_id', 'id');
    }

    public function enajenanteDomicilio(){
       return $this->hasMany('RegistroEscritura', 'dir_enajenante_id', 'id');
    }

    public static function domicilioCompleto($value)
    {
        //array para juntar todas la partes
        $partes= array();
         $asent= array();
         $cps= array();
         $localidad= array();
         $entidades=array();
         $direccion= array();
        //consulta del domicilio
        $datos = self::where('id',$value)->get()[0];
        //tipo vialidad
        if($tvialidad =  $datos->tipoVialidad->descripcion)
        {

      //  $consulta = TipoVialidad::where('id',$tvialidad)->pluck('descripcion');

             $partes[]= $tvialidad;
        }
        //vialidad
         if($vialidad =  $datos['vialidad'])
        {
             $partes[]=$vialidad;
        }

        if($ext= $datos['num_ext'])
        {
             $partes[]='No.Ext. '.$ext;
        }

        if($int= $datos['num_int'])
        {
             $partes[]='No.Int. '.$int;
        }

        //tipo asentamiento
        if($tasentamiento =  $datos->TipoAsentamiento->descripcion)
        {

      //  $consulta = TipoAsentamiento::where('id',$tasentamiento)->pluck('descripcion');

             $asent[]= $tasentamiento;
        }

         if($asentamiento= $datos['asentamiento'])
        {
             $asent[]=$asentamiento;
        }

         if($cp= $datos['cp'])
        {

             $cps[]='CP '.$cp;
        }

        if($localidadD =  $datos['localidad'])
        {

             $localidad[]=$localidadD;
        }


         if($municipio = $datos->mpio->nombre_municipio)
        {
             $entidades[]=$municipio;
        }

        if($entidad = $datos->edo->nom_ent)
        {
             $entidades[]=$entidad;
        }
        $vialida = implode(" ", $partes);
        
        $asent=implode(" ", $asent);
        $localidad=implode(", ", $localidad);
        $cps=implode(" ",$cps);
        $entidades=implode(",",$entidades);
        $direccion[]=$vialida;
        $direccion[]=$asent;
        
        $direccion[]=$localidad;
        $direccion[]=$cps;
        $direccion[]=$entidades;
        
        $domicilio=implode(", ", $direccion);
return $domicilio;

        /**
         * Avenida Cinco de Mayo 123 int 4, Colonia La patriota, CP: 87000, Huimanguillo, Tabasco
         */
    }

}