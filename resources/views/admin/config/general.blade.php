@extends('admin.layouts.master')

@php
	$can_update = Gate::allows('update', $shop->config) ?: Null;
@endphp

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">
			{{ trans('app.general_settings') }}
	      </h3>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	    	<div class="row">
		        {!! Form::model($shop, ['method' => 'PUT', 'route' => ['admin.setting.basic.config.update', $shop->id], 'files' => true, 'id' => 'form', 'class' => 'form-horizontal', 'data-toggle' => 'validator']) !!}
			    	<div class="col-sm-9">
						<div class="form-group">
							{!! Form::label('name', '*' . trans('app.shop_name') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
					        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_name') }}"></i>
						  	<div class="col-sm-8 nopadding-left">
						  		@if($can_update)
						  			{!! Form::text('name', $shop->name, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.shop_name'), 'required']) !!}
							  		<div class="help-block with-errors"></div>
								@else
									<span class="lead">{{ $shop->name }}</span>
								@endif
						  	</div>
						</div>

						<div class="form-group">
							@if($shop->slug)
								{!! Form::label('slug', trans('app.shop_url') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
					        	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_url') }}"></i>
							  	<div class="col-sm-8 nopadding-left">
									<span> {{ get_shop_url($shop->id) }} </span>
								</div>
							@elseif($can_update)
								{!! Form::label('slug', '*' . trans('app.form.slug') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
					        	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_slug') }}"></i>
							  	<div class="col-sm-8 nopadding-left">
						  			{!! Form::text('slug', null, ['class' => 'form-control slug', 'placeholder' => trans('app.placeholder.slug'), 'required']) !!}
							  		<div class="help-block with-errors"></div>
								</div>
							@endif
						</div>

						<div class="form-group">
							{!! Form::label('legal_name', '*' . trans('app.shop_legal_name') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
					        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_legal_name') }}"></i>
						  	<div class="col-sm-8 nopadding-left">
						  		@if($can_update)
						  			{!! Form::text('legal_name', $shop->legal_name, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.shop_name'), 'required']) !!}
							  		<div class="help-block with-errors"></div>
								@else
									<span>{{ $shop->legal_name }}</span>
								@endif
						  	</div>
						</div>

						<div class="form-group">
							{!! Form::label('email', '*' . trans('app.form.email_address'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
					        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_email') }}"></i>
						  	<div class="col-sm-8 nopadding-left">
						  		@if($can_update)
									{!! Form::email('email', $shop->email, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.valid_email'), 'required']) !!}
							  		<div class="help-block with-errors"></div>
								@else
									<span>{{ $shop->email }}</span>
								@endif
						  	</div>
						</div>

						<div class="form-group">
						    {!! Form::label('external_url', trans('app.form.external_url') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
					        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_external_url') }}"></i>
						  	<div class="col-sm-8 nopadding-left">
						  		@if($can_update)
							    	{!! Form::text('external_url', $shop->external_url, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.external_url')]) !!}
								@else
									<span>{{ $shop->external_url }}</span>
								@endif
						  	</div>
						</div>

						<div class="form-group">
					        {!! Form::label('timezone_id', '*' . trans('app.form.timezone'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
						  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_timezone') }}"></i>
						  	<div class="col-sm-8 nopadding-left">
						  		@if($can_update)
							        {!! Form::select('timezone_id', $timezones , $shop->timezone_id, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.timezone'), 'required']) !!}
							  		<div class="help-block with-errors"></div>
								@else
									<span>{{ $shop->timezone->text }}</span>
								@endif
						  	</div>
						</div>

						<div class="form-group">
							{!! Form::label('description', trans('app.form.description') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
						  	<div class="col-sm-8 nopadding-left">
						  		@if($can_update)
									{!! Form::textarea('description', $shop->description, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.description'), 'rows' => '3']) !!}
								@else
									<span>{{ $shop->description }}</span>
								@endif
							</div>
						</div>

				  		@if($can_update)
							<div class="form-group">
								<label for="exampleInputFile" class="with-help col-sm-3 control-label"> {{ trans('app.form.logo') }}</label>
						      	<div class="col-md-6 nopadding">
									<input id="uploadFile" placeholder="{{ trans('app.placeholder.logo') }}" class="form-control" disabled="disabled" style="height: 28px;" />
			                        <div class="help-block with-errors">{{ trans('help.logo_img_size') }}</div>
						    	</div>
							    <div class="col-md-2 nopadding-left">
								  	<div class="fileUpload btn btn-primary btn-block btn-flat">
								      <span>{{ trans('app.form.upload') }}</span>
									    <input type="file" name="image" id="uploadBtn" class="upload" />
							      	</div>
							    </div>
							</div>

			                <div class="form-group">
			                  	{!! Form::label('exampleInputFile', trans('app.form.cover_img'), ['class' => 'with-help col-sm-3 control-label']) !!}
			                  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.cover_img', ['page' => trans('app.shop')]) }}"></i>
						      	<div class="col-md-6 nopadding">
			                        <input id="uploadFile1" placeholder="{{ trans('app.placeholder.cover_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
			                        <div class="help-block with-errors">{{ trans('help.cover_img_size') }}</div>
			                    </div>
			                    <div class="col-md-2 nopadding-left">
			                        <div class="fileUpload btn btn-primary btn-block btn-flat">
			                            <span>{{ trans('app.form.upload') }} </span>
			                            <input type="file" name="cover_image" id="uploadBtn1" class="upload" />
			                        </div>
			                    </div>
			                </div>
						@endif
						<p class="help-block">* {{ trans('app.form.required_fields') }}</p>

				  		@if($can_update)
							<div class="col-md-offset-3">
					            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-flat btn-new']) !!}
					        </div>
				  		@endif
			    	</div>

			        <div class="col-sm-3">
				    	@if($can_update)
							<div class="form-group text-center">
								{!! Form::label('maintenance_mode', trans('app.form.maintenance_mode'), ['class' => 'control-label with-help']) !!}
							  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_maintenance_mode_handle') }}"></i>
							  	<div class="handle">
									<a href="{{ route('admin.setting.config.maintenanceMode.toggle', $shop) }}" type="button" class="toggle-confirm btn btn-lg btn-secondary btn-toggle {{ $shop->config->maintenance_mode == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $shop->config->maintenance_mode == 1 ? 'true' : 'false' }}" autocomplete="off">
										<div class="btn-handle"></div>
									</a>
							  	</div>
							</div>
				        @endif

						<div class="text-center">
							<div class="form-group">
								{!! Form::label('shop_address', trans('app.shop_address'), ['class' => 'control-label with-help']) !!}
							  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.shop_address') }}"></i>
							</div>

							@if($shop->primaryAddress)

								{!! $shop->primaryAddress->toHtml() !!}

								<a href="#" data-link="{{ route('address.edit', $shop->primaryAddress->id) }}"  class="btn btn-default ajax-modal-btn"><i class="fa fa-map-marker"></i> {{ trans('app.update_address') }}</a>
							@else
								<a href="#" data-link="{{ route('address.create', ['shop', $shop->id]) }}"  class="btn btn-default ajax-modal-btn"><i class="fa fa-plus-square-o"></i> {{ trans('app.add_address') }}</a>
							@endif

					        <div class="spacer30"></div>
						</div>

						@if(isset($shop) && $shop->logo)
							<div class="form-group text-center">
								<label class="with-help control-label"> {{ trans('app.logo') }}</label>
								<img src="{{ get_storage_file_url(optional($shop->logo)->path, 'medium') }}" alt="{{ trans('app.logo') }}">
						        <div class="spacer10"></div>
								<label>
							    	{!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_logo') }}
								</label>
							</div>
					  	@endif

						@if(isset($shop) && $shop->featuredImage)
							<div class="form-group text-center">
								<label class="with-help control-label"> {{ trans('app.cover_image') }}</label>
		                      	<img src="{{ get_storage_file_url(optional($shop->featuredImage)->path, 'medium') }}" width="" alt="{{ trans('app.cover_image') }}">
			                    <label>
						        <div class="spacer10"></div>
								<label>
		                        	{!! Form::checkbox('delete_cover_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
			                    </label>
			                </div>
					  	@endif

					</div>
		        {!! Form::close() !!}
	    	</div>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection