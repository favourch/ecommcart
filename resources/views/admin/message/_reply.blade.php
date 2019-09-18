<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::model($message, ['method' => 'POST', 'route' => ['admin.support.message.storeReply', $message->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.reply') }}
        </div>
        <div class="modal-body">
            @if($template)
                @include('admin.partials._email_template_id_field')
                @include('admin.partials._attachment_upload_field')
            @else
                @include('admin.partials._reply')
            @endif
            <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.reply'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->