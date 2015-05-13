<div class="form-group">
	{{Form::label('minimo','Mínimo')}}
	{{Form::number('minimo', $row->minimo, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'1', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','maxlength'=>'13'] )}}
	{{$errors->first('minimo', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('maximo','Máximo')}}
	{{Form::number('maximo', $row->maximo, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'maxlength'=>'13'] )}}
	{{$errors->first('maximo', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('resultante','Resultante')}}
	{{Form::number('resultante', $row->resultante, ['step'=>'0.01', 'min'=>'0.00', 'max'=>'9999999.99', 'tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'maxlength'=>'13'] )}}
	{{$errors->first('resultante', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('status_factor_superficie', 'Estatus')}}
	{{ Form::checkbox('status_factor_superficie', 1,  $row->status_factor_superficie) }}
</div>
