{{ HTML::style('css/fileinput.min.css') }}

    @foreach($tipotramite->requisitos as $requisito)
        <div class="form-group">
        {{ Form::label('documento['.$requisito->id.']', $requisito->nombre) }}
        {{ Form::file('documento['.$requisito->id.']', ['class'=>'form-control upload-inputs', 'data-requisito_id'=>$requisito->id]) }}
        {{$errors->first('documento['.$requisito->id.']', '<span class=text-danger>:message</span>')}}
        {{Form::hidden('requisito_ids[]',$requisito->id) }}
        </div>
    @endforeach

    @section('javascript')
        {{ HTML::script('js/fileinput.min.js') }}
        {{ HTML::script('js/fileinput_locale_es.js') }}
        <script type="text/javascript">

        $(function() {
            //Función de upload asincrono.
            $(".upload-inputs").fileinput({
                uploadUrl: "{{URL::to('tramites/documentos')}}", // server upload action
                uploadAsync: true,
                showPreview: false,
                allowedFileExtensions: ["pdf", "png", "jpg"],
                uploadExtraData: {'tramite_id': "{{$tramite->id}}"}
            });

            $(".upload-inputs").on('fileuploaded', function(event, data, previewId, index) {
                alert(index);

                var form = data.form, files = data.files, extra = data.extra,
                        response = data.response, reader = data.reader;

            });

        });
    </script>
    @append