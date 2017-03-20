@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Create your perfect trico</h1>
        <p>... just in few steps.</p>
            @foreach($factories as $factory)
                <h3>Factories</h3>
            <div class="list-group">
                <a href="{{ route('factory', $factory->id) }}" class="list-group-item">{{ $factory->name }}</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
