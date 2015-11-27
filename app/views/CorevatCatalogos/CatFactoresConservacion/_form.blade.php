<div class="form-group">
	{{Form::label('abr_factor_conservacion','Abreviatura')}}
	{{Form::text('abr_factor_conservacion', null, ['tabindex'=>'1','class'=>'form-control', 'required' => 'required','maxlength'=>'10'] )}}
	{{$errors->first('abr_factor_conservacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('factor_conservacion','Descripción')}}
	{{Form::text('factor_conservacion', null, ['tabindex'=>'2','class'=>'form-control', 'required' => 'required','maxlength'=>'50'] )}}
	{{$errors->first('factor_conservacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	
	{{Form::label('valor_factor_conservacion', 'Valor')}}
	{{Form::number('valor_factor_conservacion', number_format($row->valor_factor_conservacion, 4, '.', ''), ['tabindex'=>'3', 'required' => 'required', 'class'=>'form-control clsNumeric', 'step'=>'0.0001', 'min'=>'0.0000', 'max'=>'1.0000'] )}}
	{{$errors->first('valor_factor_conservacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_conservacion', 'Estatus')}}
	{{ Form::checkbox('status_factor_conservacion', 1,  $row->status_factor_conservacion) }}
</div>
