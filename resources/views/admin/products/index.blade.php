@extends('admin.layouts.admin')

@section('page-title', 'Products')

@section('content')

    <products :products-init="{{ $products }}" :factories="{{ $factories }}"></products>

@endsection