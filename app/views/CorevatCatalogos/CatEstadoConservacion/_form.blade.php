<div class="form-group">
	{{Form::label('estado_conservacion','Descripción')}}
	{{Form::text('estado_conservacion', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatEstadoConservacion.estado_conservacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('estado_conservacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_estado_conservacion', 'Estatus')}}
	{{ Form::checkbox('status_estado_conservacion', 1,  $row->status_estado_conservacion) }}
</div>
