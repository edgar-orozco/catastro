<div class="col-xs-12 mt10 fechas">
    <div class="col-xs-4">
        <select ng-model="tipoFecha" class="form-control" ng-change="changeDate()">
            <option value="">--Fechas--</option>
            <option value="especifica">Fecha específica</option>
            <option value="rango-fechas">Rango de Fechas</option>
        </select>
    </div>

    <div class="col-xs-8">
        <div ng-show="tipoFecha == 'especifica'" class="col-xs-6">
            <p class="input-group calendar">
                <input type                 = "text"
                       class                = "form-control"
                       datepicker-popup     = "{[{format}]}"
                       ng-model             = "fecha"
                       is-open              = "onlyDate"
                       min-date             = "minDate"
                       max-date             = "today"
                       show-weeks           = "false"
                       datepicker-options   = "dateOptions"
                       date-disabled        = "disabled(date, mode)"
                       close-text           = "Cerrar"
                       current-text         = "Hoy"
                       clear-text           = "Limpiar"
                        />
            <span class="input-group-btn">
                <button type="button"
                        class="btn btn-default"
                        ng-click="open($event, 'onlyDate')">
                    <i class="glyphicon glyphicon-calendar"></i>
                </button>
            </span>
            </p>
        </div>
        <div ng-show="tipoFecha == 'rango-fechas'" class="col-xs-12">
            <div class="col-xs-6 fecha-inicio">
                <p class="input-group calendar">
                    <input type             = "text"
                           class                = "form-control"
                           datepicker-popup     = "{[{format}]}"
                           ng-model             = "inicio"
                           is-open              = "dateFrom"
                           show-weeks           = "false"
                           min-date             = "minDate"
                           max-date             = "maxDate"
                           datepicker-options   = "dateOptions"
                           date-disabled        = "disabled(date, mode)"
                           close-text           = "Cerrar"
                           current-text         = "Hoy"
                           clear-text           = "Limpiar"
                            />
                    <span class="input-group-btn">
                        <button type="button"
                                class="btn btn-default"
                                ng-click="open($event, 'dateFrom')">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </p>
            </div>
            <div class="col-xs-6 fecha-fin">
                <p class="input-group calendar">
                    <input type                 = "text"
                           class                = "form-control"
                           datepicker-popup     = "{[{format}]}"
                           ng-model             = "fin"
                           is-open              = "dateTo"
                           min-date             = "inicio"
                           max-date             = "today"
                           show-weeks           = "false"
                           datepicker-options   = "dateOptions"
                           date-disabled        = "disabled(date, mode)"
                           close-text           = "Cerrar"
                           current-text         = "Hoy"
                           clear-text           = "Limpiar"
                            />
                    <span class="input-group-btn">
                        <button type="button"
                                class="btn btn-default"
                                ng-click="open($event, 'dateTo')">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="col-xs-12 mt10">
    <div class="col-xs-4">
        <select ng-model="filtro" class="form-control" ng-change="changeFilter()">
            <option value="">--Filtrar por--</option>
            <option value="roles">Roles</option>
            <option value="municipios">Municipios</option>
            <option value="actividades">Actividades</option>
            <option value="usuario">Usuario</option>
        </select>
    </div>
    <div class="col-xs-8" ng-show="filtro == 'roles'">
        <select select-two  = "select2"
                placeholder = "Selecciona"
                multiple    = "multiple"
                class       = "select2-select"
                selection   = "selectOption.roles"
                ng-model    = "selectOption.roles">
            @foreach(Role::filtro() as $role)
                <option value="{{ $role['id'] }}"> {{ $role['label']  }} </option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-8" ng-show="filtro == 'municipios'">
        <select select-two  = "select2"
                placeholder = "Selecciona"
                multiple    = "multiple"
                class       = "select2-select"
                selection   = "selectOption.municipios"
                ng-model    = "selectOption.municipios">
            @foreach(Municipio::filtro() as $municipio)
                <option value="{{ $municipio['id'] }}"> {{ $municipio['label']  }} </option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-8" ng-show="filtro == 'actividades'">
        <select select-two  = "select2"
                placeholder = "Selecciona"
                multiple    = "multiple"
                class       = "select2-select"
                selection   = "selectOption.actividades"
                ng-model    = "selectOption.actividades">
                <option value="Nuevo usuario"> Nuevo usuario </option>
                <option value="Modificación de usuario"> Modificación de usuario </option>
        </select>
    </div>
    <div class="col-xs-8" ng-show="filtro == 'usuario'">
        <select select-two  = "select2"
                placeholder = "Selecciona"
                multiple    = "multiple"
                class       = "select2-select"
                selection   = "selectOption.usuario"
                ng-model    = "selectOption.usuario">
            @foreach(User::filtroAdmins() as $usuario)
                <option value="{{ $usuario['id'] }}"> {{ $usuario['label']  }} </option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-xs-12 mt10">
    <div class="col-xs-6">
        <button class="btn btn-block btn-success" ng-click="filterRecords()" ng-disabled="isFilterSelect()">
            Filtrar resultados
        </button>
    </div>
    <div class="col-xs-6">
        <button class="btn btn-block btn-warning" ng-click="clearFilter()" ng-disabled="isFilterSelect()">
            Limpiar
        </button>
    </div>
</div>