@extends('admin.layouts.admin')

@section('page-title',  ucfirst($factory->name) . ' factory production')

@section('content')



    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#modificators" role="tab" data-toggle="tab">Modificators</a></li>
        <li><a href="#products" role="tab" data-toggle="tab">Products</a></li>
        <li><a href="#tab3" role="tab" data-toggle="tab">Tab3</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <div class="tab-content">
        <div class="active tab-pane fade in" id="modificators">
            @foreach($factory->modificators as $modificator)
                {{ $modificator->name }} <br>
            @endforeach

            <div class="well-sm">
                @include('admin.modificators._create_form', ['modificable_model' => $factory])
            </div>
        </div>
        <div class="tab-pane fade" id="products">
            <div class="list-group">
                @foreach($factory->products as $product)
                    <a href="{{ route('products.edit', $product->id) }}" class="list-group-item">
                        <h4 class="list-group-item-heading">{{ $product->title }}</h4>
                        <p class="list-group-item-text">{{ $product }}</p>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="tab-pane fade" id="tab3">
            <h2>Tab3</h2>
            <p>Lorem ipsum.</p>
        </div>
    </div>



@endsection