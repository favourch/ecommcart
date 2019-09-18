<div class="row">
  <div class="col-md-8 nopadding-right">
    <div class="form-group">
      {!! Form::label('title', trans('app.form.title'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.banner_title') }}"></i>
      {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.title')]) !!}
      <div class="help-block with-errors"></div>
    </div>
    <div class="form-group">
      {!! Form::label('description', trans('app.form.description'), ['class' => 'with-help']) !!}
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.banner_description') }}"></i>
      {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.banner_description')]) !!}
      <div class="help-block with-errors"></div>
    </div>

    <div class="row">
      <div class="col-md-6 nopadding-right">
        <div class="form-group">
          {!! Form::label('link', trans('app.form.link'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.banner_link') }}"></i>
          {!! Form::text('link', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.link')]) !!}
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="col-md-6 nopadding-left">
        <div class="form-group">
          {!! Form::label('link_label', trans('app.form.link_label'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.link_label') }}"></i>
          {!! Form::text('link_label', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.link_label')]) !!}
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 nopadding-right">
        <div class="form-group">
          {!! Form::label('group_id', trans('app.form.group').'*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.banner_group') }}"></i>
          {!! Form::select('group_id', $groups, null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.group')]) !!}
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="col-md-4 nopadding-left nopadding-right">
        <div class="form-group">
          {!! Form::label('columns', trans('app.form.columns'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.bs_columns') }}"></i>
          {!! Form::select('columns', ['4' => 4, '6' => 6, '8' => 8, '12' => 12], isset($banner) ? null : 12, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.columns')]) !!}
          <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="col-md-4 nopadding-left">
        <div class="form-group">
          {!! Form::label('order', trans('app.form.position'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.banner_order') }}"></i>
          {!! Form::number('order' , null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.position')]) !!}
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="exampleInputFile" class="with-help"> {{ trans('app.banner_image') }}</label>
      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.banner_image') }}"></i>
      @if(isset($banner) && Storage::exists(optional($banner->featuredImage)->path))
        <img src="{{ get_storage_file_url(optional($banner->featuredImage)->path, 'small') }}" width="" alt="{{ trans('app.banner_image') }}">
        <span style="margin-left: 10px;">
          {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
        </span>
      @endif

      <div class="row">
        <div class="col-md-9 nopadding-right">
          <input id="uploadFile" placeholder="{{ trans('app.banner_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
        </div>
        <div class="col-md-3 nopadding-left">
          <div class="fileUpload btn btn-primary btn-block btn-flat">
            <span>{{ trans('app.form.upload') }}</span>
            <input type="file" name="image" id="uploadBtn" class="upload" />
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          {!! Form::label('bg_color', trans('app.background'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.banner_background') }}"></i>
          <div class="input-group my-colorpicker2 colorpicker-element">
              {!! Form::text('bg_color', isset($banner) ? Null : '#ab7553', ['class' => 'form-control', 'placeholder' => trans('app.placeholder.color')]) !!}
            <div class="input-group-addon">
              <i style="background-color: rgb(171, 117, 83);"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 nopadding-left">
        @if(isset($banner) && Storage::exists(optional($banner->images->first())->path))
          <img src="{{ get_storage_file_url(optional($banner->images->first())->path, 'small') }}" width="" alt="{{ trans('app.banner_image') }}">
          <span style="margin-left: 10px;">
            {!! Form::checkbox('delete_bg_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
          </span>
        @endif
        <div class="form-group">
          <label>&nbsp;</label>
          <span class="spacer10"></span>
          <span>OR</span>
          <input type="file" name="bg_image"  class="indent10" style="display: inline-block;" />
          <div class="help-block with-errors"></div>
        </div>
      </div>
    </div>

    <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
  </div> <!--/.col-md-9 -->
  <div class="col-md-4 nopadding-left">
    <img src="{{ asset('images/placeholders/banner_layout.jpg') }}" width="100%">
  </div> <!--/.col-md-3 -->
</div> <!--/.row -->
