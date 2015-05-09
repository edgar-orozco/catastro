<div class="form-group">
	{{Form::label('factor_ubicacion','Descripción')}}
	{{Form::text('factor_ubicacion', $row->factor_ubicacion, ['tabindex'=>'1', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresUbicacion.factor_ubicacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'20'] )}}
	{{$errors->first('factor_ubicacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('valor_factor_ubicacion', 'Valor')}}
	{{Form::number('valor_factor_ubicacion', $row->valor_factor_ubicacion, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'2', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresUbicacion.valor_factor_ubicacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'maxlength'=>'13'] )}}
	{{$errors->first('valor_factor_ubicacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_ubicacion', 'Estatus')}}
	{{Form::checkbox('status_factor_ubicacion', 1,  $row->status_factor_ubicacion) }}
</div>
