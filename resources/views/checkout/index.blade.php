@extends('layouts.app')

@section('content')
    <div class="checkout box">
    <checkout :payments="{{ $paymentTypes }}" :shippings="{{ $shippingTypes }}" :cart="{{ $cart }}"></checkout>
    </div>
@endsection