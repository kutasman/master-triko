@extends('admin.layouts.admin')

@section('content')

    {{ HTML::link( route('products.create'), 'Create Product') }}

    @forelse($products as $product)
        {{$product}}
    @empty
        <div>Empty here</div>
    @endforelse

@endsection