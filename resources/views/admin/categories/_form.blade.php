{!! BootForm::open(['model' => $category, 'store' => 'categories.store', 'update' => 'categories.update']) !!}

{!! BootForm::text('name') !!}
{!! BootForm::textarea('description') !!}

{!! BootForm::submit('Save') !!}

{!! BootForm::close() !!}