@extends('admin.layouts.admin')

@section('content')

    <h2 class="page-header">
        Products
        {{ HTML::link( route('products.create'), 'Create Product', ['class' => 'btn btn-success pull-right']) }}
    </h2>

    <ul class="list-group">
        @forelse($products as $product)
            <li class="list-group-item">{{ $product->title }}, {!! HTML::link(route('products.edit', ['id' => $product->id]), 'Edit') !!}</li>

        @empty
            <div>Empty here</div>
        @endforelse
    </ul>


@endsection