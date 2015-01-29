<?php
use LaravelBook\Ardent\Ardent;

/**
 * Class Intento
 * Con esta clase representamos los intentos que se han hecho para iniciar un trámite
 */
class Intento extends Ardent {

    protected $fillable = ['clave', 'cuenta', 'tipotramite_id', 'noencontrado', 'usuario'];

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

    public function requisitos() {
        return $this->belongsToMany('Requisito', 'requisito_intento');
    }

    public function tipotramite(){
        return $this->belongsTo('Tipotramite');
    }

    public function usuario(){
        return $this->belongsTo('User','usuario_id');
    }

    /**
     * Guarda los requisitos asociados no presentados por el usuario del tramite
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
}