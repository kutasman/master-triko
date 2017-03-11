@extends('admin.layouts.admin')


@section('content')
    <h2 class="page-header">
        Attributes
        {{ HTML::link(route('attributes.create'), 'Create attribute', ['class' => 'btn btn-success pull-right']) }}

    </h2>


    <ul class="list-group">
        @forelse($attributes as $attribute)
            <li class="list-group-item">{{$attribute->name}}, {{ HTML::link(route('attributes.edit', ['id' => $attribute->id]), 'Edit') }}</li>

        @empty
        nothing here
        @endforelse
    </ul>
@endsection