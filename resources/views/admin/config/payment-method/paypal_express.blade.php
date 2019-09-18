<div class="modal-dialog modal-sm">
  <div class="modal-content">
    {!! Form::model($paypalExpress, ['method' => 'PUT', 'route' => ['admin.setting.paypalExpress.update', $paypalExpress], 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        {{ trans('app.form.config') . ' PayPal Express' }}
    </div>
    <div class="modal-body">
        <div class="form-group">
          {!! Form::label('sandbox', trans('app.form.environment') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_payment_environment') }}"></i>
          {!! Form::select('sandbox', ['1' => trans('app.test'), '0' => trans('app.live')], null, ['class' => 'form-control select2-normal', 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('account', trans('app.form.paypal_express_account') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_paypal_express_account') }}"></i>
          {!! Form::text('account', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.paypal_express_account'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('client_id', trans('app.form.paypal_express_client_id') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_paypal_express_client_id') }}"></i>
          {!! Form::text('client_id', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.paypal_express_client_id'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('secret', trans('app.form.paypal_express_secret') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_paypal_express_secret') }}"></i>
          {!! Form::text('secret', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.paypal_express_secret'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->