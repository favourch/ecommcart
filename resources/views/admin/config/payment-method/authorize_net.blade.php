<div class="modal-dialog modal-sm">
  <div class="modal-content">
    {!! Form::model($authorizeNet, ['method' => 'PUT', 'route' => ['admin.setting.authorizeNet.update', $authorizeNet], 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        {{ trans('app.form.config') . ' Authorize Net' }}
    </div>
    <div class="modal-body">
        <div class="form-group">
          {!! Form::label('sandbox', trans('app.form.environment') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_payment_environment') }}"></i>
          {!! Form::select('sandbox', ['1' => trans('app.test'), '0' => trans('app.live')], null, ['class' => 'form-control select2-normal', 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('api_login_id', trans('app.form.authorize_net_api_login_id') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_authorize_net_api_login_id') }}"></i>
          {!! Form::text('api_login_id', Null, ['class' => 'form-control', 'placeholder' => trans('app.form.authorize_net_api_login_id'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('transaction_key', trans('app.form.authorize_net_transaction_key') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_authorize_net_transaction_key') }}"></i>
          {!! Form::text('transaction_key', Null, ['class' => 'form-control', 'placeholder' => trans('app.form.authorize_net_transaction_key'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->