@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.8.0/styles/default.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.8.0/highlight.min.js"></script>

    <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tail" aria-controls="tail" role="tab" data-toggle="tab">Últimos registros</a></li>
            <li role="presentation"><a href="#por-fecha" aria-controls="por-fecha" role="tab" data-toggle="tab">Por fecha</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="tail">
                </br>
                {{ Form::open(array('url' => 'admin/laravel-log', 'method' => 'GET')) }}
                <div class="form-inline">
                    <div class="form-group">
                        <label for="lineas">Últimas</label>
                        <div class="input-group">
                            <input type="text" name="lineas" class="form-control" id="lineas" placeholder="100" size="4" maxlength="4">
                            <input type="hidden" name="accion" value="por-lineas">
                            <div class="input-group-addon">Líneas</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </div>

                {{ Form::close() }}
            </div>


            <div role="tabpanel" class="tab-pane" id="por-fecha">

                </br>
                {{ Form::open(array('url' => 'admin/laravel-log', 'method' => 'GET')) }}
                <div class="form-inline">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="text" name="fecha" class="form-control" id="fecha" placeholder="aaaa-mm-dd hh:mm:ss" size="20" maxlength="20">
                        <input type="hidden" name="accion" value="por-fecha">
                    </div>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>

    <style>
        code {
            display: inline-block;
            white-space: nowrap;
        }
    </style>

    </br>

    <div id="log" style="">
        <code class="bash">
            @foreach($lineas as $linea)
                {{trim($linea)}}
                <br>
            @endforeach
        </code>
    </div>

@stop

@section('javascript')
    <script>

        $(document).ready(function() {
            $('code').each(function(i, block) {
                hljs.highlightBlock(block);
            });
        });

    </script>

@stop
