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
            <h2>General</h2>
            <p>
                @include('admin.products._form')
            </p>
        </div>
        <div class="tab-pane fade" id="images">
            <h2>Images</h2>
            <p>Lorem ipsum.</p>
        </div>
        <div class="tab-pane fade" id="attributes">
            <h2>Attributes</h2>
            <p>
                @foreach($product->attributes as $attribute)
                    {{ $attribute->name }}
                @endforeach
            </p>
        </div>

    </div>



@endsection