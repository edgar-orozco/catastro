<div class="form-group">
	{{Form::label('aplanado','Descripción')}}
	{{Form::text('aplanado', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatAplanados.aplanado', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)', 'maxlength'=>'100'] )}}
	{{$errors->first('aplanado', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status', 'Estatus')}}
	{{ Form::checkbox('status', 1,  $row->status) }}
</div>
@append
