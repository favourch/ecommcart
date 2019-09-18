<div class="modal-dialog modal-md">
    <div class="modal-content">
    	{!! Form::open(['route' => 'admin.support.refund.initiate', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.form.form') }}
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-8 nopadding-right">
                    <div class="form-group">
                        @if(isset($order))
                          {!! Form::hidden('order_id', $order->id) !!}
                          {!! Form::label('', trans('app.form.order_number').'*', ['class' => 'with-help']) !!}
                          {!! Form::text('', $order->order_number, ['class' => 'form-control', 'disabled']) !!}
                        @else
                          {!! Form::label('order_id', trans('app.form.select_refund_order').'*', ['class' => 'with-help']) !!}
                          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.refund_select_order') }}"></i>
                          {!! Form::select('order_id', $orders , Null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
                          <div class="help-block with-errors"></div>
                        @endif
                    </div>
                </div>
                <div class="col-md-4 nopadding-left">
                    <div class="form-group">
                      {!! Form::label('status', trans('app.form.status').'*', ['class' => 'with-help']) !!}
                      {!! Form::select('status', $statuses , 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
                      <div class="help-block with-errors"></div>
                    </div>
                </div>
            </div>

            @if(is_int($order) && $order->refunds->count())
              <fieldset class="collapsible collapsed">
                <legend>{{ trans('app.previous_refunds') }} </legend>
                <table class="table table-border">
                  <tbody>
                    @foreach($order->refunds as $refund )
                      <tr>
                        <td>{{ $refund->created_at->diffForHumans() }}</td>
                        <td>{{ get_formated_currency($refund->amount) }}</td>
                        <td>{!! $refund->statusName() !!}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </fieldset>
              <div class="spacer30"></div>
            @endif

            <div class="form-group">
                {!! Form::label('amount', trans('app.form.refund_amount') . '*') !!}
                <div class="input-group">
                    <span class="input-group-addon">
                        {{ config('system_settings.currency_symbol') ?: '$' }}
                    </span>
                    {!! Form::number('amount' , null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.refund_amount'), 'required']) !!}
                </div>
                <div class="help-block with-errors">
                  @if(isset($order))
                    @php
                      $refunded_amt = $order->refundedSum();
                    @endphp

                    @if($refunded_amt > 0)
                      <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4><i class="fa fa-warning"></i> {{ trans('app.alert') }}!</h4>
                        {!! trans('help.order_refunded', ['amount' => get_formated_currency($refunded_amt), 'total' => get_formated_currency($order->grand_total)]) !!}
                      </div>
                    @else
                      {!! trans('help.customer_paid', ['amount' => get_formated_currency($order->grand_total)]) !!}
                    @endif
                  @endif
                </div>
            </div>

            <div class="row">
              <div class="col-md-6 nopadding-right">
                <div class="form-group">
                  <div class="input-group">
                    {{ Form::hidden('return_goods', 0) }}
                    {!! Form::checkbox('return_goods', null, null, ['class' => 'icheckbox_line']) !!}
                    {!! Form::label('return_goods', trans('app.form.return_goods')) !!}
                    <span class="input-group-addon" id="">
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.refund_return_goods') }}"></i>
                    </span>
                  </div>
                </div>
              </div>

              <div class="col-md-6 nopadding-left">
                <div class="form-group">
                  <div class="input-group">
                    {{ Form::hidden('order_fulfilled', 0) }}
                    @if(isset($order))
                      {!! Form::checkbox('order_fulfilled', null, $order->isFulfilled() ? 1 : Null, ['class' => 'icheckbox_line', 'disabled']) !!}
                    @else
                      {!! Form::checkbox('order_fulfilled', null, Null, ['class' => 'icheckbox_line']) !!}
                    @endif
                    {!! Form::label('order_fulfilled', trans('app.form.order_fulfilled')) !!}
                    <span class="input-group-addon" id="">
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.refund_order_fulfilled') }}"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('description', trans('app.form.description')) !!}
              {!! Form::textarea('description', null, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.description')]) !!}
              <div class="help-block with-errors"></div>
            </div>

            <small>
              {!! Form::checkbox('notify_customer', 1, null, ['class' => 'icheck', 'checked']) !!}
              {!! Form::label('notify_customer', strtoupper(trans('app.notify_customer')), ['class' => 'indent5']) !!}
              <i class="fa fa-question-circle indent5" data-toggle="tooltip" data-placement="top" title="{{ trans('help.notify_customer') }}"></i>
            </small>

            <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        </div>
        <div class="modal-footer">
            {!! Form::submit(trans('app.form.initiate'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->