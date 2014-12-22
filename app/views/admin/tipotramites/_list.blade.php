<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Tipos de trámites</h3>
    </div>
    @if(count($tipotramites) == 0)
        <div class="panel-body">
            <p>No hay tipos de trámite dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del trámite</th>
                <th>Duración aprox.</th>
                <th>Costo en DSMV</th>
                <th>Requisitos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tipotramites as $tipotramite)
            <tr>
                <td>
                    {{$tipotramite->nombre}}
                </td>
                <td>
                    {{$tipotramite->tiempo}}
                </td>
                <td>
                    {{$tipotramite->costodsmv}}
                </td>
                <td>
                    <ul>
                        @foreach($tipotramite->requisitos as $requisito )
                            <li>{{$requisito->nombre}} {{$requisito->pivot->original ? 'original' : ''}} {{$requisito->pivot->original &&  $requisito->pivot->copias ? ' y ' : ''}}  {{$requisito->pivot->copias ? $requisito->pivot->copias. " ".Lang::choice('messages.copias', $requisito->pivot->copias ) : ''}} {{$requisito->pivot->certificadas ? Lang::choice('messages.certificadas', $requisito->pivot->copias) : ''}}  </li>
                        @endforeach
                    </ul>
                </td>
                <td nowrap>
                    {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.tipotramites.destroy', $tipotramite->id))) }}
                        <a href="{{ action('TipotramitesController@edit', ['id' => $tipotramite->id]) }}" class="btn btn-warning" title="Editar tipo de trámite">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <button class="btn btn-danger">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
{{ $tipotramites->appends(Request::except('page'))->links() }}

