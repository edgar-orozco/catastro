@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('angular')
    ng-app="app" ng-controller="ProfileCtrl" ng-init="initApp({{ Auth::user()->datosProfile() }})"
@stop

@section('content')
<style type="text/css">
.dropzone button{
    margin-top: 15px;
}
</style>
    <div id="profile" style="display: none" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{[{ user.nombre +' '+user.apepat+' '+user.apemat }]}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 dropzone text-center">
                        <img alt="User Pic" ng-src="{[{ user.foto }]}">


                        <button type="button" class="btn btn-success btn-sm" ng-click="openFileSelector()">
                            <i class="glyphicon glyphicon-picture"></i>
                            Cambiar imagen
                        </button>

                        {{Form::file('logo', ['bxd-file-size' => 'bxd-file-size'] )}}


                        <p class="text-danger" ng-show="showErrorType">
                            Solo se permiten imágenes de tipo PNG y JPG
                        </p>
                        <p class="help-block" ng-show="showErrorSize">
                            <span class="text-danger">El tamaño de la imagen no es correcto, intenta nuevamente.</span><br>
                            <span class="text-danger">Tamaño actual: {[{ imgActual.width }]} X {[{ imgActual.height }]} .</span><br>
                            <span class="text-danger" ng-if="imgActual.height > imgMax.height || imgActual.width > imgMax.width">Tamaño máximo admitido es de {[{ imgMax.width }]} X {[{ imgMax.height }]} pixeles.</span>
                            <span class="text-danger" ng-if="imgActual.height < imgMin.height || imgActual.width < imgMin.width">Tamaño mínimo admitido es de {[{ imgMin.width }]} X {[{ imgMin.height }]} pixeles.</span>
                        </p>

                    </div>

                    <div class=" col-md-9 col-lg-9 ">
                        <form name="formUser">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Usuario</td>
                                        <td>
                                            <input type="text" class="form-control" required="required" ng-model="user.username" />
                                            <span ng-repeat="error in user.errors.username" class=text-danger>{[{ error }]}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nombre</td>
                                        <td>
                                            <input type="text" class="form-control" required="required" ng-model="user.nombre" />
                                            <span ng-repeat="error in user.errors.nombre" class=text-danger>{[{ error }]}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apellido paterno</td>
                                        <td>
                                            <input type="text" class="form-control" required="required" ng-model="user.apepat" />
                                            <span ng-repeat="error in user.errors.apepat" class=text-danger>{[{ error }]}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Apellido materno</td>
                                        <td>
                                            <input type="text" class="form-control" ng-model="user.apemat" />
                                            <span ng-repeat="error in user.errors.apemat" class=text-danger>{[{ error }]}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>
                                            <input type="email" class="form-control" ng-model="user.email" />
                                            <span ng-repeat="error in user.errors.email" class=text-danger>{[{ error }]}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Contraseña</td>
                                        <td>
                                            <input type="password" class="form-control" ng-model="user.password" ng-required="(user.id === undefined) ? true : false" />
                                            <span ng-repeat="error in user.errors.password" class=text-danger>{[{ error }]}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Confirmar contraseña</td>
                                        <td>
                                            <input type="password" class="form-control" ng-model="user.password_confirmation" ng-required="(user.id === undefined) ? true : false" />
                                            <span class=text-danger ng-show="checkPassword()">
                                                No coincide la confirmación de la contraseña, favor de reingresar la constraseña y su confirmación.
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        <a href="{{ URL::action('ProfileController@index') }}" ng-hide="loading" class="btn btn-primary">
                            Regresar
                        </a>
                        &nbsp; &nbsp;
                        <button type="button" class="btn btn-success" ng-hide="loading" ng-disabled="formUser.$invalid || checkPassword() || showErrorSize || showErrorType" ng-click="updateUser()">
                            Actualizar datos
                        </button>
                        <span class="glyphicon glyphicon-refresh spin" ng-show="loading"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/profile/profile.js') }}
    {{ HTML::script('js/laroute.js') }}
    <script type="text/javascript">
        var minImgSize  = {{ json_encode(ShapesHelper::minImgUploadSize()) }},
            maxImgSize  = {{ json_encode(ShapesHelper::maxImgUploadSize()) }};
    </script>
@stop

