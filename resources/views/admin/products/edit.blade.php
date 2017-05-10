@extends('admin.layouts.admin')


@section('content')


<product :product="{{ $product }}" :factories="{{ $factories }}"></product>
{{--<!-- TAB NAVIGATION -->
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
                                                 document.getElementById("delete-image-form-'.$image->id.'").submit();']) }}

                {!! BootForm::open(['method' => 'delete', 'id' => 'delete-image-form-' . $image->id,'route' => ['products.delete-image', $product->id, $image->id]]) !!}
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
            <div class="col-xs-8">
                    @forelse($product->modificators as $mod)

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    {{ $mod->name }} <span class="label label-default">{{ $mod->type }}</span>
                                    <a href="#" class="pull-right text-danger" onclick="event.preventDefault();document.getElementById('detach-modificator-form-{{ $mod->id }}').submit();">detach</a>
                                    {!! BootForm::open(['id' => 'detach-modificator-form-' . $mod->id, 'method' => 'DELETE', 'route' => ['modificators.detach', $mod->id]]) !!}
                                    {!! BootForm::hidden('modificable_id', $product->id) !!}
                                    {!! BootForm::hidden('modificable_type', $product->getMorphClass()) !!}
                                    {!! BootForm::close() !!}
                                </h3>
                            </div>
                            @if('select' == $mod->type)
                                <ul class="list-group">
                                    @foreach($mod->options as $option)
                                        <li class="list-group-item">
                                            {{ $option->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            @if('select' == $mod->type)
                                <div class="panel-footer">
                                    @include('admin.mod_options._create_form',['modificator' => $mod])
                                </div>
                            @endif
                        </div>

                    @empty
                        nothing here
                    @endforelse
            </div>
            <div class="col-xs-4">

                <h3>Attach modificator</h3>

                {!! BootForm::open(['route' => ['products.add_modificator', $product->id], 'method' => 'PUT']) !!}
                {!! BootForm::checkboxes('modificators[]', 'Factory modificators', $product->factory->modificators->pluck('name', 'id'), $product->modificators->pluck('id')->toArray()) !!}
                {!! BootForm::submit('Add modificator') !!}
                {!! BootForm::close() !!}


                <h3>Create modificator</h3>

                @include('admin.modificators._create_form', ['modificable_model' => $product])

            </div>
        </div>


    </div>


</div>--}}



@endsection