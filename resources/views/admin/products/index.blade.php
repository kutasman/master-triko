@extends('admin.layouts.admin')

@section('page-title', 'Products')

@section('content')

    <products :products="{{ $products }}"></products>

   {{-- <div class="list-group">
        @foreach($products as $product)
        <a href="{{ route('products.edit', ['id' => $product->id]) }}" class="list-group-item">
            <div class="row">
                <div class="col-xs-2">
                    {{ HTML::image('storage/' . $product->images->first()['path'], null, ['class' => 'img-thumbnail']) }}
                </div>
                <div class="col-xs-10">
                    <h4 class="list-group-item-heading">{{ $product->title }} <small class="badge">{{ $product->code }}</small>
                        <i><small class="text-muted">{{ $product->type_slug }} </small></i>
                    </h4>
                    <p class="list-group-item-text">Content goes here</p>
                </div>
            </div>

        </a>
        @endforeach
    </div>
--}}
@endsection