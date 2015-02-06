@extends('layouts.default')

@section('title')
    {{{ $title }}} :: @parent
@stop

@section('content')
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">{{ Auth::user()->nombreCompleto()  }}</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-lg-3 " align="center">
                        <img alt="User Pic" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=100" class="img-circle">
                    </div>

                    <div class=" col-md-9 col-lg-9 ">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Usuario</td>
                                <td>{{{ Auth::user()->username }}}</td>
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td>{{{ Auth::user()->name ? Auth::user()->name : '-' }}}</td>
                            </tr>
                            <tr>
                                <td>Apellidos</td>
                                <td>{{{ Auth::user()->apellidos() ? Auth::user()->apellidos() : '-' }}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{{ Auth::user()->email ? Auth::user()->email : '-' }}}</td>
                            </tr>
                            <tr>
                                <td>Roles</td>
                                <td>
                                    @foreach (Auth::user()->roles as $role)
                                        {{{ $role->name }}} <br>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td>Municipios</td>
                                <td>
                                    @foreach (Auth::user()->municipiosPertenece() as $municipio)
                                        {{{ $municipio }}} <br>
                                    @endforeach
                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary pull-right">Editar datos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

