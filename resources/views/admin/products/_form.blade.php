{!! BootForm::open(['model' => $product, 'store' => 'products.store', 'update' => 'products.update']) !!}

{!! BootForm::text('title') !!}

{!! BootForm::number('price') !!}

{!! BootForm::select('factory_id', 'Factory', $factories->pluck('name', 'id'), $product->factory_id) !!}

{!! BootForm::submit('Save', ['value' => 'Save']) !!}

<div class="form-group">
    {!! HTML::link(redirect()->back()->getTargetUrl(), 'Cancel',['class' => 'btn btn-warning']) !!}
</div>

{!! BootForm::close() !!}