@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <h3>{{$clave}}</h3>

    @if($errors->any())
        {{dd($errors->all())}}
    @endif

    {{ Form::open(array('url' => 'tramites/guardar-documentos', 'method' => 'POST', 'files'=>true)) }}

    @foreach($requisitos as $requisito)
        <div class="form-group">
        {{ Form::label('documento['.$requisito->id.']', $requisito->nombre) }}

        {{ Form::file('documento['.$requisito->id.']', ['class'=>'form-control']) }}
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

    <script type="text/javascript">
        $(function() {

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

@stop