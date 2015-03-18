{{ HTML::style('js/jquery/jquery-ui.css') }}
@section('javascript')
{{ HTML::script('js/jquery/jquery-ui.js') }}
@stop

<div class="form-group">
    {{Form::label('mes','Mes')}}
    
    {{Form::select('mes',$mes, null,['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.mes', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('anio','Año')}}
    {{Form::text('anio', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.anio','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('anio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('inpc','INPC')}}
    {{Form::text('inpc', null, ['class'=>'form-control','autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'inpc.inpc','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('inpc', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Valor del indice nacional de precios al consumidor.</p>
</div>

@section('javascript')
<script>  
//Numero    
function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
return /\d/.test(String.fromCharCode(keynum));
}


</script>
@append