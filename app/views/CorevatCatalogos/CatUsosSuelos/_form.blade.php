<div class="form-group">
	{{Form::label('usos_suelos','Descripción')}}
	{{Form::text('usos_suelos', $row->usos_suelos, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatUsosSuelos.usos_suelos', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('usos_suelos', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_usos_suelos', 'Estatus')}}
	{{ Form::checkbox('status_usos_suelos', 1,  $row->status_usos_suelos) }}
</div>
