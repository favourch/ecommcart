<div class="modal-dialog modal-sm">
    <div class="modal-content">
        {!! Form::model($order, ['method' => 'PUT', 'route' => ['admin.order.order.fulfill', $order->id], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.fulfill_order') }}
        </div>
        <div class="modal-body">
			<div class="form-group">
			  {!! Form::label('tracking_id', trans('app.form.order_tracking_id'), ['class' => 'with-help']) !!}
			  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.order_tracking_id') }}"></i>
			  {!! Form::text('tracking_id', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.order_tracking_id')]) !!}
			</div>

        	@php
        		$carrier_id = $order->carrier ? $order->carrier->id : ( $order->shippingRate ? optional($order->shippingRate->carrier)->id : Null);
        	@endphp

			<div class="form-group">
			  {!! Form::label('carrier_id', trans('app.form.carrier') . '*', ['class' => 'with-help']) !!}
			  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.order_fulfillment_carrier') }}"></i>
			  {!! Form::select('carrier_id', $carriers, $carrier_id, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.carrier'), 'required']) !!}
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
            {!! Form::submit(trans('app.form.update'), ['class' => 'btn btn-flat btn-new']) !!}
        </div>
        {!! Form::close() !!}
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->