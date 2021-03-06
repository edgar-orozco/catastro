<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name'];

    /**
     * Bandera para poblar el objeto con el request enviado desde la forma Input::all()
     * @see https://github.com/laravelbook/ardent#updates-with-unique-rules
     * @var bool
     */
    public $autoHydrateEntityFromInput = true;

    /**
     * Bandera para purgar atributos html como el CRSF, _token, etc.
     * @see https://github.com/laravelbook/ardent#automatically-purge-redundant-form-data
     * @var bool
     */
    public $autoPurgeRedundantAttributes = true;

    /**
     * Errores de validación
     * @var
     */
    protected $errors;

    /**
     * Reglas de validación
     * @var array
     */
    public static $rules = [
        'name' => 'required|unique:permissions'
    ];

    /**
     * Devuelve el número total de roles registrados
     * @return int
     */
    public static function totalRoles()
    {
        return self::all()->count();
    }

    /**
     * Función para obtener los datos que requiere select2 para formar los filtros
     * de la bitacora de actividades
     */
    public static function filtro() {
        $roles = array();
        $raw = self::all();
        foreach($raw as $role){
            $roles[] = array(
                'id'    => $role->id,
                'label' => $role->name,
            );
        }

        return $roles;
    }

}