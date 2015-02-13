@extends('layouts.default')
@section('content')
<div id="PeopleTableContainer" style="width: 800px;"></div>
<script type="text/javascript">

    $(document).ready(function () {
        //Prepare jTable
        $('#PeopleTableContainer').jtable({
            title: 'Instalaciones Especiales',
            paging: true,
            sorting: true,
            actions: {
                listAction: 'getData/list',
                createAction: 'getData/create',
                updateAction: 'getData/update',
                deleteAction: 'getData/delete',
            },
            fields: {
                gid_construccion: {
                    key: true,
                    create: false,
                    edit: false,
                    title: 'Id',
                    width: '40%',
                    list: true
                },
                clave: {
                    title: 'Clave',
                    width: '40%'
                },
                uso_construccion: {
                    title: 'Uso',
                    width: '20%'
                },
                sup_const: {
                    title: 'Superficie',
                    width: '20%'
                },
                fecha_ingr: {
                    title: 'Fecha Ingreso',
                    width: '50%',
                    type: 'date',
                    create: false,
                    edit: false
                },
                fecha_umod: {
                    title: 'Fecha Modificacion',
                    width: '50%',
                    type: 'date',
                    create: false,
                    edit: false
                },
                geom: {
                    title: 'Geom',
                    width: '20%'
                },
            }
        });

        //Load person list from server
        $('#PeopleTableContainer').jtable('load');

    });

</script>
<!--        <h1>Si llega</h1>-->
@stop