<?php
use LaravelBook\Ardent\Ardent;


class Tramite extends Ardent
{

    protected $fillable = ['clave', 'tipotramite_id', 'usuario_id', 'folio', 'uuid', 'role_id', 'departamento_id'];


    public function documentos()
    {
        return $this->hasManyThrough('Documento','RequisitoTramite','id','documentable_id');
    }

    public function usuario()
    {
        return $this->belongsTo('User','usuario_id');
    }

    public function tipotramite()
    {
        return $this->belongsTo('Tipotramite');
    }

    public function notaria()
    {
        return $this->belongsTo('Notaria');
    }

    public function requisitos()
    {
        return $this->belongsToMany('Requisito', 'requisito_tramite')->withPivot(['usuario_id']);
    }

    public function solicitante(){
        return $this->hasOne('personas', 'id_p', 'solicitante_id');
    }

    public function departamento(){
        return $this->hasOne('DepartamentoTramite', 'id', 'departamento_id');
    }

    public function rol(){
        return $this->hasOne('Role', 'id', 'role_id');
    }

    public function actividades(){
        return ActividadTramite::where('tramite_id',$this->id)->get();
    }

    public function estatus() {
        return $this->hasOne('EstatusTramite', 'id', 'estatus_id');
    }

    /**
     * Revisa si existe el tramite por su uuid, si existe regresa el registro, si no existe regresa nulo
     * @param $uuid
     * @return mixed
     */
    public static function existeUuid($uuid){
        return self::where('uuid',$uuid)->first();
    }


    public function scopeMunicipios($q, $municipios){

        return $q->whereRaw('substring(clave FROM 4 FOR 3) IN (?)', [$municipios]);
    }

    public function scopeRol($q, $roles){
        return $q->whereIn('role_id', $roles);
    }

    public function scopeSolicitante($q, $apepat){
        return $q->leftJoin('personas','personas.id_p', '=', 'tramites.solicitante_id')->where('personas.apellido_paterno', $apepat);
    }

    /**
     * Limita la consulta a los trámites que son responsabilidad del usuario, dado sus roles y sus municipios
     * @param $q
     * @param $roles
     * @param $municipios
     * @return
     */
    public function scopeResponsabilidad($q, $roles, $municipios) {

        $select = $q->whereIn('role_id', $roles);
        if(count($municipios))
        {
            return $select->whereRaw('substring(clave FROM 4 FOR 3) IN (?)', [$municipios]);
        }

        return $select;
    }

    /**
     * Obtiene registros en los que el usuario se ha involucrado o está por involucrarse
     * @param $q
     * @param $user_id
     * @return mixed
     */
/*    public function scopeInvolucrado($q, $user_id) {

        //$q->

        return $q;
    }
*/
}