<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>

            <div class="col-md-3 nopadding" style="margin-top: 10px;">
				<img src="{{ get_storage_file_url(optional($shop->logo)->path, 'medium') }}" class="thumbnail" width="100%" alt="{{ trans('app.logo') }}">
			</div>
            <div class="col-md-9 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.name') }}:</th>
						<td style="width: 75%;">{{ $shop->name }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.owner') }}:</th>
						<td style="width: 75%;">{{ $shop->owner->name }}</td>
					</tr>
		            <tr>
		            	<th class="text-right">{{ trans('app.status') }}: </th>
		            	<td style="width: 75%;">
		            		@if($shop->config->maintenance_mode)
					          	<span class="label label-warning">{{ trans('app.maintenance_mode') }}</span>
		            		@else
			            		{{ ($shop->active) ? trans('app.active') : trans('app.inactive') }}
							@endif
		            	</td>
		            </tr>
					<tr>
						<th class="text-right">{{ trans('app.available_from') }}:</th>
						<td style="width: 75%;">{{ $shop->created_at->toFormattedDateString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 75%;">{{ $shop->updated_at->toDayDateTimeString() }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>

			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#basic" data-toggle="tab">
					{{ trans('app.basic_info') }}
				  </a></li>
				  <li><a href="#config" data-toggle="tab">
					{{ trans('app.configs') }}
				  </a></li>
				  <li><a href="#description" data-toggle="tab">
					{{ trans('app.description') }}
				  </a></li>
				  <li><a href="#contact" data-toggle="tab">
					{{ trans('app.contact') }}
				  </a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="basic">
					  	<div class="box-body">
				        	<table class="table">
								<tr>
									<th class="text-right">{{ trans('app.legal_name') }}:</th>
									<td style="width: 75%;">{{ $shop->legal_name }}</td>
								</tr>
								<tr>
									<th class="text-right">{{ trans('app.slug') }}:</th>
									<td style="width: 75%;">{{ $shop->slug }}</td>
								</tr>
								<tr>
									<th class="text-right">{{ trans('app.time_zone') }}:</th>
									<td style="width: 75%;">{{ $shop->timezone->text }}</td>
								</tr>
					            @if($shop->external_url)
									<tr>
										<th class="text-right">{{ trans('app.external_url') }}:</th>
										<td style="width: 75%;">{{ $shop->external_url }}</td>
									</tr>
								@endif
							</table>
						</div>
					</div>
				    <div class="tab-pane" id="config">
					  <div class="box-body">
				        <table class="table">
							<tr>
								<th class="text-right">{{ trans('app.order_handling_cost') }}:</th>
								<td style="width: 75%;">{{ get_formated_currency($shop->config->order_handling_cost) }}</td>
							</tr>

							@if($shop->config->tax)
								<tr>
									<th class="text-right">{{ trans('app.default_tax') }}:</th>
									<td style="width: 75%;">{{ $shop->config->tax->name }}</td>
								</tr>
							@endif

							@if($shop->config->paymentMethod)
								<tr>
									<th class="text-right">{{ trans('app.default_payment_method') }}:</th>
									<td style="width: 75%;">{{ $shop->config->paymentMethod->name }}</td>
								</tr>
							@endif

							<tr>
								<th class="text-right">{{ trans('app.payment_methods') }}:</th>
								<td style="width: 75%;">
									@foreach($shop->config->paymentMethods as $paymentMethod)
										<span class="label label-outline"> {{ $paymentMethod->name }}</span>
									@endforeach
								</td>
							</tr>

							<tr>
								<th class="text-right">{{ trans('app.support_phone') }}:</th>
								<td style="width: 75%;">{{ $shop->config->support_phone }}</td>
							</tr>

				            @if($shop->config->support_phone_toll_free)
								<tr>
									<th class="text-right">{{ trans('app.support_phone_toll_free') }}:</th>
									<td style="width: 75%;">{{ $shop->config->support_phone_toll_free }}</td>
								</tr>
							@endif

							<tr>
								<th class="text-right">{{ trans('app.support_email') }}:</th>
								<td style="width: 75%;">{{ $shop->config->support_email }}</td>
							</tr>

							<tr>
								<th class="text-right">{{ trans('app.config_updated_at') }}:</th>
								<td style="width: 75%;">{{ $shop->config->updated_at->toDayDateTimeString() }}</td>
							</tr>
				        </table>
					  </div>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="description">
			            {!! $shop->description ?? trans('app.description_not_available') !!}
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="contact">
					  <div class="box-body">
				        <table class="table">
				            @if($shop->email)
							<tr>
								<th class="text-right">{{ trans('app.email') }}:</th>
								<td style="width: 75%;">{{ $shop->email }}</td>
							</tr>
							@endif
				            @if($shop->primaryAddress)
							<tr>
								<th class="text-right">{{ trans('app.address') }}:</th>
								<td style="width: 75%;">
				        			{!! $shop->primaryAddress->toHtml() !!}
								</td>
							</tr>
							@endif
				        </table>
					  </div>
				    </div>
				    <!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->