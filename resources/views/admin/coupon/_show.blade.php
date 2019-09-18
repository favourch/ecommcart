<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
            <div class="col-md-12 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.name') }}:</th>
						<td style="width: 65%;"><span class="lead">{{ $coupon->name }}</span></td>
					</tr>
		            @if($coupon->shop_id)
					<tr>
						<th class="text-right">{{ trans('app.merchant') }}:</th>
						<td style="width: 65%;">
							<span class="label label-outline">
		                		{{ $coupon->shop->name }}
							</span>
						</td>
					</tr>
					@endif
					<tr>
						<th class="text-right">{{ trans('app.coupon_value') }}:</th>
						<td style="width: 65%;">
							<span class="label label-primary">
								{{ $coupon->type == 'amount' ? get_formated_currency($coupon->value) : get_formated_decimal($coupon->value) . ' ' . trans('app.percent') }}
							</span>
						</td>
					</tr>
	                <tr>
	                	<th class="text-right">{{ trans('app.status') }}: </th>
	                	<td style="width: 65%;">
							@if($coupon->ending_time < \Carbon\Carbon::now())
								{{ trans('app.expired') }}
							@else
								{{ ($coupon->active) ? trans('app.active') : trans('app.inactive') }}
							@endif
	                	</td>
	                </tr>
					<tr>
						<th class="text-right">{{ trans('app.created_at') }}:</th>
						<td style="width: 65%;">{{ $coupon->created_at->toDayDateTimeString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 65%;">{{ $coupon->updated_at->toDayDateTimeString() }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#tab_1" data-toggle="tab">
					{{ trans('app.basic_info') }}
				  </a></li>
				  <li><a href="#tab_2" data-toggle="tab">
					{{ trans('app.description') }}
				  </a></li>
				  <li><a href="#tab_3" data-toggle="tab">
					{{ trans('app.accessibility') }}
				  </a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="tab_1">
				        <table class="table">
			                <tr>
			                	<th>{{ trans('app.code') }}: </th>
			                	<td>{{ $coupon->code }}</td>
			                </tr>
				            @if($coupon->quantity_per_customer && $coupon->quantity_per_customer != 0)
				                <tr>
				                	<th>{{ trans('app.coupon_quantity_per_customer') }}: </th>
				                	<td>{{ $coupon->quantity_per_customer }}</td>
				                </tr>
				            @endif
			                <tr>
			                	<th>{{ trans('app.active_from') }}: </th>
			                	<td>{{ $coupon->starting_time ? $coupon->starting_time->toDayDateTimeString() : ''}}</td>
			                </tr>
			                <tr>
			                	<th>{{ trans('app.active_till') }}: </th>
			                	<td>{{ $coupon->ending_time ? $coupon->ending_time->toDayDateTimeString() : ''}}</td>
			                </tr>
				            @if($coupon->min_order_amount && $coupon->min_order_amount != 0)
				                <tr>
				                	<th>{{ trans('app.min_order_amount') }}: </th>
				                	<td>{{ get_formated_currency($coupon->min_order_amount) }}</td>
				                </tr>
				            @endif
			                <tr>
			                	<th>{{ trans('app.restriction') }}: </th>
			                	<td>{{ $coupon->limited ? trans('app.limited_coupon') : trans('app.public_coupon') }}</td>
			                </tr>
				        </table>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_2">
					  <div class="box-body">
				        @if($coupon->description)
				            {!! htmlspecialchars_decode($coupon->description) !!}
				        @else
				            <p>{{ trans('app.description_not_available') }} </p>
				        @endif
					  </div>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_3">
			            @if($coupon->limited)
							<table class="table table-hover table-2nd-short">
								<thead>
									<tr>
							          <th>{{ trans('app.avatar') }}</th>
							          <th>{{ trans('app.nice_name') }}</th>
							          <th>{{ trans('app.full_name') }}</th>
							          <th>{{ trans('app.email') }}</th>
							          <th>{{ trans('app.status') }}</th>
									</tr>
								</thead>
						        <tbody>
							        @foreach($coupon->customers as $customer )
								          <td>
											<img src="{{ get_storage_file_url(optional($customer->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
								          </td>
								          <td>{{ $customer->nice_name }}</td>
								          <td>{{ $customer->name }}</td>
								          <td>{{ $customer->email }}</td>
								          <td>{{ ($customer->active) ? trans('app.active') : trans('app.inactive') }}</td>
								        </tr>
							        @endforeach
						        </tbody>
							</table>
			            @else
				            <p>{{ trans('app.public_coupon') }} </p>
			            @endif
				    </div>
				  <!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->