<div class="col-xs-12" ng-show="filtrado">
    <table class="table table-striped table-responsive"
           datatables="datatables"
           content="datosTabla"
           columns="aoCols"
            >
        <thead>
            <tr>
                <th width="150">Fecha</th>
                <th>Actividad</th>
                <th>Usuario modifico</th>
                <th>Registro modificado</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>

<div class="col-xs-12" ng-hide="filtrado">
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th width="150">Fecha</th>
            <th>Actividad</th>
            <th>Usuario modifico</th>
            <th>Registro modificado</th>
        </tr>
        </thead>
        <tbody>
            @foreach($actividades as $actividad)
            <tr>
                <td>
                    {{ $actividad->created_at->format('Y-m-d H:i:s') }}
                </td>
                <td>
                    {{ $actividad->actividad }}
                </td>
                <td>
                    {{ $actividad->usuario->nombreCompleto() }}
                </td>
                <td>
                    {{ $actividad->registro->nombreCompleto() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pull-right">
        {{ $actividades->appends(Request::except('page'))->links() }}
    </div>

</div>
