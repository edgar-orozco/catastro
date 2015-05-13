<div class="form-group">
	{{Form::label('techo','Descripción')}}
	{{Form::text('techo', $row->techo, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatTechos.techo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('techo', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_techo', 'Estatus')}}
	{{ Form::checkbox('status_techo', 1,  $row->status_techo) }}
</div>
