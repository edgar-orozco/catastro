<div class="form-group">
    {{Form::label('cve_status','Clave del status')}}
    {{Form::text('cve_status', null, ['class'=>'form-control', 'autofocus'=> 'autofocus', 'required' => 'required', 'ng-model' => 'status.cve_status', 'tb-focus' => 'focusForm', 'ng-blur' => 'focusForm = false','placeholder'=>'ES','maxlength'=>'2'] )}}
    {{$errors-> first('cve_status', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Dos letras mayusculas para indetifacar el estatus del proceso de ejecucion fiscal.</p>
</div>

<div class="form-group">
    {{Form::label('descrip','Descripción del status')}}
    {{Form::text('descrip', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'status.descrip','placeholder'=>'Ejemplo Status'] )}}
    {{$errors-> first('descrip', '<span class=text-danger>:message</span>')}}
    <p class="help-block">Es un texto descriptivo del estatus de ejecución, así se identificará para los usuarios.</p>
</div>

<div class="form-group">
    {{Form::label('Notificacion','Notificacion')}}
    <br>
    <input ng-model="status.notificacion" type="radio" name="notificacion" value="Si">Si  
    <input ng-model="status.notificacion" type="radio" name="notificacion" value="No">No 
</div>
<div class="form-group" ng-model="master">
    {{Form::label('Dias Habiles','Dias Habiles')}}
    <br>
    <input ng-model="status.dias_habiles" ng-model="$parent.selectedPerson" id="radio_1" type="radio" name="dias_habiles" value="Naturales">Naturales  
    <input ng-model="status.dias_habiles" type="radio" name="dias_habiles" value="Habiles">Habiles 
</div>
<div class="form-group">
    {{Form::label('dias_vigencia','Dias Vigencia')}}
    {{Form::text('dias_vigencia', null, ['class'=>'form-control', 'required' => 'required', 'ng-model' => 'status.dias_vigencia','placeholder'=>'Num De Dias'] )}}
    {{$errors->first('dias_vigencia', '<span class=text-danger>:message</span>')}}
</div>
@section('javascript')
<script>
  $("div.form-group #radio_1").attr("checked",true);
   $("div.form-group #radio_1").addClass("ng-touched").attr("checked",true);
</script>
@stop