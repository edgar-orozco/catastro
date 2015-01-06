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

                                            <div class="btn-group btn-toggle" data-toggle="buttons">
                                                <label class="btn btn-sm btn-default">
                                                    <input type="radio" name="requisitos[{{$tipotramite->id}}][{{$requisito->id}}]" value="1"> SI
                                                </label>
                                                <label class="btn btn-sm btn-default">
                                                    <input type="radio" name="requisitos[{{$tipotramite->id}}][{{$requisito->id}}]" value="0" > NO
                                                </label>
                                            </div>
                                            {{$requisito->nombre}} {{$requisito->pivot->original ? 'original' : ''}}
                                            {{$requisito->pivot->original &&  $requisito->pivot->copias ? ' y ' : ''}}
                                            {{$requisito->pivot->copias ? $requisito->pivot->copias. " ".Lang::choice('messages.copias', $requisito->pivot->copias ) : ''}}
                                            {{$requisito->pivot->certificadas ? Lang::choice('messages.certificadas', $requisito->pivot->copias) : ''}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

