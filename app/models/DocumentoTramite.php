<?php
use LaravelBook\Ardent\Ardent;

class DocumentoTramite extends Ardent {

    protected $table ='documentos_tramites';

    protected $fillable = ['tramite_id','tipotramite_id', 'requisito_id', 'documento_id'];

    public function documento(){
        return $this->hasOne('Documento', 'id', 'documento_id');
    }
}