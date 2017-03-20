{!! BootForm::open(['model' => $product, 'store' => 'products.store', 'update' => 'products.update']) !!}

{!! BootForm::text('title') !!}

{!! BootForm::number('price') !!}

{!! BootForm::text('factory_id') !!}


{!! BootForm::submit('Save', ['value' => 'Save']) !!}

<div class="form-group">
    {!! HTML::link(redirect()->back()->getTargetUrl(), 'Cancel',['class' => 'btn btn-warning']) !!}
</div>

{!! BootForm::close() !!}