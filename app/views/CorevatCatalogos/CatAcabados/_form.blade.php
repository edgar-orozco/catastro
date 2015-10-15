<div class="form-group">
	{{Form::label('nombre','Descripción')}}
	{{Form::text('nombre', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatAcabados.nombre', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)', 'maxlength'=>'100'] )}}
	{{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('estatus', 'Estatus')}}
	{{ Form::checkbox('estatus', 1,  $row->estatus) }}
</div>

