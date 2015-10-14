@extends('layouts.hooktramite')
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th>
                Clave
            </th>
            <th>
                Cuenta
            </th>
        </tr>
        </thead>
        <tbody>

           <tr data-pk="1">
                <td>
                    {{Form::input('text','clave[]',null)}}
                </td>
                <td>
                    {{Form::input('text','cuenta[]',null)}}
                </td>
                <td>
                    <button type="button" class="btn btn-warning pull-right borrar-predio" data-pk="1" title="Eliminar datos de predio">
                        <i class="glyphicon glyphicon-trash"></i>
                    </button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <button type="button" class="btn btn-success pull-right agregar-predio">
                        <i class="glyphicon glyphicon-plus-sign"></i>&nbsp; Agregar predio</button>
                </td>
            </tr>
        </tfoot>
    </table>
@stop

@section('javascript')
    <script>



    </script>
@append