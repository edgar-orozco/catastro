<div id="lista-tramites">
<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Traslados de dominios</h3>
    </div>


  <div class="alert alert-success" id="dominio-eliminado" style="display: none;">
            <h4><span class="glyphicon glyphicon-ok"></span>  Se eliminó correctamente el dominio.</h4>
        </div>

    @if(count($traslados) == 0)
        <div class="panel-body">
            <p>No hay traslados de dominios dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
        <table class="table" >
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Cuenta</th>
                    <th>Comprador</th>
                    <th>Vendedor</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($traslados as $traslado)
                <tr id="traslado-{{$traslado->id}}">
                    <td nowrap>
                        {{$traslado->clave}}
                    </td>
                    <td>
                          {{$traslado->cuenta}}
                    </td>
                    <td> {{$traslado->comprador->nombres}} {{$traslado->comprador->apellido_paterno}} {{$traslado->comprador->apellido_materno}}</td>

                       <td>{{$traslado->vendedor->nombres}} {{$traslado->vendedor->apellido_paterno}} {{$traslado->vendedor->apellido_materno}}</td>
                         <td> {{$traslado->created_at->format("d-m-Y")}}</td>

                    <td style="text-align: right;" nowrap>
                        <a href="{{ action('OficinaVirtualNotarioController@edit', ['id' => $traslado->id]) }}" class="btn btn-warning" title="Editar traslado">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                       <!-- <a href="{{--action('OficinaVirtualNotarioController@destroy', ['id' => $traslado->id]) --}}"
                        class="eliminar btn btn-danger" title="Borrar traslado">
                            <span class="glyphicon glyphicon-trash"></span>
                              </a>-->
                         <a href="#" data-toggle="modal" data-target="#confirm-delete" class="btn-borrar btn btn-danger" data-traslado_id="{{$traslado->id}}">
                           <span class="glyphicon glyphicon-trash danger"></span>
                         </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>


<!--60 líneas de código en algo que se pudo hacer con 2 :/ -->



 <!-- Modal para confirmar cuando se borra un documento -->
    <div class="modal fade modal-borrar" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirm-delete"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="confirm-logout-title">Confirme la acción:</h4>
                </div>
                <div class="modal-body">
                    <h4 style="text-align: center">¿Desea eliminar el traslado de dominio de su lista? <br>Esta acción no puede deshacerse.</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger btn-submit-borrar" data-documento_id="" data-dismiss="modal">
                        <span class="glyphicon glyphicon-trash " ></span> Eliminar traslado de dominio</button>
                    <input type="hidden" name="documento_id" id="documento_id">
                </div>
            </div>
        </div>
    </div>


    @section('javascript')
        <script type="text/javascript">

        $(function() {

            //Cuando se activa la modal se pasa el documento_id correspondiente al botón que mostró la modal
            $('.modal-borrar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var traslado_id = button.data('traslado_id');
                $('#documento_id').val(documento_id);
                $('.btn-submit-borrar').data('traslado_id',traslado_id);
            });

            //Cuando se da click en el botón de borrar de la modal:
            $('.btn-submit-borrar').click(function(){
                var traslado_id = $(this).data('traslado_id');
                console.log('se quiere borrar este: '+traslado_id);
                $.get("{{url('ofvirtual/notario/traslado/destroy/')}}"+'/'+ traslado_id, function (data){
                    console.log('Regresa de borrar el traslado:' + traslado_id);
                    $('#traslado-'+traslado_id).hide();
                    $('#dominio-eliminado').show();
                    return false;
                });


        });
     });
    </script>
    @append