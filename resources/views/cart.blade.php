@extends('layouts.app')

@section('content')
{{ $cart }}
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
        @forelse($products as $product)
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    {{ HTML::image('storage/' . $product->images->first()['path'], null) }}

                    <div class="caption">
                        <h3>{{ $product->title }}, <span class="text-success">{{ $product->price }} грн.</span> </h3>
                        <p>
                            @forelse($product->cart_modificators as $mod)
                                {{ $mod->name }}:
                                @if('text' != $mod->type)
                                    @foreach($mod->options as $option)
                                        {{ $option->name }}
                                    @endforeach
                                @else
                                    {{ $mod->value }}
                                @endif
                                <br/>
                            @empty

                            @endforelse
                        </p>
                        <p>
                            <a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a>
                            <span class="pull-right text-success">Total: {{ $product->price }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <h2>Cart is empty</h2>
        @endforelse
                    </div>
                </div>
                <div class="panel-footer">
                    @if($products->count())
                            <h2 class="text-right text-success">Total: {{ $products->sum('price') }}</h2>
                    @endif

                </div>
            </div>

@endsection