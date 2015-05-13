<div class="form-group">
	{{Form::label('piso','Descripción')}}
	{{Form::text('piso', $row->piso, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatPisos.piso', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('piso', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_piso', 'Estatus')}}
	{{Form::checkbox('status_piso', 1,  $row->status_piso) }}
</div>
