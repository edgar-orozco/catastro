<?php

class ActividadesSistema extends Eloquent  {

    protected $fillable = [
        'id',
        'user_id',
        'modulo',
        'actividad',
        'pk_afectada',
        'created_at',
        'usuario',
        'registro',
    ];
    protected $table = 'actividades_sistema';

    /**
     * One-to-One relación con Peritos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function usuario()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

    /**
     * One-to-One relación con Peritos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function registro()
    {
        return $this->hasOne('User', 'id', 'pk_afectada');
    }
    /**
     * Función para obtener los datos de la actividades del sistema con una consulta dada
     *
     * @param $parametros
     * @return array
     */
    public function consulta($parametros){
        $datos = array();
        $consulta = $this;
        if(array_key_exists('tipoFecha', $parametros)) {
            if ($parametros['tipoFecha'] == 'especifica') {
                $fecha = explode('T', $parametros['fecha']);
                $consulta = $this->fechaEspecifica($fecha[0]);
            } else {
                $inicio = explode('T', $parametros['inicio']);
                $fin = explode('T', $parametros['fin']);
                $consulta = $this->entreFechas($inicio[0], $fin[0]);
            }
        }
        if(array_key_exists('tipo', $parametros)) {
            $ids = json_decode(stripslashes($parametros['datos']));
            switch ($parametros['tipo']) {
                case 'roles':
                    $consulta = $consulta->rolesAuditados($ids);
                    break;
                case 'municipios':
                    $consulta = $consulta->municipiosAuditados($ids);
                    break;
                case 'actividades':
                    $consulta = $consulta->actividadesAuditadas($ids);
                    break;
                case 'usuario':
                    $consulta = $consulta->usuariosAuditados($ids);
                    break;
            }
        }
        $consulta = $consulta
            ->with('usuario')
            ->with('registro')
            ->get();

        foreach($consulta as $actividad){
            $datos[] = array(
                'fecha'     => $actividad->created_at->format('Y-m-d H:i:s'),
                'actividad' => $actividad->actividad,
                'modulo'    => $actividad->modulo,
                'usuario'   => $actividad->usuario->nombreCompleto(),
                'registro'  => $actividad->registro->nombreCompleto(),
            );
        }

        return $datos;
    }

    /**
     * Scope query para obtener las actividades del sistema por rango de fechas
     * @param $query
     * @param $inicio
     * @param $fin
     * @return mixed
     */
    public function scopeEntreFechas($query, $inicio, $fin){
        return $query->whereBetween('actividades_sistema.created_at', array($inicio.' 00:00:00', $fin.' 23:59:59') );
    }

    /**
     * Scope query para obtener las actividades del sistema por rango de fechas
     * @param $query
     * @param $fecha
     * @return mixed
     */
    public function scopeFechaEspecifica($query, $fecha){
        return $query->whereBetween('actividades_sistema.created_at', array($fecha.' 00:00:00', $fecha.' 23:59:59') );
    }

    /**
     * Scope query para obtener las actividades del sistema por roles afectados
     * @param $query
     * @param $roles
     * @return mixed
     */
    public function scopeRolesAuditados($query, $roles){
        return $query
            ->join('users', 'actividades_sistema.pk_afectada', '=', 'users.id')
            ->join('assigned_roles', 'users.id', '=', 'assigned_roles.user_id')
            ->whereIn('assigned_roles.role_id', $roles );
    }
    /**
     * Scope query para obtener las actividades del sistema por municipios afectados
     * @param $query
     * @param $municipios
     * @return mixed
     */
    public function scopeMunicipiosAuditados($query, $municipios){
        return $query
            ->join('users', 'actividades_sistema.pk_afectada', '=', 'users.id')
            ->join('user_municipio', 'users.id', '=', 'user_municipio.usuario_id')
            ->whereIn('user_municipio.municipio_id', $municipios );
    }
    /**
     * Scope query para obtener las actividades del sistema por usuarios que modifican registros
     * @param $query
     * @param $usuarios
     * @return mixed
     */
    public function scopeUsuariosAuditados($query, $usuarios){
        return $query->whereIn('actividades_sistema.user_id', $usuarios );
    }
    /**
     * Scope query para obtener las actividades del sistema por actividad
     * @param $query
     * @param $activiadades
     * @return mixed
     */
    public function scopeActividadesAuditadas($query, $activiadades){
        return $query->whereIn('actividades_sistema.actividad', $activiadades );
    }
}

