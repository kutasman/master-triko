@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Create your perfect trico</h1>
        <p>... just in few steps.</p>
        <div class="list-group">
            @foreach($categories as $category)
                <h2>{{ $category->name }}</h2>
                @foreach($category->factories as $factory)
                    <a href="{{ route('factory', $factory->id) }}" class="list-group-item">{{ $factory->name }}</a>
                @endforeach
            @endforeach
        </div>

    </div>
</div>
@endsection
