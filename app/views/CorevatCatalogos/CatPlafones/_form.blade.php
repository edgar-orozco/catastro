<div class="form-group">
	{{Form::label('plafon','Descripción')}}
	{{Form::text('plafon', $row->plafon, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatPlafones.plafon', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('plafon', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_plafon', 'Estatus')}}
	{{ Form::checkbox('status_plafon', 1,  $row->status_plafon) }}
</div>
