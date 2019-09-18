<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.packaging_name').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.packaging_name') }}"></i>
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.packaging_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('active', trans('app.form.status').'*',  ['class' => 'with-help']) !!}
      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], isset($packaging) ? null : 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-4 col-xs-12 nopadding-right">
    <div class="form-group">
        {!! Form::label('width', trans('app.form.width').'*', ['class' => 'with-help']) !!}
        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.width') }}"></i>
        <div class="input-group">
          {!! Form::number('width', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.width'), 'required']) !!}
          <span class="input-group-addon">{{ config('system_settings.length_unit') ?: 'cm' }}</span>
        </div>
        <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-sm-4 col-xs-12 nopadding">
    <div class="form-group">
      {!! Form::label('height', trans('app.form.height').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.height') }}"></i>
      <div class="input-group">
        {!! Form::number('height', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.height'), 'required']) !!}
        <span class="input-group-addon">{{ config('system_settings.length_unit') ?: 'cm' }}</span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>

  <div class="col-sm-4 col-xs-12 nopadding-left">
    <div class="form-group">
      {!! Form::label('depth', trans('app.form.depth').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.depth') }}"></i>
      <div class="input-group">
        {!! Form::number('depth', isset($packaging) ? null : 0, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.depth'), 'required']) !!}
        <span class="input-group-addon">{{ config('system_settings.length_unit') ?: 'cm' }}</span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('cost', trans('app.form.cost'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.packaging_cost') }}"></i>
      <div class="input-group">
        <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
        {!! Form::number('cost', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.packaging_cost')]) !!}
      </div>
    </div>
  </div>

  <div class="col-sm-6 nopadding-left">
    <label class="with-help">&nbsp;</label>
    <div class="form-group">
      <div class="input-group">
        {{ Form::hidden('default', 0) }}
        {!! Form::checkbox('default', null, null, ['id' => 'default', 'class' => 'icheckbox_line']) !!}
        {!! Form::label('default', trans('app.form.set_as_default_packaging')) !!}
        <span class="input-group-addon" id="basic-addon1">
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.set_as_default_packaging') }}"></i>
        </span>
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('exampleInputFile', trans('app.form.image')) !!}
  @if(isset($packaging) && $packaging->image)
  <label>
    <img src="{{ get_storage_file_url($packaging->image->path, 'small') }}" alt="{{ trans('app.image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
    </span>
  </label>
  @endif
  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.placeholder.image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
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