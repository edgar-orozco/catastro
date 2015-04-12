{{ HTML::style('css/fileinput.min.css') }}

{{ Form::open(array('url' => 'tramites/guardar-documentos', 'method' => 'POST', 'files'=>true)) }}

    @foreach($requisitos as $requisito)
        <div class="form-group">
        {{ Form::label('documento['.$requisito->id.']', $requisito->nombre) }}

        {{ Form::file('documento['.$requisito->id.']', ['class'=>'form-control upload-inputs']) }}
        {{$errors->first('documento['.$requisito->id.']', '<span class=text-danger>:message</span>')}}
        {{Form::hidden('requisito_ids[]',$requisito->id) }}
        </div>
    @endforeach

    {{Form::hidden('clave',$clave) }}
    {{Form::hidden('num_requisitos', count($requisitos)) }}
    {{Form::hidden('tipotramite_id',$tipotramite->id) }}

    <div class="form-group">
        {{ Form::submit('Guardar documentos', ['class'=>'btn btn-info', 'id' => 'guardar-documentos', 'style'=>'display:none;']) }}
    </div>

    {{ Form::close() }}

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
                allowedFileExtensions: ["pdf", "png", "jpg"]
            });


            $("input:file").change(function (){
                var todos = true;
                $("input:file").each(function () {
                    var input = $(this);
                    if( !input.val()  ){
                        todos = false;
                    }
                });
                if(todos) {
                    $('#guardar-documentos').show();
                }
                else {
                    $('#guardar-documentos').hide();
                }
            });
        });
    </script>
    @append