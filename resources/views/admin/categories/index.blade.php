@extends('admin.layouts.admin')
@section('page-title', 'Categories')

@section('toolbar')
    {{ HTML::link(route('categories.create'), 'Create category', ['class' => 'btn btn-success pull-right']) }}
@endsection

@section('content')
    {{ $categories }}
@endsection