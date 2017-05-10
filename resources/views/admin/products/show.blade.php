@extends('admin.layouts.admin')


@section('content')

    <product :product="{{ $product }}" :factories="{{ $factories }}"></product>

@endsection