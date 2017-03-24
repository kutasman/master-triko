@extends('admin.layouts.admin')

@section('page-title', 'Modificators')


@section('content')



        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Factory</th>
                <th>Product</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($modificators as $mod)
                <tr>
                    <td>{{ $mod->factories->pluck('name') }}</td>
                    <td>{{ $mod->products->pluck('title') }}</td>
                    <td>{{ $mod->name }}</td>
                    <td>
                        {!! BootForm::open(['route' => ['modificators.destroy',$mod->id], 'method' => 'DELETE']) !!}
                        {!! BootForm::submit('delete',['btn btn-link']) !!}
                        {!! BootForm::close() !!}
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
@endsection