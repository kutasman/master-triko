{!! BootForm::open(['model' => $factory, 'update' => 'factories.update', 'store' => 'factories.store']) !!}
{!! BootForm::text('name') !!}
{!! BootForm::text('slug') !!}
{!! BootForm::submit() !!}
{!! BootForm::close() !!}