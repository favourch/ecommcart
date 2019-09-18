@php
	$shipping_country_id = get_id_of_model('countries', 'iso_3166_2', $geoip->iso_code);
	$shipping_state_id = $geoip->state;

	$shipping_zone = get_shipping_zone_of($item->shop_id, $shipping_country_id, $shipping_state_id);
	$shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';
@endphp

<section>
	<div class="container">
		<div class="row sc-product-item" id="single-product-wrapper">
		  	<div class="col-md-5 col-sm-6">
		  		@include('layouts.jqzoom', ['item' => $item])
		  	</div><!-- /.col-md-5 col-sm-6 -->

		  	<div class="col-md-7 col-sm-6">
		  		<div class="row">
				  	<div class="col-md-7 col-sm-6 nopadding">
				      	<div class="product-single">
					  		@include('layouts.product_info', ['item' => $item])

			              	<div class="space20"></div>

				          	<div class="product-info-options space10">
				              	<div class="select-box-wrapper">
				              		@foreach($attributes as $attribute)
					                  	<div class="row product-attribute">
										  	<div class="col-sm-3 col-xs-4">
					    	              		<span class="info-label" id="attr-{{str_slug($attribute->name)}}" >{{ $attribute->name }}:</span>
											</div>
										  	<div class="col-sm-9 col-xs-8 nopadding-left">
							                    <select class="product-attribute-selector {{ $attribute->attribute_type_id == \App\Attribute::TYPE_COLOR ? 'color-options' : 'selectBoxIt' }}" required="required">
								              		@foreach($attribute->attributeValues as $option)
						                          		<option value="{{ $option->id }}" data-color="{{ $option->color ?? $option->value }}" {{ in_array($option->id, $item_attrs) ? 'selected' : '' }}>{{ $option->value }}</option>
								              		@endforeach
						                      	</select>
												<div class="help-block with-errors"></div>
							              	</div><!-- /.col-sm-9 .col-xs-6 -->
						              	</div><!-- /.row -->
				              		@endforeach
				              	</div><!-- /.row .select-box-wrapper -->

					          	<div class="sep"></div>

				              	<div id="calculation-section">
				                  	<div class="row">
									  	<div class="col-sm-3 col-xs-4">
				    	              		<span class="info-label" data-options="{{ $shipping_options }}" id="shipping-options" >@lang('theme.shipping'):</span>
								            {{ Form::hidden('shipping_zone_id', Null, ['id' => 'shipping-zone-id']) }}
								            {{ Form::hidden('shipping_rate_id', Null, ['id' => 'shipping-rate-id']) }}
										</div>
									  	<div class="col-sm-9 col-xs-8 nopadding-left">
				                            <span id="summary-shipping-cost" data-value="0"></span>
					                        <div id="product-info-shipping-detail">
					                            <span>{{ strtolower(trans('theme.to')) }}
							                      	<select name="ship_to" class="ship_to" id="shipTo">
													    @foreach($countries as $country_id => $country_name)
															<option value="{{$country_id}}" {{$country_id == $shipping_country_id ? 'selected' : ''}}>{{$country_name}}</option>
													    @endforeach
							                      	</select>
													<select id="width_tmp_select"><option id="width_tmp_option"></option></select>
					                            </span>

										  		<span class="dynamic-shipping-rates" data-toggle="popover" title="{{ trans('theme.shipping_options') }}">
						                            <span id="summary-shipping-carrier"></span>
						                            <small><i class="fa fa-caret-square-o-down"></i></small>
										  		</span>
									  		</div>
									  		<small class="text-muted" id="delivery-time"></small>
						              	</div><!-- /.col-sm-9 .col-xs-6 -->
					              	</div><!-- /.row -->

				                  	<div class="row">
									  	<div class="col-sm-3 col-xs-4">
				    	              		<span class="info-label qtt-label">@lang('theme.quantity'):</span>
										</div>
									  	<div class="col-sm-9 col-xs-8 nopadding">
							              	<div class="product-qty-wrapper">
							                  	<div class="product-info-qty-item">
							                      	<button class="product-info-qty product-info-qty-minus">-</button>
							                      	<input class="product-info-qty product-info-qty-input" data-name="product_quantity" data-min="{{$item->min_order_quantity}}" data-max="{{$item->stock_quantity}}" type="text" value="{{$item->min_order_quantity}}">
							                      	<button class="product-info-qty product-info-qty-plus">+</button>
								                </div>
							                  	<span class="available-qty-count">@lang('theme.stock_count', ['count' => $item->stock_quantity])</span>
							              	</div>
						              	</div><!-- /.col-sm-9 .col-xs-6 -->
				                  	</div><!-- /.row -->

				                  	<div class="row" id="order-total-row">
									  	<div class="col-sm-3 col-xs-4">
				    	              		<span class="info-label">@lang('theme.total'):</span>
										</div>
									  	<div class="col-sm-9 col-xs-8 nopadding">
				                            <span id="summary-total" class="text-muted">{{ trans('theme.notify.will_calculated_on_select') }}</span>
						              	</div><!-- /.col-sm-9 .col-xs-6 -->
					              	</div><!-- /.row -->
				              	</div>
				          	</div><!-- /.product-option -->

				          	<div class="sep"></div>

 				          	<a href="{{ route('direct.checkout', $item->slug) }}" class="btn btn-lg btn-warning flat" id="buy-now-btn"><i class="fa fa-rocket"></i> @lang('theme.button.buy_now')</a>

 				          	@if($item->product->inventories_count > 1)
						        <a href="{{ route('show.offers', $item->product->slug) }}" class="btn btn-sm btn-link">
					        		@lang('theme.view_more_offers', ['count' => $item->product->inventories_count])
						        </a>
					        @endif
				      	</div><!-- /.product-single -->
			  		</div>

				  	<div class="col-md-5 col-sm-6 nopadding-right">
				        <div class="seller-info space30">
				            <div class="text-muted small">@lang('theme.sold_by')</div>

							<img src="{{ get_storage_file_url(optional($item->shop->image)->path, 'tiny') }}" class="seller-info-logo img-sm img-circle" alt="{{ trans('theme.logo') }}">

				            <a href="{{ route('show.store', $item->shop->slug) }}" class="seller-info-name">
				            	{{ $item->shop->name }}
				            </a>
				        </div><!-- /.seller-info -->

			          	<a href="{{ route('cart.addItem', $item->slug) }}" class="btn btn-primary btn-lg btn-block flat space10 sc-add-to-cart">
			          		<i class="fa fa-shopping-bag"></i> @lang('theme.button.add_to_cart')
			          	</a>

			          	@if($item->product->inventories_count > 1)
					        <a href="{{ route('show.offers', $item->product->slug) }}" class="btn btn-block btn-link btn-sm">
					        	@lang('theme.view_more_offers', ['count' => $item->product->inventories_count])
					        </a>
						@endif

						<div class="clearfix space20"></div>

						<div>
					        <div class="section-title">
					          <h4>{!! trans('theme.section_headings.key_features') !!}</h4>
					        </div>
							<ul class="key_feature_list">
								@foreach(unserialize($item->key_features) as $key_feature)
									<li>{{ $key_feature }}</li>
								@endforeach
							</ul>
						</div>
			  		</div>
		  		</div><!-- /.row -->
		      	<div class="space20"></div>
		  	</div><!-- /.col-md-7 col-sm-6 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>

<div class="clearfix space20"></div>

<section id="item-desc-section">
    <div class="container">
      	<div class="row">
      		@if($linked_items->count())
		        <div class="col-md-3 bg-light nopadding-right nopadding-left">
			        <div class="section-title">
			          <p class="">@lang('theme.section_headings.bought_together'): </p>
			        </div>
					<ul class="sidebar-product-list">
					    @foreach($linked_items as $linkedItem)
					        <li class="sc-product-item">
					            <div class="product-widget">
					                <div class="product-img-wrap">
					                    <!-- <img class="product-img" src="{{ get_storage_file_url(optional($linkedItem->image)->path, 'small') }}" alt="{{ $linkedItem->title }}" title="{{ $linkedItem->title }}" /> -->
					                    <img class="product-img" src="{{ get_inventory_img_src($linkedItem, 'small') }}" alt="{{ $linkedItem->title }}" title="{{ $linkedItem->title }}" />
					                </div>
					                <div class="product-info space10">
					                    @include('layouts.ratings', ['ratings' => $linkedItem->feedbacks->avg('rating')])

					                    <a href="{{ route('show.product', $linkedItem->slug) }}" class="product-info-title" data-name="product_name">{{ $linkedItem->title }}</a>

					                    @include('layouts.pricing', ['item' => $linkedItem])
					                </div>
					                <div class="btn-group pull-right">
				                        <a class="btn btn-default btn-xs flat itemQuickView" href="{{ route('quickView.product', $linkedItem->slug) }}">
				                            <i class="fa fa-external-link" data-toggle="tooltip" title="@lang('theme.button.quick_view')"></i> <span>@lang('theme.button.quick_view')</span>
				                        </a>

							          	<a href="{{ route('cart.addItem', $linkedItem->slug) }}" class="btn btn-primary btn-xs flat sc-add-to-cart pull-right">
							          		<i class="fa fa-shopping-bag"></i> @lang('theme.button.add_to_cart')
							          	</a>
					                </div>
					            </div>
					        </li>
					    @endforeach
					</ul>
		        </div><!-- /.col-md-2 -->
	        @endif

	        <div class="col-md-{{$linked_items->count() ? '9' : '12'}}" id="product_desc_section">
          		<div role="tabpanel">
	              	<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#desc_tab" aria-controls="desc_tab" role="tab" data-toggle="tab" aria-expanded="true">@lang('theme.product_desc')</a>
						</li>
						<li role="presentation">
							<a href="#seller_desc_tab" aria-controls="seller_desc_tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.product_desc_seller')</a>
						</li>
						<li role="presentation">
							<a href="#reviews_tab" aria-controls="reviews_tab" role="tab" data-toggle="tab" aria-expanded="false">@lang('theme.customer_reviews')</a>
						</li>
					</ul><!-- /.nav-tab -->

              		<div class="tab-content">
                  		<div role="tabpanel" class="tab-pane fade active in" id="desc_tab">
							{!! $item->product->description !!}
		                </div>
         		        <div role="tabpanel" class="tab-pane fade" id="seller_desc_tab">

                		  	{!! $item->description !!}

                		  	<br/><br/><hr class="style4 muted"/><br/>

                		  	<h4>{{ trans('theme.return_and_refund_policy') }}: </h4>
                		  	{!! $item->shop->config->return_refund !!}
	                  	</div>
		              	<div role="tabpanel" class="tab-pane fade" id="reviews_tab">
                      		<div class="reviews-tab">
	                      		@forelse($item->feedbacks->sortByDesc('created_at') as $feedback)
									<p>
										<b>{{ $feedback->customer->getName() }}</b>

										<span class="pull-right small">
											<b class="text-success">@lang('theme.verified_purchase')</b>
											<span class="text-muted"> | {{ $feedback->created_at->diffForHumans() }}</span>
										</span>
									</p>

									<p>{{ $feedback->comment }}</p>

			                        @include('layouts.ratings', ['ratings' => $feedback->rating])

			                        @unless($loop->last)
										<div class="sep"></div>
			                        @endunless
	                          	@empty
	                          		<div class="space20"></div>
	                          		<p class="lead text-center text-muted">@lang('theme.no_reviews')</p>
	                          	@endforelse
	                      	</div>
    	              	</div>
	              	</div><!-- /.tab-content -->
          		</div><!-- /.tabpanel -->
        	</div><!-- /.col-md-9 -->
      	</div><!-- /.row -->
    </div><!-- /.container -->
</section>

<div class="clearfix space20"></div>