@extends('admin.layouts.admin')
@section('page-title', 'Orders')

@section('content')

    <orders :orders="{{ $orders }}"></orders>

@endsection