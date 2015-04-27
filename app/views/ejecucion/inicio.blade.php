<?php
error_reporting(E_ERROR | E_WARNING);
setlocale(LC_MONETARY, 'es_MX');
?>
@extends('layouts.default')

@section('title')
    Bienvenido :: @parent
@stop



@section('content')
    <div>
        <div class="panel-default">

            <div class="panel-heading">

                <h3 class="panel-title">Busqueda de Predios</h3>

            </div>

        </div>

        {{ HTML::style('css/style.css') }}
        {{ HTML::style('css/theme.default.css') }}
        {{ HTML::style('js/jquery/jquery-ui.css') }}

        @section('javascript')
            {{ HTML::script('js/jquery/jquery-ui.js') }}
            <script>
                //mostrar  ocultatr vistaa
                function SINO(cual) {
                    var elElemento = document.getElementById(cual);
                    if (elElemento.style.display == 'block') {
                        elElemento.style.display = 'none';
                    } else {
                        elElemento.style.display = 'block';
                    }
                }
                //activar boton los ementos bloquedos
                function validar(obj) {
                    var d = document.formulario;
                    if (obj.checked == true) {
                        d.boton.disabled = false;
                        d.datepicker.disabled = false;
                        d.ejecutores.disabled = false;
                    } else {
                        d.boton.disabled = true;
                        d.datepicker.disabled = true;
                        d.ejecutores.disabled = true;
                    }
                }
            </script>

            <script>
                //actualiza el paginado cuando se cambia el numero de registros a mostrar
                $('#pagi').on('change', function () {
                    $('#paginado').val($('#pagi').val());
                    document.busqueda.submit();
                });
            </script>

            <script>
                //actualiza el paginado cuando se cambia el numero de registros a mostrar
                $('#limpiar').on('click', function () {
                    $('#nombre').val("");
                    $('#clave').val("");
                    $('#mayor').val("");
                    $('#menor').val("");
                    $('#municipio').val("");
                    $('#adeudos').val("");
                });
            </script>
            <script type="text/javascript">
                // funcion para saleccionar todos los registos y desbolquear elementos bloqueados
                $(document).ready(function () {
                    var d = document.formulario;
                    //Checkbox seleccionar todos
                    $("input[name=checktodos]").change(function () {
                        $('input[type=checkbox]').each(function () {
                            if ($("input[name=checktodos]:checked").length == 1) {
                                this.checked = true;
                                d.boton.disabled = false;
                                d.datepicker.disabled = false;
                                d.ejecutores.disabled = false;
                            } else {
                                this.checked = false;
                                d.boton.disabled = true;
                                d.datepicker.disabled = true;
                                d.ejecutores.disabled = true;
                            }
                        });
                    });

                });
            </script>
            <script>
                $(document).ready(function () {
                    $("#clave").keydown(function (event) {
                        if (event.shiftKey) {
                            event.preventDefault();
                        }

                        if (event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 189 || event.keyCode == 109) {
                        }
                        else {
                            if (event.keyCode < 95) {
                                if (event.keyCode < 48 || event.keyCode > 57) {
                                    event.preventDefault();
                                }
                            }
                            else {
                                if (event.keyCode < 96 || event.keyCode > 105) {
                                    event.preventDefault();
                                }
                            }
                        }
                    });
                });

                $(document).ready(function () {
                    $("#mayor").keydown(function (event) {
                        if (event.shiftKey) {
                            event.preventDefault();
                        }

                        if (event.keyCode == 46 || event.keyCode == 8) {
                        }
                        else {
                            if (event.keyCode < 95) {
                                if (event.keyCode < 48 || event.keyCode > 57) {
                                    event.preventDefault();
                                }
                            }
                            else {
                                if (event.keyCode < 96 || event.keyCode > 105) {
                                    event.preventDefault();
                                }
                            }
                        }
                    });
                });
                $(document).ready(function () {
                    $("#menor").keydown(function (event) {
                        if (event.shiftKey) {
                            event.preventDefault();
                        }

                        if (event.keyCode == 46 || event.keyCode == 8) {
                        }
                        else {
                            if (event.keyCode < 95) {
                                if (event.keyCode < 48 || event.keyCode > 57) {
                                    event.preventDefault();
                                }
                            }
                            else {
                                if (event.keyCode < 96 || event.keyCode > 105) {
                                    event.preventDefault();
                                }
                            }
                        }
                    });
                });
                //Calendario
                $(function () {
                    $("#datepicker").datepicker();
                });
                //Cambiar a español el calendario
                $.datepicker.regional['es'] = {
                    closeText: 'Cerrar',
                    prevText: '<Ant',
                    nextText: 'Sig>',
                    currentText: 'Hoy',
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                    weekHeader: 'Sm',
                    dateFormat: 'yy-mm-dd',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: ''
                };
                $.datepicker.setDefaults($.datepicker.regional['es']);
                $(function () {
                    $("#fecha").datepicker();
                });
            </script>

            <script>
                function soloLetras(e) {
                    key = e.keyCode || e.which;
                    tecla = String.fromCharCode(key).toLowerCase();
                    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
                    especiales = [8, 37, 39, 46];

                    tecla_especial = false
                    for (var i in especiales) {
                        if (key == especiales[i]) {
                            tecla_especial = true;
                            break;
                        }
                    }
                    if (letras.indexOf(tecla) == -1 && !tecla_especial)
                        return false;
                }
            </script>

        @stop

        <div class="panel-body">
            {{ Form::open(array(
                'class'  => 'busqueda',
                'role'   => 'form',
                'method' => 'BuscarController@index',
                'method' => 'POST',
                'url'    =>'/ejecucion',
                'name'   =>'busqueda'

             )) }}

            <div class="table">
                <table class="table">
                    <tr>
                        <th>{{Form::label('clave','Clave Catastral:') }}</th>
                        <th>{{Form::label('nombre','Nombre Propietario:') }}</th>
                        <th>{{Form::label('mayor','Mayor a:') }}</th>
                        <th>{{Form::label('menor','Menor a:') }}</th>
                        <th>{{Form::label('municipios','Municipio:') }}</th>
                        <th>{{Form::label('adeudos','Años de Adeudo:') }}</th>
                    </tr>
                    <tr>
                        <td>
                            {{ Form::text('clave',$clave, array('class' => 'form-control focus', 'placeholder'=>'xx-xxx-xxx-xxxx-xxxxxx', 'autofocus'=> 'autofocus', 'pattern'=> '\d{2}[\-]\d{3}[\-]\d{3}[\-]\d{4}[\-]\d{6}'))}}
                        </td>
                        <td>
                            {{ Form::text('nombre',$propietario, array('class' => 'form-control focus', 'placeholder'=>'Nombre', 'onkeypress' => 'return soloLetras(event)')) }}
                            {{ Form::number('paginado',10, array('id'=>'paginado', 'hidden')) }}
                        </td>
                        <td>
                            {{ Form::number('mayor',$mayor, array('class' => 'form-control focus', 'placeholder'=>'Mayor a :'))  }}
                        </td>
                        <td>
                            {{ Form::number('menor',$menor, array('class' => 'form-control focus', 'placeholder'=>'Menor a :'))  }}
                        </td>
                        {{$errors->first("predios")}}
                        <td>
                            <select name="municipios" class="btn btn-default btn-sm dropdown-toggle">
                                <option value=''>Seleccione un municipio...</option>
                                @foreach($municipio as $row)
                                    <option value="{{$row->municipio}}">{{$row->nombre_municipio}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {{Form::select('adeudos', array('1' => '1', '1' => '1', '3' => '3', '4' => '4', '5' => '5'),array('class'=>'btn btn-default btn-sm dropdown-toggle'))}}
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>{{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}</td>
                        <td>{{ Form::button('limpiar', array('class' => 'btn btn-primary', 'id' => 'limpiar')) }} </td>
                    </tr>
                </table>
            </div>
            {{ Form::close() }}
        </div>
        @if(count($items) == 0)
            <div class="panel-body">

                @if(Session::has('mensaje'))

                    <h2>
                        <div class="alert alert-danger">No hubo resultados para la busqueda, Intente de nuevo.</div>
                    </h2>

                @endif
            </div>
        @endif
        @if(count($items) > 0)
            
        @endif
    </div>
@stop
