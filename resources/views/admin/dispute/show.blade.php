@extends('admin.layouts.master')

@section('content')
  	<div class="row">
	    <div class="col-md-2 nopadding-right">
			<div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">{{ trans('app.merchant') }}</h3>
			    </div> <!-- /.box-header -->
			    <div class="box-body">
					@if(Gate::allows('view', $dispute->shop))
		            	<a href="#" data-link="{{ route('admin.vendor.shop.show', $dispute->shop_id) }}" class="ajax-modal-btn small"><span class="lead"> {{ $dispute->shop->name }} </span></a>
					@else
						<span class="lead">{{ $dispute->shop->name }}</span>
					@endif

					<img src="{{ get_storage_file_url(optional($dispute->shop->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.logo') }}">

					<p>
						{{ trans('app.total_disputes') }}:
						<span class="label label-outline">{{ \App\Helpers\Statistics::dispute_count($dispute->shop_id) }}</span>
					</p>
					<p>
						{{ trans('app.latest_days', ['days' => 30]) }}:
						<span class="label label-info"><strong>{{ \App\Helpers\Statistics::dispute_count($dispute->shop_id, 30) }}</strong></span>
					</p>
		            @if($dispute->shop->owner)
						<hr/>
						<div class="form-group">
						  	<label>{{ trans('app.owner') }}</label>
							<p>
					            @if($dispute->shop->owner->image)
									<img src="{{ get_storage_file_url(optional($dispute->shop->owner->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @else
				            		<img src="{{ get_gravatar_url($dispute->shop->owner->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @endif
								&nbsp;
								@if(Gate::allows('view', $dispute->shop->owner))
						            <a href="#" data-link="{{ route('admin.admin.user.show', $dispute->shop->owner_id) }}" class="ajax-modal-btn small"><span class="lead">{{ $dispute->shop->owner->getName() }}</span></a>
								@else
									<span class="small">{{ $dispute->shop->owner->getName() }}</span>
								@endif
					        </p>
						</div>
		            @endif
	    		</div>
	    	</div>
	    </div>

	    <div class="col-md-7">
			<div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">{{ trans('app.dispute') }}</h3>
			      <div class="box-tools pull-right">
					@can('response', $dispute)
						<a href="#" data-link="{{ route('admin.support.dispute.response', $dispute) }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.response') }}</a>
					@endcan
			      </div>
			    </div> <!-- /.box-header -->
			    <div class="box-body">
					{!! $dispute->statusName() !!}
					<span class="label label-outline">
						{{ trans('app.order_number') . ': ' }}{{ $dispute->order->order_number }}
					</span>
					<p class="lead">{{ $dispute->dispute_type->detail }}</p>

					@if(count($dispute->attachments))
						{{ trans('app.attachments') . ': ' }}
						@foreach($dispute->attachments as $attachment)
				            <a href="{{ route('attachment.download', $attachment->path) }}"><i class="fa fa-file"></i></a>
						@endforeach
					@endif

					@if($dispute->description)
					  <div class="well">
						{!! $dispute->description !!}
					  </div>
					@endif

			        @if($dispute->replies->count() > 0)
			          	<fieldset><legend>{{ strtoupper(trans('app.conversations')) }}</legend></fieldset>

				        @foreach($dispute->replies as $reply)
							@include('admin.partials._reply_conversations')
				        @endforeach
			        @endif
			    </div> <!-- /.box-body -->
			</div> <!-- /.box -->

    		@include('admin.partials._activity_logs', ['logger' => $dispute])
		</div>

	    <div class="col-md-3 nopadding-left">
			@if($dispute->product_id)
			    <div class="box">
			        <div class="box-header with-border">
			          <h3 class="box-title"> {{ trans('app.product') }}</h3>
			          <div class="box-tools pull-right">
			            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			          </div>
			        </div> <!-- /.box-header -->
			        <div class="box-body">
						<div class="form-group">
						  	<label>{{ trans('app.product') }}</label>
							<img src="{{ get_storage_file_url(optional($dispute->product->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.image') }}">
							@if(Gate::allows('view', $dispute->product))
					            <a href="#" data-link="{{ route('admin.catalog.product.show', $dispute->product_id) }}" class="ajax-modal-btn"><span class="lead indent10">{{ $dispute->product->name }}</span></a>
							@else
								<span class="lead indent10">{{ $dispute->product->name }}</span>
							@endif
						</div>
			        </div>
		    	</div>
			@endif

	      	<div class="box">
		        <div class="box-header with-border">
		          <h3 class="box-title"> {{ trans('app.customer') }}</h3>
		          <div class="box-tools pull-right">
		            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		          </div>
		        </div> <!-- /.box-header -->
		        <div class="box-body">
		            @if($dispute->customer->image)
						<img src="{{ get_storage_file_url(optional($dispute->customer->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
		            @else
	            		<img src="{{ get_gravatar_url($dispute->customer->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
		            @endif
					@if(Gate::allows('view', $dispute->customer))
			            <a href="#" data-link="{{ route('admin.admin.customer.show', $dispute->customer_id) }}" class="ajax-modal-btn small"><span class="lead indent10">{{ $dispute->customer->getName() }}</span></a>
					@else
						<span class="lead indent10">{{ $dispute->customer->getName() }}</span>
					@endif
					<p>
						{{ trans('app.total_disputes') }}:
						<span class="label label-outline">{{ \App\Helpers\Statistics::disputes_by_customer_count($dispute->customer_id) }}</span>
					</p>
					<p>
						{{ trans('app.latest_days', ['days' => 30]) }}:
						<span class="label label-info"><strong>{{ \App\Helpers\Statistics::disputes_by_customer_count($dispute->customer_id, 30) }}</strong></span>
					</p>
					<hr/>
					<div class="form-group text-muted">
						<p>
						  	<label>{{ trans('app.created_at') }}</label>
							{{ $dispute->created_at->diffForHumans() }}
						</p>
						<p>
						  	<label>{{ trans('app.updated_at') }}</label>
							{{ $dispute->updated_at->diffForHumans() }}
						</p>
					</div>

		        </div>
	      	</div>
		</div>
	</div>
@endsection