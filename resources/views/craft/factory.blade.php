@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Panel title</h3>
        </div>
        <div class="panel-body">
            {{ $product->meta }}

            {!! BootForm::open(['route' => ['craft.factory', $productType->slug]]) !!}

            {!! BootForm::select('gender', null, ['male' => 'male', 'female' => 'female'], $product->meta->gender) !!}
            {!! BootForm::select('sport', null, ['powerlifting' => 'powerlifting', 'wrestling' => 'wrestling'], $product->meta->sport) !!}

            {!! BootForm::submit() !!}
            {!! BootForm::close() !!}
        </div>
    </div>


@endsection