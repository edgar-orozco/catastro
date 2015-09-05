<div class="datos-predio">
    <div class="form-inline">
        <div class="form-group">
            {{Form::label($instancia.'[sup_terreno]','Superficie del terreno')}}
            <div class="input-group">
                {{Form::text($instancia.'[sup_terreno]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-sup_terreno',
                    'maxlength'=>'12',
                    'size'=>'14',
                    'placeholder'=>'SUP. TERRENO',
                    'required'=>true,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>

            {{Form::label($instancia.'[sup_construccion]','Superficie de construcción')}}
            <div class="input-group">
                {{Form::text($instancia.'[sup_construccion]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-sup_construccion',
                    'maxlength'=>'12',
                    'size'=>'14',
                    'placeholder'=>'SUP. CONS.',
                    'required'=>true,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">m<sup>2</sup></span>
            </div>

            <span class="solo-rusticos">
                {{Form::label($instancia.'[vias_comunicacion_id]','Vías de comunicación')}}
                {{Form::select($instancia.'[vias_comunicacion_id]', [null => '']+$viasComunicacion, null, ['class'=>'form-control select2'] )}}
            </span>
        </div>
    </div>

    <div class="form-inline">
        <div class="form-group">
            <span class="solo-rusticos">

                {{Form::label($instancia.'[poblacion_proxima]','Población próxima')}}
                {{Form::text($instancia.'[poblacion_proxima]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-poblacion_proxima',
                    'maxlength'=>'120',
                    'size'=>'25',
                    'required'=>false,
                    'data-instancia'=>$instancia
                    ]
                )}}
                {{Form::label($instancia.'[distancia_poblacion]','Distancia')}}
                <div class="input-group">
                    {{Form::text($instancia.'[distancia_poblacion]', null, [
                        'class' => 'form-control',
                        'id'=>$instancia.'-distancia_poblacion',
                        'maxlength'=>'12',
                        'size'=>'13',
                        'required'=>false,
                        'data-instancia'=>$instancia
                        ]
                    )}}
                    <span class="input-group-addon">Km.</span>
                </div>
            </span>

            {{Form::label($instancia.'[tenencia_tierra_id]','Tenencia de la tierra')}}
            {{Form::select($instancia.'[tenencia_tierra_id]', [null => '']+$tenenciaTierra, null, ['class'=>'form-control select2'] )}}

            {{Form::label($instancia.'[uso_predio_id]','Uso del predio')}}
            {{Form::select($instancia.'[uso_predio_id]', [null => '']+$usoPredio, null, ['class'=>'form-control select2'] )}}

            {{Form::label($instancia.'_servicios[servicio_id][]','Servicios públicos')}}
            {{Form::select($instancia.'_servicios[servicio_id][]', $serviciosPublicos, null, ['class'=>'form-control select2-multiple', 'multiple'=>'multiple'] )}}

            <h4>Características del suelo</h4>
            {{Form::label($instancia.'[suelo_inundable]','Inundable')}}
            <div class="input-group">
                {{Form::text($instancia.'[suelo_inundable]', null, [
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
                {{Form::text($instancia.'[suelo_popal]', null, [
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
                {{Form::text($instancia.'[suelo_desnivel]', null, [
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
                {{Form::text($instancia.'[suelo_incultivable]', null, [
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
                {{Form::text($instancia.'[suelo_cultivable]', null, [
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