@extends('layouts.app')


@section('content')

<div class="box">

    <h3 class="title is-3"><span class="badge">{{ $cart->countItems() }}</span> items</h3>

    <div class="container is-fluid">
        @foreach($cart->getAll() as $item)

            <div class="media">
                <div class="media-content">

                    {{ $item['product']['title'] }}
                </div>

            </div>

        {{--<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="thumbnail">
                <img data-src="3"  src="{{ asset('storage/' . $item->imageSrc()) }}" alt="">
                <div class="caption">
                    <h3>{{ $item->data('title') }} <small>{{ $item->data('price') }}</small></h3>
                    <p>
                    <ul class="list-group">
                        @if($item->hasMods())

                        @foreach( $item->data('user_modifications')->toArray() as $mod )
                            @include('cart.options._' . $mod->type)
                        @endforeach

                        @endif
                    </ul>
                    </p>
                    <p>

                        {!! BootForm::open(['route' => ['cart.remove_item', $item], 'method' => 'delete']) !!}

                        {!! BootForm::submit('delete', ['class' => 'btn btn-xs btn-danger']) !!}

                        {!! BootForm::close() !!}
                        <span class="text-success">{{ $item->total() }} грн.</span>
                    </p>
                </div>
            </div>
        </div>--}}
        @endforeach
    </div>
    @if( $cart->hasItems())
        <div class="container is-fluid has-text-centered">
            <a href="{{ route('checkout') }}" class="button is-large is-success">Checkout <span class="tag">{{ 'total' }}</span>грн. </a>
        </div>
    @endif
</div>

@endsection