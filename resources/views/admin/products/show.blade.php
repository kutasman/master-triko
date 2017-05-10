@extends('admin.layouts.admin')


@section('content')

    <product :product-init="{{ $product }}" :factories="{{ $factories }}"></product>

@endsection