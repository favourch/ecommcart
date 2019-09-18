<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('name', trans('app.form.category_name').'*', ['class' => 'with-help']) !!}
      {!! Form::text('name', null, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.category_name'), 'required']) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
  <div class="col-md-4 nopadding-left">
    <div class="form-group">
      {!! Form::label('order', trans('app.form.position'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.display_order') }}"></i>
      {!! Form::number('order' , null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.position')]) !!}
      <div class="help-block with-errors"></div>
    </div>
  </div>
</div>

<div class="form-group">
  {!! Form::label('description', trans('app.form.description'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.cat_grp_desc') }}"></i>
  {!! Form::textarea('description', null, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.description'), 'rows' => '2']) !!}
</div>

<div class="row">
	<div class="col-md-6 nopadding-right">
		<div class="form-group">
		  	{!! Form::label('icon', trans('app.form.icon')) !!}
			<div class="input-group">
				{!! Form::text('icon', isset($categoryGroup) ? null : 'fa-cube', ['class' => 'form-control iconpicker-input', 'placeholder' => trans('app.placeholder.icon'), 'data-placement' => 'bottomRight']) !!}
                <span class="input-group-addon"><i class="fa fa-cube"></i></span>
            </div>
		  <div class="help-block with-errors"></div>
		</div>
	</div>
	<div class="col-md-6 nopadding-left">
		<div class="form-group">
		  {!! Form::label('active', trans('app.form.status').'*') !!}
		  {!! Form::select('active', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
		  <div class="help-block with-errors"></div>
		</div>
	</div>
</div>

<div class="form-group">
  {!! Form::label('slug', trans('app.form.slug').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slug') }}"></i>
  {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="form-group">
  {!! Form::label('exampleInputFile', trans('app.featured_image'), ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.cat_grp_img') }}"></i>
  @if(isset($categoryGroup) && Storage::exists(optional($categoryGroup->image)->path))
    <label>
      <img src="{{ get_storage_file_url(optional($categoryGroup->image)->path, 'small') }}" width="" alt="{{ trans('app.featured_image') }}">
      <span style="margin-left: 10px;">
        {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
      </span>
    </label>
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