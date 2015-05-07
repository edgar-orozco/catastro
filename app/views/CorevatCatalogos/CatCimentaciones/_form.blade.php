<div class="form-group">
	{{Form::label('cimentacion','Descripción')}}
	{{Form::text('cimentacion', null, ['Placeholder'=>'Descripción','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatCimentaciones.cimentacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('cimentacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_cimentacion', 'Estatus')}}
	{{ Form::checkbox('status_cimentacion', 1,  $row->status_cimentacion) }}
</div>
