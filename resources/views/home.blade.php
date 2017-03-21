@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Create your perfect trico</h1>
        <p>... just in few steps.</p>
        <h3>Factories</h3>
        <div class="list-group">
            @foreach($factories as $factory)
                <a href="{{ route('factory', $factory->id) }}" class="list-group-item">{{ $factory->name }}</a>
            @endforeach
        </div>

    </div>
</div>
@endsection
