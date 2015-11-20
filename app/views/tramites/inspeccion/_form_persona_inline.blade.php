<div class="persona">
    <div class="form-inline">
        <div class="form-group">
            {{Form::label('tipo_persona','Tipo de persona:',[])}}
            {{Form::label($instancia.'PersonaFisica','Física')}}

            {{Form::radio($instancia.'[id_tipo]', '1', null, ['class'=>$instancia.'-radio-persona-1 radio-persona', 'id'=>$instancia.'PersonaFisica', 'data-instancia'=>$instancia]) }}
            {{Form::label($instancia.'PersonaMoral','Moral')}}
            {{Form::radio($instancia.'[id_tipo]', '2', null, ['class'=>$instancia.'-radio-persona-2 radio-persona',  'id'=>$instancia.'PersonaMoral', 'data-instancia'=>$instancia]) }}

            {{Form::text($instancia.'[curp]', null, [
                'class' => "form-control $instancia-campos-fisica",
                'id'=>$instancia.'-curp',
                'placeholder'=>'CURP',
                'minlength'=>'18',
                'maxlength'=>'18',
                'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z]{6})([0-9]{2})',
                'title' => 'El CURP ingresado no tiene el formato esperado, verifique nuevamente el CURP ingresado',
                'data-instancia'=>$instancia
                ]
            )}}

            {{Form::text($instancia.'[rfc]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-rfc',
                'placeholder'=>'RFC',
                'minlength'=> '12',
                'maxlength'=> '13',
                'pattern' => '([A-Za-z]{4})([0-9]{6})([A-Za-z0-9]{3})',
                'title' => 'El RFC ingresado no tiene el formato esperado, verifique nuevamente el RFC ingresado',
                'data-instancia'=>$instancia
                ]
            )}}

            {{Form::text($instancia.'[nombres]', null, [
                'class' => 'form-control',
                'id'=>$instancia.'-nombres',
                'maxlength'=>'120',
                'size'=>'25',
                'placeholder'=>'NOMBRE',
                'required'=>true,
                'data-instancia'=>$instancia
                ]
            )}}

            <span class="{{$instancia}}-campos-fisica">
                {{Form::text($instancia.'[apellido_paterno]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-apellido_paterno',
                    'maxlength'=>'120',
                    'size'=>'25',
                    'placeholder'=>'APELLIDO PATERNO',
                    'required'=> true,
                    'data-instancia'=>$instancia
                    ]
                )}}
                {{Form::text($instancia.'[apellido_materno]', null, [
                    'class' => 'form-control',
                    'id'=>$instancia.'-apellido_materno',
                    'maxlength'=>'120',
                    'size'=>'25',
                    'placeholder'=>'APELLIDO MATERNO',
                    'data-instancia'=>$instancia
                    ]
                )}}
            </span>
        </div>
    </div>
</div>

