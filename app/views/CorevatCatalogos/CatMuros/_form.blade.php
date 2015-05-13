<div class="form-group">
	{{Form::label('muro','Descripción')}}
	{{Form::text('muro', $row->muro, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatMuros.muro', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('muro', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_muro', 'Estatus')}}
	{{Form::checkbox('status_muro', 1,  $row->status_muro) }}
</div>
