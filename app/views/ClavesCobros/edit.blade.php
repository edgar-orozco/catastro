@extends('layouts.default')

@section('title')

@stop

@section('content')
{{ HTML::style('css/select2.min.css') }}
<style type="text/css">
    .select2-selection__choice span{
        padding-top: 0;
    }
    .select2-container{
        width: 100% !important;
    }
</style>

<div class="row">
    <a href="/Clavescobros" class="btn btn-primary pull-right" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
    <div class="col-md-4">

        {{ Form::model($catalogo, ['url' => array('editarclave'), 'method'=>'GET' ]) }}  
              
        @include('ClavesCobros._form', compact('catalogo'))      

        <div class="form-actions form-group">
            {{ Form::submit('Modificar Clave', array('class' => 'btn btn-primary')) }}
            {{ Form::reset('Cancelar', ['class' => 'btn btn-warning']) }}
        </div>
        {{Form::close()}}

    </div>

    <div class="col-sm-8 col-md-8 col-lg-8">

        @include('ClavesCobros._list')

    </div>
</div>

@stop

@section('javascript')
{{ HTML::script('js/select2/select2.min.js') }}
<script type="text/javascript">
    $(document).ready(function () {
        $(".select2-select").select2({
            placeholder: "Permisos"
        });
        $(".select2-select").val($(".select2-select").data('permission')).trigger("change");
    });
</script>
@stop