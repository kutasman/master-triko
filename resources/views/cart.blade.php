@extends('layouts.app')

@section('content')
    <ul class="list-group">
        @forelse($products as $product)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-2">
                        {{ HTML::image('storage/' . $product->images->first()['path'], null,['class' => 'img-thumbnail']) }}
                    </div>
                    <div class="col-xs-8">
                        {{ $product->title }}
                    </div>
                    <div class="col-xs-2">
                        <h2 class="text-success">{{ $product->price }} <small>грн.</small></h2>
                    </div>
                </div>

            </li>



        @empty
            <h2>Cart in empty</h2>
        @endforelse
    </ul>

    <div class="alert alert-success">
        <h2 class="text-right">Total: {{ $products->sum('price') }}</h2>
    </div>

@endsection