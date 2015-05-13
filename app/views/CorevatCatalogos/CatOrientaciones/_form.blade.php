<div class="form-group">
	{{Form::label('orientacion','Descripción')}}
	{{Form::text('orientacion', $row->orientacion, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatOrientaciones.orientacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('orientacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_orientacion', 'Estatus')}}
	{{Form::checkbox('status_orientacion', 1,  $row->status_orientacion) }}
</div>
