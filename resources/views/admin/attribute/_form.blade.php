<div class="form-group">
  {!! Form::label('attribute_type_id', trans('app.form.attribute_type').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_type') }}"></i>
  {!! Form::select('attribute_type_id', $typeList , null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.attribute_type'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.attribute_name').'*') !!}
      <div class="input-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.attribute_name'), 'required']) !!}
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_name') }}"></i>
        </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('order', trans('app.form.list_order')) !!}
      <div class="input-group">
        {!! Form::number('order', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.list_order')]) !!}
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.list_order') }}"></i>
        </span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>