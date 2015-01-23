@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
        @foreach($tipotramites as $tipotramite)
            <div class="panel panel-info">
                <div class="panel-heading" role="tab" id="heading-{{$tipotramite->id}}">
                    <h4 class="panel-title">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion"
                           href="#collapse-{{$tipotramite->id}}" aria-expanded="false"
                           aria-controls="collapse-{{$tipotramite->id}}">
                            {{$tipotramite->nombre}}
                        </a>
                    </h4>
                </div>
                <div id="collapse-{{$tipotramite->id}}" class="panel-collapse collapse" role="tabpanel"
                     aria-labelledby="heading-{{$tipotramite->id}}">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    {{Form::text('clave', null, ['class'=>'form-control clave-catastral', 'placeholder'=>'Clave Catastral', 'data-tipotramite'=>$tipotramite->id] )}}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </span>
                                </div><!-- /input-group -->
                            </div>

                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-info">
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">Duración en días hábiles</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="glyphicon glyphicon-time gi-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{$tipotramite->tiempo}}</div>
                                                <div>Días</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="panel panel-info">
                                    <a href="#">
                                        <div class="panel-footer">
                                            <span class="pull-left">Costo</span>
                                            <div class="clearfix"></div>
                                        </div>
                                    </a>
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <i class="glyphicon glyphicon-usd gi-5x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <div class="huge">{{$tipotramite->costodsmv}}</div>
                                                <div>Pesos M.N.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6">

                                <ul class="list-unstyled">
                                    @foreach($tipotramite->requisitos as $requisito)
                                        <li>
                                            @include('ventanilla._form_requisitos',compact('tipotramite','requisito'))
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="form-actions form-group">
                                    {{ Form::submit('Iniciar trámite', array('class' => 'btn btn-primary')) }}
                                </div>


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/laroute.js') }}
    <script>
        $(function() {
            $('.clave-catastral').change(function(ev){
                var clave = $(this).val().trim();
                if(clave == '') {
                    return false;
                }
                //console.log(laroute.route('ventanilla.consulta-padron'));
                $.get( laroute.route('ventanilla.consulta-padron'), {'clave': clave}, function( data ) {
                    console.log( data );
                    if(data == '') {
                        console.log('No existe');
                    }
                });
            });
        });
    </script>
@append