<div class="form-group">
	{{Form::label('regimen_propiedad','Descripción')}}
	{{Form::text('regimen_propiedad', $row->regimen_propiedad, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatRegimenPropiedad.regimen_propiedad', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'50'] )}}
	{{$errors->first('regimen_propiedad', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_regimen_propiedad', 'Estatus')}}
	{{ Form::checkbox('status_regimen_propiedad', 1,  $row->status_regimen_propiedad) }}
</div>
