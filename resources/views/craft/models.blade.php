@extends('layouts.factory')

@section('panel-title')
    <span class="badge">2</span> Choose model
@endsection

@section('panel-body')
    @foreach($items as $item)
        {{ $item }}
    @endforeach
@endsection