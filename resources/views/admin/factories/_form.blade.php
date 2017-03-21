{!! BootForm::open(['model' => $factory, 'update' => 'factories.update', 'store' => 'factories.store']) !!}
{!! BootForm::text('name') !!}
{!! BootForm::text('slug') !!}
{!! BootForm::select('categories[]', 'Categories', $categories->pluck('name', 'id'), $factory->categories->pluck('id'), ['multiple']) !!}
{!! BootForm::submit() !!}
{!! BootForm::close() !!}