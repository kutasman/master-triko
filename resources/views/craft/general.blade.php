@extends('layouts.craft')

@section('panel-title')
    <span class="badge">1</span> Base parameters
@endsection

@section('panel-body')
    {!! BootForm::open(['route' => 'craft.models']) !!}

    {!! BootForm::select('gender', null, ['male' => 'male', 'female'=>'female']) !!}
    {!! BootForm::select('sport', null, ['powerlifting' => 'powerlifting', 'wrestling' => 'wrestling']) !!}

    {!! BootForm::submit('Next step',['class' => 'btn btn-success pull-right']) !!}

    {!! BootForm::close() !!}
@endsection