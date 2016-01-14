<?php

use Laravelrus\LocalizedCarbon\Models\Eloquent;

class Manifestacion extends Eloquent
{
    protected $table = 'manifestaciones';
    protected $guarded = ['id'];
    protected $nullable =[
        'movimiento','cuenta_predio','clave_zona','clave_manzana','clave_predio','cuenta_afectada','memo_num',
        'tipo_predio','tipo_propietario',
        'direccion_rustico_id', 'direccion_urbano_id',
        'adquiriente_id','domicilio_adquiriente_id',
        'enajenante_id','domicilio_enajenante_id',
        'vias_comunicacion_id','poblacion_proxima','tenencia_tierra_id',
        'uso_predio_id','bloques_construccion','tipo_escritura_id','notaria_id','notario_id',
        'num_titulo','num_registro','num_predio','fecha_titulo','fecha_escritura',
        'num_folio','volumen','folio_real','reg_municipio','estatus_fiscal','semestre_valuacion','semestre_alta',
        'informacion_adicional','nombre_manifestante',
        'sup_terreno','sup_construccion','distancia_poblacion',
        'suelo_inundable', 'suelo_popal', 'suelo_cultivable', 'suelo_desnivel', 'suelo_incultivable', 'suelo_otros',
        'sup_cons_albercas', 'total_sup_construccion', 'inc_terreno', 'dem_terreno', 'dem_construccion',
        'valor_terreno', 'valor_construccion',
        'cat_total'
    ];

    public function adquiriente()
    {
        return $this->belongsTo('personas', 'adquiriente_id', 'id_p');
    }
    public function enajenante()
    {
        return $this->belongsTo('personas', 'enajenante_id', 'id_p');
    }

    public function domicilioAdquiriente()
    {
        return $this->belongsTo('Domicilio', 'domicilio_adquiriente_id', 'id');
    }

    public function domicilioEnajenante()
    {
        return $this->belongsTo('Domicilio', 'domicilio_enajenante_id', 'id');
    }

    public function direccionUrbano()
    {
        return $this->belongsTo('DomicilioUrbano', 'direccion_urbano_id', 'id_du');
    }

    public function direccionRustico()
    {
        return $this->belongsTo('DomicilioRustico', 'direccion_rustico_id', 'id_dr');
    }

    public function construcciones(){
        return $this->hasMany('ManifestacionConstruccion');
    }

    public function notaria()
    {
        return $this->belongsTo('Notaria', 'notaria_id', 'id_notaria');
    }

    public function notario()
    {
        return $this->belongsTo('personas', 'notario_id', 'id_p');
    }

    public function municipio()
    {
        return $this->belongsTo('Municipio', 'municipio', 'municipio');
    }

    public function regMunicipio()
    {
        return $this->belongsTo('Municipio', 'reg_municipio', 'municipio');
    }

    public function colindancias()
    {
       return $this->hasMany('ManifestacionColindancia', 'manifestacion_id', 'id');
    }

    public function servicios()
    {
        return $this->hasMany('ManifestacionServicio','manifestacion_id', 'id');
    }
    public function Propietario()
    {
        return $this->belongsTo('propietarios', 'propietario_id', 'id_propietarios');
    }
    public function SERVICIO () 
    {
        return $this->hasMany('ServicioPublico', 'manifestacion_predio_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
           self::setNullables($model);
        });
    }


    /**
     * Seteamos a null los nulables
     * @param object $model
     */
    protected static function setNullables($model)
    {
        foreach($model->nullable as $field)
        {
            if(empty($model->{$field}))
            {
                $model->{$field} = null;
            }
        }
    }
}