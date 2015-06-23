
@extends('layouts.default')

@section('title')
{{{ $title }}} :: @parent
@stop

@section('content')
{{ Form::open(array('url'=>'admin/notaria')) }}
<div class="row">
    <a class="btn btn-info" href="{{action('admin_notariaController@create')}}" role="button">
        <span class="glyphicon glyphicon-plus"></span> Crear notaria
    </a>
</div>
<br>
<div class="row">
    @include('admin.notaria._list', compact('notaria'))
</div>
@stop
