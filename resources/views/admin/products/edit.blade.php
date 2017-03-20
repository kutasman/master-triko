@extends('admin.layouts.admin')

@section('page-title', $product->title)

@section('page-title-subtext', $product->code)

@section('content')

<!-- TAB NAVIGATION -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#general" role="tab" data-toggle="tab">General</a></li>
    <li><a href="#images" role="tab" data-toggle="tab">Images</a></li>
    <li><a href="#properties" role="tab" data-toggle="tab">Properties</a></li>
    <li><a href="#modificators" role="tab" data-toggle="tab">Modificators</a></li>
</ul>
<!-- TAB CONTENT -->
<div class="tab-content">
    <div class="active tab-pane fade in" id="general">
        <p>
            @include('admin.products._form')
        </p>
    </div>
    <div class="tab-pane fade" id="images">
        <p>
        <div class="row">
        <div class="col-xs-12 col-sm-8">
            @foreach($product->images as $image)
                {!! HTML::image('storage/' .$image->path, null, ['class' => 'thumbnail col-xs-12 col-sm-4']) !!}

                {{ HTML::link('#', 'Delete',['onclick' => 'event.preventDefault();
                                                 document.getElementById("delete-image-form").submit();']) }}

                {!! BootForm::open(['method' => 'delete', 'id' => 'delete-image-form','route' => ['products.delete-image', $product->id, $image->id]]) !!}

                {!! BootForm::close() !!}
            @endforeach
        </div>
        <div class="col-xs-12 col-sm-4">
            {!! BootForm::open(['route' => ['products.add_image', $product->id], 'files' => true ]) !!}

            {!! BootForm::file('image') !!}

            {!! BootForm::submit('Add image', ['class' => 'btn btn-success pull-right']) !!}
            {!! BootForm::close() !!}
        </div>
        </div>
        </p>
    </div>
    <div class="tab-pane fade" id="properties">
    <p>
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                <ul class="list-group">

                </ul>
            </div>
            <div class="col-xs-12 col-sm-4">

            </div>
        </div>
    </p>
    </div>
    <div class="tab-pane fade" id="modificators">

        <div class="row">

        </div>


    </div>


</div>



@endsection