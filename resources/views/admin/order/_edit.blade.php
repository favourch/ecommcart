<div class="modal-dialog modal-sm">
    <div class="modal-content">
        {!! Form::model($order, ['method' => 'PUT', 'route' => ['admin.order.order.updateOrderStatus', $order->id], 'id' => 'form', 'data-toggle' => 'validator']) !!}
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        	{{ trans('app.update') }}
        </div>
        <div class="modal-body">
			<div class="form-group">
			  {!! Form::label('order_status_id', trans('app.form.order_status') . '*', ['class' => 'with-help']) !!}
			  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.update_order_status') }}"></i>
			  {!! Form::select('order_status_id', $order_statuses, $order->order_status_id, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.carrier'), 'required']) !!}
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