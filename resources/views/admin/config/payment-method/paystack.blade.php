<div class="modal-dialog modal-sm">
  <div class="modal-content">
    {!! Form::model($paystack, ['method' => 'PUT', 'route' => ['admin.setting.paystack.update', $paystack], 'id' => 'form', 'data-toggle' => 'validator']) !!}
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        {{ trans('app.form.config') . ' Paystack' }}
    </div>
    <div class="modal-body">
        <div class="form-group">
          {!! Form::label('sandbox', trans('app.form.environment') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_payment_environment') }}"></i>
          {!! Form::select('sandbox', ['1' => trans('app.test'), '0' => trans('app.live')], null, ['class' => 'form-control select2-normal', 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('merchant_email', trans('app.form.merchant_email') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_paystack_merchant_email') }}"></i>
          {!! Form::text('merchant_email', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.merchant_email'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('public_key', trans('app.form.public_key') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_paystack_public_key') }}"></i>
          {!! Form::text('public_key', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.public_key'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <div class="form-group">
          {!! Form::label('secret', trans('app.form.secret') . '*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_paystack_secret') }}"></i>
          {!! Form::text('secret', Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.secret'), 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="modal-footer">
        {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
    </div>
    {!! Form::close() !!}
  </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->