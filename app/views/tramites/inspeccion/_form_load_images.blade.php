
<div class="row">

    <label class="control-label">Select File</label>

    <input id="input-1" name="imagen" type="file"  data-show-preview="true" multiple data-show-upload="false" data-show-caption="true">
</div>
<br>
{{Form::label('imagen','Imagenes cargadas')}}



<div class="row">
    <div class="col-md-4-offset-0">
        <img src="{{$consultaMani->fachada}}" width="300" height="300">
    </div>
</div>

