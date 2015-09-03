
<div class="col-md-6">

    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-2">
                {{Form::label('manifestacion[municipio]','Municipio')}}
            </div>
            <div class="col-sm-10">
                {{Form::select('manifestacion[municipio]', [null => '']+$listaMunicipios, null, ['class'=>'form-control select2'] )}}
                {{$errors->first('traslado[lugar]', '<span class=text-danger>:message</span>')}}
            </div>
        </div>
    </div>
    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-2">
                {{Form::label('manifestacion[fecha]','Fecha')}}
            </div>
            <div class="col-sm-10">
                {{Form::text('manifestacion[fecha]', date('d/m/Y'), ['class'=>'form-control', 'disabled'=>true, 'size'=>10, 'maxlength'=>10,'required'=>true])}}
            </div>
        </div>
    </div>
    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-2">
                {{Form::label('manifestacion[movimiento]','Movimiento')}}
            </div>
            <div class="col-sm-10">
                {{Form::textarea('manifestacion[movimiento]', null, ['class'=>'form-control', 'maxlength'=>'250', 'required'=>true, 'cols'=>40, 'rows'=>3] )}}
                {{$errors->first('manifestacion[movimiento]', '<span class=text-danger>:message</span>')}}
            </div>
        </div>
    </div>

    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-2">
                {{Form::label('manifestacion[tipo_propietario]','Tipo propietario')}}
            </div>
            <div class="col-sm-10">
                {{Form::select('manifestacion[tipo_propietario]', [null => '']+$listaTiposPropietario, null, ['class'=>'form-control select2'] )}}
                {{$errors->first('manifestacion[tipo_propietario]', '<span class=text-danger>:message</span>')}}
            </div>
        </div>
    </div>

</div>

<div class="col-md-6">

    <div class="form-horizontal">

        <div class="form-group">
            <div class="col-sm-3">
                {{Form::label('manifestacion[cuenta_predio]','Cuenta')}}
            </div>
            <div class="col-sm-3">
                {{Form::text('manifestacion[cuenta_predio]', null, ['class'=>'form-control cuenta-predio', 'placeholder' => '000000', 'maxlength'=>6, 'size'=>6, 'required'=>true ] )}}
                {{$errors->first('manifestacion[cuenta_predio]', '<span class=text-danger>:message</span>')}}
            </div>
        </div>
    </div>

    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-3">
                {{Form::label('manifestacion[clave_zona]','Clave Catastral')}}
            </div>
            <div class="col-sm-2">
                {{Form::text('manifestacion[clave_zona]', null, ['class'=>'form-control clave-zona', 'placeholder' => '000', 'maxlength'=>3, 'size'=>3, 'required'=>true] )}}
                {{$errors->first('manifestacion[clave]', '<span class=text-danger>:message</span>')}}
            </div>
            <div class="col-sm-2">
                {{Form::text('manifestacion[clave_manzana]', null, ['class'=>'form-control clave-manzana', 'placeholder' => '0000', 'maxlength'=>4, 'size'=>4, 'required'=>true] )}}
                {{$errors->first('manifestacion[manzana]', '<span class=text-danger>:message</span>')}}
            </div>
            <div class="col-sm-3">
                {{Form::text('manifestacion[clave_predio]', null, ['class'=>'form-control clave-predio', 'placeholder' => '000000', 'maxlength'=>6, 'size'=>7, 'required'=>true] )}}
                {{$errors->first('manifestacion[manzana]', '<span class=text-danger>:message</span>')}}
            </div>

        </div>
    </div>

    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-3">
                {{Form::label('manifestacion[cuenta_afectada]','Cuenta Afectada')}}
            </div>
            <div class="col-sm-3">
                {{Form::text('manifestacion[cuenta_afectada]', null, ['class'=>'form-control cuenta-afectada', 'placeholder' => '000000-R/U', 'maxlength'=>8, 'size'=>8, 'required'=>true ] )}}
                {{$errors->first('manifestacion[cuenta_afectada]', '<span class=text-danger>:message</span>')}}
            </div>
        </div>
    </div>

    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-3">
                {{Form::label('manifestacion[memo_num]','Memo núm.')}}
            </div>
            <div class="col-sm-3">
                {{Form::text('manifestacion[memo_num]', null, ['class'=>'form-control memo-num', 'maxlength'=>30, 'size'=>8, 'required'=>true ] )}}
                {{$errors->first('manifestacion[memo_num]', '<span class=text-danger>:message</span>')}}
            </div>
        </div>
    </div>

    <div class="form-horizontal">
        <div class="form-group">
            <div class="col-sm-3">
                {{Form::label('manifestacion[tipo_predio]','Tipo predio')}}
            </div>
            <div class="col-sm-2">
                {{Form::text('manifestacion[tipo_predio]', null, ['class'=>'form-control tipo-predio', 'placeholder'=>'R/U', 'maxlength'=>1, 'size'=>1, 'required'=>true ] )}}
                {{$errors->first('manifestacion[tipo_predio]', '<span class=text-danger>:message</span>')}}
            </div>
        </div>
    </div>

</div>


