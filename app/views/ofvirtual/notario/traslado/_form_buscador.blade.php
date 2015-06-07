{{ Form::open(array('url' => 'ofvirtual/notario/traslado/buscar', 'method' => 'POST', 'name' => 'forma-buscador', 'id'=>'forma-buscador')) }}
<div class="col-sm-6">
    <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search boton-buscador"></span>
                </span>
        {{Form::text('q', null, ['class'=>'form-control', 'placeholder'=>'Buscar por...', 'id'=>'q'] )}}

        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle dropdown-label buscador" data-toggle="dropdown">

                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right dropdown-tipo" role="menu">
                <li><a href="javascript:void(0);" data-tipo="Folio">Folio</a></li>
                <li><a href="javascript:void(0);" data-tipo="Vendedor">Nombre del vendedor</a></li>
                <li><a href="javascript:void(0);" data-tipo="Comprador">Nombre del comprador</a></li>
                <li><a href="javascript:void(0);" data-tipo="Ubicación de la propiedad">Ubicación de la propiedad</a></li>
                <li><a href="javascript:void(0);" data-tipo="Clave">Clave catastral de propiedad</a></li>
                <li><a href="javascript:void(0);" data-tipo="Cuenta">Número de cuenta de la propiedad</a></li>
            </ul>
        </div><!-- /btn-group -->
    </div><!-- /input-group -->
</div><!-- /.col-lg-4 -->

{{Form::hidden('tipo','folio',['id'=>'tipo'])}}
{{Form::close()}}

@section('javascript')
    <script>


$(function () {

    $(document).on("submit", "#forma-buscador", function(e){
        e.preventDefault();
        var tipo = $('#tipo').val();
        //console.log(tipo);
        var q = $('#q').val();
        if(q=='') return false;
        $( "#lista-tramites" ).load( "{{URL::to('ofvirtual/notario/traslado/buscar')}}", { tipo: tipo, q: q }, function() {
            //console.log('Se ha cargado la lista de trámites');
        });
                return false;
            });
});


        $('.dropdown-tipo li a').click(function () {
            var tipo = $(this).data('tipo');
            //console.log(tipo);
            //$('#q').val('');
            $('.buscador').text(tipo);
            $('#tipo').val(tipo);
        });

    </script>
@append