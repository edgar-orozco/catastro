{{ Form::open(array('url' => 'ofvirtual/notario/traslado/create', 'method' => 'GET')) }}

<div class="row col-sm-4">
    {{Form::claveCuenta()}}
</div>

<span class="input-group-btn">
    <button class="btn btn-success" type="submit">Crear traslado de dominio
        <span class="glyphicon glyphicon-plus boton-buscador" aria-hidden="true"></span>
    </button>
</span>

<!-- /col-md-6 -->
<div>
    <div class="alert alert-danger" style="display: none;">
        No se encontró el predio solicitado en el padrón.
    </div>
</div>
<!-- //Inputs de clave o cuenta -->

<!--</form>-->
{{ Form::close() }}
