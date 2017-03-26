{!! BootForm::horizontal(['route' => ['mod-options.store', $modificator->id]]) !!}
{!! BootForm::text('name') !!}
{!! BootForm::number('rise') !!}
{!! BootForm::submit() !!}
{!! BootForm::close() !!}