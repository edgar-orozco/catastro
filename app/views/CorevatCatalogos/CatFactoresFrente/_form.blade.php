<div class="form-group">
	{{Form::label('factor_frente','Descripción')}}
	{{Form::text('factor_frente', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresFrente.factor_frente', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'20'] )}}
	{{$errors->first('factor_frente', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('valor_factor_frente','Valor')}}
	{{Form::number('valor_factor_frente', $row->valor_factor_frente, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'2', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresFrente.valor_factor_frente', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'maxlength'=>'13'] )}}
	{{$errors->first('valor_factor_frente', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_frente', 'Estatus')}}
	{{ Form::checkbox('status_factor_frente', 1,  $row->status_factor_frente) }}
</div>
