<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
<!--script src="//code.jquery.com/jquery-1.10.2.js"></script-->
{{ HTML::script('js/jquery/jquery.min.js') }}
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

<div>
{{Form::label('id_p','Nombre del ejecutor')}} 
{{Form::text('id_p',null, ['id' => 'id_p', 'class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.id_p'] )}}
{{$errors->first('id_p', '<span class=text-danger>:message</span>')}}
<p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('cargo','Cargo')}}
    {{Form::text('cargo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'ng-model' => 'ejecutores.cargo'] )}}
    {{$errors->first('cargo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('titulo','Titulo')}}
    {{Form::text('titulo', null, ['class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.titulo'] )}}
    {{$errors->first('titulo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('f_nombramiento','Fecha de nombramiento')}}
    {{Form::input('date','f_nombramiento', null, ['class'=>'form-control','placeholder' => 'Date','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.f_nombramiento'] )}}
    {{$errors->first('f_nombramiento', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('id_p_otorga_nombramiento','Quien lo nombra')}}
    {{Form::text('id_p_otorga_nombramiento', null, ['class'=>'form-control','autofocus'=> 'autofocus',  'ng-model' => 'ejecutores.id_p_otorga_nombramiento'] )}}
    {{$errors->first('id_p_otorga_nombramiento', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>


<script>
$(function () {

    $("#id_p").autocomplete({
        source: "/search/autocomplete2",
        minLength: 1
    });
    
  
});

$(function () {
    $("#id_p_otorga_nombramiento").autocomplete({
        source: "/search/autocomplete2",
        minLength: 1
    });
    
  
});
</script>
