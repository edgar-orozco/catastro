@extends('layouts.default')

@section('content')
  <h2>Dashboard</h2><hr>
  Welcome <strong>{{ Auth::user()->name }}</strong>. You have logged in your system.
@stop
