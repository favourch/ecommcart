<div class="form-group">
  	{!! Form::label('customer_list', trans('app.form.search_customer').'*', ['class' => 'with-help']) !!}
  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.search_customer') }}"></i>
	{!! Form::select('customer_list[]', isset($customer_list) ? $customer_list : [], Null, ['id' => 'customer_list_field', 'class' => 'form-control searchCustomer', 'style' =>'width: 100%', 'multiple' => 'multiple']) !!}
  	<div class="help-block with-errors"></div>
</div>