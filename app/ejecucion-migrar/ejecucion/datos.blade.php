@extends('layouts.default')

@section('title')
Bienvenido :: @parent
@stop

@section('content')
<div>
    
 
    
    <h1>Uso de suelos </h1>
    @if(Session::has('mensaje'))

    <h2>{{ Session::get('mensaje') }}</h2>

    @endif
   

    <div class="panel-body">

        {{ Form::open(array(
                    'url' => '',
                    'method' => 'POST'
                    ))
        }}

        <div class="input-group">
            {{ Form::text('predios', null, array('class' => 'form-control focus', 'placeholder'=>'Buscar Predios', 'autofocus'=> 'autofocus')) }}
            {{$errors->first("predios")}}
        </div>
        <div class="input-group">
            
        </div>
        <br/>

        {{ Form::submit('Buscar', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
        
    </div>
    
</div>
@stop
