@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop

@section('content')

    <div class="page-header">
        <h2>Bienvenid@
            <small>{{Auth::user()->nombreCompleto()}}</small>
        </h2>
    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-user gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{User::totalUsers()}}</div>
                            <div>Usuarios registrados</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/user')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Administrar usuarios</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-lock gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{Permission::totalPermissions()}}</div>
                            <div>Permisos registrados</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/permission')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Administrar permisos</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-tags gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{Role::totalRoles()}}</div>
                            <div>Roles registrados</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/role')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Administrar roles</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-th-list gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{Tipotramite::totalTipotramites()}}</div>
                            <div>Tipos de trámites</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/tipotramites')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Administrar Tipo de trámites</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-cloud-upload gi-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ ShapesHelper::countShapes() }}</div>
                            <div>Archivos cargados</div>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('admin/carga-shapes')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Actualización Cartográfica</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="glyphicon glyphicon-globe gi-5x"></i>
                        </div>
                    </div>
                </div>
                <a href="{{URL::to('cartografia/consultas')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Consulta Cartográfica</span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>
@stop
