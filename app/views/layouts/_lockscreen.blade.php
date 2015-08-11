<div class="lock-screen" id="lock-screen">
    <div class="middle-box text-center lock-screen-container animated fadeInDown">
        <div>
            <div class="m-b-md">
                <img alt="image"  src="{{ asset('/css/images/main/logo-header.png') }}">
            </div>
            <h3>{{Auth::user()->nombreCompleto()}}</h3>
            <p>
                Tu sesión se cerro por inactividad, ingresa tu contraseña para desbloquear esta pantalla.
            </p>
            <div id="lock-screen-error" class="alert alert-danger">
                <span class="glyphicon glyphicon-remove"></span>
                <span id="lock-screen-error-text"></span>
            </div>
            <form class="m-t" role="form" id="lock-screen-form">
                <div class="form-group">
                    <input type="password" id="lock-password" class="form-control" placeholder="*******" required="">
                    <input type="hidden" id="lock-username" value="{{ Auth::user()->username }}" >
                </div>
                <button type="submit" id="lock-screen-submit" class="btn btn-primary btn-block">
                    Desbloquear
                </button>
                <img id="lock-screen-loader" src="/css/fancybox_loading.gif" alt="cargando ...">
            </form>
        </div>
        <div class="change-user">
            <a href="/users/login">
                <i class="glyphicon glyphicon-user"></i>
                Cambiar de usuario
            </a>
        </div>
    </div>
</div>