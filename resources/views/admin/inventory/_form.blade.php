<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">{{ isset($inventory) ? trans('app.update_inventory') : trans('app.add_inventory') }}</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        @include('admin.partials._product_widget')

        @php
          if(isset($inventory)){
            $product = $inventory->product;
          }
          $requires_shipping = $product->requires_shipping || (isset($inventory) && $inventory->product->requires_shipping);
          $title_calsses = isset($inventory) ? 'form-control' : 'form-control makeSlug';
        @endphp
        {{ Form::hidden('product_id', $product->id) }}
        {{ Form::hidden('brand', $product->brand) }}

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              {!! Form::label('title', trans('app.form.title').'*') !!}
              {!! Form::text('title', null, ['class' => $title_calsses, 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="col-md-7 nopadding-right">
            <div class="form-group">
              {!! Form::label('sku', trans('app.form.sku').'*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sku') }}"></i>
              {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.sku'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="col-md-3 nopadding">
            <div class="form-group">
              {!! Form::label('condition', trans('app.form.condition').'*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_product_condition') }}"></i>
              {!! Form::select('condition', ['New' => trans('app.new'), 'Used' => trans('app.used'), 'Refurbished' => trans('app.refurbished')], isset($inventory) ? null : 'New', ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="col-md-2 nopadding-left">
            <div class="form-group">
              {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_inventory_status') }}"></i>
              {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], isset($inventory) ? null : 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
              <div class="help-block with-errors"></div>
            </div>
          </div>
        </div>

        @include('admin.inventory._common')

        <fieldset>
          <legend>{{ trans('app.form.images') }}</legend>
          <div class="form-group">
            <div class="file-loading">
              <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>{{ trans('app.inventory_rules') }}</legend>
          @if($requires_shipping)
            <div class="row">
              <div class="col-md-6 nopadding-right">
                <div class="form-group">
                  {!! Form::label('stock_quantity', trans('app.form.stock_quantity').'*', ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.stock_quantity') }}"></i>
                  {!! Form::number('stock_quantity', isset($inventory) ? null : 1, ['min' => 0, 'class' => 'form-control', 'placeholder' => trans('app.placeholder.stock_quantity'), 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>

              <div class="col-md-6 nopadding-left">
                <div class="form-group">
                  {!! Form::label('min_order_quantity', trans('app.form.min_order_quantity'), ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.min_order_quantity') }}"></i>
                  {!! Form::number('min_order_quantity', isset($inventory) ? null : 1, ['min' => 1, 'class' => 'form-control', 'placeholder' => trans('app.placeholder.min_order_quantity')]) !!}
                </div>
              </div>
            </div>
          @endif

          <div class="row">
            <div class="col-md-6 nopadding-right">
              <div class="form-group">
                {!! Form::label('sale_price', trans('app.form.sale_price').'*', ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sale_price') }}"></i>
                <div class="input-group">
                  <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                  <input name="sale_price" value="{{ isset($inventory) ? $inventory->sale_price : Null }}" type="number" min="{{ $product->min_price }}" {{ $product->max_price ? ' max="'. $product->max_price .'"' : '' }} step="any" placeholder="{{ trans('app.placeholder.sale_price') }}" class="form-control" required="required">
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6 nopadding-left">
              <div class="form-group">
                {!! Form::label('offer_price', trans('app.form.offer_price'), ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_price') }}"></i>
                <div class="input-group">
                  <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                  {!! Form::number('offer_price', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.offer_price')]) !!}
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 nopadding-right">
              <div class="form-group">
                {!! Form::label('offer_start', trans('app.form.offer_start'), ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_start') }}"></i>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  {!! Form::text('offer_start', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.offer_start')]) !!}
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>

            <div class="col-md-6 nopadding-left">
              <div class="form-group">
                {!! Form::label('offer_end', trans('app.form.offer_end'), ['class' => 'with-help']) !!}
                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_end') }}"></i>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  {!! Form::text('offer_end', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.offer_end')]) !!}
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('linked_items[]', trans('app.form.linked_items'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.inventory_linked_items') }}"></i>
            {!! Form::select('linked_items[]', $inventories , Null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
            <div class="help-block with-errors"></div>
          </div>
        </fieldset>

        <p class="help-block">* {{ trans('app.form.required_fields') }}</p>

        @if(isset($inventory))
          <a href="{{ route('admin.stock.inventory.index') }}" class="btn btn-default btn-flat">{{ trans('app.form.cancel_update') }}</a>
        @endif
        {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-lg btn-new pull-right']) !!}
      </div>
    </div>
  </div><!-- /.col-md-8 -->

  <div class="col-md-4 nopadding-left">
    <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">{{ trans('app.additional_info') }}</h3>
      </div> <!-- /.box-header -->
      <div class="box-body">
        <div class="form-group">
          {!! Form::label('available_from', trans('app.form.available_from'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.available_from') }}"></i>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            {!! Form::text('available_from', null, ['class' => 'datetimepicker form-control', 'placeholder' => trans('app.placeholder.available_from')]) !!}
          </div>
        </div>

        @if($requires_shipping)
          <fieldset>
            <legend>{{ trans('app.shipping') }}</legend>
            <div class="form-group">
              <div class="input-group">
                {{ Form::hidden('free_shipping', 0) }}
                {!! Form::checkbox('free_shipping', null, null, ['id' => 'free_shipping', 'class' => 'icheckbox_line']) !!}
                {!! Form::label('free_shipping', trans('app.form.free_shipping')) !!}
                <span class="input-group-addon" id="">
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.free_shipping') }}"></i>
                </span>
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('warehouse_id', trans('app.form.warehouse'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_warehouse') }}"></i>
              {!! Form::select('warehouse_id', $warehouses, isset($inventory) ? null : config('shop_settings.default_warehouse_id'), ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
            </div>

            <div class="form-group">
              {!! Form::label('shipping_weight', trans('app.form.shipping_weight'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.shipping_weight') }}"></i>
              <div class="input-group">
                {!! Form::number('shipping_weight', null, ['class' => 'form-control', 'step' => 'any', 'min' => 0, 'placeholder' => trans('app.placeholder.shipping_weight')]) !!}
                <span class="input-group-addon">{{ config('system_settings.weight_unit') ?: 'gm' }}</span>
              </div>
              <div class="help-block with-errors"></div>
            </div>

            <div class="form-group">
              {!! Form::label('packaging_list[]', trans('app.form.packagings'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_packagings') }}"></i>
              {!! Form::select('packaging_list[]', $packagings , isset($inventory) ? null : config('shop_settings.default_packaging_ids'), ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
            </div>
          </fieldset>
        @endif

        @if(count($attributes))
          <fieldset class="collapsible">
            <legend>{{ trans('app.attributes') }}</legend>
            @foreach ($attributes as $attribute)
              <div class="form-group">
                {!! Form::label($attribute->name, $attribute->name) !!}

                <select class = "form-control select2" id="{{ $attribute->name }}" name="variants[{{ $attribute->id }}]" placeholder = {{ trans('app.placeholder.select') }}>

                  <option value="">{{ trans('app.placeholder.select') }}</option>

                  @foreach($attribute->attributeValues as $attributeValue)
                    <option value="{{ $attributeValue->id }}"
                      @if(isset($inventory) && count($inventory->attributes))
                        {{ in_array($attributeValue->id, $inventory->attributeValues->pluck('id')->toArray()) ? 'selected' : '' }}
                      @endif
                    >
                      {{ $attributeValue->value }}
                    </option>
                  @endforeach
                </select>
              </div>
            @endforeach
          </fieldset>
        @endif

        <fieldset>
          <legend>{{ trans('app.reporting') }}</legend>
          <div class="form-group">
            {!! Form::label('purchase_price', trans('app.form.purchase_price'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.purchase_price') }}"></i>
            <div class="input-group">
              <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
              {!! Form::number('purchase_price', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.purchase_price')]) !!}
            </div>
          </div>
          @if($requires_shipping)
            <div class="form-group">
              {!! Form::label('supplier_id', trans('app.form.supplier'), ['class' => 'with-help']) !!}
              <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_supplier') }}"></i>
              {!! Form::select('supplier_id', $suppliers, isset($inventory) ? null : config('shop_settings.default_supplier_id'), ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
            </div>
          @endif
        </fieldset>

        <fieldset>
          <legend>{{ trans('app.seo') }}</legend>
          <div class="form-group">
            {!! Form::label('slug', trans('app.form.slug').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slug') }}"></i>
            {!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => 'SEO Friendly URL', 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
            {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('meta_title', trans('app.form.meta_title'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_title') }}"></i>
            {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_title')]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('meta_description', trans('app.form.meta_description'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_description') }}"></i>
            {!! Form::text('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_description')]) !!}
          </div>
        </fieldset>
      </div>
    </div>
  </div><!-- /.col-md-4 -->
</div><!-- /.row -->