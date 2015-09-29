<div class="domicilio">
    <div class="form-inline">
        <div class="form-group">
            {{Form::label($instancia.'[tipo_vialidad_id]','Tipo de vialidad: ')}}
            {{Form::select($instancia.'[tipo_vialidad_id]', [null => '']+$vialidades, !($manifestacion) ?: 5, ['class'=>'form-control select2 select-'.$instancia.'-tipo_vialidad_id'] )}}
            {{$errors->first($instancia.'[tipo_vialidad_id]', '<span class=text-danger>:message</span>')}}

            {{Form::text($instancia.'[vialidad]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-vialidad',
                'maxlength'=>'120',
                'size'=>'25',
                'placeholder'=>'VIALIDAD',
                'required'=>true,
                'data-instancia'=>$instancia
                ]
            )}}

            {{Form::text($instancia.'[num_ext]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-num_ext',
                'maxlength'=>'60',
                'size'=>'15',
                'placeholder'=>'NUM. EXT.',
                'required'=>true,
                'data-instancia'=>$instancia
                ]
            )}}

            {{Form::text($instancia.'[num_int]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-num_int',
                'maxlength'=>'60',
                'size'=>'15',
                'placeholder'=>'NUM. INT.',
                'data-instancia'=>$instancia
                ]
            )}}

            {{Form::label($instancia.'[tipo_asentamiento_id]','Tipo de asentamiento')}}
            {{Form::select($instancia.'[tipo_asentamiento_id]', [null => '']+$asentamientos, !($manifestacion) ?: 7, ['class'=>'form-control select2 select-'.$instancia.'-tipo_asentamiento_id'] )}}
            {{$errors->first($instancia.'[tipo_asentamiento_id]', '<span class=text-danger>:message</span>')}}

            {{Form::text($instancia.'[asentamiento]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-asentamiento',
                'maxlength'=>'120',
                'size'=>'25',
                'placeholder'=>'ASENTAMIENTO',
                'required'=>true,
                'data-instancia'=>$instancia
                ]
            )}}
        </div>
    </div>

    <div class="form-inline">
        <div class="form-group">
            {{Form::label($instancia.'[entidad]','Entidad: ')}}
            {{Form::select($instancia.'[entidad]', [null => '']+$entidades, !($manifestacion) ?: 27, ['class'=>'form-control select2 select-'.$instancia.'-entidad'] )}}
            {{$errors->first($instancia.'[entidad]', '<span class=text-danger>:message</span>')}}

            {{Form::label($instancia.'[municipio]','Municipio: ')}}
            {{Form::select($instancia.'[municipio]', [null => '']+$municipios, null, ['class'=>'form-control select2 select-'.$instancia.'-municipio'] )}}
            {{$errors->first($instancia.'[municipio]', '<span class=text-danger>:message</span>')}}

            {{Form::text($instancia.'[cp]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-cp',
                'maxlength'=>'5',
                'size'=>'7',
                'placeholder'=>'CP',
                'required'=>true,
                'data-instancia'=>$instancia
                ]
            )}}

            {{Form::text($instancia.'[localidad]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-localidad',
                'maxlength'=>'120',
                'size'=>'25',
                'placeholder'=>'LOCALIDAD',
                'data-instancia'=>$instancia
                ]
            )}}

        </div>
    </div>

</div>


