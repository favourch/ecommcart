<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>

            <div class="col-md-4 nopadding" style="margin-top: 10px;">
			  	@if($inventory->product->featuredImage)
					<img src="{{ get_storage_file_url(optional($inventory->product->featuredImage)->path, 'medium') }}" class="thumbnail" width="100%" alt="{{ trans('app.featured_image') }}">
			  	@elseif($inventory->image)
					<img src="{{ get_storage_file_url($inventory->image->path, 'medium') }}"  width="100%" class="thumbnail" alt="{{ trans('app.image') }}">
				@else
					<img src="{{ get_storage_file_url(optional($inventory->product->image)->path, 'medium') }}" width="100%" class="thumbnail" alt="{{ trans('app.image') }}">
				@endif
			</div>
            <div class="col-md-8 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.name') }}:</th>
						<td style="width: 75%;">{{ $inventory->product->name }}</td>
					</tr>

		            @if($inventory->product->brand)
		                <tr>
		                	<th class="text-right">{{ trans('app.brand') }}: </th>
		                	<td style="width: 75%;">{{ $inventory->product->brand }}</td>
		                </tr>
		            @endif

		            @if($inventory->product->model_number)
						<tr>
							<th class="text-right">{{ trans('app.model_number') }}:</th>
							<td style="width: 75%;">{{ $inventory->product->model_number }}</td>
						</tr>
					@endif

		            <tr>
		            	<th class="text-right">{{ trans('app.status') }}: </th>
		            	<td style="width: 75%;">{{ ($inventory->active) ? trans('app.active') : trans('app.inactive') }}</td>
		            </tr>
					<tr>
						<th class="text-right">{{ trans('app.available_from') }}:</th>
						<td style="width: 75%;">{{ $inventory->available_from->toFormattedDateString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 75%;">{{ $inventory->updated_at->toDayDateTimeString() }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#listing_tab" data-toggle="tab">
					{{ trans('app.listing') }}
				  </a></li>
				  <li><a href="#productinfo_tab" data-toggle="tab">
					{{ trans('app.product') }}
				  </a></li>
				  <li><a href="#description_tab" data-toggle="tab">
					{{ trans('app.description') }}
				  </a></li>
				  <li><a href="#offer_tab" data-toggle="tab">
					{{ trans('app.offer') }}
				  </a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="listing_tab">
				        <table class="table">
				            @if($inventory->sku)
								<tr>
									<th class="text-right">{{ trans('app.sku') }}:</th>
									<td style="width: 75%;">{{ $inventory->sku }}</td>
								</tr>
							@endif

							<tr>
								<th class="text-right">{{ trans('app.sale_price') }}:</th>
								<td style="width: 75%;"> {{ get_formated_currency($inventory->sale_price) }} </td>
							</tr>

							<tr>
								<th class="text-right">{{ trans('app.stock_quantity') }}:</th>
								<td style="width: 75%;"> {{ $inventory->stock_quantity }} </td>
							</tr>

							<tr>
								<th class="text-right">{{ trans('app.min_order_quantity') }}:</th>
								<td style="width: 75%;">{{ $inventory->min_order_quantity }}</td>
							</tr>

					    	@php
					    		$attributes = $inventory->attributes->toArray();
					    		$attributeValues = $inventory->attributeValues->toArray();
					    	@endphp

				            @if(count($attributes) > 0)
								@foreach($attributes as $k => $attribute )
									<tr>
										<th class="text-right">{{ $attribute['name'] }}:</th>
										<td style="width: 75%;">{{ $attributeValues[$k]['value'] or trans('help.not_available') }}</td>
									</tr>
								@endforeach
							@endif

				            @if($inventory->condition)
								<tr>
									<th class="text-right">{{ trans('app.condition') }}:</th>
									<td style="width: 75%;">{{ $inventory->condition }}</td>
								</tr>
							@endif

				            @if($inventory->condition_note)
								<tr>
									<th class="text-right">{{ trans('app.condition_note') }}:</th>
									<td style="width: 75%;"> {{ $inventory->condition_note }} </td>
								</tr>
							@endif

							@if($inventory->product->requires_shipping)
								<tr>
									<th class="text-right">{{ trans('app.shipping_weight') }}:</th>
									<td style="width: 75%;">{{ get_formated_weight($inventory->shipping_weight) }}</td>
								</tr>
								<tr>
									<th class="text-right">{{ trans('app.packagings') }}:</th>
									<td style="width: 75%;">
										@forelse($inventory->packagings as $packaging)
											<label class="label label-outline">{{ $packaging->name }}</label>
										@empty
											<span>{{ trans('app.packaging_not_available') }}</span>
										@endforelse
									</td>
								</tr>
							@endif

				            @if($inventory->puchase_price)
								<tr>
									<th class="text-right">{{ trans('app.puchase_price') }}:</th>
									<td style="width: 75%;"> {{ get_formated_currency($inventory->puchase_price) }} </td>
								</tr>
							@endif

				            @if($inventory->damaged_quantity)
								<tr>
									<th class="text-right">{{ trans('app.damaged_quantity') }}:</th>
									<td style="width: 75%;"> {{ $inventory->damaged_quantity }} </td>
								</tr>
							@endif

				            @if($inventory->supplier)
								<tr>
									<th class="text-right">{{ trans('app.supplier') }}:</th>
									<td style="width: 75%;"> {{ $inventory->supplier->name }} </td>
								</tr>
							@endif

				            @if($inventory->warehouse)
								<tr>
									<th class="text-right">{{ trans('app.warehouse') }}:</th>
									<td style="width: 75%;"> {{ $inventory->warehouse->name }} </td>
								</tr>
							@endif
				        </table>
				    </div>
				    <!-- /.tab-pane -->

				    <div class="tab-pane" id="productinfo_tab">
				        <table class="table">
			                <tr>
			                	<th class="text-right">{{ trans('app.name') }}: </th>
			                	<td style="width: 75%;">{{ $inventory->product->name }}</td>
				            </tr>

			                <tr>
			                	<th class="text-right">{{ trans('app.categories') }}: </th>
			                	<td style="width: 75%;">
						          	@foreach($inventory->product->categories as $category)
							          	<span class="label label-outline">{{ $category->name }}</span>
							        @endforeach
				                </td>
				            </tr>

				            @if($inventory->product->gtin_type && $inventory->product->gtin )
				                <tr>
				                	<th class="text-right">{{ $inventory->product->gtin_type }}: </th>
				                	<td style="width: 75%;">{{ $inventory->product->gtin }}</td>
				                </tr>
				            @endif

				            @if($inventory->product->mpn)
				                <tr>
				                	<th class="text-right">{{ trans('app.mpn') }}: </th>
				                	<td style="width: 75%;">{{ $inventory->product->mpn }}</td>
				                </tr>
				            @endif

				            @if($inventory->product->manufacturer)
				                <tr>
				                	<th class="text-right">{{ trans('app.manufacturer') }}: </th>
				                	<td style="width: 75%;">{{ $inventory->product->manufacturer->name }}</td>
				                </tr>
				            @endif

				            @if($inventory->product->origin)
				                <tr>
				                	<th class="text-right">{{ trans('app.origin') }}: </th>
				                	<td style="width: 75%;">{{ $inventory->product->origin->name }}</td>
				                </tr>
				            @endif

							<tr>
								<th class="text-right">{{ trans('app.has_variant') }}:</th>
								<td style="width: 75%;">{{ $inventory->product->has_variant ? trans('app.yes') : trans('app.no') }}</td>
							</tr>

			                <tr>
			                	<th class="text-right">{{ trans('app.downloadable') }}: </th>
			                	<td style="width: 75%;">
									{{ $inventory->product->downloadable ? trans('app.yes') : trans('app.no') }}
								</td>
			                </tr>

			                <tr>
			                	<th class="text-right">{{ trans('app.requires_shipping') }}: </th>
			                	<td style="width: 75%;">
									{{ $inventory->product->requires_shipping ? trans('app.yes') : trans('app.no') }}
								</td>
			                </tr>

				            @if($inventory->product->min_price && $inventory->product->min_price > 0)
				                <tr>
				                	<th class="text-right">{{ trans('app.min_price') }}: </th>
				                	<td style="width: 75%;">{{ get_formated_currency($inventory->product->min_price) }}</td>
				                </tr>
				            @endif
				            @if($inventory->product->max_price && $inventory->product->max_price > 0)
				                <tr>
				                	<th class="text-right">{{ trans('app.max_price') }}: </th>
				                	<td style="width: 75%;">{{ get_formated_currency($inventory->product->max_price) }}</td>
				                </tr>
				            @endif

			                <tr>
			                	<th class="text-right">{{ trans('app.description') }}: </th>
			                	<td style="width: 75%;">
				            		{!! htmlspecialchars_decode($inventory->product->description) !!}
			                	</td>
			                </tr>

				        </table>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="description_tab">
					  <div class="box-body">
				        @if($inventory->description)
				            {!! $inventory->description !!}
				        @else
				            <p>{{ trans('app.description_not_available') }} </p>
				        @endif
					  </div>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="offer_tab">
				        <table class="table">
				            @if($inventory->offer_price && $inventory->offer_price > 0)
								<tr>
									<th class="text-right">{{ trans('app.offer_price') }}:</th>
									<td style="width: 75%;">{{ get_formated_currency($inventory->offer_price) }}</td>
								</tr>
					        @else
								<tr>
									<th>{{ trans('app.no_offer_available') }}</th>
								</tr>
							@endif
				            @if($inventory->offer_start)
								<tr>
									<th class="text-right">{{ trans('app.offer_start') }}:</th>
									<td style="width: 75%;">
										{{ $inventory->offer_start->toDayDateTimeString() .' - '. $inventory->offer_start->diffForHumans() }}
									</td>
								</tr>
							@endif
				            @if($inventory->offer_end)
								<tr>
									<th class="text-right">{{ trans('app.offer_end') }}:</th>
									<td style="width: 75%;">{{ $inventory->offer_end->toDayDateTimeString() .' - '. $inventory->offer_end->diffForHumans() }}</td>
								</tr>
							@endif
				        </table>
				    </div>
				  	<!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->