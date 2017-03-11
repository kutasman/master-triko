{!! BootForm::open(['model' => $attribute, 'store' => 'attributes.store', 'update' => 'attributes.update']) !!}

{!! BootForm::text('name') !!}
{!! BootForm::textarea('description') !!}
{!! BootForm::select('type', null, ['radio' => 'radio', 'checkbox' => 'checkbox', 'text' => 'text', 'number' => 'number']) !!}

<div class="row">
    <div class="col-xs-6">
        {!! HTML::link(route('attributes.index'), 'Back', ['class' => 'btn btn-default ']) !!}
    </div>
    <div class="col-xs-6">
        {!! BootForm::submit('Save', ['class' => 'pull-right btn btn-primary']) !!}
    </div>
</div>
{!! BootForm::close() !!}