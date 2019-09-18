<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.setting.system.saveEnvFile', 'class' => 'ajax-form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            @if( env('APP_DEMO') == true )
                <div class="alert alert-warning">
                    {{ trans('messages.demo_restriction') }}
                </div>
            @else
                <p class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> {!! trans('messages.modify_environment_file') !!}</p>

                <div class="form-group">
                    {!! Form::label('env', trans('app.form.env_contents')) !!}
                    <textarea class="form-control" name="env" rows="9" style="background-color: #2b303b; color: #c0c5ce">{{ $envContents }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 nopadding-right">
                        <div class="form-group">
                            {!! Form::label('do_action', trans('app.form.type_environment')) !!}
                            {!! Form::text('do_action', null, ['class' => 'form-control', 'required']) !!}
                            <div class="help-block with-errors">{!! trans('help.type_environment') !!}</div>
                        </div>
                    </div>

                    <div class="col-md-6 nopadding-left">
                        <div class="form-group">
                            {!! Form::label('password', trans('app.form.confirm_acc_password')) !!}
                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => trans('app.placeholder.password'), 'data-minlength' => '6', 'required']) !!}
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div><!-- / .row -->
            @endif
        </div>
        <div class="modal-footer">
            @unless( env('APP_DEMO') == true )
                {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-new confirm']) !!}
            @endunless
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->