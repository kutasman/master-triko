@extends('admin.layouts.admin')

@section('page-title', 'Product types')
@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Type</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prodTypes as $type)
        <tr>
            <td>{{ HTML::link(route('product-types.show', $type->id), $type->name )}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection