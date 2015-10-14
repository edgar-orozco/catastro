<div class="row">
    <div class="col-md-3">

        <div class="form-group">
            {{Form::label('sup_terreno','Superficie')}}
            {{Form::text('sup_terreno', $superficie_terreno, ['class' => 'form-control'])}}
            {{$errors->first('sup_terreno', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group">
            {{Form::label('valor_calle','Valor de calle')}}
            {{Form::text('valor_calle', null, ['class' => 'form-control'])}}
            {{$errors->first('valor_calle', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group">
            {{Form::label('usosuelo_id','Uso de suelo')}}
            {{Form::select('usosuelo_id', [null => '']+$usoSuelo, null, ['class'=>'form-control select2 select-usosuelo_id'] )}}
            {{$errors->first('usosuelo_id', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="form-group">
            {{Form::label('inc_esquina_id','Incrementos por esquina')}}
            {{Form::select('inc_esquina_id', [null => '']+$incEsquina, null, ['class'=>'form-control select2 select-inc_esquina_id'] )}}
            {{$errors->first('inc_esquina_id', '<span class=text-danger>:message</span>')}}
        </div>
        
    </div>

    <div class="col-md-3">
        <fieldset><legend>Demérito por escaso frente</legend>
            <div class="form-group">
                {{Form::label('dem_frente','Frente')}}
                {{Form::text('dem_frente', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_frente', '<span class=text-danger>:message</span>')}}
            </div>
        </fieldset>
        <fieldset><legend>Demérito por profundidad</legend>
            <div class="form-group">
                {{Form::label('dem_prof_frente','Frente')}}
                {{Form::text('dem_prof_frente', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_prof_frente', '<span class=text-danger>:message</span>')}}
            </div>
            <div class="form-group">
                {{Form::label('dem_prof_prof','Profundidad')}}
                {{Form::text('dem_prof_prof', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_prof_prof', '<span class=text-danger>:message</span>')}}
            </div>
        </fieldset>
    </div>

    <div class="col-md-3">
        <fieldset><legend>Demérito por irregularidad</legend>
            <div class="form-group">
                {{Form::label('dem_irregular','Area regular')}}
                {{Form::text('dem_irregular', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_irregular', '<span class=text-danger>:message</span>')}}
            </div>
        </fieldset>
        <fieldset><legend>Demérito por excavaciones</legend>
            <div class="form-group">
                {{Form::label('dem_sup_excavada','Superficie excavada')}}
                {{Form::text('dem_sup_excavada', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_sup_excavada', '<span class=text-danger>:message</span>')}}
            </div>
            <div class="form-group">
                {{Form::label('dem_prof_excavada','Profundidad excavada')}}
                {{Form::text('dem_prof_excavada', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_prof_excavada', '<span class=text-danger>:message</span>')}}
            </div>
        </fieldset>
    </div>

    <div class="col-md-3">
        <fieldset><legend>Demérito por desnivel</legend>
            <div class="form-group">
                {{Form::label('dem_desnivel_area','Area afectada')}}
                {{Form::text('dem_desnivel_area', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_desnivel_area', '<span class=text-danger>:message</span>')}}
            </div>
            <div class="form-group">
                {{Form::label('dem_desnivel_pct','% de la pendiente')}}
                {{Form::text('dem_desnivel_pct', null, ['class' => 'form-control'])}}
                {{$errors->first('dem_desnivel_pct', '<span class=text-danger>:message</span>')}}
            </div>
        </fieldset>
        <fieldset><legend>Predio interior</legend>
            <div class="form-group">
                {{Form::label('sup_paso_servidumbre','Sup. del paso servidumbre')}}
                {{Form::text('sup_paso_servidumbre', null, ['class' => 'form-control'])}}
                {{$errors->first('sup_paso_servidumbre', '<span class=text-danger>:message</span>')}}
            </div>
            
        </fieldset>
    </div>

</div>