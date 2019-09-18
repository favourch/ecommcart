<div class="form-group">
  {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.order_status_name') }}"></i>
  {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.status_name'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

@unless(isset($orderStatus) && in_array($orderStatus->id, config('system.freeze.order_statuses')))
  <div class="form-group">
    {!! Form::label('fulfilled', trans('app.form.fulfilled').'*', ['class' => 'with-help']) !!}
    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.order_status_fulfilled') }}"></i>
    {!! Form::select('fulfilled', ['1' => trans('app.yes'), '0' => trans('app.no')], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.fulfilled'), 'required']) !!}
    <div class="help-block with-errors"></div>
  </div>
@endunless

<div class="form-group">
  {!! Form::label('color', trans('app.form.color'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.order_status_color') }}"></i>
  <div class="input-group my-colorpicker2 colorpicker-element">
      {!! Form::text('label_color', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.color')]) !!}
    <div class="input-group-addon">
      <i style="background-color: rgb(135, 60, 60);"></i>
    </div>
  </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>