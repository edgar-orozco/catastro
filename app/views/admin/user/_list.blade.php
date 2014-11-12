<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">Usuarios del sistema</h3>
    </div>
    @if(count($usuarios) == 0)
        <div class="panel-body">
            <p>No hay usuarios dados de alta actualmente en el sistema.</p>
        </div>
    @endif
    <div class="list-group">
        @foreach($usuarios as $usr)
            <a href="{{ action('AdminUserController@edit', ['id' => $usr->id] )}}" class="list-group-item">
                <h4 class="list-group-item-heading">{{$usr->nombreCompleto()}}</h4>
                <p class="list-group-item-text">{{$usr->username}}</p>
            </a>
        @endforeach
    </div>

</div>


