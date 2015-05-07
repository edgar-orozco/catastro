<div class="form-group">
	{{Form::label('rs','Razón Social')}}
	{{Form::text('rs', null, ['tabindex'=>'1','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'empresa.rs', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'150'] )}}
	{{$errors->first('rs', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('ncomer','Nombre')}}
	{{Form::text('ncomer', null, ['tabindex'=>'2','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'empresa.ncomer', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'100'] )}}
	{{$errors->first('ncomer', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('df','DF')}}
	{{Form::text('df', null, ['tabindex'=>'3','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'empresa.df', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'200'] )}}
	{{$errors->first('df', '<span class=text-danger>:message</span>')}}
</div>
<div class="form-group">
	{{Form::label('rfc','RFC')}}
	{{Form::text('rfc', null, ['tabindex'=>'4','class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'empresa.rfc', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false', 'onblur'=>'aMayusculas(this.value,this.id)','maxlength'=>'20'] )}}
	{{$errors->first('rfc', '<span class=text-danger>:message</span>')}}
</div>
