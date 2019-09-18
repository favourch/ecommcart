<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.name') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_name') }}"></i>
      {!! Form::text('name', null, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('active', trans('app.form.status') . '*', ['class' => 'with-help']) !!}
      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('code', trans('app.form.code') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_code') }}"></i>
      <div class="input-group code-field">
        {!! Form::text('code', null, ['class' => 'form-control code', 'placeholder' => trans('app.placeholder.code'), isset($coupon) ? 'disabled' : 'required']) !!}
        <span class="input-group-btn">
          <button id="coupon" class="btn btn-lg btn-default generate-code" type="button" {{ isset($coupon) ? 'disabled' : '' }}><i class="fa fa-rocket"></i> Generate</button>
        </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('value', trans('app.form.coupon_value') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_value') }}"></i>
      <div class="input-group">
        {!! Form::number('value' , null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.coupon_value'), 'required']) !!}
        {!! Form::select('type', ['amount' => config('system_settings.currency_symbol') ?: '$', 'percent' => trans('app.percent')], null, ['class' => 'selectpicker']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4 nopadding-right">
    <div class="form-group">
      {!! Form::label('quantity', trans('app.form.coupon_quantity') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_quantity') }}"></i>
      {!! Form::number('quantity' , null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.quantity'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-md-4 nopadding">
    <div class="form-group">
      {!! Form::label('min_order_amount', trans('app.form.coupon_min_order_amount'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_min_order_amount') }}"></i>
      <div class="input-group">
        <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
        {!! Form::number('min_order_amount' , null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.coupon_min_order_amount')]) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('quantity_per_customer', trans('app.form.coupon_quantity_per_customer'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_quantity_per_customer') }}"></i>
      {!! Form::number('quantity_per_customer' , !isset($coupon) ? 1 : null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.coupon_quantity_per_customer')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('description', trans('app.form.description')) !!}
  {!! Form::textarea('description', null, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.description')]) !!}
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      <div class="input-group">
        {!! Form::checkbox('for_limited_shipping_zones', null, (isset($coupon) && $coupon->forLimitedZone()), ['id' => 'for_limited_shipping_zones', 'class' => 'icheckbox_line']) !!}
        {!! Form::label('for_limited_shipping_zones', trans('app.form.limited_to_shipping_zone')) !!}
        <span class="input-group-addon" id="">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_limited_to_shipping_zones') }}"></i>
        </span>
      </div>
    </div>
  </div>

  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      <div class="input-group">
        {!! Form::checkbox('for_limited_customer', null, (isset($coupon) && $coupon->forLimitedCustomer()), ['id' => 'for_limited_customer', 'class' => 'icheckbox_line']) !!}
        {!! Form::label('for_limited_customer', trans('app.form.limited_to_customer')) !!}
        <span class="input-group-addon" id="">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.coupon_limited_to_customers') }}"></i>
        </span>
      </div>
    </div>
  </div>
</div>

<div id="zones_field" class="{{ (isset($coupon) && $coupon->forLimitedZone()) ? 'show' : 'hidden' }}">
    <div class="form-group">
      {!! Form::label('zone_list[]', trans('app.form.shipping_zones').'*', ['class' => 'with-help']) !!}
      {!! Form::select('zone_list[]', $shipping_zones , Null, ['id' => 'zone_list_field', 'class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
      <div class="help-block with-errors"></div>
    </div>
</div>

<div id="customers_field" class="{{ (isset($coupon) && $coupon->forLimitedCustomer()) ? 'show' : 'hidden' }}">

  @include('admin.partials._search_customer_multiple')

</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('starting_time', trans('app.form.starting_time') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.starting_time') }}"></i>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {!! Form::text('starting_time', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.starting_time'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('ending_time', trans('app.form.ending_time') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.ending_time') }}"></i>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {!! Form::text('ending_time', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.ending_time'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>


<p class="help-block">* {{ trans('app.form.required_fields') }}</p>