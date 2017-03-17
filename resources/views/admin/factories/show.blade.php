@extends('admin.layouts.admin')

@section('page-title',  ucfirst($factory->name) . ' factory production')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Models</h3>
        </div>
        <div class="panel-body">
            <div class="list-group">
                @foreach($factory->models as $model)
                <a href="{{ route('models.edit', $model->id) }}" class="list-group-item">
                    <h4 class="list-group-item-heading">{{ $model->name }}</h4>
                    <p class="list-group-item-text">{{ $model }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>


@endsection