<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('title', trans('app.form.page_title').'*') !!}
      {!! Form::text('title', null, ['class' => isset($page) ? 'form-control' : 'form-control makeSlug', 'placeholder' => trans('app.placeholder.page_title'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('position', trans('app.form.view_area').'*') !!}
      {!! Form::select('position', $positions, Null, ['class' => 'form-control select2-normal', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

@unless(isset($page))
  <div class="form-group">
    {!! Form::label('slug', trans('app.form.slug').'*') !!}
    {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
    <div class="help-block with-errors"></div>
  </div>
@endunless

<div class="form-group">
  {!! Form::label('content', trans('app.form.content').'*') !!}
  {!! Form::textarea('content', null, ['class' => 'form-control summernote-long', 'placeholder' => trans('app.placeholder.content'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

@unless(isset($page) && in_array($page->id, config('system.freeze.pages')))
  <div class="row">
    <div class="col-md-6 nopadding-right">
      <div class="form-group">
        {!! Form::label('published_at', trans('app.form.publish_at')) !!}
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          {!! Form::text('published_at', isset($page) ? $page->published_at : null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.publish_at')]) !!}
        </div>
        <div class="help-block with-errors">{{ trans('help.leave_empty_to_save_as_draft') }}</div>
      </div>
    </div>
    <div class="col-md-6 nopadding-left">
      <div class="form-group">
        {!! Form::label('visibility', trans('app.form.visibility').'*') !!}
        {!! Form::select('visibility', ['1' => trans('app.public'), '2' => trans('app.merchant')], null, ['class' => 'form-control select2-normal', 'required']) !!}
        <div class="help-block with-errors"></div>
      </div>
    </div>
  </div>
@endunless

<div class="form-group">
  <label for="exampleInputFile"> {{ trans('app.featured_image') }}</label>
  @if(isset($page) && Storage::exists(optional($page->image)->path))
    <img src="{{ get_storage_file_url(optional($page->image)->path, 'small') }}" width="" alt="{{ trans('app.featured_image') }}">
    <span style="margin-left: 10px;">
      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
    </span>
  @endif

  <div class="row">
    <div class="col-md-9 nopadding-right">
      <input id="uploadFile" placeholder="{{ trans('app.featured_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
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