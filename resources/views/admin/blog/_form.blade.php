<div class="form-group">
  {!! Form::label('title', trans('app.form.blog_title').'*') !!}
  {!! Form::text('title', null, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
</div>
<div class="form-group">
  {!! Form::label('slug', trans('app.form.slug').'*') !!}
  {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
<div class="form-group">
  {!! Form::label('excerpt', trans('app.form.excerpt').'*') !!}
  {!! Form::textarea('excerpt', null, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.excerpt'), 'rows' => '3', 'required']) !!}
  <div class="help-block with-errors"></div>
</div>
<div class="form-group">
  {!! Form::label('content', trans('app.form.content').'*') !!}
  {!! Form::textarea('content', null, ['class' => 'form-control summernote-long', 'placeholder' => trans('app.placeholder.content'), 'required']) !!}
</div>
<div class="row">
  <div class="col-md-6 nopadding-right">
    <div class="form-group">
      {!! Form::label('published_at', trans('app.form.publish_at')) !!}
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        {!! Form::text('published_at', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.publish_at')]) !!}
      </div>
    </div>
  </div>
  <div class="col-md-6 nopadding-left">
    <div class="form-group">
      {!! Form::label('status', trans('app.form.status').'*') !!}
      {!! Form::select('status', ['1' => trans('app.publish'), '0' => trans('app.draft')], null, ['class' => 'form-control select2-normal', 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>
<div class="form-group">
    {!! Form::label('tag_list[]', trans('app.form.tags')) !!}
    {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
</div>
<div class="form-group">
  <label for="exampleInputFile"> {{ trans('app.featured_image') }}</label>
  @if(isset($blog) && Storage::exists(optional($blog->image)->path))
    <img src="{{ get_storage_file_url(optional($blog->image)->path, 'small') }}" width="" alt="{{ trans('app.featured_image') }}">
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
  <div class="help-block with-errors">{{ trans('help.blog_feature_img_hint') }}</div>
</div>
<p class="help-block">* {{ trans('app.form.required_fields') }}</p>