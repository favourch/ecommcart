@if($gift_cards->count() > 0)
	<table class="table" id="buyer-order-table">
	  	<thead>
			<tr>
				<th>{{ trans('theme.value') }}</th>
				<th>{{ trans('theme.serial_number') }}</th>
				<th>{{ trans('theme.support_partial_use') }}</th>
				<th width="30%">{{ trans('theme.validity') }}</th>
			</tr>
	  	</thead>
	  	<tbody>
			@foreach($gift_cards as $gift)
				<tr>
					<td class="text-center">
						<div class="customer-gift-card-lists {{ $gift->expiry_time && $gift->expiry_time < \Carbon\Carbon::now() ? 'customer-gift-card-expired' : ''}}">
							<div class="gift-card-item">
								<span class="customer-gift-card-value"><i class="fa fa-gift"></i> {{ get_formated_currency($gift->value) }}</span>
							</div>
						</div>
					</td>
					<td class="text-center vertical-center">{{ $gift->serial_number }}</td>
					<td class="text-center vertical-center small">
						@if($gift->partial_use)
							<span class="label label-outline flat">@lang('theme.yes')</span>
						@else
							<span class="label label-default flat">@lang('theme.no')</span>
						@endif
					</td>
					<td class="vertical-center">
						@if($gift->expiry_time)
							@if($gift->expiry_time && $gift->expiry_time < \Carbon\Carbon::now())
								<span class="text-muted small">{{ trans('theme.expired_at') }}: {{ $gift->expiry_time->format('M j,y g:i a') }}</span>
							@elseif($gift->activation_time < \Carbon\Carbon::now())
								<span class="text-muted small">{{ trans('theme.use_before') }}:</span>
								{{ $gift->expiry_time->format('M j,y g:i a') }}
							@elseif($gift->activation_time > \Carbon\Carbon::now())
								<span class="text-muted small">{{ trans('theme.use_between') }}:</span>
								{{ $gift->activation_time->format('M j,y g:i a') }}<br/>
								<span class="text-muted small"> @lang('theme.and') </span>
								{{ $gift->expiry_time->format('M j,y g:i a') }}
							@else
								<span class="text-muted small">{{ trans('theme.invalid') }}</span>
							@endif
						@elseif($gift->activation_time > \Carbon\Carbon::now())
							<span class="text-muted small">{{ trans('theme.valid_from') }}:</span>
								{{ $gift->activation_time->format('M j,y g:i a') }}
						@else
							<span class="text-muted small">{{ trans('theme.lifetime') }}</span>
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<div class="sep"></div>
@else
  <div class="clearfix space50"></div>
  <p class="lead text-center space50">
    @lang('theme.nothing_found')
  </p>
@endif

<div class="row pagenav-wrapper">
    {{ $gift_cards->links('layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->
<div class="clearfix space20"></div>