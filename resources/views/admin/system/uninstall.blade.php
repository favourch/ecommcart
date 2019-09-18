<div class="modal-dialog modal-sm">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.setting.license.reset', 'class' => 'ajax-form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            <div class="form-group">
              {!! Form::label('do_action', trans('app.form.type_uninstall')) !!}
              {!! Form::text('do_action', null, ['class' => 'form-control', 'required']) !!}
              <div class="help-block with-errors">{!! trans('help.type_uninstall') !!}</div>
            </div>

            <div class="form-group">
                {!! Form::label('password', trans('app.form.confirm_acc_password')) !!}
                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => trans('app.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>

            <p class="text-danger"><i class="fa fa-exclamation-triangle"></i> {!! trans('messages.uninstall_app_license') !!}</p>

        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.uninstall'), ['class' => 'btn btn-flat btn-new confirm']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->