<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::model($address, ['method' => 'PUT', 'route' => ['address.update', $address->id], 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">

            {!! Form::hidden('address_type', $address->address_type) !!}
            {!! Form::hidden('addressable_id', $address->addressable_id) !!}
            {!! Form::hidden('addressable_type', $address->addressable_type) !!}

            @include('address._form')

        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->