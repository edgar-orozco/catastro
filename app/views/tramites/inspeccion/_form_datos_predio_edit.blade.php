<style>
    .solo-rusticos{
        display: none;
    }
</style>
<div class="datos-predio">
    <div class="form-inline">
        <div class="form-group">
            {{Form::label($instancia.'[sup_terreno]','Superficie del terreno')}}
            <div class="input-group">
                {{Form::text($instancia.'[sup_terreno]', $consultaMani->sup_terreno, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-sup_terreno',
                    'maxlength'=>'12',
                    'size'=>'14',
                    'placeholder'=>'SUP. TERRENO',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>

            {{Form::label($instancia.'[sup_construccion]','Superficie de construcción')}}
            <div class="input-group">
                {{Form::text($instancia.'[sup_construccion]', $consultaMani->sup_construccion, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-sup_construccion',
                    'maxlength'=>'12',
                    'size'=>'14',
                    'placeholder'=>'SUP. CONS.',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>

            {{Form::label($instancia.'[tipo_predio]','Tipo Predio')}}
            <div class="input-group">
                {{Form::select($instancia.'[tipo_predio]', [null => '', 'U'=>'Urbano', 'R'=>'Rustica marica'], $consultaMani->tipo_predio , ['class'=>'form-control select2 select-manifestacion-tipo_predio'] )}}
            </div>

            <span class="solo-rusticos">
                {{Form::label($instancia.'rustico[vias_comunicacion_id]','Vías de comunicación')}}
                {{Form::select($instancia.'rustico[vias_comunicacion_id]', [null => '']+$viasComunicacion, null, ['class'=>'form-control select2 select-manifestacion-vias_comunicacion_id'])}}
            </span>
        </div>
    </div>

    <div class="form-inline">
        <div class="form-group">
            <span class="solo-rusticos">

                {{Form::label($instancia.'rustico[poblacion_proxima]','Población próxima')}}
                {{Form::text($instancia.'rustico[poblacion_proxima]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-poblacion_proxima',
                    'maxlength'=>'120',
                    'size'=>'25',

                    'data-instancia'=>$instancia
                    ]
                )}}
                {{Form::label($instancia.'rustico[distancia_poblacion]','Distancia')}}
                <div class="input-group">
                    {{Form::text($instancia.'rustico[distancia_poblacion]', null, [
                        'class' => 'form-control',
                        'id'=>$instancia.'-distancia_poblacion',
                        'maxlength'=>'12',
                        'size'=>'13',

                        'data-instancia'=>$instancia
                        ]
                    )}}
                    <span class="input-group-addon">Km.</span>
                </div>
            </span>
            {{Form::label($instancia.'[tenencia_tierra_id]','Tenencia de la tierra')}}
            {{Form::select($instancia.'[tenencia_tierra_id]', [null => '']+$tenenciaTierra, $consultaMani->tenencia_tierra_id , ['class'=>'form-control select2 select-manifestacion-tenencia_tierra_id'] )}}

            {{Form::label($instancia.'[uso_predio_id]','Uso del predio')}}
            {{Form::select($instancia.'[uso_predio_id]', [null => '']+$usoPredio, $consultaMani->uso_predio_id, ['class'=>'form-control select2 select-manifestacion-uso_predio_id'] )}}

            {{Form::label($instancia.'_servicios[]','Servicios públicos')}}
            {{Form::select($instancia.'_servicios[]', $serviciosPublicos, $serv_publico, ['class'=>'form-control select2-multiple select-manifestacion-servicios_id', 'multiple'=>'multiple'] )}}

            <h4>Características del suelo</h4>
            {{Form::label($instancia.'[suelo_inundable]','Inundable')}}
            <div class="input-group">
                {{Form::text($instancia.'[suelo_inundable]', $consultaMani->suelo_inundable, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-suelo_inundable',
                    'maxlength'=>'5',
                    'size'=>'6',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">%</span>
            </div>
            {{Form::label($instancia.'[suelo_popal]','Popal')}}
            <div class="input-group">
                {{Form::text($instancia.'[suelo_popal]', $consultaMani->suelo_popal, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-suelo_popal',
                    'maxlength'=>'5',
                    'size'=>'6',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">%</span>
            </div>
            {{Form::label($instancia.'[suelo_desnivel]','Desnivel')}}
            <div class="input-group">
                {{Form::text($instancia.'[suelo_desnivel]', $consultaMani->suelo_desnivel, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-suelo_desnivel',
                    'maxlength'=>'5',
                    'size'=>'6',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">%</span>
            </div>
            {{Form::label($instancia.'[suelo_incultivable]','Incultivable')}}
            <div class="input-group">
                {{Form::text($instancia.'[suelo_incultivable]', $consultaMani->suelo_incultivable, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-suelo_incultivable',
                    'maxlength'=>'5',
                    'size'=>'6',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">%</span>
            </div>

            {{Form::label($instancia.'[suelo_cultivable]','Cultivable')}}
            <div class="input-group">
                {{Form::text($instancia.'[suelo_cultivable]', $consultaMani->suelo_cultivable, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-suelo_cultivable',
                    'maxlength'=>'5',
                    'size'=>'6',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">%</span>
            </div>
        </div>
    </div>
</div>