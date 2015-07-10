<?php
class RegistroEscrituras extends Eloquent  {
    protected $table ='registro_escrituas';
    protected $primaryKey = 'id';
    protected $guarded = array("*");
    protected $fillable = array("*");

    public function enajenante() 
    {
    return $this->belongsTo('personas', 'enajenante_id', 'id_p');
    }
}