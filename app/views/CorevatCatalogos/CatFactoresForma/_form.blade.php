<div class="form-group">
	{{Form::label('factor_forma','Descripción')}}
	{{Form::text('factor_forma', null, ['Placeholder'=>'Descripción', 'tabindex'=>'1', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresForma.factor_forma', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'20'] )}}
	{{$errors->first('factor_forma', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('valor_factor_forma', 'Valor')}}
	{{Form::number('valor_factor_forma', $row->valor_factor_forma, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'2', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresForma.valor_factor_forma', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'maxlength'=>'13'] )}}
	{{$errors->first('valor_factor_forma', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_forma', 'Estatus')}}
	{{ Form::checkbox('status_factor_forma', 1,  $row->status_factor_forma) }}
</div>
