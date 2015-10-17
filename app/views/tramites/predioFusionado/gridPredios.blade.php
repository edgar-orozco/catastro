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
            @foreach($predios as $predio)
            <tr>
                <td>
                    {{$predio->clave}}
                </td>
                <td>
                    {{$predio->cuenta}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop