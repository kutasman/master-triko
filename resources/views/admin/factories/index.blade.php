@extends('admin.layouts.admin')
@section('page-title', 'Factories')
@section('toolbar')
    {{ HTML::link(route('factories.create'), 'Create factory', ['class' => 'pull-right btn btn-success']) }}
@endsection
@section('content')
    <ul class="list-group">
        @foreach($factories as $factory)

            <li class="list-group-item">{{ $factory->name }}
            </li>
        @endforeach
    </ul>

@endsection