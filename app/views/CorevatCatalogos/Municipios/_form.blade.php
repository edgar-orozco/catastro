<div class="form-group">
	{{Form::label('idestado', 'Estado')}}
	{{Form::select('idestado', $lstEstados, $row->idestado, ['id' => 'idestado', 'class'=>'form-control', 'tabindex'=>'0'])}}
</div>

<div class="form-group">
	{{Form::label('municipio','Municipios')}}
	{{Form::text('municipio', $row->municipio, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'municipio.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('clave','Clave')}}
	{{Form::text('clave', $row->clave, ['tabindex'=>'2','class'=>'form-control', 'ng-model' => 'municipio.clave', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('clave', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status', 'Estatus')}}
	{{ Form::checkbox('status', 1,  $row->status) }}
</div>
