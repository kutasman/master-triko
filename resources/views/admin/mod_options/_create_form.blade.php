{!! BootForm::horizontal(['route' => ['mod-options.store', $modificator->id]]) !!}
{!! BootForm::text('name') !!}
{!! BootForm::text('value') !!}
{!! BootForm::submit() !!}
{!! BootForm::close() !!}