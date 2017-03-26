@extends('layouts.app')

@section('content')
    <ul class="list-group">
{{ $cart }}

        @forelse($products as $product)
            <pre>

            {{ $product }}
            </pre>
           {{-- <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-2">
                        {{ HTML::image('storage/' . $product->images->first()['path'], null, ['class' => 'img-thumbnail']) }}


                    </div>
                    <div class="col-xs-8">
                        {{ $product->title }}
                        @forelse($product->cart_modificators as $mod)
                            {{ $mod->name }}:
                            @forelse($mod->options as $option)
                                {{ $option->name }}: {{ $option->value }}
                            @empty
                            @endforelse
                        @empty
                        @endforelse
                    </div>
                </div>
            </li>--}}
        @empty
            <h2>Cart is empty</h2>
        @endforelse

       {{-- @forelse($products as $product)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-2">
                        {{ HTML::image('storage/' . $product->images->first()['path'], null, ['class' => 'img-thumbnail']) }}
                    </div>
                    <div class="col-xs-8">

                    </div>
                </div>
            </li>
        @empty
            <h2>Cart is empty</h2>
        @endforelse
--}}

    </ul>

    @if(!$cart)
    <div class="alert alert-success">
        <h2 class="text-right">Total: {{ $products->sum('price') }}</h2>
    </div>
    @endif

@endsection