{{ HTML::style('css/fileinput.min.css') }}

    @foreach($tipotramite->requisitos as $requisito)

        <div class="form-group">
        {{ Form::label('documento['.$requisito->id.']', $requisito->nombre) }}

            <div id="docs-requisito-{{$requisito->id}}">
                @include('ventanilla._documentos_tramite', [
                    'documentos' => $tramite->documentosTramite()->where('requisito_id',$requisito->id)->whereNull('deleted_at')->get(),
                    'requisito' => $requisito
                ])
            </div>

        </div>

    @endforeach

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
                    <h4 style="text-align: center">¿Realmente desea borrar el documento?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger btn-submit-borrar" data-documento_id="" data-dismiss="modal">
                        <span class="glyphicon glyphicon-trash " ></span> Borrar documento</button>
                    <input type="hidden" name="documento_id" id="documento_id">
                </div>
            </div>
        </div>
    </div>



    @section('javascript')
        {{ HTML::script('js/fileinput.min.js') }}
        {{ HTML::script('js/fileinput_locale_es.js') }}
        <script type="text/javascript">

        $(function() {

            //Esta es la configuración del input upload
            var inputUploadCfg = {
                uploadUrl: "{{URL::to('tramites/documentos')}}", // server upload action
                uploadAsync: true,
                showPreview: false,
                allowedFileExtensions: ["pdf", "png", "jpg"],
                uploadExtraData: {'tramite_id': "{{$tramite->id}}"}
            };

            //Escuchamos todos los eventos ajax, debido a una falla en el evento onupload del input upload.
            $( document ).ajaxComplete(function( event, xhr, settings ) {
                var res = jQuery.parseJSON(xhr.responseText);
                var tramite_id = '{{$tramite->id}}';

                //Cuando termina de subir un archivo recargamos la lista de archivos para ese requisito
                if(settings.url.indexOf('tramites/documentos') >= 0)
                {
                    var requisito_id = res.requisito_id;
                    $( "#docs-requisito-" + requisito_id ).load( "{{URL::to('tramite/lista/documentos')}}/" + tramite_id + "/" + requisito_id, function() {
                        //Se vuelven a acargar las funciones para el nuevo nodo del documento que se ha cargado via ajax y no tiene las funciones asociadas
                        $(".upload-inputs").fileinput(inputUploadCfg);
                        $(".upload-inputs").on('filebatchuploadcomplete', function(event, data, previewId, index, jqXHR) {
                            $('#docs-requisito-' + $(event.currentTarget).data('requisito_id') + ' .file-input' ).hide();
                        });
                    });
                }

                //Aquí es cuando se recarga la lista
                else if(settings.url.indexOf('tramite/lista/documentos/') >= 0)
                {
                    console.log('Regresa de recargar lista');
                }
            });

            //Plugin para el manejo de los uploads archivos mediante ajax
            $(".upload-inputs").fileinput(inputUploadCfg);
            $(".upload-inputs").on('filebatchuploadcomplete', function(event, data, previewId, index, jqXHR) {
                $('#docs-requisito-' + $(event.currentTarget).data('requisito_id') + ' .file-input' ).hide();
            });

            //Cuando se activa la modal se pasa el documento_id correspondiente al botón que mostró la modal
            $('.modal-borrar').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var documento_id = button.data('documento_id');
                $('#documento_id').val(documento_id);
                $('.btn-submit-borrar').data('documento_id',documento_id);
            });

            //Cuando se da click en el botón de borrar de la modal:
            $('.btn-submit-borrar').click(function(){

                var documento_id = $(this).data('documento_id');
                console.log('se quiere borrar este: '+documento_id);
                $.post("{{URL::to('tramites/documentos/eliminar')}}", {'documento_id': documento_id}, function (data) {
                    console.log('Regresa de borrar el docid:' + documento_id);
                    return false;
                });

            });

        });
    </script>
    @append