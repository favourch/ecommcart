<div class="form-group">
  {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.subscription_name') }}"></i>
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.subscription_name'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('plan_id', trans('app.form.subscription_plan_id').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.subscription_plan_id') }}"></i>
  {!! Form::text('plan_id', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.subscription_plan_id'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('cost', trans('app.form.cost_per_month').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.subscription_cost') }}"></i>
      <div class="input-group">
        <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
        {!! Form::number('cost', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.subscription_cost'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <label class="with-help">&nbsp;</label>
    <div class="form-group">
      <div class="input-group">
        {{ Form::hidden('featured', 0) }}
        {!! Form::checkbox('featured', null, null, ['id' => 'featured', 'class' => 'icheckbox_line']) !!}
        {!! Form::label('featured', trans('app.form.featured')) !!}
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.featured_subscription') }}"></i>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('team_size', trans('app.form.team_size').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.team_size') }}"></i>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-users"></i></span>
        {!! Form::number('team_size', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.team_size'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('inventory_limit', trans('app.form.inventory_limit').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.inventory_limit') }}"></i>
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
        {!! Form::number('inventory_limit', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.inventory_limit'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('marketplace_commission', trans('app.form.marketplace_commission').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.marketplace_commission') }}"></i>
      <div class="input-group">
        {!! Form::number('marketplace_commission', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.marketplace_commission'), 'required']) !!}
        <span class="input-group-addon">{{ trans('app.percent') }}</span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('transaction_fee', trans('app.form.transaction_fee').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.transaction_fee') }}"></i>
      <div class="input-group">
        <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
        {!! Form::number('transaction_fee', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.transaction_fee'), 'required']) !!}
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('best_for', trans('app.form.best_for'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.subscription_best_for') }}"></i>
  {!! Form::text('best_for', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.subscription_best_for')]) !!}
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>