<div class="form-group">
  {!! Form::label('name', trans('app.form.name') . '*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gift_card_name') }}"></i>
  {!! Form::text('name', null, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.name'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('description', trans('app.form.description')) !!}
  {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => trans('app.placeholder.description')]) !!}
</div>

@unless(isset($giftCard))
<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('pin_code', trans('app.form.pin_code') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gift_card_pin_code') }}"></i>
      <div class="input-group code-field">
        {!! Form::text('pin_code', null, ['class' => 'form-control code', 'placeholder' => trans('app.placeholder.pin_code'), 'required']) !!}
        <span class="input-group-btn">
          <button id="gc-pin-number" class="btn btn-lg btn-default generate-code" type="button"><i class="fa fa-rocket"></i> Generate</button>
        </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('serial_number', trans('app.form.serial_number') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gift_card_serial_number') }}"></i>
      <div class="input-group code-field">
        {!! Form::text('serial_number', null, ['class' => 'form-control code', 'placeholder' => trans('app.placeholder.serial_number'), 'required']) !!}
        <span class="input-group-btn">
          <button id="gc-serial-number" class="btn btn-lg btn-default generate-code" type="button"><i class="fa fa-rocket"></i> Generate</button>
        </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
@endunless

<div class="row">
  <div class="col-md-4 nopadding-right">
    <div class="form-group">
      {!! Form::label('value', trans('app.form.gift_card_value') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gift_card_value') }}"></i>
      <div class="input-group">
        <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
        {!! Form::number('value' , null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.gift_card_value')]) !!}
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>

  <div class="col-md-4 nopadding">
    <div class="form-group">
      {!! Form::label('activation_time', trans('app.form.activation_time') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gift_card_activation_time') }}"></i>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {!! Form::text('activation_time', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.activation_time'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('expiry_time', trans('app.form.expiry_time') . '*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gift_card_expiry_time') }}"></i>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {!! Form::text('expiry_time', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.expiry_time'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4 nopadding-right">
    <div class="form-group">
      <div class="input-group">
        {{ Form::hidden('exclude_tax_n_shipping', 0) }}
        {!! Form::checkbox('exclude_tax_n_shipping', null, null, ['id' => 'exclude_tax_n_shipping', 'class' => 'icheckbox_line']) !!}
        {!! Form::label('exclude_tax_n_shipping', trans('app.form.exclude_tax_n_shipping')) !!}
        <span class="input-group-addon" id="">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.exclude_tax_n_shipping') }}"></i>
        </span>
      </div>
    </div>
  </div>

  <div class="col-md-4 nopadding">
    <div class="form-group">
      <div class="input-group">
        {{ Form::hidden('exclude_offer_items', 0) }}
        {!! Form::checkbox('exclude_offer_items', null, null, ['class' => 'icheckbox_line']) !!}
        {!! Form::label('exclude_offer_items', trans('app.form.exclude_offer_items')) !!}
        <span class="input-group-addon" id="">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.exclude_offer_items') }}"></i>
        </span>
      </div>
    </div>
  </div>

  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      <div class="input-group">
        {{ Form::hidden('partial_use', 0) }}
        {!! Form::checkbox('partial_use', null, null, ['id' => 'partial_use', 'class' => 'icheckbox_line']) !!}
        {!! Form::label('partial_use', trans('app.form.allow_partial_use')) !!}
        <span class="input-group-addon" id="">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gift_card_partial_use') }}"></i>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  <label for="exampleInputFile">{{ trans('app.form.featured_image') }}</label>
  @if(isset($giftCard) && Storage::exists(optional($giftCard->image)->path))
  <label>
    <img src="{{ get_storage_file_url(optional($giftCard->image)->path, 'small') }}" width="" alt="{{ trans('app.featured_image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
    </span>
  </label>
  @endif
  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.placeholder.featured_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
    </div>
    <div class="col-md-3 nopadding-left">
      <div class="fileUpload btn btn-primary btn-block btn-flat">
          <span>{{ trans('app.form.upload') }}</span>
          <input type="file" name="image" id="uploadBtn" class="upload" />
      </div>
    </div>
  </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>