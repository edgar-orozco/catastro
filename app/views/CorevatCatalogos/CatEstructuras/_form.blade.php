<div class="form-group">
	{{Form::label('estructura','Descripción')}}
	{{Form::text('estructura', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatEstructuras.estructura', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('estructura', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_estructura', 'Estatus')}}
	{{Form::checkbox('status_estructura', 1,  $row->status_estructura) }}
</div>
