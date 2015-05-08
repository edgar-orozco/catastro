<div class="form-group">
	{{Form::label('construccion','Descripción')}}
	{{Form::text('construccion', null, ['Placeholder'=>'Descripción','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatConstrucciones.construccion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('construccion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_construccion', 'Estatus')}}
	{{ Form::checkbox('status_construccion', 1,  $row->status_construccion) }}
</div>
