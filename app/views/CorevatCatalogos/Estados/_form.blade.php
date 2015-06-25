<div class="form-group">
	{{Form::label('estado','Estado')}}
	{{Form::text('estado', $row->estado, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'estado.estado', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('estado', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('clave','Clave')}}
	{{Form::text('clave', $row->clave, ['tabindex'=>'2','class'=>'form-control', 'ng-model' => 'estado.clave', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('clave', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status', 'Estatus')}}
	{{ Form::checkbox('status', 1,  $row->status) }}
</div>
