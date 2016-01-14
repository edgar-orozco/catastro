<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="col-md-4">
            {{Form::label('tramite_id','Tipo de Predio')}}<br>
            <?php 
                if($predio->tipo_predio == "U"){
                    echo "URBANO";
                }
                if($predio->tipo_predio == "R"){
                    echo "RÚSTICO";
                }
            ?>
            {{$errors->first('tramite_id', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="col-md-4">
            {{Form::label('cuenta','Cuenta')}}<br>
            {{$valuacion->cuenta}}
            {{$errors->first('Cuenta', '<span class=text-danger>:message</span>')}}
        </div>

        <div class="col-md-4">
            {{Form::label('clave','Clave Catastral')}}<br>
            {{$valuacion->clave}}
            {{$errors->first('clave', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="col-xs-12">
            {{Form::label('movimiento','Ultimo Movimiento')}}
            {{Form::text('movimiento', null, ['placeholder'=>'Ultimo Movimiento','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('movimiento', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('memorandum','Memorándum')}}
            {{Form::text('memorandum', null, ['placeholder'=>'Memorándum','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('memorandum', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('fecha','Fecha Tramite')}}
            {{Form::text('fecha', null, ['placeholder'=>'Fecha Tramite','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('fecha', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('folio','Folio Tramite')}}
            {{Form::text('folio', null, ['placeholder'=>'Folio Tramite','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('folio', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="col-md-12">
            {{Form::label('calle','Calle')}}
            {{Form::text('calle', null, ['placeholder'=>'Calle','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$predio -> notaria}}            
            {{$errors->first('calle', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-12">
            {{Form::label('agurpacion','Agrupación')}}
            {{Form::text('agurpacion', null, ['placeholder'=>'Agrupacón','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('agurpacion', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-12">
            {{Form::label('nomenclatura','Nomenclatura')}}
            {{Form::text('nomenclatura', null, ['placeholder'=>'Nomenclatura','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('nomenclatura', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-12">
            {{Form::label('fraccionamiento','Fraccionamiento')}}
            {{Form::text('fraccionamiento', null, ['placeholder'=>'Fraccionamiento','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('fraccionamiento', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-12">
            {{Form::label('colonia','Colonia')}}
            {{Form::text('colonia', null, ['placeholder'=>'Colonia','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('colonia', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-6">
            {{Form::label('cp','Codigo Postal')}}
            {{Form::text('cp', null, ['placeholder'=>'Codigo Postal','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('cp', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-6">
            {{Form::label('poblacion','Población')}}
            {{Form::text('poblacion', null, ['placeholder'=>'Población','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('poblacion', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="col-md-4">
            {{Form::label('superficie','Superficie')}}<br>
            {{$predio->sup_terreno}} m<sup>2</sup>
            {{$errors->first('superficie', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-8">
            {{Form::label('poblacion','Uso del Predio')}}<br>
            <?php 
                if($valuacion->ValuacionTerreno->usosuelo_id == 1) {
                    echo "SIN CONSTRUCCIÓN (BALDÍOS)";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 2) {
                    echo "RESTAURANTES";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 3) {
                    echo "ESTACIONAMIENTO";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 4) {
                    echo "CINES";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 5) {
                    echo "CLUBES";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 6) {
                    echo "PASTIZALES";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 7) {
                    echo "DEPARTAMENTO EN CONDOMINIO";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 8) {
                    echo "OFICINAS DE SERVICIOS";
                }
                if($valuacion->ValuacionTerreno->usosuelo_id == 9) {
                    echo "CASA HABITACIÓN";
                }
            ?>
            {{$errors->first('poblacion', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-4">
            {{Form::label('valor','Valor de Calle')}}<br>
            {{$valuacion->ValuacionTerreno->valor_calle}}
            {{$errors->first('valor', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-8">
            {{Form::label('predio','Informacion del Predio')}}
            {{Form::text('predio', null, ['placeholder'=>'Informacion del Predio','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('predio', '<span class=text-danger>:message</span>')}}
        </div>
         <div class="col-md-12">
            {{Form::label('notas','Notas')}}
            {{Form::text('notas', null, ['placeholder'=>'Notas','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('notas', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>