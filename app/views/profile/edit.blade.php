@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('angular')
    ng-app="app" ng-controller="ProfileCtrl" ng-init="initApp({{ Auth::user()->datosProfile() }})"
@stop

@section('content')
    <div id="profile" style="display: none" class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{[{ user.nombre +' '+user.apepat+' '+user.apemat }]}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center">
                        <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle">
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
                        <button type="button" class="btn btn-success pull-right" ng-hide="loading" ng-disabled="formUser.$invalid || checkPassword()" ng-click="updateUser()">
                            Actualizar datos
                        </button>
                        <span class="glyphicon glyphicon-refresh spin pull-right" ng-show="loading"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    {{ HTML::script('js/profile/profile.js') }}
    {{ HTML::script('js/laroute.js') }}
@stop

