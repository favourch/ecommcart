<div class="modal-dialog modal-md">
    <div class="modal-content">
        {!! Form::model($paymentMethod, ['method' => 'PUT', 'route' => ['admin.setting.manualPaymentMethod.update', $paymentMethod->code], 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            {{ trans('app.form.config') . ' ' . $paymentMethod->name }}
        </div>
        <div class="modal-body">
            <div class="form-group">
              {!! Form::label('additional_details', trans('app.form.additional_details') . '*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_additional_details') }}"></i>
              {!! Form::textarea('additional_details', $paymentMethod->pivot->additional_details, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.additional_details'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
            <div class="form-group">
              {!! Form::label('payment_instructions', trans('app.form.payment_instructions') . '*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.config_payment_instructions') }}"></i>
              {!! Form::textarea('payment_instructions', $paymentMethod->pivot->payment_instructions, ['class' => 'form-control summernote', 'placeholder' => trans('app.placeholder.payment_instructions'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->