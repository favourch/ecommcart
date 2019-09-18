<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::open(['route' => ['admin.support.ticket.assign', $ticket], 'files' => true, 'id' => 'form', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.reply') }}
        </div>
        <div class="modal-body">
            <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('assigned_to', trans('app.form.assign_to')) !!}
                  {!! Form::select('assigned_to', $users , $ticket->assigned_to, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->

