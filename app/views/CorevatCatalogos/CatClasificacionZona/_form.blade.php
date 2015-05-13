<div class="form-group">
	{{Form::label('clasificacion_zona','Descripción')}}
	{{Form::text('clasificacion_zona', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatClasificacionZona.clasificacion_zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('clasificacion_zona', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_clasificacion_zona', 'Estatus')}}
	{{ Form::checkbox('status_clasificacion_zona', 1,  $row->status_clasificacion_zona) }}
</div>
