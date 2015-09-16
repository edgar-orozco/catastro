<div class="form-group">
	{{Form::label('titulo_persona','Descripción')}}
	{{Form::text('titulo_persona', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatTituloPersona.titulo_persona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)', 'maxlength'=>'100'] )}}
	{{$errors->first('titulo_persona', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status', 'Estatus')}}
	{{ Form::checkbox('status', 1,  $row->status) }}
</div>
