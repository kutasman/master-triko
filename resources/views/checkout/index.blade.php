@extends('layouts.app')

@section('content')
    <div class="checkout" id="checkout-container" data-cart="{{ $cart->session }}">
    <checkout :payments="{{ $paymentTypes }}" :shippings="{{ $shippingTypes }}" :cart="{{ $cart }}"></checkout>
    </div>
@endsection