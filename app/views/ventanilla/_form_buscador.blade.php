<div class="col-sm-6 paddin-null">
    <a class="btn btn-success btn-poratender btn-actionForm01" href="javascript:void(0);" role="button" >
       Por atender &nbsp;
        <span class="badge badge-num">{{$por_atender}}</span>
        <span class="glyphicon glyphicon-refresh spin" style="display: none;"></span>
    </a>
</div>


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
                <li><a href="javascript:void(0);" data-tipo="Departamento">Departamento</a></li>
                <li><a href="javascript:void(0);" data-tipo="Estatus">Estatus</a></li>
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
                var q = $('#q').val();
                if(q=='') return false;
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

        $('.btn-poratender').click(function () {
            var tipo = $(this).data('tipo');

            $('.btn-poratender .badge-num').hide();
            $('.btn-poratender .spin').show();
            $( "#lista-tramites" ).load( "{{URL::to('tramites/poratender')}}", function() {
                console.log('Se ha cargado la lista de trámites por atender');
                $('.btn-poratender .badge-num').show();
                $('.btn-poratender .spin').hide();

            });
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