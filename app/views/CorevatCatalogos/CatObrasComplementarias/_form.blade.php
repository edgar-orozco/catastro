<div class="form-group">
	{{Form::label('obra_complementaria','Descripción')}}
	{{Form::text('obra_complementaria', $row->obra_complementaria, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatObrasComplementarias.obra_complementaria', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('obra_complementaria', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_obra_complementaria', 'Estatus')}}
	{{ Form::checkbox('status_obra_complementaria', 1,  $row->status_obra_complementaria) }}
</div>
