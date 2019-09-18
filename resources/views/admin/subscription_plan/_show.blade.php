<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-body" style="padding: 0px;">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9;">×</button>
	  		<div class="panel panel-default">
		  		<div class="panel-body">
					<table class="table no-border">
						<tr>
							<th class="text-right">{{ trans('app.name') }}:</th>
							<td>
								<span class="lead">{{ $subscriptionPlan->name }}</span>
								@if($subscriptionPlan->featured)
									<span class="label label-primary indent10">{{ trans('app.featured') }}</span>
								@endif
							</td>
						</tr>
						<tr>
							<th class="text-right">{{ trans('app.cost') }}:</th>
							<td class="lead">{{ get_formated_currency($subscriptionPlan->cost) . trans('app.per_month') }}</td>
						</tr>
						@if((bool) config('system_settings.trial_days'))
							<tr>
								<th class="text-right">{{ trans('app.trial_days') }}:</th>
								<td><i class="fa fa-pagelines"></i> {{ config('system_settings.trial_days') . ' ' . trans('days') }}</td>
							</tr>
						@endif
						<tr>
							<th class="text-right">{{ trans('app.team_size') }}:</th>
							<td><i class="fa fa-users"></i> {{ $subscriptionPlan->team_size }}</td>
						</tr>
						<tr>
							<th class="text-right">{{ trans('app.inventory_limit') }}:</th>
							<td><i class="fa fa-cubes"></i> {{ $subscriptionPlan->inventory_limit }}</td>
						</tr>
						<tr>
							<th class="text-right">{{ trans('app.transaction_fee') }}:</th>
							<td>{{ get_formated_currency($subscriptionPlan->transaction_fee) }}</td>
						</tr>
						<tr>
							<th class="text-right">{{ trans('app.marketplace_commission') }}:</th>
							<td>{{ $subscriptionPlan->marketplace_commission . trans('app.percent') }}</td>
						</tr>
						<tr>
							<th class="text-right">{{ trans('app.available_from') }}:</th>
							<td>{{ $subscriptionPlan->created_at->toFormattedDateString() }}</td>
						</tr>
						<tr>
							<th class="text-right">{{ trans('app.updated_at') }}:</th>
							<td>{{ $subscriptionPlan->updated_at->toDayDateTimeString() }}</td>
						</tr>
					</table>
	        	</div>
	        </div>
        </div>
    </div> <!-- / .modal-content -->
</div> <!-- / .modal-dialog -->