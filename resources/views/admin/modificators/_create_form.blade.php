{!! BootForm::open(['route' => ['modificators.store']]) !!}


{!! BootForm::select('type', null, ['text'=> 'text', 'select' => 'select']) !!}
{!! BootForm::text('name') !!}
{!! BootForm::hidden('modificable_id', $modificable_model->id) !!}
{!! BootForm::hidden('modificable_type', $modificable_model->getMorphClass()) !!}

{!! BootForm::submit('Create modificator') !!}
{!! BootForm::close() !!}