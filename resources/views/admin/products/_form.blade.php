{!! BootForm::open(['model' => $product, 'store' => 'products.store', 'update' => 'products.update']) !!}

{!! BootForm::text('title') !!}

{!! BootForm::textarea('description') !!}

{!! BootForm::select('categories[]', 'Categories', $categories, $product->categories->pluck('id')->toArray(), ['multiple']) !!}

{!! BootForm::number('price') !!}

{!! BootForm::submit('Save', ['value' => 'Save']) !!}

<div class="form-group">
    {!! HTML::link(redirect()->back()->getTargetUrl(), 'Cancel',['class' => 'btn btn-warning']) !!}
</div>

{!! BootForm::close() !!}