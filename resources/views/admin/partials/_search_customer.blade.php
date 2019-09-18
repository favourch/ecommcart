<div class="form-group">
  	{!! Form::label('customer_id', trans('app.form.search_customer').'*', ['class' => 'with-help']) !!}
  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="{{ trans('help.search_customer') }}"></i>
	{!! Form::select('customer_id', isset($customer) ? [ $customer->id => $customer->name . ' | ' . $customer->email ] : [], isset($customer) ? $customer->id : Null, ['class' => 'form-control searchCustomer', 'style' =>'width: 100%', 'required']) !!}
  	<div class="help-block with-errors"></div>
</div>