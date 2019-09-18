<div class="modal-dialog modal-lg">
    <div class="modal-content">
        {!! Form::open(['route' => 'address.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.form') }}
        </div>
        <div class="modal-body">

            @if(isset($addressable_id))
              {!! Form::hidden('addressable_id', $addressable_id) !!}
              {!! Form::hidden('addressable_type', $addressable_type) !!}
            @endif

            @include('address._form')

        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->

