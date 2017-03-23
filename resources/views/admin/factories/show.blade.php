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

            <div class="row">
                <div class="col-xs-8">
                    @foreach($factory->modificators as $mod)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ $mod->name }}, <small>type: {{ $mod->type }}</small></h3>
                            </div>
                            @if('select' == $mod->type)
                            <ul class="list-group">
                                @forelse($mod->options as $option)
                                    <li class="list-group-item">
                                        {{ $option->name }}, <span class="text-success">+ {{ $option->value }}</span>
                                    </li>
                                @empty
                                    nothing here
                                @endforelse
                            </ul>
                            <div class="panel-footer">
                                <h4>Add option</h4>
                                @include('admin.mod_options._create_form', ['modificator' => $mod])
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="col-xs-4">
                    <h3>Create modificator</h3>
                    @include('admin.modificators._create_form', ['modificable_model' => $factory])
                </div>
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