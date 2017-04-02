@extends('layouts.app')


@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><span class="badge">{{ $cart->count() }}</span> items</h3>
    </div>
    <div class="panel-body">
        @foreach($cart->items as $item)
        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
            <div class="thumbnail">
                <img data-src="3"  src="{{ asset('storage/' . $item->imageSrc()) }}" alt="">
                <div class="caption">
                    <h3>{{ $item->data('title') }} <small>{{ $item->data('price') }}</small></h3>
                    <p>
                    <ul class="list-group">
                        @foreach( $item->data('user_modifications')->toArray() as $mod )
                            @include('cart.options._' . $mod->type)
                        @endforeach
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
        </div>
        @endforeach
    </div>
</div>

@endsection