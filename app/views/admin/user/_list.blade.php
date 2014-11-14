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
            <a href="{{ action('AdminUserController@edit', ['id' => $usr->id, 'page'=> $usuarios->getCurrentPage()] )}}" class="list-group-item {{($usr->id == $user->id) ? 'active':''}}">
                <div class="row">
                <div class="col-sm-9">
                <h4 class="list-group-item-heading">{{$usr->nombreCompleto()}}</h4>
                <p class="list-group-item-text">{{$usr->username}}</p>
                </div>
                <div class="col-sm-3">
                @foreach($usr->roles as $rol)
                    <span class="label label-warning">{{$rol->name}}</span>
                @endforeach
                </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
{{ $usuarios->appends(Request::except('page'))->links() }}

