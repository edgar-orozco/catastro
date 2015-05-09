<div class="form-group">
	{{Form::label('tipo_inmueble','Descripción')}}
	{{Form::text('tipo_inmueble', $row->tipo_inmueble, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatTipoInmueble.tipo_inmueble', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('tipo_inmueble', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_tipo_inmueble', 'Estatus')}}
	{{ Form::checkbox('status_tipo_inmueble', 1,  $row->status_tipo_inmueble) }}
</div>
