<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::model($ticket, ['method' => 'POST', 'route' => ['admin.support.ticket.storeReply', $ticket->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.reply') }}
        </div>
        <div class="modal-body">
            @include('admin.ticket._status_form')

            @include('admin.partials._reply')

            <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.reply'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->