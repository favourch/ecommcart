@extends('admin.layouts.master')

@section('page-style')
	@include('plugins.ionic')
@endsection

@section('content')

	@include('admin.partials._subscription_notice')

    @if(! Auth::user()->isVerified())
		<div class="alert alert-info alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
			{{ trans('messages.email_verification_notice') }}
	    	<a href="{{ route('verify') }}">{{ trans('app.resend_varification_link') }}</a>
		</div>
    @endif

    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
          <div class="info-box">
            <span class="info-box-icon bg-yellow">
				<i class="icon ion-md-cube"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('app.unfulfilled_orders') }}</span>
              <span class="info-box-number">
              	{{ $unfulfilled_order_count }}
    			<a href="{{ url('admin/order/order?tab=unfulfilled') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
    				<i class="icon ion-md-send"></i>
    			</a>
              </span>
              	@php
              		$unfulfilled_percents = $todays_order_count == 0 ?
              				($unfulfilled_order_count * 100) : round(($unfulfilled_order_count / $todays_order_count) * 100);
              	@endphp
              	<div class="progress">
                	<div class="progress-bar progress-bar-warning" style="width: {{$unfulfilled_percents}}%"></div>
              	</div>
              	<span class="progress-description text-muted">
              		{{ trans('messages.unfulfilled_percents', ['percent' => $unfulfilled_percents]) }}
                </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">
				<i class="icon ion-md-cart"></i>
            </span>

            <div class="info-box-content">
	            <span class="info-box-text">{{ trans('app.last_sale') }}</span>
              	<span class="info-box-number">
              		{{ get_formated_currency($last_sale ? $last_sale->total : 0) }}
              		@if($last_sale)
	  	    			<a href="{{ route('admin.order.order.show', $last_sale->id) }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
    						<i class="icon ion-md-send"></i>
    					</a>
					@endif
				</span>
              	<div class="progress" style="background: transparent;"></div>
              	<span class="progress-description text-muted">
              		@if($last_sale)
	                    <i class="icon ion-md-time"></i> {{ $last_sale->created_at->diffForHumans() }}
					@else
						<i class="icon ion-md-hourglass"></i> {{ trans('messages.no_sale', ['date' => trans('app.yet')]) }}
					@endif
                </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
          <div class="info-box">
            <span class="info-box-icon bg-green">
            	<i class="icon ion-md-wallet"></i>
            </span>

            <div class="info-box-content">
	            <span class="info-box-text">{{ trans('app.todays_sale') }}</span>
              	<span class="info-box-number">
              		{{ get_formated_currency($todays_sale_amount) }}
  	    			<a href="{{ route('admin.order.order.index') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
    					<i class="icon ion-md-send"></i>
    				</a>
				</span>

              	@php
              		$difference = $todays_sale_amount - $yesterdays_sale_amount;
              		$todays_sale_percents = $todays_sale_amount == 0 ? 0 : round(($difference / $todays_sale_amount) * 100);
              	@endphp
              	<div class="progress">
                	<div class="progress-bar progress-bar-success" style="width: {{$todays_sale_percents}}%"></div>
              	</div>
              	<span class="progress-description text-muted">
              		@if($todays_sale_amount == 0)
	              		<i class="icon ion-md-hourglass"></i>
              			{{ trans('messages.no_sale', ['date' => trans('app.today')]) }}
              		@else
	              		<i class="icon ion-md-arrow-{{ $difference < 0 ? 'down' : 'up'}}"></i>
	              		{{ trans('messages.todays_sale_percents', ['percent' => $todays_sale_percents, 'state' => $difference < 0 ? trans('app.down') : trans('app.up')]) }}
              		@endif
                </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left">
          <div class="info-box">
            <span class="info-box-icon bg-red">
            	<i class="icon ion-md-notifications-outline"></i>
            </span>

            <div class="info-box-content">
	            <span class="info-box-text">{{ trans('app.stock_outs') }}</span>
              	<span class="info-box-number">
              		{{ $stock_out_count }}
	    			<a href="{{ url('admin/stock/inventory?tab=out_of_stock') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
	    				<i class="icon ion-md-send"></i>
	    			</a>
              	</span>

              	@php
              		$stock_out_percents = $stock_count == 0 ?
              				($stock_out_count * 100) : round(($stock_out_count / $stock_count) * 100);
              	@endphp
              	<div class="progress">
                	<div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              	</div>
              	<span class="progress-description text-muted">
	          		{{ trans('messages.stock_out_percents', ['percent' => $stock_out_percents, 'total' => $stock_count]) }}
                </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-8 col-sm-7 col-xs-12">
			@if($dispute_count > 0 || $refund_request_count > 0)
			    <div class="row">
			        <div class="col-sm-6 col-xs-12 nopadding-right">
						<div class="info-box bg-yellow">
							<span class="info-box-icon"><i class="icon ion-md-megaphone"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">{{ trans('app.disputes') }}</span>
								<span class="info-box-number">
					              	{{ $dispute_count }}
					    			<a href="{{ route('admin.support.dispute.index') }}" class="pull-right" data-toggle="tooltip" data-placement="left" title="{{ trans('app.take_action') }}" >
					    				<i class="icon ion-md-paper-plane"></i>
					    			</a>
								</span>

				              	@php
				              		$last_months = $last_60days_dispute_count - $last_30days_dispute_count;
				              		$difference = $last_30days_dispute_count - $last_months;
				              		$last_30_days_percents = $last_months == 0 ? 100 : round(($difference / $last_months) * 100);
				              	@endphp
								<div class="progress">
									<div class="progress-bar" style="width: {{$last_30_days_percents}}%"></div>
								</div>
								<span class="progress-description">
				              		<i class="icon ion-md-arrow-{{ $difference > 0 ? 'up' : 'down'}}"></i>
				              		{{ trans('messages.last_30_days_percents', ['percent' => $last_30_days_percents, 'state' => $difference > 0 ? trans('app.increase') : trans('app.decrease')]) }}
								</span>
							</div>
							<!-- /.info-box-content -->
						</div>
					</div>

			        <div class="col-sm-6 col-xs-12 nopadding-left">
						<div class="info-box bg-aqua">
							<span class="info-box-icon"><i class="icon ion-md-nuclear"></i></span>

							<div class="info-box-content">
								<span class="info-box-text">{{ trans('app.refund_requests') }}</span>
								<span class="info-box-number">
					              	{{ $refund_request_count }}
					    			<a href="{{ route('admin.support.refund.index') }}" class="pull-right" data-toggle="tooltip" data-placement="left" title="{{ trans('app.take_action') }}" >
					    				<i class="icon ion-md-paper-plane"></i>
					    			</a>
								</span>

				              	@php
				              		$last_months = $last_60days_refund_request_count - $last_30days_refund_request_count;
				              		$difference = $last_30days_refund_request_count - $last_months;
				              		$last_30_days_percents = $last_months == 0 ? 100 : round(($difference / $last_months) * 100);
				              	@endphp
								<div class="progress">
									<div class="progress-bar" style="width: {{$last_30_days_percents}}%"></div>
								</div>
								<span class="progress-description">
				              		<i class="icon ion-md-arrow-{{ $difference > 0 ? 'up' : 'down'}}"></i>
				              		{{ trans('messages.last_30_days_percents', ['percent' => $last_30_days_percents, 'state' => $difference > 0 ? trans('app.increase') : trans('app.decrease')]) }}
								</span>
							</div>
							<!-- /.info-box-content -->
						</div>
					</div>
				</div>
			@endif

         	<div class="box">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs nav-justified">
						<li class="active"><a href="#orders_tab" data-toggle="tab">
							<i class="fa fa-shopping-cart hidden-sm"></i>
							{{ trans('app.latest_orders') }}
						</a></li>
						<li><a href="#inventory_tab" data-toggle="tab">
							<i class="fa fa-cubes hidden-sm"></i>
							{{ trans('app.recently_added_products') }}
						</a></li>
						<li><a href="#low_stock_tab" data-toggle="tab">
							<i class="fa fa-cube hidden-sm"></i>
							{{ trans('app.low_stock_items') }}
						</a></li>
					</ul>
		            <!-- /.nav .nav-tabs -->

					<div class="tab-content">
					    <div class="tab-pane active" id="orders_tab">
				            <div class="box-body nopadding">
								<div class="table-responsive">
									<table class="table no-margin table-condensed">
										<thead>
											<tr>
												<th>{{ trans('app.order_number') }}</th>
												<th>{{ trans('app.order_date') }}</th>
												<th>{{ trans('app.customer') }}</th>
												<th>{{ trans('app.grand_total') }}</th>
												<th>{{ trans('app.payment') }}</th>
												<th>{{ trans('app.status') }}</th>
											</tr>
										</thead>
										<tbody>
											@forelse($latest_orders as $order)
												<tr>
													<td>
														@can('view', $order)
															<a href="{{ route('admin.order.order.show', $order->id) }}">
																{{ $order->order_number }}
															</a>
														@else
															{{ $order->order_number }}
														@endcan
														@if($order->disputed)
															<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
														@endif
													</td>
											        <td>{{ $order->created_at->diffForHumans() }}</td>
													<td>{{ optional($order->customer)->name }}</td>
													<td>{{ get_formated_currency($order->grand_total )}}</td>
													<td>{!! $order->paymentStatusName() !!}</td>
													<td>
														<span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
															{{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
														</span>
													</td>
												</tr>
											@empty
												<tr>
													<td colspan="6">{{ trans('app.no_data_found') }}</td>
												</tr>
											@endforelse
										</tbody>
									</table>
								</div>
								<!-- /.table-responsive -->
				            </div>
				            <!-- /.box-body -->
				            <div class="box-footer clearfix">
								@can('create', App\Order::class)
									<a href="#" data-link="{{ route('admin.order.order.searchCutomer') }}" class="ajax-modal-btn btn btn-new btn-flat pull-left">
										<i class="icon ion-md-cart"></i> {{ trans('app.add_order') }}
									</a>
								@endcan
					            @can('index', App\Order::class)
									<a href="{{ route('admin.order.order.index') }}" class="btn btn-default btn-flat pull-right">
										<i class="icon ion-md-gift"></i> {{ trans('app.all_orders') }}
									</a>
								@endcan
				            </div>
				            <!-- /.box-footer -->
						</div>
			            <!-- /.tab-pane -->

					    <div class="tab-pane" id="inventory_tab">
				            <div class="box-body nopadding">
								<div class="table-responsive">
									<table class="table no-margin table-condensed">
										<thead>
											<tr>
												<th>{{ trans('app.image') }}</th>
												<th>{{ trans('app.sku') }}</th>
												<th>{{ trans('app.name') }}</th>
												<th>{{ trans('app.price') }} <small>( {{ trans('app.excl_tax') }} )</small> </th>
												<th>{{ trans('app.quantity') }}</th>
												<th>{{ trans('app.status') }}</th>
											</tr>
										</thead>
										<tbody>
											@forelse($latest_stocks as $inventory)
												<tr>
													<td>
														<img src="{{ get_storage_file_url(optional($inventory->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
													</td>
													<td>{{ $inventory->sku }}</td>
													<td>{{ optional($inventory->product)->name }}</td>
													<td>
														@if(($inventory->offer_price > 0) && ($inventory->offer_end > \Carbon\Carbon::now()))
															<?php $offer_price_help =
																	trans('help.offer_starting_time') . ': ' .
																	$inventory->offer_start->diffForHumans() . ' and ' .
																	trans('help.offer_ending_time') . ': ' .
																	$inventory->offer_end->diffForHumans(); ?>

															<small class="text-muted">{{ $inventory->sale_price }}</small><br/>
															{{ get_formated_currency($inventory->offer_price) }}

															<small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ $offer_price_help }}"><sup><i class="fa fa-question"></i></sup></small>
														@else
															{{ get_formated_currency($inventory->sale_price) }}
														@endif
													</td>
													<td>{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}</td>
													<td>{{ ($inventory->active) ? trans('app.active') : trans('app.inactive') }}</td>
												</tr>
											@empty
												<tr>
													<td colspan="6">{{ trans('app.no_data_found') }}</td>
												</tr>
											@endforelse
										</tbody>
									</table>
								</div>
								<!-- /.table-responsive -->
				            </div>
				            <!-- /.box-body -->
				            <div class="box-footer clearfix">
					            @can('index', App\Inventory::class)
									<a href="{{ route('admin.stock.inventory.index') }}" class="btn btn-default btn-flat pull-right">
										<i class="icon ion-md-cube"></i> {{ trans('app.inventories') }}
									</a>
								@endcan
				            </div>
				            <!-- /.box-footer -->
						</div>
			            <!-- /.tab-pane -->

					    <div class="tab-pane" id="low_stock_tab">
				            <div class="box-body nopadding">
								<div class="table-responsive">
									<table class="table no-margin table-condensed">
										<thead>
											<tr>
												<th>{{ trans('app.image') }}</th>
												<th>{{ trans('app.sku') }}</th>
												<th>{{ trans('app.name') }}</th>
												<th>{{ trans('app.quantity') }}</th>
												<th>{{ trans('app.status') }}</th>
												<th width="20px">&nbsp;</th>
											</tr>
										</thead>
										<tbody>
											@forelse($low_qtt_stocks as $inventory)
												<tr>
													<td>
														<img src="{{ get_storage_file_url(optional($inventory->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
													</td>
													<td>{{ $inventory->sku }}</td>
													<td>{{ optional($inventory->product)->name }}</td>
													<td class="qtt-{{$inventory->id}}">{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}</td>
													<td>{{ ($inventory->active) ? trans('app.active') : trans('app.inactive') }}</td>
													<td class="row-options">
														@can('update', $inventory)
															<a href="#" data-link="{{ route('admin.stock.inventory.editQtt', $inventory->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.update') }}" class="icon ion-md-add-circle"></i></a>
														@endcan
													</td>
												</tr>
											@empty
												<tr>
													<td colspan="6">{{ trans('app.no_data_found') }}</td>
												</tr>
											@endforelse
										</tbody>
									</table>
								</div>
								<!-- /.table-responsive -->
				            </div>
				            <!-- /.box-body -->
				            <div class="box-footer clearfix">
					            @can('index', App\Inventory::class)
									<a href="{{ route('admin.stock.inventory.index') }}" class="btn btn-default btn-flat pull-right">
										<i class="icon ion-md-cube"></i> {{ trans('app.inventories') }}
									</a>
								@endcan
				            </div>
				            <!-- /.box-footer -->
						</div>
			            <!-- /.tab-pane -->
					</div>
		            <!-- /.tab-content -->
				</div>
	            <!-- /.nav-tabs-custom -->
          	</div>
          	<!-- /.box -->

          	{{-- Activity Logs --}}
	    	@include('admin.partials._activity_logs', ['logger' => Auth::user()->shop])
	    </div>
      	<!-- /.col-*-* -->

        <div class="col-md-4 col-sm-5 col-xs-12 nopadding-left">
        	@if((bool) config('dashboard.upgrade_plan_notice'))
	          	@php
	          		$staff_count_percentage = round(($user_count / $current_plan->team_size ) * 100);
	          		$stock_used_percentage = round(($stock_count / $current_plan->inventory_limit ) * 100);
	          	@endphp

	        	@if($staff_count_percentage > 90 || $stock_used_percentage > 75)
	          		<div class="box box-solid removable">
						<div class="box-header">
							<h3 class="box-title text-warning"><i class="icon ion-md-pulse"></i> {{ trans('app.resource_uses') }}</h3>
							<div class="box-tools pull-right">
			                	<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>

			            <div class="box-body">
			              	<span class="progress-description">
	            				<i class="icon ion-md-contacts"></i> {{ trans('app.staff') }}
			                </span>

			              	@php
			              		switch ($staff_count_percentage) {
			              			case $staff_count_percentage > 90: $state = 'red'; break;
			              			case $staff_count_percentage > 75: $state = 'warning'; break;
			              			case $staff_count_percentage > 60: $state = 'info'; break;
			              			default: $state = 'primary'; break;
			              		}
			              	@endphp

							<div class="progress active">
				                <div class="progress-bar progress-bar-{{$state}} progress-bar-striped" role="progressbar" aria-valuenow="{{$staff_count_percentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$staff_count_percentage}}%">
				                  <span class="show {{$staff_count_percentage < 50 ? 'text-muted' : ''}}">{{ trans('messages.resource_uses_out_of', ['used' => $user_count, 'limit' => $current_plan->team_size]) }}</span>
				                </div>
				            </div>

			              	<span class="progress-description">
	            				<i class="icon ion-md-cube"></i> {{ trans('app.stock') }}
			                </span>

			              	@php
			              		switch ($stock_used_percentage) {
			              			case $stock_used_percentage > 90: $state = 'red'; break;
			              			case $stock_used_percentage > 75: $state = 'warning'; break;
			              			case $stock_used_percentage > 60: $state = 'info'; break;
			              			default: $state = 'primary'; break;
			              		}
			              	@endphp

							<div class="progress active">
				                <div class="progress-bar progress-bar-{{$state}} progress-bar-striped" role="progressbar" aria-valuenow="{{$stock_used_percentage}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$stock_used_percentage}}%">
				                  <span class="show {{$stock_used_percentage < 50 ? 'text-muted' : ''}}">{{ trans('messages.resource_uses_out_of', ['used' => $stock_count, 'limit' => $current_plan->inventory_limit]) }}</span>
				                </div>
				            </div>

							<div class="callout callout-info" style="margin-bottom: 0!important;">
				            	<i class="fa fa-support"></i> {{ trans('messages.time_to_upgrade_plan') }}
						    </div>
			        	</div>
						<div class="box-footer">
	                		<a href="{{ route('admin.account.billing') }}" type="button" class="btn btn-flat btn-default">
		                		<i class="fa fa-leaf"></i> {{ trans('app.choose_plan') }}
		                	</a>

							<div class="box-tools pull-right">
		                		<a href="{{ route('admin.dashboard.config.toggle', 'upgrade_plan_notice') }}" type="button" class="btn btn-box-tool toggle-widget toggle-confirm">
			                		<i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="{{ trans('app.never_show_this') }}"></i>
			                	</a>
							</div>
						</div>
			        </div>
	        	@endif
        	@endif

          	<div class="box box-solid">
	            <div class="box-header with-border">
	              	<h3 class="box-title text-warning">
	              		<i class="icon ion-md-clock"></i> {{ trans('app.latest_days', ['days' => config('charts.latest_sales.days', 15)]) }}
	              	</h3>
	              	<div class="box-tools pull-right">
	                	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                	<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	              	</div>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	            	<p class="text-muted"><span class="lead"> {{ trans('app.total') }}: {{ get_formated_currency($latest_sale_total) }} </span><span class="pull-right">{{ $latest_order_count . ' ' . trans('app.orders') }}</span></p>
	        		<div>{!! $chart->container() !!}</div>

        			<table class="table table-default">
        				<thead>
        					<tr>
        						<td><span class="info-box-text">{{ trans('app.breakdown') }}:</span></td>
        						<td>&nbsp;</td>
        					</tr>
        				</thead>
        				<tbody>
        					<tr>
        						<td>{{ trans('app.orders') }}</td>
        						<td class="pull-right">{{ get_formated_currency($latest_sale_total) }}</td>
        					</tr>
        					<tr>
        						<td>{{ trans('app.refunds') }}</td>
        						<td class="pull-right">-{{ get_formated_currency($latest_refund_total) }}</td>
        					</tr>
        					<tr>
        						<td>{{ trans('app.total') }}</td>
        						<td class="pull-right">{{ get_formated_currency($latest_sale_total - $latest_refund_total) }}</td>
        					</tr>
        				</tbody>
        			</table>
	            </div>
	            <!-- /.box-body -->
          	</div>
          	<!-- /.box -->

	        <!-- PRODUCT LIST -->
	        <div class="box box-primary">
	            <div class="box-header with-border">
	              	<h3 class="box-title"><i class="icon ion-md-rocket"></i> {{ trans('app.top_selling_items') }}</h3>
	              	<div class="box-tools pull-right">
	                	<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	                	<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
	              	</div>
	            </div><!-- /.box-header -->
	            <div class="box-body">
	                <div class="table-responsive">
	                  	<table class="table no-margin table-condensed">
	                      	<thead>
	                        	<tr class="text-muted">
	                          		<th width="60px">&nbsp;</th>
	                          		<th>{{ trans('app.inventory') }}</th>
	                          		<th width="8%">{{ trans('app.sold') }}</th>
	                        	</tr>
	                      	</thead>
	                      	<tbody>
				                @foreach($top_listings as $inventory)
									<tr>
										<td>
											<img src="{{ get_storage_file_url(optional($inventory->image)->path, 'small') }}" class="img-md" alt="{{ trans('app.image') }}">
										</td>
										<td>
				                            <h5 class="nopadding">
				                            	<small>{{ trans('app.sku') . ': ' }}</small>
				                                @can('view', $inventory)
				                                    <a href="#" data-link="{{ route('admin.stock.inventory.show', $inventory->id) }}" class="ajax-modal-btn modal-btn">{{ $inventory->sku }}</a>
				                                @else
				                                  {{ $inventory->sku }}
				                                @endcan
				                            </h5>

				                        	<span class="text-muted">
				                          		{{ $inventory->name }}
												@if($inventory->attributeValues->count())
					                          		<small>({{ implode(' | ', array_column($inventory->attributeValues->toArray(), 'value') ) }})</small>
				                                @endif
				                        	</span>
										</td>
										<td>{{ trans('app.sold_units', ['units' => $inventory->sold_qtt]) }}</td>
									</tr>
				                @endforeach
	                      	</tbody>
	                  	</table>
	              	</div>
	            </div><!-- /.box-body -->
	            <div class="box-footer text-center">
					<a href="{{ route('admin.stock.inventory.index') }}" class="btn btn-default btn-flat pull-right">
						<i class="icon ion-md-cube"></i> {{ trans('app.inventories') }}
					</a>
	            </div><!-- /.box-footer -->
	        </div><!-- /.box -->
	    </div><!-- /.col-*-* -->
    </div><!-- /.row -->
@endsection

@section('page-script')
	@include('plugins.chart')

	{!! $chart->script() !!}
@endsection
