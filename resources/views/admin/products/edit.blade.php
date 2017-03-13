@extends('admin.layouts.admin')

@section('content')

    <!-- TAB NAVIGATION -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="active"><a href="#general" role="tab" data-toggle="tab">General</a></li>
        <li><a href="#images" role="tab" data-toggle="tab">Images</a></li>
        <li><a href="#attributes" role="tab" data-toggle="tab">Attributes</a></li>
    </ul>
    <!-- TAB CONTENT -->
    <div class="tab-content">
        <div class="active tab-pane fade in" id="general">
            <h2 class="">General</h2>
            <p>
                @include('admin.products._form')
            </p>
        </div>
        <div class="tab-pane fade" id="images">
            <h2>Images</h2>

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
        <div class="tab-pane fade" id="attributes">
            <h2>Attributes</h2>

            <div class="row">
                <div class="col-xs-12 col-sm-8">
                    <ul class="list-group">
                            @foreach($product->attributes as $attribute)
                            <li class="list-group-item">{{ $attribute->name }}, {{ $attribute->description }}</li>
                            @endforeach
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4">
                    {!! BootForm::open(['route' => ['attributes.store', $product->id]]) !!}

                    {!! BootForm::text('name') !!}
                    {!! BootForm::textarea('description') !!}
                    {!! BootForm::select('type_id', 'Type', $attributeTypes) !!}

                    {!! BootForm::submit('Add') !!}
                    {!! BootForm::close() !!}
                </div>
            </div>


            <p>

            </p>
        </div>

    </div>



@endsection