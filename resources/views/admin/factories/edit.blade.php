@extends('admin.layouts.admin')
@section('page-title', 'Edit factory')
@section('content')
    <factory-edit :factory-init="{{ $factory }}"></factory-edit>
@endsection