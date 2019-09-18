<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
      {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.manufacturer_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.inactive_for_back_office', ['page' => trans('app.brand')]) }}"></i>
      {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('url', trans('app.form.url')) !!}
      <div class="input-group">
        {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.url')]) !!}
        <span class="input-group-addon" id="basic-addon1" data-toggle="tooltip" data-placement="left" title="{{ trans('help.manufacturer_url') }}"><i class="fa fa-question-circle"></i></span>
      </div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('country_id', trans('app.form.country')) !!}
      {!! Form::select('country_id', $countries , null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.country')]) !!}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('email', trans('app.form.email_address') ) !!}
      <div class="input-group">
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.valid_email')]) !!}
        <span class="input-group-addon" id="basic-addon1" data-toggle="tooltip" data-placement="left" title="{{ trans('help.manufacturer_email') }}"><i class="fa fa-question-circle"></i></span>
      </div>
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('phone', trans('app.form.phone')) !!}
      <div class="input-group">
        {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.phone_number')]) !!}
        <span class="input-group-addon" id="basic-addon1" data-toggle="tooltip" data-placement="left" title="{{ trans('help.manufacturer_phone') }}"><i class="fa fa-question-circle"></i></span>
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('description', trans('app.form.description')) !!}
  {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'placeholder' => trans('app.placeholder.description')]) !!}
</div>

<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('exampleInputFile', trans('app.form.logo'), ['class' => 'with-help']) !!}
      @if(isset($manufacturer) && Storage::exists(optional($manufacturer->logo)->path))
      <label>
        <img src="{{ get_storage_file_url($manufacturer->logo->path, 'small') }}" alt="{{ trans('app.logo') }}">
        <span style="margin-left: 10px;">
          {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_logo') }}
        </span>
      </label>
      @endif
    	<div class="row">
        <div class="col-md-9 nopadding-right">
    			<input id="uploadFile" placeholder="{{ trans('app.placeholder.logo') }}" class="form-control" disabled="disabled" style="height: 28px;" />
            <div class="help-block with-errors">{{ trans('help.logo_img_size') }}</div>
        </div>
        <div class="col-md-3 nopadding-left">
    			<div class="fileUpload btn btn-primary btn-block btn-flat">
    			    <span>{{ trans('app.form.upload') }}</span>
    			    <input type="file" name="image" id="uploadBtn" class="upload" />
    			</div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('exampleInputFile', trans('app.form.cover_img'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.cover_img', ['page' => trans('app.brand')]) }}"></i>
      @if(isset($manufacturer) && Storage::exists(optional($manufacturer->featuredImage)->path))
        <label>
          <img src="{{ get_storage_file_url(optional($manufacturer->featuredImage)->path, 'small') }}" width="" alt="{{ trans('app.cover_image') }}">
          <span style="margin-left: 10px;">
            {!! Form::checkbox('delete_cover_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
          </span>
        </label>
      @endif
      <div class="row">
          <div class="col-md-9 nopadding-right">
            <input id="uploadFile1" placeholder="{{ trans('app.placeholder.cover_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
            <div class="help-block with-errors">{{ trans('help.cover_img_size') }}</div>
          </div>
          <div class="col-md-3 nopadding-left">
            <div class="fileUpload btn btn-primary btn-block btn-flat">
                <span>{{ trans('app.form.upload') }} </span>
                <input type="file" name="cover_image" id="uploadBtn1" class="upload" />
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>