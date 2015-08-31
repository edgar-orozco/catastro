<div class="panel panel-default">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="col-xs-12">
            {{Form::label('propietario','Propietario')}}
            {{Form::text('propietario', null, ['placeholder'=>'Propietario','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('propietario', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-12">
            {{Form::label('tipoPropietario','Tipo Propietario')}}
            {{Form::text('tipoPropietario', null, ['placeholder'=>'Tipo Propietario','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('tipoPropietario', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-12">
            {{Form::label('rfc_curp','RFC/CURP')}}
            {{Form::text('rfc_curp', null, ['placeholder'=>'RFC/CURP','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('rfc_curp', '<span class=text-danger>:message</span>')}}
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
        <div class="col-xs-12">
            {{Form::label('fraccionamiento','Fraccionamiento')}}
            {{Form::text('fraccionamiento', null, ['placeholder'=>'Fraccionamiento','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('fraccionamiento', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-12">
            {{Form::label('colonia','Colonia')}}
            {{Form::text('colonia', null, ['placeholder'=>'Colonia','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('colonia', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-4">
            {{Form::label('cp','Codigo Postal')}}
            {{Form::text('cp', null, ['placeholder'=>'Codigo Postal','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('cp', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-4">
            {{Form::label('telefono','Telefono')}}
            {{Form::text('telefono', null, ['placeholder'=>'Telefono','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('telefono', '<span class=text-danger>:message</span>')}}
        </div>
        <div class="col-xs-4">
            {{Form::label('poblacion','Población')}}
            {{Form::text('poblacion', null, ['placeholder'=>'poblacion','tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
            {{$errors->first('poblacion', '<span class=text-danger>:message</span>')}}
        </div>
    </div>
</div>