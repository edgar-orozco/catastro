<?php

use LaravelBook\Ardent\Ardent;

/**
 * Class Tipotramite
 */
class Tipotramite extends Ardent
{
    protected $fillable = ['nombre', 'tiempo', 'costodsmv'];

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
        'nombre' => 'required|unique:tipotramites',
        'tiempo' => 'digits_between:0,365',
        'costodsmv' => 'digits_between:0,1000',
    ];

    /**
     * Se implementa el metodo beforesave para procesar datos antes de guardar
     *
     * @return bool
     */
    public function beforeSave()
    {

        if ($this->tiempo === '' || $this->tiempo === null) {
            $this->tiempo = 0;
        }
        if ($this->costodsmv === '' || $this->costodsmv === null) {
            $this->costodsmv = 0;
        }

        return true;
    }

    /**
     * Devuelve los requisitos que pertenecen al tipotramite
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function requisitos()
    {
        return $this->belongsToMany('Requisito')->withPivot(['original', 'copias', 'certificadas']);
    }

    /**
     * Indica si el requisito es requerido o no
     * @param $requisito_id
     * @return bool
     */
    public function requisitoEnOriginal($requisito_id)
    {
        $r = $this->requisitos()->wherePivot('original', true)->wherePivot('requisito_id',
            $requisito_id)->lists('original');
        return isset($r[0]) ? $r[0] : false;
    }


    /**
     * Devuelve el número de copias que solicita un requisito dado
     * @param $requisito_id
     * @return int | null
     */
    public function requisitoNumeroCopias($requisito_id)
    {
        $r = $this->requisitos()->wherePivot('requisito_id', $requisito_id)->lists('copias');
        return isset($r[0]) ? $r[0] : null;
    }

    /**
     * Indica si las copias del requisito son certificadas o no.
     * @param $requisito_id
     * @return bool
     */
    public function requisitoEnCopiasCertificadas($requisito_id)
    {
        $r = $this->requisitos()->wherePivot('certificadas', true)->wherePivot('requisito_id',
            $requisito_id)->lists('certificadas');
        return isset($r[0]) ? $r[0] : false;
    }

    /**
     * Guarda los requisitos asociados
     * @param $requisitos
     */
    public function guardaRequisitos($requisitos)
    {
        if (!empty($requisitos)) {
            $this->requisitos()->detach(); //Metemos detach porque por alguna oscura razón no sirve el sync solo. Debiera hacer detach y luego attach el sync, pero no lo hace
            $this->requisitos()->sync($requisitos);
        } else {
            $this->requisitos()->detach();
        }
    }

    /**
     * Devuelve el número total de tipos de trámites registrados
     * @return int
     */
    public static function totalTipotramites()
    {
        return self::all()->count();
    }


}