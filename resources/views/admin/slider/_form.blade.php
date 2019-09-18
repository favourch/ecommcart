<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('title', trans('app.form.title'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slider_title') }}"></i>
      {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.title')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('title_color', trans('app.form.text_color'), ['class' => 'with-help']) !!}
      <div class="input-group my-colorpicker2 colorpicker-element">
          {!! Form::text('title_color', isset($slider) ? Null : '#333333', ['class' => 'form-control', 'placeholder' => trans('app.placeholder.color')]) !!}
        <div class="input-group-addon">
          <i style="background-color: rgb(51, 51, 51);"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('sub_title', trans('app.form.sub_title'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slider_sub_title') }}"></i>
      {!! Form::text('sub_title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.sub_title')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('sub_title_color', trans('app.form.text_color'), ['class' => 'with-help']) !!}
      <div class="input-group my-colorpicker2 colorpicker-element">
          {!! Form::text('sub_title_color', isset($slider) ? Null : '#b5b5b5', ['class' => 'form-control', 'placeholder' => trans('app.placeholder.color')]) !!}
        <div class="input-group-addon">
          <i style="background-color: rgb(181, 181, 181);"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('link', trans('app.form.link'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slider_link') }}"></i>
      {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.link')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('order', trans('app.form.position'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slider_order') }}"></i>
      {!! Form::number('order' , null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.position')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="form-group">
      <label for="exampleInputFile" class="with-help"> {{ trans('app.slider_image') . '*' }}</label>
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slider_image') }}"></i>
      @if(isset($slider) && Storage::exists(optional($slider->featuredImage)->path))
        <img src="{{ get_storage_file_url(optional($slider->featuredImage)->path, 'medium') }}" width="50%" alt="{{ trans('app.slider_image') }}">
        <span class="indent10">
          {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
        </span>
      @endif

      <div class="row">
        <div class="col-md-9 nopadding-right">
          <input id="uploadFile" placeholder="{{ trans('app.slider_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
        </div>
        <div class="col-md-3 nopadding-left">
          <div class="fileUpload btn btn-primary btn-block btn-flat">
            <span>{{ trans('app.form.select') }}</span>
            <input type="file" name="image" id="uploadBtn" class="upload" {{ isset($slider) ? '' : 'required' }} />
          </div>
        </div>
      </div>
      <div class="help-block with-errors">{{ trans('help.slider_img_hint') }}</div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      <label for="thumb" class="with-help"> {{ trans('app.thumbnail') }}</label>
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slider_thumb_image') }}"></i>
      @if(isset($slider) && Storage::exists(optional($slider->images->first())->path))
        <img src="{{ get_storage_file_url(optional($slider->images->first())->path, 'medium') }}" width="30%" alt="{{ trans('app.slider_image') }}">
        <span class="indent10">
          {!! Form::checkbox('delete_thumb_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
        </span>
      @endif
      <span class="spacer5"></span>
      <input type="file" name="thumb" style="display: inline-block;" />
      <div class="help-block with-errors">{{ trans('help.slider_thumb_hint') }}</div>
    </div>
  </div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>