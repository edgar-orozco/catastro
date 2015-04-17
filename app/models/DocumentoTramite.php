<?php
use LaravelBook\Ardent\Ardent;

class DocumentoTramite extends Ardent {

    use SoftDeletingTrait;

    protected $table ='documentos_tramites';

    protected $fillable = ['tramite_id','tipotramite_id', 'requisito_id', 'documento_id'];

    protected $dates = ['deleted_at'];

    public function documento(){
        return $this->hasOne('Documento', 'id', 'documento_id');
    }
}