@extends('layouts.app')

@section('content')
    <div class="checkout" id="checkout-container" data-cart="{{ $cart->session }}">
    <checkout></checkout>
    </div>
@endsection