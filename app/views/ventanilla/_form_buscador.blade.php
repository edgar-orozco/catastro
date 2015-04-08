{{ Form::open(array('url' => 'tramites/buscar', 'method' => 'POST', 'name' => 'forma-buscador', 'id'=>'forma-buscador')) }}
<div class="col-sm-6">
    <div class="input-group">
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-search boton-buscador"></span>
                </span>
        {{Form::text('q', null, ['class'=>'form-control', 'placeholder'=>'Buscar por...', 'id'=>'q'] )}}

        <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle dropdown-label" data-toggle="dropdown">
                Folio
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right dropdown-tipo" role="menu">
                <li><a href="javascript:void(0);" data-tipo="Folio">Folio</a></li>
                <li><a href="javascript:void(0);" data-tipo="Solicitante">Solicitante</a></li>
                <li><a href="javascript:void(0);" data-tipo="Notaría">Notaría</a></li>
                <li><a href="javascript:void(0);" data-tipo="Tipo de trámite">Tipo de trámite</a></li>
                <li><a href="javascript:void(0);" data-tipo="Fecha">Fecha</a></li>
            </ul>
        </div><!-- /btn-group -->
    </div><!-- /input-group -->
</div><!-- /.col-lg-6 -->

{{Form::hidden('tipo','folio',['id'=>'tipo'])}}
{{Form::close()}}

@section('javascript')
    <script>


        $(function () {

            $(document).on("submit", "#forma-buscador", function(e){
                e.preventDefault();
                var tipo = $('#tipo').val();
                var q = $('#q').val();
                $( "#lista-tramites" ).load( "{{URL::to('tramites/buscar')}}", { tipo: tipo, q: q }, function() {
                    console.log('Se ha cargado la lista de trámites');
                });
                return false;
            });
        });


        $('.dropdown-tipo li a').click(function () {
            var tipo = $(this).data('tipo');
            console.log(tipo);
            //$('#q').val('');
            $('.dropdown-label').text(tipo);
            $('#tipo').val(tipo.toLowerCase());
        });

        //Spinner de cargando
        $(document).bind("ajaxSend", function(){
            $(".boton-buscador").removeClass('glyphicon-search');
            $(".boton-buscador").addClass('glyphicon-refresh spin');
        }).bind("ajaxComplete", function(){
            $(".boton-buscador").removeClass('glyphicon-refresh spin');
            $(".boton-buscador").addClass('glyphicon-search');
        });

    </script>
@endsection