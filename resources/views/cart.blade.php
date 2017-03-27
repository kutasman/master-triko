@extends('layouts.app')


@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
        @forelse($products as $index => $product)
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
                        <p><h3 class="text-success">Total: {{ $product->price + $product->cart_modificators->pluck('options')->collapse()->sum('rise') }}</h3></p>
                        <p>

                            <a href="#" class="text-danger" role="button" onclick="event.preventDefault();document.getElementById('remove-cart-item-{{ $index }}' ).submit();">delete</a>

                            {!! BootForm::open(['route' => ['cart.remove_item', $index], 'method'=> 'DELETE', 'id' => 'remove-cart-item-' . $index]) !!}
                            {!! BootForm::close() !!}
                        </p>


                    </div>
                </div>
            </div>
        @empty
            <div class="container-fluid">
                <h2 class="text-info">Cart is empty</h2>
            </div>
        @endforelse
        </div>
    </div>
        @if($products->count())
        <div class="panel-footer">
            <h2 class="text-right text-success">Total: {{ $total }}</h2>
        </div>
    @endif
</div>

@endsection