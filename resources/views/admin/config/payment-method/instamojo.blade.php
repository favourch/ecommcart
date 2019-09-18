<div class="modal-dialog modal-sm">
  <div class="modal-content">
    {!! Form::model($instamojo, ['method' => 'PUT', 'route' => ['admin.setting.instamojo.update', $instamojo], 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        {{ trans('app.form.config') . ' Instamojo' }}
    </div>
    <div class="modal-body">
        <div class="form-group">
          {!! Form::label('sandbox', trans('app.form.environment') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_payment_environment') }}"></i>
          {!! Form::select('sandbox', ['1' => trans('app.test'), '0' => trans('app.live')], null, ['class' => 'form-control select2-normal', 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('api_key', trans('app.form.instamojo_api_key') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_instamojo_api_key') }}"></i>
          {!! Form::text('api_key', Null, ['class' => 'form-control', 'placeholder' => trans('app.form.instamojo_api_key'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('auth_token', trans('app.form.instamojo_auth_token') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_instamojo_auth_token') }}"></i>
          {!! Form::text('auth_token', Null, ['class' => 'form-control', 'placeholder' => trans('app.form.instamojo_auth_token'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->