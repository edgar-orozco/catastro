@if(Session::has('error'))
    <div class="alert alert-danger">
        @if(is_array(Session::get('error')))
            @foreach(Session::get('error') as $error )
                <h4><span class="glyphicon glyphicon-remove"></span>  {{ $error }}</h4>
            @endforeach
        @else
            <h4><span class="glyphicon glyphicon-remove"></span>  {{ Session::get('error') }}</h4>
        @endif
    </div>
@endif

@if (Session::get('notice'))
    <div class="alert alert-notice">
        <h4><span class="glyphicon glyphicon-info-sign"></span>  {{ Session::get('notice') }}</h4>
    </div>
@endif

@if (Session::get('success'))
    <div class="alert alert-success">
        <h4><span class="glyphicon glyphicon-ok"></span>  {{ Session::get('success') }}</h4>
    </div>
@endif
