@extends('admin.layouts.admin')

@section('content')

    <h2 class="page-header">
        Products
        {{ HTML::link( route('products.create'), 'Create Product', ['class' => 'btn btn-success pull-right']) }}
    </h2>

    <ul class="list-group">
        @forelse($products as $product)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-2">
                        {{ HTML::image('storage/' . $product->images()->first()['path'], null, ['class' => 'img-thumbnail']) }}


                    </div>
                    <div class="col-xs-6">
                        {{ $product->title }}
                    </div>
                    <div class="col-xs-2">
                        {{ HTML::link(route('products.edit', ['id' => $product->id]), 'Edit') }}
                    </div>
                </div>

                {{ $product->title }},
            </li>

        @empty
            <div>Empty here</div>
        @endforelse
    </ul>


@endsection