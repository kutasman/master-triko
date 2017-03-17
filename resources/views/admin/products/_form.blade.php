{!! BootForm::open(['model' => $product, 'store' => 'products.store', 'update' => 'products.update']) !!}

{!! BootForm::text('title') !!}

{!! BootForm::textarea('description') !!}

{!! BootForm::number('price') !!}

{!! BootForm::text('code') !!}

{!! BootForm::select('type_slug', 'Product type', $productTypes, $product->exists ? $product->type_slug : '') !!}

{!! BootForm::submit('Save', ['value' => 'Save']) !!}

<div class="form-group">
    {!! HTML::link(redirect()->back()->getTargetUrl(), 'Cancel',['class' => 'btn btn-warning']) !!}
</div>

{!! BootForm::close() !!}