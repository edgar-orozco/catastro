<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Traslados de dominios</h3>
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
                    <th>Usuario</th>
                    <th>Notaria</th>
                    <th>Comprador</th>
                    <th>Vendedor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($traslados as $traslado)
                <tr>
                    <td nowrap>
                        {{$traslado->clave}}
                    </td>
                    <td>

                          {{$traslado->cuenta}}
                    </td>
                    <td> {{$traslado->usuario->nombreCompleto()}}</td>

                       <td> {{$traslado->notaria->nombre}}</td>
                         <td> {{$traslado->comprador->nombres}} {{$traslado->comprador->apellido_paterno}} {{$traslado->comprador->apellido_materno}}</td>
                         <td> {{$traslado->vendedor->nombres}} {{$traslado->vendedor->apellido_paterno}} {{$traslado->vendedor->apellido_materno}}</td>


                    <td style="text-align: right;" nowrap>
                        <a href="{{ action('OficinaVirtualNotarioController@edit', ['id' => $traslado->id]) }}" class="btn btn-warning" title="Editar traslado">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        <a href="{{ action('OficinaVirtualNotarioController@destroy', ['id' => $traslado->id]) }}" class="btn btn-danger" title="Borrar traslado">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

