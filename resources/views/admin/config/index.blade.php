@extends('admin.layouts.master')

@php
	$can_update = Gate::allows('update', $config) ?: Null;
@endphp

@section('content')
	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="active"><a href="#inventory_tab" data-toggle="tab">
					<i class="fa fa-cubes hidden-sm"></i>
					{{ trans('app.inventory') }}
				</a></li>
				<li><a href="#order_tab" data-toggle="tab">
					<i class="fa fa-shopping-cart hidden-sm"></i>
					{{ trans('app.order') }}
				</a></li>
				<li><a href="#views_tab" data-toggle="tab">
					<i class="fa fa-laptop hidden-sm"></i>
					{{ trans('app.views') }}
				</a></li>
				<li><a href="#support_tab" data-toggle="tab">
					<i class="fa fa-phone hidden-sm"></i>
					{{ trans('app.support') }}
				</a></li>
				<li><a href="#notifications_tab" data-toggle="tab">
					<i class="fa fa-bell-o hidden-sm"></i>
					{{ trans('app.notifications') }}
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane active" id="inventory_tab">
			    	<div class="row">
				        {!! Form::model($config, ['method' => 'PUT', 'route' => ['admin.setting.config.update', $config], 'files' => true, 'id' => 'form2', 'class' => 'form-horizontal ajax-form', 'data-toggle' => 'validator']) !!}
					    	<div class="col-sm-9">
								<div class="form-group">
							        {!! Form::label('alert_quantity', trans('app.alert_quantity'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.config_alert_quantity') }}"></i>
								  	<div class="col-sm-2 nopadding-left">
								  		@if($can_update)
								        	{!! Form::number('alert_quantity', get_formated_decimal($config->alert_quantity), ['class' => 'form-control', 'placeholder' => trans('app.placeholder.alert_quantity')]) !!}
										@else
											<span>{{ get_formated_decimal($config->alert_quantity) }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('default_supplier_id', trans('app.default_supplier'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.default_supplier') }}"></i>
								  	<div class="col-sm-7 nopadding-left">
								  		@if($can_update)
									        {!! Form::select('default_supplier_id', $suppliers , $config->default_supplier_id, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
										@else
											<span>{{ optional($config->supplier)->name }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('default_warehouse_id', trans('app.default_warehouse'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.default_warehouse') }}"></i>
								  	<div class="col-sm-7 nopadding-left">
								  		@if($can_update)
									        {!! Form::select('default_warehouse_id', $warehouses , $config->default_warehouse_id, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
										@else
											<span>{{ optional($config->warehouse)->name }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('default_packaging_ids', trans('app.default_packagings'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.default_packaging_ids_for_inventory') }}"></i>
								  	<div class="col-sm-7 nopadding-left">
								  		@if($can_update)
										    {!! Form::select('default_packaging_ids[]', $packagings , $config->default_packaging_ids, ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
										@else
											@foreach($config->default_packaging_ids as $packaging)
												<span class="label label-outline">{{ get_value_from($packaging, 'packagings', 'name') }}</span>
											@endforeach
										@endif
								  	</div>
								</div>

						  		@if($can_update)
									<div class="col-md-offset-4">
							            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-flat btn-new']) !!}
							        </div>
						  		@endif
					    	</div>
					    	<div class="col-sm-3">&nbsp;</div>
				        {!! Form::close() !!}
			    	</div>
			    </div>
			  	<!-- /.tab-pane -->

			    <div class="tab-pane" id="order_tab">
			    	<div class="row">
				        {!! Form::model($config, ['method' => 'PUT', 'route' => ['admin.setting.config.update', $config], 'files' => true, 'id' => 'form2', 'class' => 'form-horizontal ajax-form', 'data-toggle' => 'validator']) !!}
					    	<div class="col-sm-7 nopadding-right">
								<div class="form-group">
									{!! Form::label('order_number_prefix', trans('app.order_number_prefix') . ':', ['class' => 'with-help col-sm-4 control-label']) !!}
							        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.order_number_prefix_suffix') }}"></i>
								  	<div class="col-sm-2 nopadding-left">
								  		@if($can_update)
								  			{!! Form::text('order_number_prefix', $config->order_number_prefix, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.order_number_prefix')]) !!}
										@else
											<span>{{ $config->order_number_prefix }}</span>
										@endif
								  	</div>

									{!! Form::label('order_number_suffix', trans('app.and') . ' ' . trans('app.suffix') . ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<div class="col-sm-2 nopadding-left">
								  		@if($can_update)
								  			{!! Form::text('order_number_suffix', $config->order_number_suffix, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.order_number_suffix')]) !!}
										@else
											<span>{{ $config->order_number_suffix }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('default_payment_method_id', trans('app.default_payment_method'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.default_payment_method_id') }}"></i>
								  	<div class="col-sm-7 nopadding-left">
								  		@if($can_update)
										    {!! Form::select('default_payment_method_id', $payment_methods , $config->default_payment_method_id, ['class' => 'form-control select2-normal']) !!}
										@else
											<span>{{ optional($config->payment_method)->name }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('default_tax_id', trans('app.default_tax'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.default_tax_id') }}"></i>
								  	<div class="col-sm-7 nopadding-left">
								  		@if($can_update)
									        {!! Form::select('default_tax_id', $taxes , $config->default_tax_id, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
										@else
											<span>{{ $config->tax->name }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('order_handling_cost', trans('app.order_handling_cost'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.config_order_handling_cost') }}"></i>
								  	<div class="col-sm-7 nopadding-left">
								  		@if($can_update)
										    <div class="input-group">
									        	{!! Form::number('order_handling_cost', get_formated_decimal($config->order_handling_cost), ['class' => 'form-control', 'placeholder' => trans('app.placeholder.order_handling_cost')]) !!}
										        <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
											</div>
										@else
											<span>{{ get_formated_decimal($config->order_handling_cost) }}</span>
										@endif
								  	</div>
								</div>
					    	</div>
					    	<div class="col-sm-5 nopadding-left">
					    		<fieldset>
					    			<legend>{{ trans('app.after_fulfilled') }}</legend>
							    	<div class="row">
								    	<div class="col-sm-6 text-right">
											<div class="form-group">
										        {!! Form::label('auto_archive_order', trans('app.auto_archive_order'). ':', ['class' => 'with-help control-label']) !!}
											  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.config_auto_archive_order') }}"></i>
											</div>
										</div>
								    	<div class="col-sm-6">
									  		@if($can_update)
											  	<div class="handle horizontal">
													<a href="{{ route('admin.setting.config.notification.toggle', 'auto_archive_order') }}" type="button" class="btn btn-md btn-secondary btn-toggle {{ $config->auto_archive_order == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $config->auto_archive_order == 1 ? 'true' : 'false' }}" autocomplete="off">
														<div class="btn-handle"></div>
													</a>
											  	</div>
											@else
												<span>{{ $config->auto_archive_order == 1 ? trans('app.on') : trans('app.off') }}</span>
											@endif
										</div>
								  	</div>
								    <!-- /.row -->
					    		</fieldset>
					    	</div>

					    	<div class="col-sm-12">
						  		@if($can_update)
									<div class="col-md-offset-3">
							            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-flat btn-new']) !!}
							        </div>
						  		@endif
					    	</div>
				        {!! Form::close() !!}
			    	</div>
			    </div>
			    <!-- /.tab-pane -->

			    <div class="tab-pane" id="views_tab">
			    	<div class="row">
				        {!! Form::model($config, ['method' => 'PUT', 'route' => ['admin.setting.config.update', $config], 'files' => true, 'id' => 'form2', 'class' => 'form-horizontal ajax-form', 'data-toggle' => 'validator']) !!}
					    	<div class="col-sm-6">
					    		<fieldset>
					    			<legend>{{ trans('app.back_office') }}</legend>
									<div class="form-group">
								        {!! Form::label('pagination', trans('app.pagination'). ':', ['class' => 'with-help col-sm-4 control-label']) !!}
									  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.config_pagination') }}"></i>
									  	<div class="col-sm-7 nopadding-left">
									  		@if($can_update)
											    <div class="input-group">
										    	    {!! Form::number('pagination', get_formated_decimal($config->pagination)?:Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.pagination')]) !!}
											        <span class="input-group-addon"><i class="fa fa-list-ul"></i></span>
										    	</div>
											@else
												<span>{{ get_formated_decimal($config->pagination)?:Null }}</span>
											@endif
									  	</div>
									</div>
					    		</fieldset>
					    	</div>
					    	<div class="col-sm-6">
					    		<fieldset>
					    			<legend>{{ trans('app.store_front') }}</legend>
					    		</fieldset>
					    	</div>

					  		@if($can_update)
								<div class="col-sm-12">
						            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-flat btn-new col-sm-offset-2']) !!}
						        </div>
					  		@endif
				        {!! Form::close() !!}
			    	</div>
			    </div>
			    <!-- /.tab-pane -->

			    <div class="tab-pane" id="support_tab">
			    	<div class="row">
				        {!! Form::model($config, ['method' => 'PUT', 'route' => ['admin.setting.config.update', $config], 'files' => true, 'id' => 'form2', 'class' => 'form-horizontal ajax-form', 'data-toggle' => 'validator']) !!}
					    	<div class="col-sm-12">
								<div class="form-group">
							        {!! Form::label('support_phone', trans('app.support_phone'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.support_phone') }}"></i>
								  	<div class="col-sm-6 nopadding-left">
								  		@if($can_update)
										    <div class="input-group">
										        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
									    	    {!! Form::number('support_phone', $config->support_phone, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.support_phone')]) !!}
									    	</div>
										@else
											<span>{{ $config->support_phone }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('support_phone_toll_free', trans('app.support_phone_toll_free'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.support_phone_toll_free') }}"></i>
								  	<div class="col-sm-6 nopadding-left">
								  		@if($can_update)
										    <div class="input-group">
										        <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>
									    	    {!! Form::number('support_phone_toll_free', $config->support_phone_toll_free, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.support_phone_toll_free')]) !!}
									    	</div>
										@else
											<span>{{ $config->support_phone_toll_free }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('support_email', '*' . trans('app.support_email'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.support_email') }}"></i>
								  	<div class="col-sm-6 nopadding-left">
								  		@if($can_update)
										    <div class="input-group">
										        <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
												{!! Form::email('support_email', $config->support_email, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.support_email'), 'required']) !!}
									    	</div>
									      	<div class="help-block with-errors"></div>
										@else
											<span>{{ $config->support_email }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('default_sender_email_address', '*' . trans('app.default_sender_email_address'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.default_sender_email_address') }}"></i>
								  	<div class="col-sm-6 nopadding-left">
								  		@if($can_update)
										    <div class="input-group">
										        <span class="input-group-addon"><i class="fa fa-at"></i></span>
												{!! Form::email('default_sender_email_address', $config->default_sender_email_address, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.default_sender_email_address'), 'required']) !!}
									    	</div>
									      	<div class="help-block with-errors"></div>
										@else
											<span>{{ $config->default_sender_email_address }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('default_email_sender_name', '*' . trans('app.default_email_sender_name'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.default_email_sender_name') }}"></i>
								  	<div class="col-sm-6 nopadding-left">
								  		@if($can_update)
										    <div class="input-group">
										        <span class="input-group-addon"><i class="fa fa-user"></i></span>
												{!! Form::text('default_email_sender_name', $config->default_email_sender_name, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.default_email_sender_name'), 'required']) !!}
									    	</div>
									      	<div class="help-block with-errors"></div>
										@else
											<span>{{ $config->default_email_sender_name }}</span>
										@endif
								  	</div>
								</div>

								<div class="form-group">
							        {!! Form::label('return_refund', '*' . trans('app.form.config_return_refund'). ':', ['class' => 'with-help col-sm-3 control-label']) !!}
								  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.config_return_refund') }}"></i>
								  	<div class="col-sm-6 nopadding-left">
								  		@if($can_update)
											{!! Form::textarea('return_refund', $config->return_refund, ['class' => 'form-control summernote-without-toolbar', 'placeholder' => trans('app.placeholder.config_return_refund'), 'required']) !!}
									      	<div class="help-block with-errors"></div>
										@else
											<span>{{ $config->return_refund }}</span>
										@endif
								  	</div>
								</div>

								<p class="help-block">* {{ trans('app.form.required_fields') }}</p>

						  		@if($can_update)
									<div class="col-md-offset-3">
							            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-flat btn-new']) !!}
							        </div>
						  		@endif
						  	</div>
				        {!! Form::close() !!}
			    	</div>
			    </div>
			  	<!-- /.tab-pane -->

			    <div class="tab-pane" id="notifications_tab">
			    	<div class="row">
				    	<div class="col-sm-6">
				    		<fieldset>
				    			<legend>{{ trans('app.inventory') }}</legend>
						    	<div class="row">
							    	<div class="col-sm-8 text-right">
										<div class="form-group">
									        {!! Form::label('notify_new_message', trans('app.notify_new_message'). ':', ['class' => 'with-help control-label']) !!}
										  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.notify_new_message') }}"></i>
										</div>
									</div>
							    	<div class="col-sm-4">
								  		@if($can_update)
										  	<div class="handle horizontal">
												<a href="{{ route('admin.setting.config.notification.toggle', 'notify_new_message') }}" type="button" class="btn btn-md btn-secondary btn-toggle {{ $config->notify_new_message == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $config->notify_new_message == 1 ? 'true' : 'false' }}" autocomplete="off">
													<div class="btn-handle"></div>
												</a>
										  	</div>
										@else
											<span>{{ $config->notify_new_message == 1 ? trans('app.on') : trans('app.off') }}</span>
										@endif
									</div>
							  	</div>
							    <!-- /.row -->

						    	<div class="row">
							    	<div class="col-sm-8 text-right">
										<div class="form-group">
									        {!! Form::label('notify_alert_quantity', trans('app.notify_alert_quantity'). ':', ['class' => 'with-help control-label']) !!}
										  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.notify_alert_quantity') }}"></i>
										</div>
									</div>
							    	<div class="col-sm-4">
								  		@if($can_update)
										  	<div class="handle horizontal">
												<a href="{{ route('admin.setting.config.notification.toggle', 'notify_alert_quantity') }}" type="button" class="btn btn-md btn-secondary btn-toggle {{ $config->notify_alert_quantity == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $config->notify_alert_quantity == 1 ? 'true' : 'false' }}" autocomplete="off">
													<div class="btn-handle"></div>
												</a>
										  	</div>
										@else
											<span>{{ $config->notify_alert_quantity == 1 ? trans('app.on') : trans('app.off') }}</span>
										@endif
									</div>
							  	</div>
							    <!-- /.row -->

						    	<div class="row">
							    	<div class="col-sm-8 text-right">
										<div class="form-group">
									        {!! Form::label('notify_inventory_out', trans('app.notify_inventory_out'). ':', ['class' => 'with-help control-label']) !!}
										  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.notify_inventory_out') }}"></i>
										</div>
									</div>
							    	<div class="col-sm-4">
								  		@if($can_update)
										  	<div class="handle horizontal">
												<a href="{{ route('admin.setting.config.notification.toggle', 'notify_inventory_out') }}" type="button" class="btn btn-md btn-secondary btn-toggle {{ $config->notify_inventory_out == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $config->notify_inventory_out == 1 ? 'true' : 'false' }}" autocomplete="off">
													<div class="btn-handle"></div>
												</a>
										  	</div>
										@else
											<span>{{ $config->notify_inventory_out == 1 ? trans('app.on') : trans('app.off') }}</span>
										@endif
									</div>
							  	</div>
							    <!-- /.row -->
							</fieldset>
					  	</div>
					    <!-- /.col-sm-6 -->

					  	<div class="col-sm-6">
				    		<fieldset>
				    			<legend>{{ trans('app.order') }}</legend>
						    	<div class="row">
							    	<div class="col-sm-8 text-right">
										<div class="form-group">
									        {!! Form::label('notify_new_order', trans('app.notify_new_order'). ':', ['class' => 'with-help control-label']) !!}
										  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.notify_new_order') }}"></i>
										</div>
									</div>
							    	<div class="col-sm-4">
								  		@if($can_update)
										  	<div class="handle horizontal">
												<a href="{{ route('admin.setting.config.notification.toggle', 'notify_new_order') }}" type="button" class="btn btn-md btn-secondary btn-toggle {{ $config->notify_new_order == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $config->notify_new_order == 1 ? 'true' : 'false' }}" autocomplete="off">
													<div class="btn-handle"></div>
												</a>
										  	</div>
										@else
											<span>{{ $config->notify_new_order == 1 ? trans('app.on') : trans('app.off') }}</span>
										@endif
									</div>
							  	</div>
							    <!-- /.row -->

						    	<div class="row">
							    	<div class="col-sm-8 text-right">
										<div class="form-group">
									        {!! Form::label('notify_abandoned_checkout', trans('app.notify_abandoned_checkout'). ':', ['class' => 'with-help control-label']) !!}
										  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.notify_abandoned_checkout') }}"></i>
										</div>
									</div>
							    	<div class="col-sm-4">
								  		@if($can_update)
										  	<div class="handle horizontal">
												<a href="{{ route('admin.setting.config.notification.toggle', 'notify_abandoned_checkout') }}" type="button" class="btn btn-md btn-secondary btn-toggle {{ $config->notify_abandoned_checkout == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $config->notify_abandoned_checkout == 1 ? 'true' : 'false' }}" autocomplete="off">
													<div class="btn-handle"></div>
												</a>
										  	</div>
										@else
											<span>{{ $config->notify_abandoned_checkout == 1 ? trans('app.on') : trans('app.off') }}</span>
										@endif
									</div>
							  	</div>
							    <!-- /.row -->

						    	<div class="row">
							    	<div class="col-sm-8 text-right">
										<div class="form-group">
									        {!! Form::label('notify_new_disput', trans('app.notify_new_disput'). ':', ['class' => 'with-help control-label']) !!}
										  	<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.notify_new_disput') }}"></i>
										</div>
									</div>
							    	<div class="col-sm-4">
								  		@if($can_update)
										  	<div class="handle horizontal">
												<a href="{{ route('admin.setting.config.notification.toggle', 'notify_new_disput') }}" type="button" class="btn btn-md btn-secondary btn-toggle {{ $config->notify_new_disput == 1 ? 'active' : '' }}" data-toggle="button" aria-pressed="{{ $config->notify_new_disput == 1 ? 'true' : 'false' }}" autocomplete="off">
													<div class="btn-handle"></div>
												</a>
										  	</div>
										@else
											<span>{{ $config->notify_new_disput == 1 ? trans('app.on') : trans('app.off') }}</span>
										@endif
									</div>
							  	</div>
							    <!-- /.row -->
							</fieldset>
					  	</div>
					    <!-- /.col-sm-6 -->
			    	</div>
				    <!-- /.row -->
			    </div>
			    <!-- /.tab-pane -->
			</div>
			<!-- /.tab-content -->
		</div>
	</div> <!-- /.box -->
@endsection