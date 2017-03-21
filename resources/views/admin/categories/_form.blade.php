{!! BootForm::open(['model' => $category, 'store' => 'categories.store', 'update' => 'categories.update']) !!}

{!! BootForm::text('name') !!}
{!! BootForm::textarea('description') !!}
{!! BootForm::select('parent_id', 'Parent category', $categories->pluck('name', 'id')->prepend('top level',null), $category->parent_id) !!}

{!! BootForm::submit('Save') !!}

{!! BootForm::close() !!}