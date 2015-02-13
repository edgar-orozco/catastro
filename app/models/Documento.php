<?php
use LaravelBook\Ardent\Ardent;

class Documento extends Ardent {

    protected $fillable = ['descripcion','archivo', 'path', 'size', 'mimetype', 'documentable_id', 'documentable_type'];

    public function documentable (){
        return $this->morphTo();
    }

}