<div class="form-group">
	{{Form::label('nivel','Descripción')}}
	{{Form::text('nivel', $row->nivel, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatNiveles.nivel', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('nivel', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_nivel', 'Estatus')}}
	{{ Form::checkbox('status_nivel', 1,  $row->status_nivel) }}
</div>
