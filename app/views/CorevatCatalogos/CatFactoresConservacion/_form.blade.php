<div class="form-group">
	{{Form::label('abr_factor_conservacion','Abreviatura')}}
	{{Form::text('abr_factor_conservacion', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresConservacion.abr_factor_conservacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'10'] )}}
	{{$errors->first('abr_factor_conservacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('factor_conservacion','Descripción')}}
	{{Form::text('factor_conservacion', null, ['tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresConservacion.factor_conservacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'20'] )}}
	{{$errors->first('factor_conservacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('valor_factor_conservacion', 'Valor')}}
	{{Form::number('valor_factor_conservacion', $row->valor_factor_conservacion, ['tabindex'=>'3','step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'CatFactoresConservacion.valor_factor_conservacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'maxlength'=>'13'] )}}
	{{$errors->first('valor_factor_conservacion', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_conservacion', 'Estatus')}}
	{{ Form::checkbox('status_factor_conservacion', 1,  $row->status_factor_conservacion) }}
</div>
