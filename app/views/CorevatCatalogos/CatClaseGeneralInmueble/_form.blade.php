<div class="form-group">
	{{Form::label('clase_general_inmueble','Descripción')}}
	{{Form::text('clase_general_inmueble', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatClaseGeneralInmueble.clase_general_inmueble', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('clase_general_inmueble', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_clase_general_inmueble', 'Estatus')}}
	{{ Form::checkbox('status_clase_general_inmueble', 1,  $row->status_clase_general_inmueble) }}
</div>
