<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
            <div class="col-md-3 nopadding" style="margin-top: 10px;">
				<img src="{{ get_storage_file_url(optional($warehouse->image)->path, 'medium') }}" class="thumbnail" width="100%" alt="{{ trans('app.image') }}">
			</div>
            <div class="col-md-9 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.name') }}:</th>
						<td style="width: 75%;">{{ $warehouse->name }}</td>
					</tr>
		            @if($warehouse->manager)
					<tr>
						<th class="text-right">{{ trans('app.incharge') }}:</th>
						<td style="width: 75%;">{{ $warehouse->manager->name }}</td>
					</tr>
					@endif
					<tr>
		            	<th class="text-right">{{ trans('app.status') }}: </th>
		            	<td style="width: 75%;">{{ ($warehouse->active) ? trans('app.active') : trans('app.inactive') }}</td>
		            </tr>
					<tr>
						<th class="text-right">{{ trans('app.available_from') }}:</th>
						<td style="width: 75%;">{{ $warehouse->created_at->toFormattedDateString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 75%;">{{ $warehouse->updated_at->toDayDateTimeString() }}</td>
					</tr>
				</table>
			</div>
			<div class="clearfix"></div>
			<!-- Custom Tabs -->
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
				  <li class="active"><a href="#tab_1" data-toggle="tab">
					{{ trans('app.inventories') }}
				  </a></li>
				  <li><a href="#tab_2" data-toggle="tab">
					{{ trans('app.description') }}
				  </a></li>
				  <li><a href="#tab_3" data-toggle="tab">
					{{ trans('app.contact') }}
				  </a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="tab_1">
						<table class="table table-hover table-2nd-short">
							<thead>
								<tr>
									<th>{{ trans('app.image') }}</th>
									<th>{{ trans('app.sku') }}</th>
									<th>{{ trans('app.name') }}</th>
									<th>{{ trans('app.condition') }}</th>
									<th>{{ trans('app.tax') }}</th>
									<th>{{ trans('app.price') }} <small>( {{ trans('app.excl_tax') }} )</small> </th>
									<th>{{ trans('app.quantity') }}</th>
									<th>{{ trans('app.status') }}</th>
									<th>{{ trans('app.option') }}</th>
								</tr>
							</thead>
							<tbody>
								@foreach($warehouse->inventories as $inventory )
								<tr>
									<td>
										@if($inventory->image)
											<img src="{{ get_storage_file_url(optional($inventory->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.image') }}">
										@else
											<img src="{{ get_storage_file_url(optional($inventory->product->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.image') }}">
										@endif
									</td>
									<td>{{ $inventory->sku }}</td>
									<td>{{ $inventory->product->name }}</td>
									<td>{{ $inventory->condition }}</td>
									<td>{{ get_formated_decimal($inventory->tax->taxrate).' '. trans('app.percent') }}</td>
									<td>
										@if(($inventory->offer_price > 0) && ($inventory->offer_end > \Carbon\Carbon::now()))
											@php
												$offer_price_help =
													trans('help.offer_starting_time').': '.
													$inventory->offer_start->diffForHumans().' and '.
													trans('help.offer_ending_time').': '.
													$inventory->offer_end->diffForHumans();
											@endphp

											<small class="text-muted">{{ $inventory->sale_price }}</small><br/>
											{{ get_formated_currency($inventory->offer_price) }}

											<small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ $offer_price_help }}"><sup><i class="fa fa-question"></i></sup></small>
										@else
											{{ get_formated_currency($inventory->sale_price) }}
										@endif
									</td>
									<td>{{ ($inventory->stock_quantity > 0) ? $inventory->stock_quantity : trans('app.out_of_stock') }}</td>
									<td>{{ ($inventory->active) ? trans('app.active') : trans('app.inactive') }}</td>
									<td class="row-options">
										<a href="{{ route('admin.stock.inventory.edit', $inventory->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;

										{!! Form::open(['route' => ['admin.stock.inventory.trash', $inventory->id], 'method' => 'delete', 'class' => 'data-form']) !!}
											{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
										{!! Form::close() !!}
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_2">
					  <div class="box-body">
				        @if($warehouse->description)
				            {!! $warehouse->description !!}
				        @else
				            <p>{{ trans('app.description_not_available') }} </p>
				        @endif
					  </div>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_3">
				        <table class="table">
				            @if($warehouse->primaryAddress)
							<tr>
								<th class="text-right">{{ trans('app.address') }}:</th>
								<td style="width: 75%;">
				        			{!! $warehouse->primaryAddress->toHtml() !!}
								</td>
							</tr>
							@endif
				            @if($warehouse->email)
							<tr>
								<th class="text-right">{{ trans('app.email') }}:</th>
								<td style="width: 75%;">{{ $warehouse->email }}</td>
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