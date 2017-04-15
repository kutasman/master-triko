@extends('admin.layouts.admin')
@section('page-title', 'Order Statuses')

@section('content')
    <order-statuses :order-statuses="{{ $orderStatuses }}"></order-statuses>
@endsection