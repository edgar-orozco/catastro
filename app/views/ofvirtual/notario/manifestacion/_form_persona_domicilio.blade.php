<div class="form-inline">
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
