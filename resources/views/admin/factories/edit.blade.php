@extends('admin.layouts.admin')
@section('page-title', 'Edit factory')
@section('content')
    <factory :factory-init="{{ $factory }}"></factory>
@endsection