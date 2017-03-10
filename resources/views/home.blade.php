@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <div class="container">
        <h1>Create your perfect trico</h1>
        <p>... just in few steps.</p>
        <p>
            {{ HTML::link(route('craft.general'),'Create perfect trico', ['class' => 'btn btn-primary btn-lg']) }}
        </p>
    </div>
</div>
@endsection
