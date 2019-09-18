<div class="form-group">
  {!! Form::label('attribute_id', trans('app.form.attribute').'*', ['class' => 'with-help']) !!}
  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.parent_attribute') }}"></i>
  {!! Form::select('attribute_id', $attributeList , isset($attribute) ? $attribute->id : null, ['class' => 'form-control select2-attribute_value-attribute', 'placeholder' => trans('app.placeholder.attribute'), 'required']) !!}
  <div class="help-block with-errors"></div>
</div>

<div class="row">
  <div class="col-md-8 nopadding-right">
	<div class="form-group">
	  	{!! Form::label('value', trans('app.form.attribute_value').'*') !!}
		<div class="input-group">
			{!! Form::text('value', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.attribute_value'), 'required']) !!}
		    <span class="input-group-addon" id="basic-addon1">
		      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.attribute_value') }}"></i>
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

<div id="color-option" class="
	{{ (
			(!isset($attribute->attribute_type_id)) ||
			($attribute->attribute_type_id != 1)
		)
		? 'hidden' : 'show'
	}}">

	<div class="form-group">
	  {!! Form::label('color', trans('app.form.color_attribute')) !!}
		<div class="input-group my-colorpicker2 colorpicker-element">
		  	{!! Form::text('color', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.color')]) !!}
			<div class="input-group-addon">
				<i style="background-color: rgb(135, 60, 60);"></i>
			</div>
		</div>
	</div>

	<div class="form-group">
	  <label for="exampleInputFile"> {{ trans('app.form.pattern') }}</label>
	  @if(isset($attributeValue) && Storage::exists(optional($attributeValue->image)->path))
	  <label>
      	<img src="{{ get_storage_file_url(optional($attributeValue->image)->path, 'small') }}" width="" alt="{{ trans('app.image') }}">
	    <span style="margin-left: 10px;">
	      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_pattern') }}
	    </span>
	  </label>
	  @endif
	  <div class="row">
	      <div class="col-md-9 nopadding-right">
	       <input id="uploadFile" placeholder="{{ trans('app.placeholder.image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
	      </div>
	      <div class="col-md-3 nopadding-left">
	      <div class="fileUpload btn btn-primary btn-block btn-flat">
	          <span>{{ trans('app.form.upload') }} </span>
	          <input type="file" name="image" id="uploadBtn" class="upload" />
	      </div>
	      </div>
	    </div>
	</div>
</div>

<p class="help-block">* {{ trans('app.form.required_fields') }}</p>