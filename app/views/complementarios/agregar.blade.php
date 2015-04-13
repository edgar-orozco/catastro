<div class="modal-header">
    <h4 class="modal-titulo" id="condominio-titulo">Agregar Instalacion</h4>
</div>
<div class="panel-body">
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
    {{ Form::open(array( 'id' => 'agregar', 'url'=> '/agregar',)) }}
    <br/>
    <div style="margin-left: 20px">
        <div class="input-group">
            {{ Form::hidden('id',$datos) }}
        </div>
        <div class="input-group">
            Instalacion:</br>

            {{Form::select('algo', $catalogo, null, ['id'=>'algo','class'=>'form-control'])}}
        </div>
        <br/>

        {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
</div>
</br>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>

</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">

$('#agregar').bind('submit',function ()
        {
            $.ajax(
            {
                type: 'POST',
                data: new FormData( this ), //Toma todo lo que hay en el formulario, en este caso el archivo .txt o .csv
                processData: false,
                contentType: false,
                url: '/agregar',
                beforeSend: function()
                {
                    alert("mandando petición");
                },
                success: function (data)
                {
                    alert("guardado correcto");
                }
            });
            return false;
        });

</script>