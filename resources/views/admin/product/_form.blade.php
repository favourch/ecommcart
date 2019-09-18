<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">{{ isset($product) ? trans('app.update_product') : trans('app.add_product') }}</h3>
          <div class="box-tools pull-right">
            @if(!isset($product))
              <a href="#" data-link="{{ route('admin.catalog.product.upload') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
            @endif
          </div>
      </div> <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-9 nopadding-right">
            <div class="form-group">
              {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_name') }}"></i>
              {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>
          <div class="col-md-3 nopadding-left">
            <div class="form-group">
              {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_active') }}"></i>
              {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], !isset($product) ? 1 : null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 nopadding-right">
            <div class="form-group">
              {!! Form::label('mpn', trans('app.form.mpn'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.mpn') }}"></i>
              {!! Form::text('mpn', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.mpn')]) !!}
            </div>
          </div>
          <div class="col-md-4 nopadding">
            <div class="form-group">
              {!! Form::label('gtin', trans('app.form.gtin'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.mpn') }}"></i>
              {!! Form::text('gtin', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.gtin')]) !!}
            </div>
          </div>
          <div class="col-md-4 nopadding-left">
            <div class="form-group">
              {!! Form::label('gtin_type', trans('app.form.gtin_type'), ['class' => 'with-help']) !!}
              {!! Form::select('gtin_type', $gtin_types , null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.gtin_type')]) !!}
            </div>
          </div>
        </div>

        <div class="form-group">
          {!! Form::label('description', trans('app.form.description').'*', ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_description') }}"></i>
          {!! Form::textarea('description', null, ['class' => 'form-control summernote', 'rows' => '4', 'placeholder' => trans('app.placeholder.description'), 'required']) !!}
          <div class="help-block with-errors">{!! $errors->first('description', ':message') !!}</div>
        </div>

        <div class="form-group">
          {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
          {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
        </div>

        <fieldset>
          <legend>
            {{ trans('app.form.images') }}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_images') }}"></i>
          </legend>
          <div class="form-group">
            <div class="file-loading">
              <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
            </div>
          </div>
        </fieldset>

        <p class="help-block">* {{ trans('app.form.required_fields') }}</p>

        <div class="box-tools pull-right">
          {!! Form::submit( isset($product) ? trans('app.form.update') : trans('app.form.save'), ['class' => 'btn btn-flat btn-lg btn-primary']) !!}
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4 nopadding-left">
    <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">{{ trans('app.organization') }}</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        <div class="form-group">
          {!! Form::label('category_list[]', trans('app.form.categories').'*') !!}
          {!! Form::select('category_list[]', $categories , Null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple', 'required']) !!}
          <div class="help-block with-errors"></div>
        </div>

        <fieldset>
          <legend>{{ trans('app.catalog_rules') }}</legend>
          <div class="form-group">
            <div class="input-group">
              {{ Form::hidden('has_variant', 0) }}
              {!! Form::checkbox('has_variant', null, !isset($product) ? 1 : null, ['id' => 'has_variant', 'class' => 'icheckbox_line']) !!}
              {!! Form::label('has_variant', trans('app.form.has_variant')) !!}
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.has_variant') }}"></i>
              </span>
            </div>
          </div>

          <div class="form-group">
            <div class="input-group">
              {{ Form::hidden('requires_shipping', 0) }}
              {!! Form::checkbox('requires_shipping', null, !isset($product) ? 1 : null, ['id' => 'requires_shipping', 'class' => 'icheckbox_line']) !!}
              {!! Form::label('requires_shipping', trans('app.form.requires_shipping')) !!}
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.requires_shipping') }}"></i>
              </span>
            </div>
          </div>

          {{-- <div class="form-group">
            <div class="input-group">
              {{ Form::hidden('downloadable', 0) }}
              {!! Form::checkbox('downloadable', null, null, ['class' => 'icheckbox_line']) !!}
              {!! Form::label('downloadable', trans('app.form.downloadable')) !!}
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.downloadable') }}"></i>
              </span>
            </div>
          </div> --}}

          @if(auth()->user()->isFromplatform())
            <div class="row">
              <div class="col-md-6 nopadding-right">
                <div class="form-group">
                  {!! Form::label('min_price', trans('app.form.catalog_min_price'), ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.catalog_min_price') }}"></i>
                    <div class="input-group">
                      <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                      {!! Form::number('min_price' , null, ['class' => 'form-control', 'step' => 'any', 'min' => '0','placeholder' => trans('app.placeholder.catalog_min_price')]) !!}
                    </div>
                    <div class="help-block with-errors"></div>
                </div>
              </div>
              <div class="col-md-6 nopadding-left">
                <div class="form-group">
                  {!! Form::label('max_price', trans('app.form.catalog_max_price'), ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.catalog_max_price') }}"></i>
                  <div class="input-group">
                    <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                    {!! Form::number('max_price' , null, ['class' => 'form-control', 'step' => 'any', 'min' => '0', 'placeholder' => trans('app.placeholder.catalog_max_price')]) !!}
                  </div>
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
          @endif
        </fieldset>

        <fieldset>
          <legend>
            {{ trans('app.featured_image') }}
            <i class="fa fa-question-circle small" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_featured_image') }}"></i>
          </legend>
          @if(isset($product) && $product->featuredImage)
            <img src="{{ get_storage_file_url($product->featuredImage->path, 'small') }}" alt="{{ trans('app.featured_image') }}">
            <label>
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
                    <span>{{ trans('app.form.upload') }} </span>
                    <input type="file" name="image" id="uploadBtn" class="upload" />
                </div>
              </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>{{ trans('app.branding') }}</legend>
          <div class="form-group">
              {!! Form::label('origin_country', trans('app.form.origin'), ['class' => 'with-help']) !!}
              {!! Form::select('origin_country', $countries , null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.origin')]) !!}
              <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            {!! Form::label('brand', trans('app.form.brand'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.brand') }}"></i>
            {!! Form::text('brand', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.brand')]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('model_number', trans('app.form.model_number'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.model_number') }}"></i>
            {!! Form::text('model_number', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.model_number')]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('manufacturer_id', trans('app.form.manufacturer'), ['class' => 'with-help']) !!}
            {!! Form::select('manufacturer_id', $manufacturers , null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.manufacturer')]) !!}
            <div class="help-block with-errors"></div>
          </div>
        </fieldset>
      </div>
    </div>
  </div>
</div>