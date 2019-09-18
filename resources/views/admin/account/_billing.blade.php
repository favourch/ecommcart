<div class="row">
  	<div class="col-md-12">
		@include('admin.partials._subscription_notice')

	    <!-- Error Message -->
		@if (Session::has('error'))
	    	<div class="alert alert-danger">{{ Session::get('error') }}</div>
    	@endif
  	</div>
  	<div class="col-md-8 col-md-offset-2">
		@if(Auth::user()->hasExpiredPlan())
			<div class="alert alert-danger">
				<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
				{{ trans('messages.subscription_expired') }}
			</div>
		@endif

		@if(Auth::user()->isSubscribed())
			@if($current_plan && ! Auth::user()->isOnGracePeriod())
		  		<div class="panel panel-default">
			  		<div class="panel-body">
						{!! trans('messages.current_subscription', ['plan' => $current_plan->name]) !!}
						@if(Auth::user()->isMerchant())
							{!! Form::open(['route' => ['admin.account.subscription.cancel', $current_plan], 'method' => 'delete', 'class' => 'inline']) !!}
								{!! Form::button(trans('app.calcel_plan'), ['type' => 'submit', 'class' => 'confirm ajax-silent btn btn-sm btn-danger pull-right']) !!}
							{!! Form::close() !!}
				  		@endif
			  		</div>
		  		</div>
	  		@endif
  		@else
			<div class="alert alert-info">
				<strong><i class="icon fa fa-rocket"></i></strong>
				{{ trans('messages.choose_subscription') }}
			</div>
  		@endif

		@unless(Auth::user()->hasBillingToken())
			<div class="alert alert-info">
				<strong><i class="icon fa fa-credit-card"></i></strong>
				{{ trans('messages.no_billing_info') }}
			</div>
  		@endunless

  		<div class="panel panel-default">
	  		<div class="panel-body">
				<fieldset>
					<legend>{{ trans('app.subscription_plans') }}</legend>
			  		<table class="table no-border">
			  			<thead></thead>
			  			<tbody>
					  		@foreach($plans as $plan)
					  			<tr>
					  				<td class="lead">
					  					{{ $plan->name }}
					  				</td>
					  				<td>
			                            <a href="#" data-link="{{ route('admin.account.subscription.features', $plan->plan_id) }}" class="ajax-modal-btn btn btn-default">
			                                <i class="fa fa-star-o"></i> {{ trans('app.features') }}
			                            </a>
					  				</td>
					  				<td class="lead">
					  					<span class="indent20">{{ get_formated_currency($plan->cost) . trans('app.per_month') }}</span>
					  				</td>
									@if(Auth::user()->isMerchant())
						  				<td class="pull-right">
				                        	@if(optional($current_plan)->stripe_plan == $plan->plan_id || optional($current_plan)->braintree_plan == $plan->plan_id)
												@if(Auth::user()->isOnGracePeriod())
					                                <a href="{{ route('admin.account.subscription.resume') }}" class="confirm btn btn-lg btn-primary">
						                            	<i class="fa fa-rocket"></i> {{ trans('app.resume_subscription') }}
						                            </a>
												@else
						                            <button class="btn btn-lg btn-primary disabled">
						                            	<i class="fa fa-check-circle-o"></i> {{ trans('app.current_plan') }}
						                            </button>
												@endif
				                        	@else
				                                <a href="{{ route('admin.account.subscribe', $plan->plan_id) }}" class="confirm btn btn-lg btn-default">
					                            	<i class="fa fa-leaf"></i> {{ trans('app.select_this_plan') }}
					                            </a>
				                        	@endif
						  				</td>
					  				@endif
					  			</tr>
					  		@endforeach
			  			</tbody>
			  		</table>

					@if((bool) config('system_settings.trial_days'))
						<span class="spacer10"></span>
						<span class="text-info">
							<strong><i class="icon fa fa-info-circle"></i></strong>
							{{ trans('messages.plan_comes_with_trial',['days' => config('system_settings.trial_days')]) }}
						</span>
					@endif
			  	</fieldset>
			</div>
		</div>

		@if(Auth::user()->isMerchant())
	  		<div class="panel panel-default">
		  		<div class="panel-body">
			        {!! Form::model($profile, ['method' => 'PUT', 'route' => ['admin.account.card.update'], 'id' => 'stripe-form', 'data-toggle' => 'validator']) !!}

						@include('auth.stripe_form')

						<div class="pull-right">
				            {!! Form::submit(trans('app.update'), ['class' => 'btn btn-lg btn-new']) !!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		@else
			<div class="alert alert-danger">
				<strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
				{{ trans('messages.only_merchant_can_change_plan') }}
			</div>
		@endif

		<fieldset>
			<legend>{{ trans('app.history') }} <i class="fa fa-history"></i> </legend>
			@include('admin.account._activity_logs', ['logger' => Auth::user()->shop])
		</fieldset>
  	</div>
</div>
