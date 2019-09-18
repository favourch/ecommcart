@if(Auth::user()->isSubscribed())
	@php
		$subscription = Auth::user()->getCurrentPlan();
	@endphp
	@if(Auth::user()->isOnTrial())
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
			{{ trans('messages.trial_ends_at', ['ends' => \Carbon\Carbon::now()->diffInDays($subscription->trial_ends_at)]) }}
		</div>
	@elseif(Auth::user()->isOnGracePeriod())
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
			{{ trans('messages.resume_subscription', ['ends' => \Carbon\Carbon::now()->diffInDays($subscription->ends_at)]) }}

			@if(Auth::user()->isMerchant())
				<span class="indent15">
		    		<a href="{{ route('admin.account.subscription.resume') }}" class="confirm btn bg-navy"><i class="fa fa-rocket"></i>  {{ trans('app.resume_subscription') }}</a>
				</span>
			@endif
		</div>
	@endif

	@if(Auth::user()->isOnGenericTrial())
		<div class="alert alert-warning alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
			{{ trans('messages.generic_trial_ends_at', ['ends' => \Carbon\Carbon::now()->diffInDays(Auth::user()->shop->trial_ends_at)]) }}
			@unless(Request::is('admin/account/billing'))
				<span class="indent15">
		    		<a href="{{ route('admin.account.billing') }}" class="btn bg-navy"><i class="fa fa-rocket"></i>  {{ trans('app.choose_plan') }}</a>
				</span>
			@endunless
		</div>
	@endif
@elseif(Auth::user()->hasExpiredOnGenericTrial())
	<div class="alert alert-danger">
		<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
		{{ trans('messages.trial_expired') }}
		@unless(Request::is('admin/account/billing'))
			<span class="indent15">
	    		<a href="{{ route('admin.account.billing') }}" class="btn bg-navy"><i class="fa fa-rocket"></i>  {{ trans('app.choose_plan') }}</a>
			</span>
		@endunless
	</div>
@endif
