<div class="row">
    <div class="col-md-4">

        <div class="form-group">
            {{Form::label('sup_terreno','Superficie')}}
            {{Form::text('sup_terreno', null, ['class' => 'form-control'])}}
            {{$errors->first('sup_terreno', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="form-group">
            {{Form::label('dem_pct_rustico','Porcentaje de demérito')}}
            {{Form::text('dem_pct_rustico', null, ['class' => 'form-control dem_pct_rustico'])}}
            {{$errors->first('dem_pct_rustico', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="form-group">
            {{Form::label('usosuelo_id','Uso de suelo')}}
            {{Form::select('usosuelo_id', [null => '']+$usoSuelo, null, ['class'=>'form-control select2 select-usosuelo_id'] )}}
            {{$errors->first('usosuelo_id', '<span class=text-danger>:message</span>')}}
        </div>


    </div>

    <div class="col-md-6">
        <fieldset><legend>Incrementos por su ubicación con respecto a:</legend>

            <div class="form-group">
                {{Form::label('inc_vias_rustico','Vías de comunicación')}}
                {{Form::select('inc_vias_rustico', [null => '']+ $viasComunicacion, null, ['class'=>'form-control select2 select-inc_vias_rustico'] )}}
                {{$errors->first('inc_vias_rustico', '<span class=text-danger>:message</span>')}}
            </div>

            <div class="form-group">
                {{Form::label('inc_dist_cabmun','Cabecera municipal')}}
                {{Form::select('inc_dist_cabmun', [null => '']+ $distCabmun, null, ['class'=>'form-control select2 select-inc_dist_cabmun'] )}}
                {{$errors->first('inc_dist_cabmun', '<span class=text-danger>:message</span>')}}
            </div>
            <div class="form-group">
                {{Form::label('inc_dist_cenpob','Centros de población')}}
                {{Form::select('inc_dist_cenpob', [null => '']+ $distCenpob, null, ['class'=>'form-control select2 select-inc_dist_cenpob'] )}}
                {{$errors->first('inc_dist_cenpob', '<span class=text-danger>:message</span>')}}
            </div>

        </fieldset>

    </div>


</div>