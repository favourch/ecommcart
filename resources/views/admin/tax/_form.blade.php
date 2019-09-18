<div class="form-group">
  {!! Form::label('name', trans('app.form.name').'*') !!}
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.supplier_name'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('taxrate', trans('app.form.taxrate').'*') !!}
      <div class="input-group">
        {!! Form::number('taxrate', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.tax_rate'), 'required']) !!}
        <span class="input-group-addon"> % </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('active', trans('app.form.status').'*') !!}
      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('country_id', trans('app.form.country').'*') !!}
      {!! Form::select('country_id', $countries , isset($tax) ? $tax->country_id : config('system_settings.address_default_country'), ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.country'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('state_id', trans('app.form.state')) !!}
      {!! Form::select('state_id', $states , isset($tax) ? $tax->state_id : config('system_settings.address_default_state'), ['class' => 'form-control select2-tag', 'placeholder' => trans('app.placeholder.state')]) !!}
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>