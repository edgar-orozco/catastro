<?php

class predios extends Eloquent
{
    protected $table ='predios';
<<<<<<< HEAD
    protected $primaryKey = 'clave';
    public $timestamps=false;
    protected $guarded = array("*");
   // protected $fillable = array("nombrec","rfc");

   

}
=======
    protected $primaryKey = 'gid';
    public $timestamps=false;
    protected $guarded = array("*");
    protected $fillable = array("gid","id_propietario","municipio");
}

>>>>>>> aaab2b194863aa20239b95ff595d18a053dadbf3
