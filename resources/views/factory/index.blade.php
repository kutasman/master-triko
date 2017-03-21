@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Factory {{ $factory->name }}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-4">
                            <h3>{{ $product->title }}</h3>

                            @foreach($product->images as $image)
                                {{ HTML::image('storage/' . $image->path, null, ['class' => 'img-thumbnail col-xs-3']) }}
                            @endforeach
                        </div>
                        <div class="col-xs-8">
                            {!! BootForm::open(['route' => ['factory', $factory->id], 'id' => 'filter-form']) !!}
                            {!! BootForm::select('model', 'Model', $factory->products->pluck('title', 'id'), $product->id) !!}

                            {!! BootForm::submit() !!}
                            {!! BootForm::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection