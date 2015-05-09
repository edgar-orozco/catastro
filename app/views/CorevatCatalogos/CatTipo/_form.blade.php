<div class="form-group">
	{{Form::label('tipo','Descripción')}}
	{{Form::text('tipo', $row->tipo, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatTipo.tipo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('tipo', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_tipo', 'Estatus')}}
	{{ Form::checkbox('status_tipo', 1,  $row->status_tipo) }}
</div>
