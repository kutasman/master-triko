@extends('admin.layouts.admin')
@section('page-title', 'Factories')
@section('toolbar')
    {{ HTML::link(route('factories.create'), 'Create factory', ['class' => 'pull-right btn btn-success']) }}
@endsection
@section('content')
    <ul class="list-group">

    @foreach($factories as $factory)

        <li  class="list-group-item">
            {{ HTML::link(route('factories.edit', $factory->id), $factory->name ) }}

            <a href="#" onclick="event.preventDefault();document.getElementById('factory-delete-{{ $factory->id }}').submit();" class="text-danger pull-right">delete</a href="#">
            {!! BootForm::open(['route' => ['factories.destroy', $factory->id], 'method' => 'DELETE', 'id' => 'factory-delete-' . $factory->id ]) !!}
            {!! BootForm::close() !!}
        </li>

    @endforeach
    </ul>


@endsection