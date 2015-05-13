<div class="form-group">
	{{Form::label('proximidad_urbana','Descripción')}}
	{{Form::text('proximidad_urbana', $row->proximidad_urbana, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatProximidadUrbana.proximidad_urbana', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('proximidad_urbana', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_proximidad_urbana', 'Estatus')}}
	{{ Form::checkbox('status_proximidad_urbana', 1,  $row->status_proximidad_urbana) }}
</div>
