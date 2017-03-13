@extends('admin.layouts.admin')

@section('content')

    <h2 class="page-header">
        Categories
        {{ HTML::link(route('categories.create'), 'Create category', ['class' => 'btn btn-success pull-right']) }}
    </h2>
    {{ $categories }}
@endsection