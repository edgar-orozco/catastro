<div class="form-group">
	{{Form::label('factor_zona','Descripción')}}
	{{Form::text('factor_zona', $row->factor_zona, ['tabindex'=>'1', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresZonas.factor_zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'20'] )}}
	{{$errors->first('factor_zona', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('valor_factor_zona', 'Valor')}}
	{{Form::number('valor_factor_zona', $row->valor_factor_zona, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'2', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresZonas.valor_factor_zona', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'maxlength'=>'13'] )}}
	{{$errors->first('valor_factor_zona', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_zona', 'Estatus')}}
	{{Form::checkbox('status_factor_zona', 1,  $row->status_factor_zona) }}
</div>
