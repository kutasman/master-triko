@extends('admin.layouts.admin')

@section('page-title', 'Modificators')


@section('content')

    <ul class="list-group">
        @foreach($modificators as $modificator)

            <li class="list-group-item">{{ $modificator->name }}, {{ $modificator=>type }}</li>

        @endforeach
    </ul>
@endsection