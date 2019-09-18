@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-truck"></i> {{ trans('app.shipping_zones') }}</h3>
			<div class="box-tools pull-right">
				@can('create', App\ShippingZone::class)
					<a href="#" data-link="{{ route('admin.shipping.shippingZone.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_shipping_zone') }}</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<div class="row">
				<div class="spacer10"></div>
				@forelse($shipping_zones as $shipping_zone )
					<div class="col-xs-12">
						<span class="lead text-muted indent10"><i class="fa fa-{{ $shipping_zone->rest_of_the_world ? 'globe' : 'map-marker'}}"></i> {{ $shipping_zone->name }}</span>

						@if($shipping_zone->rest_of_the_world)
							<span class="label label-outline indent10">{{ trans('app.rest_of_the_world') }}</span>
						@endif

						@unless($shipping_zone->active)
							<span class="label label-default indent10">{{ trans('app.inactive') }}</span>
						@endunless

						<span class="indent50">{{ $shipping_zone->tax->name }}</span>

						<div class="pull-right">
							@can('create', App\ShippingRate::class)
								<div class="btn-group">
								  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  	<i class="fa fa-plus-square-o"></i>
								    {{ trans('app.add_shipping_rate') }} <span class="caret"></span>
								  </button>
									  <ul class="dropdown-menu">
									    <li><a href="#" data-link="{{ route('admin.shipping.shippingRate.create', [$shipping_zone->id,'price']) }}" class="ajax-modal-btn"><i class="fa fa-money"></i> {{ trans('app.add_price_based_rate') }}</a></li>

										<li role="separator" class="divider"></li>

									    <li><a href="#" data-link="{{ route('admin.shipping.shippingRate.create', [$shipping_zone->id, 'weight']) }}" class="ajax-modal-btn"><i class="fa fa-balance-scale"></i> {{ trans('app.add_weight_based_rate') }}</a></li>
									  </ul>
								</div>
							@endcan

						  	@unless($shipping_zone->rest_of_the_world)
								@can('create', App\ShippingZone::class)
									<a href="#" data-link="{{ route('admin.shipping.shippingZone.edit', $shipping_zone->id) }}"  class="ajax-modal-btn btn btn-default btn-flat">
										<i class="fa fa-plus-square-o"></i> {{ trans('app.add_shipping_country') }}
								  	</a>
								@endcan
						  	@endunless

							@can('update', $shipping_zone)
								<a href="#" data-link="{{ route('admin.shipping.shippingZone.edit', $shipping_zone->id) }}"  class="ajax-modal-btn btn btn-default btn-flat"><i class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
							@endcan

							@can('delete', $shipping_zone)
								{!! Form::open(['route' => ['admin.shipping.shippingZone.destroy', $shipping_zone->id], 'method' => 'delete', 'class' => 'inline']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i> ' . trans('app.delete'), ['type' => 'submit', 'class' => 'confirm btn btn-danger btn-flat']) !!}
								{!! Form::close() !!}
							@endcan
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label class="indent10">{{ trans('app.countries') }}</label>
								</div>

								<ul class="list-group">
									@if ($shipping_zone->rest_of_the_world)
										<li class="list-group-item">
											<h4 class="list-group-item-heading inline">
												{{ trans('help.rest_of_the_world') }}
											</h4>
										</li>
									@else
										@if (!empty($shipping_zone->country_ids))
											@php
												$countries = get_countries_name_with_states($shipping_zone->country_ids);
											@endphp

											@foreach ($countries as $id => $country)
												<li class="list-group-item">
													<h4 class="list-group-item-heading inline">
														{!! get_formated_country_name($country['name'], $country['code']) !!}
													</h4>

													{!! Form::open(['route' => ['admin.shipping.shippingZone.removeCountry', $shipping_zone->id, $id], 'method' => 'delete', 'class' => 'data-form']) !!}
														{!! Form::button('<i class="fa fa-times-circle"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent small text-muted pull-right', 'title' => trans('app.remove'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
													{!! Form::close() !!}

													@if($states_count = count($country['states']))
														<p class="list-group-item-text">
															<span class="indent40">
																{{ trans('app._of_states', ['states' => $shipping_zone->state_ids ? count( array_intersect($shipping_zone->state_ids, $country['states'])) : '0', 'allStates' => $states_count]) }}
															</span>

															<small class="pull-right">
																<a href="#" data-link="{{ route('admin.shipping.shippingZone.editStates', [$shipping_zone->id, $id]) }}"  class="ajax-modal-btn"><i  class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
															</small>
														</p>
													@endif
												</li>
											@endforeach
										@else
											<li class="list-group-item">
												<h4 class="list-group-item-heading inline">
													{{ trans('app.empty_shipping_country') }}
												</h4>
											</li>
										@endif
									@endif
								</ul>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label class="indent10">{{ trans('app.shipping_rates') }}</label>
								</div>

								<ul class="list-group">
									@forelse($shipping_zone->rates as $shipping )
									  <li class="list-group-item">
									    <h4 class="list-group-item-heading">
									    	{{ $shipping->name }}

									    	@if($shipping->carrier)
										    	<small class="indent20"> {{ trans('app.by') . ' ' . $shipping->carrier->name . ' ' . trans('app.and_takes', ['time' => $shipping->delivery_takes]) }} </small>
									    	@endif

											@can('delete', $shipping)
												{!! Form::open(['route' => ['admin.shipping.shippingRate.destroy', $shipping->id], 'method' => 'delete', 'class' => 'data-form']) !!}
													{!! Form::button('<i class="fa fa-times-circle"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent small text-muted pull-right', 'title' => trans('app.delete'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
												{!! Form::close() !!}
											@endcan
										</h4>

									    <p class="list-group-item-text">
									    	{{ get_formated_shipping_range_of($shipping) }}
										  	<span class="badge indent20">
										  		{{ $shipping->rate > 0 ? get_formated_currency($shipping->rate) : trans('app.free') }}
										  	</span>
											@can('update', $shipping)
												<small class="pull-right">
													<a href="#" data-link="{{ route('admin.shipping.shippingRate.edit', $shipping->id) }}"  class="ajax-modal-btn"><i  class="fa fa-edit"></i> {{ trans('app.edit') }}</a>
												</small>
											@endcan
									    </p>

									  </li>
									@empty
									  <li class="list-group-item">
										<h4 class="list-group-item-heading">{{ trans('app.empty_shipping_rates') }}</h4>
									  </li>
									@endforelse
								</ul>
							</div>
						</div>

						@unless($loop->last)
    						<hr class="style3"/>
					    @endunless
					</div>
				@empty
					<div class="col-sm-12">
						<div class="jumbotron text-center">
							<h3>{{ 'Opps !' }}</h3>
							<p>{{ trans('app.empty_shipping_zones') }}</p>
						</div>
					</div>
				@endforelse
			</div>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection