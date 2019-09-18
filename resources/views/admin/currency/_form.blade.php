<div class="row">
  <div class="col-sm-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-sm-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('symbol', trans('app.form.symbol').'*', ['class' => 'with-help']) !!}
      {!! Form::text('symbol', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.symbol'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('iso_code', trans('app.form.iso_code').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.currency_iso_code') }}"></i>
      {!! Form::text('iso_code', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.iso_code'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-sm-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('subunit', trans('app.form.subunit').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.currency_subunit') }}"></i>
      {!! Form::text('subunit', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.subunit'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-4 nopadding-right">
    <div class="form-group">
      {!! Form::label('symbol_first', trans('app.form.symbol_first').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.currency_symbol_first') }}"></i>
      {!! Form::select('symbol_first', ['1' => trans('app.yes'), '0' => trans('app.no')], isset($currency) ? null : 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select')]) !!}
    </div>
  </div>

  <div class="col-sm-4 nopadding">
    <div class="form-group">
      {!! Form::label('thousands_separator', trans('app.form.thousands_separator').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.currency_thousands_separator') }}"></i>
      {!! Form::select('thousands_separator', [',' => ',', '.' => '.', ' ' => 'Space(&nbsp;)'], Null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-sm-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('decimal_mark', trans('app.form.decimal_mark').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.currency_decimalpoint') }}"></i>
      {!! Form::select('decimal_mark', [',' => ',', '.' => '.'], Null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>