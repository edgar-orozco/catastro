<div class="form-group">
	{{Form::label('entrepiso','Descripción')}}
	{{Form::text('entrepiso', null, ['Placeholder'=>'Descripción','tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatEntrepisos.entrepiso', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('entrepiso', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_entrepiso', 'Estatus')}}
	{{ Form::checkbox('status_entrepiso', 1,  $row->status_entrepiso) }}
</div>
