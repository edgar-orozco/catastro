<div class="form-group">
	{{Form::label('calidad_proyecto','Descripción')}}
	{{Form::text('calidad_proyecto', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatCalidadProyecto.calidad_proyecto', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('calidad_proyecto', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_calidad_proy', 'Estatus')}}
	{{ Form::checkbox('status_calidad_proy', 1,  $row->status_calidad_proy) }}
</div>
