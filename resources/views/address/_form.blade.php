@if((isset($addressable_type) && $addressable_type == 'App\Customer') || (isset($address) && $address->address_type != 'Primary'))
    <div class="form-group">
        {!! Form::label('address_title', trans('app.form.address_title')) !!}
        {!! Form::text('address_title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.address_title')]) !!}
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('address_type', trans('app.form.address_type')) !!}
            @foreach($address_types as $address_type)
              <label class="radio-inline col-md-3 nopadding">
                {!! Form::radio('address_type', $address_type, null, ['class' => 'icheck', 'required']) !!} {{ $address_type }}
              </label>
            @endforeach
            <div class="help-block with-errors"></div>
        </div>
      </div>
    </div>
    <br/>
@endif

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('address_line_1', trans('app.form.address_line_1')) !!}
      {!! Form::text('address_line_1', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.address_line_1')]) !!}
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('address_line_2', trans('app.form.address_line_2')) !!}
      {!! Form::text('address_line_2', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.address_line_2')]) !!}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4 nopadding-right">
    <div class="form-group">
      {!! Form::label('city', trans('app.form.city')) !!}
      {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.city')]) !!}
    </div>
  </div>
  <div class="col-md-4 sm-padding">
    <div class="form-group">
      {!! Form::label('zip_code', trans('app.form.zip_code')) !!}
      {!! Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.zip_code')]) !!}
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('phone', trans('app.form.phone')) !!}
      {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.phone_number')]) !!}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('country_id', trans('app.form.country')) !!}
      {!! Form::select('country_id', $countries , isset($address) ? $address->country_id : config('system_settings.address_default_country'), ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.country')]) !!}
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('state_id', trans('app.form.state')) !!}
      {!! Form::select('state_id', $states , isset($address) ? $address->sate_id : config('system_settings.address_default_state'), ['class' => 'form-control select2-tag', 'placeholder' => trans('app.placeholder.state')]) !!}
    </div>
  </div>
</div>