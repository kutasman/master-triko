@extends('admin.layouts.admin')
@section('page-title', 'Attributes')

@section('toolbar')
    {{ HTML::link(route('attributes.create'), 'Create attribute', ['class' => 'btn btn-success pull-right']) }}
@endsection

@section('content')
    <ul class="list-group">
        @forelse($attributes as $attribute)
            <li class="list-group-item">{{$attribute->name}}, {{ HTML::link(route('attributes.edit', ['id' => $attribute->id]), 'Edit') }}</li>

        @empty
        nothing here
        @endforelse
    </ul>
@endsection