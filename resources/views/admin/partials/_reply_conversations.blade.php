<div class="row">
    <div class="col-md-2 nopadding-right no-print">
		@if($reply->user_id)
	        @if($reply->user->image)
				<img src="{{ get_storage_file_url(optional($reply->user->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
	        @else
	    		<img src="{{ get_gravatar_url($reply->user->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
	        @endif

			@if(Gate::allows('view', $reply->user))
	            <a href="#" data-link="{{ route('admin.admin.user.show', $reply->user_id) }}" class="ajax-modal-btn small">{{ $reply->user->getName() }}</a>
			@else
				<span class="small">{{ $reply->user->getName() }}</span>
			@endif
		@endif
	</div>

	<div class="col-md-8 nopadding">
		<blockquote style="font-size: 1em;" class="{{ $reply->customer_id ? 'blockquote-reverse' : ''}}">
    		{!! $reply->reply !!}
			@if(count($reply->attachments))
				<small class="no-print">
					{{ trans('app.attachments') . ': ' }}
					@foreach($reply->attachments as $attachment)
			            <a href="{{ route('attachment.download', $attachment) }}"><i class="fa fa-file"></i></a>
					@endforeach
				</small>
			@endif
			<footer>
				{{ $reply->updated_at->diffForHumans() }}
			</footer>
    	</blockquote>
	</div>

    <div class="col-md-2 nopadding-left no-print">
		@if($reply->customer_id)
	        @if($reply->customer->image)
				<img src="{{ get_storage_file_url(optional($reply->customer->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
	        @else
	    		<img src="{{ get_gravatar_url($reply->customer->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
	        @endif

			@if(Gate::allows('view', $reply->user))
	            <a href="#" data-link="{{ route('admin.admin.customer.show', $reply->customer_id) }}" class="ajax-modal-btn small">{{ $reply->customer->getName() }}</a>
			@else
				<span class="small">{{ $reply->customer->getName() }}</span>
			@endif
		@endif
    </div>
</div>