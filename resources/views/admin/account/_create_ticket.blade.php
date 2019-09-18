<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.account.ticket.store', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8 nopadding-right">
                    <div class="form-group">
                      {!! Form::label('category_id', trans('app.form.ticket_category').'*') !!}
                      {!! Form::select('category_id', $ticket_categories , 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.ticket_categories'), 'required']) !!}
                      <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="col-md-4 nopadding-left">
                    <div class="form-group">
                      {!! Form::label('priority', trans('app.form.priority').'*') !!}
                      {!! Form::select('priority', $priorities , 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.priority'), 'required']) !!}
                      <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            @include('admin.partials._compose_a_message')

            @include('admin.partials._attachment_upload_field')

            <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->