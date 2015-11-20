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

            {{Form::label($instancia.'[uso_predio_id]','Uso del predio')}}
            {{Form::select($instancia.'[uso_predio_id]', [null => '']+$usoPredio, null, ['class'=>'form-control select2 select-manifestacion-uso_predio_id'] )}}

            {{Form::label($instancia.'_servicios[]','Tipo de Predio')}}
            {{Form::select($instancia.'_servicios[]', [null => '']+$tipoPredio, null, ['class'=>'form-control select2 select-manifestacion-servicios_id'] )}}


        </div>
    </div>

    <div class="form-inline">
        <div class="form-group">
            {{Form::label($instancia.'[valor_calle]','Valor de Calle')}}
                {{Form::text($instancia.'[valor_calle]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-valor_calle',
                    'maxlength'=>'12',
                    'size'=>'14',
                    'placeholder'=>'VAL. CALLE',
                    'required'=>true,
                    'data-instancia'=>$instancia
                    ]
                )}}

            {{Form::label($instancia.'[sube_foto]','Foto de Fachada')}}
            <div class="input-group">
                {{Form::text($instancia.'[sube_foto]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-sube_foto',
                    'maxlength'=>'12',
                    'size'=>'14',
                    'placeholder'=>'Archivo foto',
                    'required'=>true,
                    'data-instancia'=>$instancia
                    ]
                )}}
                <span class="input-group-addon">Buscar...</span>
            </div>

        </div>
    </div>

</div>