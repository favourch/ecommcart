<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
	        <div class="box-widget widget-user">
	            <div class="widget-user-header bg-aqua-active card-background">
	              	<h3 class="widget-user-username">{{ $customer->getName() }}</h3>
	              	<h5 class="widget-user-desc">
		                {{ ($customer->active) ? trans('app.active') : 	trans('app.inactive') }}
	              	</h5>
	            </div>
	            <div class="widget-user-image">
		            @if($customer->image)
						<img src="{{ get_storage_file_url(optional($customer->image)->path, 'small') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
		            @else
	            		<img src="{{ get_gravatar_url($customer->email, 'small') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
		            @endif
	            </div>
	            <div class="spacer10"></div>
              	<div class="row">
	                <div class="col-sm-4 border-right">
	                  <div class="description-block">
	                    <h5 class="description-header">{{ get_formated_currency(\App\Helpers\Statistics::total_spent($customer)) }}</h5>
	                    <span class="description-text">{{ trans('app.spent') }}</span>
	                  </div>
	                </div>

	                <div class="col-sm-4 border-right">
	                  <div class="description-block">
	                  	<h5 class="description-header">&nbsp;</h5>
	                    <span class="description-text small">{{ trans('app.member_since') }}: {{ $customer->created_at->diffForHumans() }}</span>
	                  </div>
	                </div>

	                <div class="col-sm-4">
	                  <div class="description-block">
	                    <h5 class="description-header">{{ \App\Helpers\Statistics::customer_orders_count($customer) }}</h5>
	                    <span class="description-text">#{{ trans('app.orders') }}</span>
	                  </div>
	                </div>
            	</div>
              	<!-- /.row -->
	            <div class="spacer10"></div>
	        </div>
	        <!-- /.widget-user -->

			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#basic_info_tab" data-toggle="tab">
				  	{{ trans('app.basic_info') }}
				  </a></li>
				  <li><a href="#address_tab" data-toggle="tab">
				  	{{ trans('app.addresses') }}
				  </a></li>
				  @if(Auth::user()->isFromPlatform())
					  <li><a href="#orders_tab" data-toggle="tab">
					  	{{ trans('app.latest_orders') }}
					  </a></li>
				  @endif
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="basic_info_tab">
				        <table class="table">
				            @if($customer->name)
				                <tr>
				                	<th width="25%">{{ trans('app.full_name') }}: </th>
				                	<td>{{ $customer->name }}</td>
				                </tr>
				            @endif

			                <tr>
			                	<th>{{ trans('app.email') }}: </th>
			                	<td>{{ $customer->email }}</td>
			                </tr>

				            @if($customer->dob)
				                <tr>
				                	<th>{{ trans('app.dob') }}: </th>
				                	<td>{!! date('F j, Y', strtotime($customer->dob)) . '<small> (' . get_age($customer->dob) . ')</small>' !!}</td>
				                </tr>
				            @endif

				            @if($customer->sex)
				                <tr>
				                	<th>{{ trans('app.sex') }}: </th>
				                	<td>{!! get_formated_gender($customer->sex) !!}</td>
				                </tr>
				            @endif

				            @if($customer->description)
				                <tr>
				                	<th>{{ trans('app.description') }}: </th>
				                	<td>{!! $customer->description !!}</td>
				                </tr>
				            @endif
				        </table>
				    </div> <!-- /.tab-pane -->

				    <div class="tab-pane" id="address_tab">
				    	@foreach($customer->addresses as $address)

					        {!! $address->toHtml() !!}

				    		@unless($loop->last)
						        <hr/>
					        @endunless
				    	@endforeach
				        <br/>
	            		@if(config('system_settings.address_show_map') && $customer->primaryAddress)
					        <div class="row">
			                    <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ urlencode($customer->primaryAddress->toGeocodeString()) }}&output=embed"></iframe>
					        </div>
					        <div class="help-block" style="margin-bottom: -10px;"><i class="fa fa-warning"></i> {{ trans('app.map_location') }}</div>
				       	@endif
				    </div> <!-- /.tab-pane -->

					@if(Auth::user()->isFromPlatform())
				    <div class="tab-pane" id="orders_tab">
				    	@if($customer->latest_orders->count())
							<table class="table table-hover table-2nd-short">
								<thead>
									<tr>
										<th>{{ trans('app.order_number') }}</th>
										<th>{{ trans('app.grand_total') }}</th>
										<th>{{ trans('app.payment') }}</th>
										<th>{{ trans('app.status') }}</th>
										<th>{{ trans('app.order_date') }}</th>
									</tr>
								</thead>
								<tbody>
									@foreach($customer->latest_orders as $order )
										<tr>
											<td>{{ $order->order_number }}</td>
											<td>{{ get_formated_currency($order->grand_total)}}</td>
											<td>{!! $order->paymentStatusName() !!}</td>
											<td>{{ optional($order->status)->name }}</td>
									        <td>{{ $order->created_at->toFormattedDateString() }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
				       	@else
				       		<p>{{ trans('messages.no_orders')}}</p>
				       	@endif
				    </div> <!-- /.tab-pane -->
					@endif
				</div> <!-- /.tab-content -->
			</div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->