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
        //consulta del domicilio
        $datos = self::where('id',$value)->get()[0];

        if($localidad =  $datos['localidad'])
        {
             $partes[]=$localidad;
        }

        if($ext= $datos['num_ext'])
        {
             $partes[]=$ext;
        }

        if($int= $datos['num_int']);
        {
             $partes[]=$int;
        }

         if($cp= $datos['cp'])
        {
             $partes[]=$cp;
        }

         if($municipio = $datos->mpio->nombre_municipio)
        {
             $partes[]=$municipio;
        }

        if($entidad = $datos->edo->nom_ent)
        {
             $partes[]=$entidad;
        }

        $direccion = implode(", ", $partes);
return $direccion;

        /**
         * Avenida Cinco de Mayo 123 int 4, Colonia La patriota, CP: 87000, Huimanguillo, Tabasco
         */
    }

}