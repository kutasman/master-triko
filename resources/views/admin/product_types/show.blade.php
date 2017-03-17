@extends('admin.layouts.admin')

@section('page-title', $type->slug . ' product type')


@section('content')
    {{ $type }}
@endsection