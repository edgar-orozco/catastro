
<div class="form-horizontal">
    <div class="form-inline">
            {{Form::label('manifestacion[tipo_escritura_id]','Tipo de escritura')}}
            {{Form::select('manifestacion[tipo_escritura_id]', [null => '']+$listaTiposEscritura, null, ['class'=>'form-control select2 select-manifestacion-tipo-escritura'] )}}
            {{$errors->first('manifestacion[tipo_escritura_id]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[notaria_id]','Notario')}}
        {{Form::select('manifestacion[notaria_id]', [null => '']+$listaNotarias, null, ['class'=>'form-control select2 select-manifestacion-notaria_id'] )}}
        {{$errors->first('manifestacion[notaria_id]', '<span class=text-danger>:message</span>')}}

        {{Form::label('manifestacion[num_registro]','No. Reg.')}}
        {{Form::text('manifestacion[num_registro]', null, ['class'=>'form-control'] )}}
        {{$errors->first('manifestacion[num_registro]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[num_titulo]','No. Título.')}}
        {{Form::text('manifestacion[num_titulo]', null, ['class'=>'form-control'] )}}
        {{$errors->first('manifestacion[num_titulo]', '<span class=text-danger>:message</span>')}}

        {{Form::label('manifestacion[num_predio]','No. Pred.')}}
        {{Form::text('manifestacion[num_predio]', null, ['class'=>'form-control'] )}}
        {{$errors->first('manifestacion[num_predio]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[fecha_titulo]','Fecha Título')}}
        {{Form::text('manifestacion[fecha_titulo]', null, ['class'=>'form-control fecha'] )}}
        {{$errors->first('manifestacion[fecha_titulo]', '<span class=text-danger>:message</span>')}}

        {{Form::label('manifestacion[num_folio]','No. Folio')}}
        {{Form::text('manifestacion[num_folio]', null, ['class'=>'form-control'] )}}
        {{$errors->first('manifestacion[num_folio]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[fecha_escritura]','Fecha Escritura')}}
        {{Form::text('manifestacion[fecha_escritura]', null, ['class'=>'form-control fecha'] )}}
        {{$errors->first('manifestacion[fecha_escritura]', '<span class=text-danger>:message</span>')}}

        {{Form::label('manifestacion[volumen]','Volumen')}}
        {{Form::text('manifestacion[volumen]', null, ['class'=>'form-control'] )}}
        {{$errors->first('manifestacion[volumen]', '<span class=text-danger>:message</span>')}}
    </div>
</div>

<div class="form-inline">
    <div class="form-group">
        {{Form::label('manifestacion[reg_municipio]','Municipio')}}
        {{Form::select('manifestacion[reg_municipio]', [null => '']+$listaMunicipios, null, ['class'=>'form-control select2 select-manifestacion-reg-municipio'] )}}
        {{$errors->first('manifestacion[reg_municipio]', '<span class=text-danger>:message</span>')}}

        {{Form::label('manifestacion[folio_real]','Volumen')}}
        {{Form::text('manifestacion[folio_real]', null, ['class'=>'form-control'] )}}
        {{$errors->first('manifestacion[folio_real]', '<span class=text-danger>:message</span>')}}
    </div>
</div>
