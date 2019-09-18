<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => ['admin.support.message.draftSend', $message], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            @php
                $customer = $message->customer;
            @endphp

            @include('admin.partials._search_customer')

            @include('admin.partials._compose_a_message')

            @include('admin.message._view_attachments')

            @include('admin.partials._attachment_upload_field')

            <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.save_as_draft'), ['name' => 'draft', 'class' => 'btn btn-flat btn-default']) !!}
            {!! Form::submit(trans('app.form.send'), ['name' => 'sned', 'class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->

