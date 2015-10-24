<div class="form-group">
	{{Form::label('factor_frente','Descripción')}}
	{{Form::text('factor_frente', null, ['tabindex'=>'1','class'=>'form-control', 'required' => 'required','maxlength'=>'80'] )}}
	{{$errors->first('factor_frente', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('valor_minimo', 'Valor Mínimo')}}
	{{Form::number('valor_minimo', $row->valor_minimo, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'2', 'class'=>'form-control clsNumeric', 'required' => 'required', 'maxlength'=>'13'] )}}
	{{$errors->first('valor_minimo', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('valor_maximo', 'Valor Máximo')}}
	{{Form::number('valor_maximo', $row->valor_maximo, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'3', 'class'=>'form-control clsNumeric', 'required' => 'required', 'maxlength'=>'13'] )}}
	{{$errors->first('valor_maximo', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_frente', 'Estatus')}}
	{{ Form::checkbox('status_factor_frente', 1,  $row->status_factor_frente) }}
</div>
