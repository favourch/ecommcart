@extends('admin.layouts.master')

@section('content')
	<div class="box">
	  	@if(Auth::user()->isFromPlatform())
		    <div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-user"></i> {{ trans('app.profile') }}</h3>
		    </div>
		    <div class="box-body">
	    		@include('admin.account._profile')
	    		<span class="spacer20"></span>
    		</div>
	  	@else
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs nav-justified">
					<li class="{{ Request::is('admin/account/profile') ? 'active' : '' }}"><a href="#profile_tab" data-toggle="tab">
						<i class="fa fa-user hidden-sm"></i>
						{{ trans('app.profile') }}
					</a></li>
					<li class="{{ Request::is('admin/account/billing') ? 'active' : '' }}"><a href="#billing_tab" data-toggle="tab">
						<i class="fa fa-credit-card hidden-sm"></i>
						{{ trans('app.billing') }}
					</a></li>
					<li class="{{ Request::is('admin/account/ticket') ? 'active' : '' }}"><a href="#ticket_tab" data-toggle="tab">
						<i class="fa fa-ticket hidden-sm"></i>
						{{ trans('app.tickets') }}
					</a></li>
				</ul>
				<div class="tab-content">
				    <div class="tab-pane {{ Request::is('admin/account/profile') ? 'active' : '' }}" id="profile_tab">
			    		@include('admin.account._profile')
				    </div>

				    <div class="tab-pane {{ Request::is('admin/account/billing') ? 'active' : '' }}" id="billing_tab">
			    		@include('admin.account._billing')
				    </div>

				    <div class="tab-pane {{ Request::is('admin/account/ticket') ? 'active' : '' }}" id="ticket_tab">
			    		@include('admin.account._ticket')
				    </div>
				</div>
				<!-- /.tab-content -->
			</div>
			<!-- /.nav-tabs-custom -->
	  	@endif
	</div> <!-- /.box -->
@endsection

@section('page-script')

  @include('plugins.stripe-scripts')

@endsection
