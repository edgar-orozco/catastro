

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Trámites</h3>
    </div>
    @if($tramites->count() == 0)
        <div class="panel-body">
            <p>No hay trámites actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
        <table class="table" >
            <thead>
            <tr>
                <th>Trámite</th>
                <th>Folio</th>
                <th style="text-align: center;">Clave</th>
                <th style="text-align: center;">Solicitante</th>
                <th style="text-align: center;">Notaría</th>
                <th style="text-align: center;">Inicio</th>
                <th style="text-align: center;">Estatus</th>
                <th style="text-align: center;">Detalle</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tramites as $tramite)
                <tr>
                    <td nowrap>
                        {{$tramite->tipotramite->nombre}}
                    </td>
                    <td>
                        {{ sprintf("%06d",$tramite->folio)}}
                    </td>
                    <td>
                        {{$tramite->clave}}
                    </td>
                    <td>
                        {{$tramite->solicitante->nombrec}}
                    </td>
                    <td>
                        {{$tramite->notaria->nombre}}
                    </td>
                    <td>
                        {{$tramite->created_at->format("Y-m-d H:i")}}
                    </td>
                    <td>
                       Estatus
                    </td>
                    <td style="text-align: right;" nowrap>
                        <a href="{{ action('TramitesController@proceso', ['id' => $tramite->id]) }}" class="btn btn-warning" title="Ver detalle">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

