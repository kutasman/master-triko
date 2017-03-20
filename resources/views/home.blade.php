@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Create your perfect trico</h1>
        <p>... just in few steps.</p>
        <p>
            @foreach($productTypes as $productType)
                {{ HTML::link('#', $productType->name) }}
            @endforeach
        </p>
    </div>
</div>
@endsection
