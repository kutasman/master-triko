@extends('admin.layouts.admin')

@section('page-title', 'Modificators')


@section('content')



    <modificators :modificators-init="{{ $modificators }}"></modificators>


@endsection