@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Factory {{ $factory->name }}</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    @if(session('status'))
                        <div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>{{ session('status') }}</strong> <a href="{{ route('cart.show') }}">Go to cart</a>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-xs-4">
                            <h3>{{ $product->title }}</h3>

                            @foreach($product->images as $image)
                                {{ HTML::image('storage/' . $image->path, null, ['class' => 'img-thumbnail col-xs-3']) }}
                            @endforeach
                        </div>
                        <div class="col-xs-8">
                            {!! BootForm::open(['route' => ['factory', $factory->id], 'id' => 'filter-form']) !!}
                            {!! BootForm::select('model', 'Model', $factory->products->pluck('title', 'id'), $product->id,[
                            'onchange' => 'document.getElementById("filter-form").submit()'
                            ]) !!}

                            {!! BootForm::close() !!}

                            {!! BootForm::open(['route' => ['cart.add_item', $product->id] ]) !!}
                                <div class="well">
                                    <h3>Modificators</h3>
                                    @foreach($product->modificators as $mod)
                                        @if('text' == $mod->type)
                                            {!! BootForm::text('modificators['. $mod->type .'][' . $mod->id . ']', $mod->name) !!}
                                        @elseif('select' == $mod->type)
                                            {!! BootForm::select('modificators['.$mod->type.'][' . $mod->id . ']', $mod->name, $mod->options->pluck('name', 'id')) !!}
                                        @endif
                                    @endforeach
                                </div>
                            {!! BootForm::submit('Add to cart', ['class' => 'btn btn-success']) !!}
                            {!! BootForm::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection