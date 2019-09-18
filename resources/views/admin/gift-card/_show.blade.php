<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
            <div class="col-md-12 nopadding">
				<table class="table no-border">
					<tr>
						<th class="text-right">{{ trans('app.name') }}:</th>
						<td style="width: 65%;"><span class="lead">{{ $giftCard->name }}</span></td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.value') }}:</th>
						<td style="width: 65%;">
							<span class="label label-primary">{{ get_formated_currency($giftCard->value) }}</span>
						</td>
					</tr>
	                <tr>
	                	<th class="text-right">{{ trans('app.status') }}: </th>
	                	<td style="width: 65%;">
							@if($giftCard->expiry_time < \Carbon\Carbon::now())
								{{ trans('app.expired') }}
							@else
								{{ ($giftCard->active) ? trans('app.active') : trans('app.inactive') }}
							@endif
	                	</td>
	                </tr>
					<tr>
						<th class="text-right">{{ trans('app.created_at') }}:</th>
						<td style="width: 65%;">{{ $giftCard->created_at->toDayDateTimeString() }}</td>
					</tr>
					<tr>
						<th class="text-right">{{ trans('app.updated_at') }}:</th>
						<td style="width: 65%;">{{ $giftCard->updated_at->toDayDateTimeString() }}</td>
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
				</ul>
				<div class="tab-content">
				    <div class="tab-pane active" id="tab_1">
				        <table class="table">
			                <tr>
			                	<th>{{ trans('app.pin_code') }}: </th>
			                	<td>{{ $giftCard->pin_code }}</td>
			                </tr>
			                <tr>
			                	<th>{{ trans('app.serial_number') }}: </th>
			                	<td>{{ $giftCard->serial_number }}</td>
			                </tr>
			                <tr>
			                	<th>{{ trans('app.allow_partial_use') }}: </th>
			                	<td>{!! $giftCard->partial_use ? '<i class="fa fa-check"></i>' : '<i class="fa fa-close"></i>' !!}</td>
			                </tr>
			                <tr>
			                	<th>{{ trans('app.exclude_offer_items') }}: </th>
			                	<td>{!! $giftCard->exclude_offer_items ? '<i class="fa fa-check"></i>' : '<i class="fa fa-close"></i>' !!}</td>
			                </tr>
			                <tr>
			                	<th>{{ trans('app.exclude_tax_n_shipping') }}: </th>
			                	<td>{!! $giftCard->exclude_tax_n_shipping ? '<i class="fa fa-check"></i>' : '<i class="fa fa-close"></i>' !!}</td>
			                </tr>
			                <tr>
			                	<th>{{ trans('app.active_from') }}: </th>
			                	<td>{{ $giftCard->activation_time ? $giftCard->activation_time->toDayDateTimeString() : ''}}</td>
			                </tr>
			                <tr>
			                	<th>{{ trans('app.active_till') }}: </th>
			                	<td>{{ $giftCard->expiry_time ? $giftCard->expiry_time->toDayDateTimeString() : ''}}</td>
			                </tr>
				        </table>
				    </div>
				    <!-- /.tab-pane -->
				    <div class="tab-pane" id="tab_2">
					  <div class="box-body">
				        @if($giftCard->description)
				            {!! htmlspecialchars_decode($giftCard->description) !!}
				        @else
				            <p>{{ trans('app.description_not_available') }} </p>
				        @endif
					  </div>
				    </div>
				    <!-- /.tab-pane -->
				</div>
				<!-- /.tab-content -->
			</div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->