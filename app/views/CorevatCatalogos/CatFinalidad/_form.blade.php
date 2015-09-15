<div class="form-group">
	{{Form::label('finalidad','Descripción')}}
	{{Form::text('finalidad', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFinalidad.finalidad', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)', 'maxlength'=>'100'] )}}
	{{$errors->first('finalidad', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status', 'Estatus')}}
	{{ Form::checkbox('status', 1,  $row->status) }}
</div>
