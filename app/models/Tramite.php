<?php
use LaravelBook\Ardent\Ardent;


class Tramite extends Ardent
{

    protected $fillable = [
        'clave',
        'tipotramite_id',
        'usuario_id',
        'folio',
        'uuid',
        'role_id',
        'notaria_id',
        'estatus_id',
        'solicitante_id',
        'tipo_solicitante',
        'departamento_id',
        'padre_id'
    ];


    public function documentos()
    {
        return $this->morphMany('Documento', 'documentable');
    }

    public function documentosTramite()
    {
        return $this->hasMany('DocumentoTramite','tramite_id', 'id');
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
        return $this->hasOne('Solicitante', 'id', 'solicitante_id');
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
     * Relación con las clave y cuenta de predios fusionados.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function TramitePrediosFusionados() {
        return $this->hasMany('TramitePredioFusionado', 'tramite_id', 'id');
    }

    /**
     * Revisa si existe el tramite por su uuid, si existe regresa el registro, si no existe regresa nulo
     * @param $uuid
     * @return mixed
     */
    public static function existeUuid($uuid){
        return self::where('uuid',$uuid)->first();
    }

    /**
     * Scope para consultar tramites por municipio
     * @param $q
     * @param $municipios
     * @return mixed
     */
    public function scopeMunicipios($q, $municipios){

        return $q->whereRaw('substring(clave FROM 4 FOR 3) IN (?)', [$municipios]);
    }

    /**
     * Scope para consultar tramites por rol
     * @param $q
     * @param $roles
     * @return mixed
     */
    public function scopeRol($q, $roles){
        return $q->whereIn('role_id', $roles);
    }

    /**
     * Scope para consultar tramites por el nombre del solicitante, puede consultar por el nombre exacto o por nombre parcial (una fraccion del nombre)
     * @param $q
     * @param $nombre
     * @return mixed
     */
    public function scopeSolicitanteNombreCompleto($q, $nombre){

        return $q->whereHas('solicitante', function($qry) use ($nombre)
        {
            $qry->whereRaw('nombrec ~* ?', [$nombre]);

        });
    }

    /**
     * Scope para consultar tramites por el nombre de la notaría, puede consultar por el nombre completo de la notaría o sólo por el número o una fracción del nombre completo
     * @param $q
     * @param $nombre
     * @return mixed
     */
    public function scopeNotariaNombre($q, $nombre){

        return $q->whereHas('notaria', function($qry) use ($nombre)
        {
            $qry->whereRaw('nombre ~* ?', [$nombre]);

        });
    }

    /**
     * Scope para consultar tramites por su tipo de trámite, puede consultar por el nombre completo del trámite o una fracción del nombre.
     * @param $q
     * @param $nombre
     * @return mixed
     */
    public function scopeTipoTramiteNombre($q, $nombre){

        return $q->whereHas('tipotramite', function($qry) use ($nombre)
        {
            $qry->whereRaw('nombre ~* ?', [$nombre]);

        });
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
            $munargs = implode("','",$municipios);
            return $select->whereRaw('substring( clave FROM 4 FOR 3 ) IN ( ? )', [$munargs]);
        }

        return $select;
    }

    /**
     * Consulta los trámites por fecha o por un extracto de la misma
     * @param $q
     * @param $fecha
     * @return mixed
     */
    public function scopeFecha($q, $fecha) {

        if(trim($fecha)) {

            $q->whereRaw("created_at::varchar ~* ?",[$fecha]);
        }
        return $q;
    }

    /**
     * Consulta los trámites por nombre de depto o por un extracto del nombre
     * @param $q
     * @param $departamento
     * @return mixed
     */
    public function scopeDepartamento($q, $departamento) {

        if(trim($departamento)) {

            return $q->whereHas('departamento', function($qry) use ($departamento)
            {
                $qry->whereRaw('nombre ~* ?', [$departamento]);

            });
        }
        return $q;
    }

    /**
     * Consulta los trámites por estatus o por un extracto del estatus
     * @param $q
     * @param $estatus
     * @return mixed
     */
    public function scopeEstatus($q, $estatus) {

        if(trim($estatus)) {

            return $q->whereHas('estatus', function($qry) use ($estatus)
            {
                $qry->whereRaw('pasado ~* ?', [$estatus]);

            });
        }
        return $q;
    }

    /**
     * Regresa los registros de trámite que tiene por atender un usuario dados sus roles.
     * @param $q
     * @param $roles
     * @return mixed
     */
    public function scopePorAtender($q, $roles) {
        $estatus = ['Finalizado', 'Finalizado observado'];
        return $q->whereIn('role_id', $roles)->whereHas('estatus', function($qry) use ($estatus)
        {
            $qry->whereNotIn('pasado', $estatus);

        });
    }


    public function scopeDocumentoRequsito($q, $requisito_id){

        return $q->whereHas('documento_tramite', function($qry) use ($requisito_id)
        {
            $qry->where('requisito_id', $requisito_id);
        });
    }

    /**
     * Obtiene registros en los que el usuario se ha involucrado o está por involucrarse
     * @param $q
     * @param $user_id
     * @param $roles
     * @param $municipios
     * @return mixed
     */
   public function scopeInvolucrado($q, $user_id, $roles, $municipios) {

       $munw = "";
       $sroles = implode(",",$roles);
       $variables = [$user_id];

       if(count($municipios)>0){
           $munw = "AND substring(clave FROM 4 FOR 3) IN (?)";
           $variables[] = $municipios;
       }

       $sql = "
       (   id IN (
                SELECT distinct tramite_id
                FROM actividades_tramites WHERE user_id = ?
            )
           OR
           (
               role_id IN ($sroles)
               $munw
           )
       )

       ";
        //dd($variables);
       $q->whereRaw($sql , $variables);
       return $q;
   }


    /**
     * Regresa el primer subtrámite involucrado del trámite.
     * @return mixed
     */
    public function tieneSubtramites(){

        return Tramites::where('padre_id', $this->id)->first();

    }

}