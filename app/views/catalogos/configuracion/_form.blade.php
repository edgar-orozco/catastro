<div class="form-group">
    {{Form::label('municipio','Seleccione el municipio')}}
    {{Form::select('municipio',$Municipio, null,['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.municipio', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'])}}
    {{$errors->first('municipio', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('nombre','Nombre completo')}}
    {{Form::text('nombre', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.nombre', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('nombre', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Nombre de la persona en mayuscula.</p>
</div>

<div class="form-group">
    {{Form::label('cargo','Cargo')}}
    {{Form::text('cargo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.cargo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false'] )}}
    {{$errors->first('cargo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('gastos_ejecucion_porcentaje','Gasto ejecucion porcentaje')}}
    {{Form::text('gastos_ejecucion_porcentaje', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.gastos_ejecucion_porcentaje', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('gastos_ejecucion_porcentaje', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('descuento_multa','Descuento Multa')}}
    {{Form::text('descuento_multa', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.descuento_multa', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('descuento_multa', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('descuento_gasto_ejecucion','Descuento gasto ejecucion')}}
    {{Form::text('descuento_gasto_ejecucion', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.descuento_gasto_ejecucion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('descuento_gasto_ejecucion', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('descuento_recargo','Descuento recargo')}}
    {{Form::text('descuento_recargo', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.descuento_recargo', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('descuento_recargo', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

<div class="form-group">
    {{Form::label('descuento_actualizacion','Descuento de actualizacion')}}
    {{Form::text('descuento_actualizacion', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'configuracionMunicipal.descuento_actualizacion', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','onkeypress'=>'return justNumbers(event)'] )}}
    {{$errors->first('descuento_actualizacion', '<span class=text-danger>:message</span>')}}
    <p class="help-block"></p>
</div>

@if(!empty($file))
<div class="form-group">  
<img src="/css/images/logos/{{$file}}" width="107" height="107">
</div>
<div class="form-group">
<form method="post" name="formulario" enctype="multipart/form-data">
Subir imágenes: <input type="file" multiple name="file" id="file">
<p class="help-block">Seleccione un archivo de file con la extencion siguente .jpg, .png, .bnp, .jpeg</p>
</div>
@endif

@if(empty($file))
<div class="form-group">
<form method="post" name="formulario" enctype="multipart/form-data">
Subir imágenes: <input type="file" multiple name="file" id="file"  required>
<p class="help-block">Seleccione un archivo de file con la extencion siguente .jpg, .png, .bnp, .jpeg</p>
</div>
@endif



@section('javascript')
<script>
window.onload = function()
 {
  var file = document.getElementById("file");
  file.onchange = function()
   {
     
 var file = document.getElementById("file").files;
  
 if(file.length == 0)
  {
   alert("La subida de la imagen es requerida");
   return;
  }
 else
 {
  for(x = 0; x < file.length; x++)
    {
     
     if (file[x].type != "image/png" && file[x].type != "image/jpg" && file[x].type != "image/jpeg" && file[x].type != "image/bnp")
  {
  alert("El archivo " + file[x].name + " no es una imagen");
  return;
  }
   
  if (file[x].size > 1024*1024*1)
  {
  alert("La imagen " + file[x].name + " supera el tamaño máximo permitido 1MB");
  return;
  }
   
    }
 }
  
 document.formulario.submit();
   }
 }
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


