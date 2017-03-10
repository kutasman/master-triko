@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">@yield('panel-title')</h3>
        </div>
        <div class="panel-body">
            @yield('panel-body')
        </div>
    </div>


@endsection