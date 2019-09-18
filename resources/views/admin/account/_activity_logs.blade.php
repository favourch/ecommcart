<ul class="list-group">
	@if($logger)
		@php
			$logChanges = [
				'current_billing_plan',
				'card_last_four',
			];
		@endphp

	    @forelse($logger->activities() as $activity)
	      	@php
	        	$changes = $activity->changes()->all();
	      	@endphp

	      	@continue(empty($changes))

	        @if(strtolower($activity->description) == 'updated')
	          	@foreach($changes['attributes'] as $attrbute => $new_value)

	          		@continue(! in_array($attrbute, $logChanges))

			      	<li class="list-group-item">
			      		<i class="fa fa-arrow-circle-o-right"></i>
			      		<span class="indent10">
			                {!! get_activity_str($logger, $attrbute, $new_value, $changes['old'][$attrbute]) !!}
			      		</span>

			        	<span class="pull-right">{{ $activity->created_at->diffForHumans() . ' ' . trans('app.by') . ' ' . $activity->causer->getName() }}</span>
			        </li>
	          	@endforeach
	        @endif
	    @empty
	    	<span class="indent5">{{ trans('messages.no_history_data') }}</span>
	    @endforelse
    @else
    	<span class="indent5">{{ trans('messages.no_history_data') }}</span>
	@endif
</ul>