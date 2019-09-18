<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>

            <div class="col-md-3 nopadding" style="margin-top: 10px;">
	            @if($cart->customer->image)
					<img src="{{ get_storage_file_url(optional($cart->customer->image)->path, 'small') }}" class="thumbnail" width="100%" alt="{{ trans('app.avatar') }}">
	            @else
            		<img src="{{ get_gravatar_url($cart->customer->email, 'small') }}" class="thumbnail" width="100%" alt="{{ trans('app.avatar') }}">
	            @endif
			</div>
            <div class="col-md-9 nopadding">
            	<div class="spacer10"></div>
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.customer') }}: </th>
						<td style="width: 75%;"><span class="lead">{{ $cart->customer->getName() }}</span></td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.email') }}:</th>
						<td style="width: 75%;">{{ $cart->customer->email }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.member_since') }}:</th>
						<td style="width: 75%;">{{ $cart->customer->created_at->toFormattedDateString() }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>

			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#items_tab" data-toggle="tab">
					{{ trans('app.items') }}
				  </a></li>
				  <li><a href="#info_tab" data-toggle="tab">
					{{ trans('app.cart_info') }}
				  </a></li>
				  <li><a href="#invoice_tab" data-toggle="tab">
					{{ trans('app.invoice') }}
				  </a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="items_tab">
					    <table class="table table-sripe">
					      <thead>
					        <tr>
					          <th>{{ trans('app.image') }}</th>
					          <th>{{ trans('app.description') }}</th>
					          <th>{{ trans('app.quantity') }}</th>
					          <th>{{ trans('app.price') }}</th>
					          <th>{{ trans('app.total') }}</th>
					        </tr>
					      </thead>
					      <tbody id="items">
				            @if(count($cart->inventories) > 0)
								@foreach($cart->inventories as $item )
									<tr>
										<td>
							                @if($item->image)
							                  <img src="{{ get_storage_file_url($item->image->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
							                @elseif($item->product->featuredImage)
							                  <img src="{{ get_storage_file_url($item->product->featuredImage->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
							                @else
							                  <img src="{{ get_storage_file_url(optional($item->product->image)->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
							                @endif
										</td>
										<td>{{ $item->pivot->item_description }}</td>
										<td>{{ $item->pivot->quantity }}</td>
										<td>{{ get_formated_currency($item->pivot->unit_price) }}</td>
										<td>{{ get_formated_currency($item->pivot->quantity * $item->pivot->unit_price) }}</td>
									</tr>
								@endforeach
							@else
						        <tr id='empty-cart'><td colspan="5">{{ trans('help.empty_cart') }}</td></tr>
							@endif
					      </tbody>
					    </table>
				    </div>
				    <!-- /.tab-pane -->

				    <div class="tab-pane" id="info_tab">
						<table class="table no-border">
							<tr>
								<th class="text-right">{{ trans('app.created_at') }}:</th>
								<td style="width: 75%;">{{ $cart->created_at->toDayDateTimeString() }}</td>
							</tr>
							<tr>
								<th class="text-right">{{ trans('app.cart') }}: </th>
								<td style="width: 75%;">{{ $cart->id }}</td>
							</tr>
							@if($cart->shippingRate)
								<tr>
									<th class="text-right">{{ trans('app.carrier') }}:</th>
									<td style="width: 75%;">
										{{ $cart->shippingRate->name }}
										@if($cart->carrier)
									    	<small class="indent20"> {{ trans('app.by') . ' ' . $cart->carrier->name }} </small>
										@endif
									</td>
								</tr>
							@endif
							@if($cart->shippingPackage)
								<tr>
									<th class="text-right">{{ trans('app.packaging') }}:</th>
									<td style="width: 75%;">{{ $cart->shippingPackage->name }}</td>
								</tr>
							@endif
							<tr>
								<th class="text-right">{{ trans('app.shipping_address') }}: </th>
								<td style="width: 75%;">{{ $cart->shipping_address }}</td>
							</tr>
							@if($cart->message_to_customer)
								<tr>
									<th class="text-right">{{ trans('app.message_to_customer') }}: </th>
									<td style="width: 75%;">{!! $cart->message_to_customer !!}</td>
								</tr>
							@endif
							@if($cart->admin_note)
								<tr>
									<th class="text-right">{{ trans('app.admin_note') }}: </th>
									<td style="width: 75%;">{!! $cart->admin_note !!}</td>
								</tr>
							@endif
						</table>
				    </div>
				    <!-- /.tab-pane -->

				    <div class="tab-pane" id="invoice_tab">
						<table class="table no-border">
							<tr>
								<th class="text-right">{{ trans('app.grand_total') }}:</th>
								<td style="width: 75%;"><span class="lead"> {{ get_formated_currency($cart->grand_total) }}</span></td>
							</tr>
							<tr>
								<th class="text-right">{{ trans('app.total') }}:</th>
								<td style="width: 75%;">{{ get_formated_currency($cart->total) }}</td>
							</tr>
							<tr>
								<th class="text-right">{{ trans('app.discount') }}:</th>
								<td style="width: 75%;"> - {{ get_formated_currency($cart->discount) }}</td>
							</tr>
							<tr>
								<th class="text-right">{{ trans('app.shipping') }}:</th>
								<td style="width: 75%;">{{ get_formated_currency($cart->shipping) }}</td>
							</tr>
							<tr>
								<th class="text-right">{{ trans('app.handling') }}:</th>
								<td style="width: 75%;">{{ get_formated_currency($cart->handling) }}</td>
							</tr>
							<tr>
								<th class="text-right">{{ trans('app.taxes') }}:</th>
								<td style="width: 75%;">{{ get_formated_currency($cart->taxes) }}</td>
							</tr>
							<tr>
								<th class="text-right">{{ trans('app.billing_address') }}:</th>
								<td style="width: 75%;">{{ $cart->billing_address }}</td>
							</tr>
						</table>
					</div>
				    <!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>
        </div> <!-- / .modal-body -->
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->