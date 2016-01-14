<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="col-md-3">
            {{Form::label('propietario','Propietario')}}<br>
            {{$predio->Propietario->propietario->nombres}} 
            {{$predio->Propietario->propietario->apellido_paterno}}
            {{$predio->Propietario->propietario->apellido_materno}}
            {{$errors->first('propietario', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-3">
            {{Form::label('tipoPropietario','Tipo Propietario')}}<br>
            <?php
                if($predio->Propietario->propietario->id_tipo == 1){
                    echo "FÍSICA";
                }
                if($predio->Propietario->propietario->id_tipo == 2){
                    echo "MORAL";
                }
            ?>
            {{$errors->first('tipoPropietario', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-3">
            {{Form::label('rfc_curp','RFC')}}<br>
            {{$predio->Propietario->propietario->rfc}}
            {{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-md-3">
            {{Form::label('rfc_curp','CURP')}}<br>
            {{$predio->Propietario->propietario->curp}}
            {{$errors->first('curp', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-3">
            {{Form::label('colonia','Colonia o Fraccionamiento')}}<br>
            {{$predio->Propietario->domicilio->vialidad}}
            {{$errors->first('colonia', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-3">
            {{Form::label('vialidad','vialidad')}}<br>
            {{$predio->Propietario->domicilio->vialidad}}
            {{$errors->first('cp', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-3">
            {{Form::label('cp','Codigo Postal')}}<br>
            {{$predio->Propietario->domicilio->cp}}
            {{$errors->first('cp', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-3">
            {{Form::label('poblacion','Población')}}<br>
            {{$predio->Propietario->domicilio->localidad}}
            {{$errors->first('poblacion', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-12">
            {{Form::label('agrupacion','Agrupación')}}
            {{Form::text('agrupacion', null, ['placeholder'=>'Agrupación','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('agrupacion', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-12">
            {{Form::label('nomenclatura','Nomenclatura')}}
            {{Form::textarea ('nomenclatura', null, ['placeholder'=>'Nomenclatura','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('nomenclatura', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>