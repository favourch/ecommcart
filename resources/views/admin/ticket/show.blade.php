@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.ticket') }}</h3>
	      <div class="box-tools pull-right">
			@can('index', $ticket)
				<a href="{{ route('admin.support.ticket.index') }}" class="btn btn-default btn-flat">{{ trans('app.back') }}</a>
			@endcan
			@can('reply', $ticket)
				<a href="#" data-link="{{ route('admin.support.ticket.reply', $ticket) }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.reply') }}</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
			<div class="row">
			  	<div class="col-md-2 nopadding-right">
					<div class="form-group">
					  	<label>{{ trans('app.merchant') }}</label>
						<p>
							<span class="lead">
								@can('view', $ticket->shop)
					            	<a href="#" data-link="{{ route('admin.vendor.shop.show', $ticket->shop_id) }}" class="ajax-modal-btn small">{{ $ticket->shop->name }}</a>
								@else
									{{ $ticket->shop->name }}
								@endcan
							</span>
							<div class="spacer5"></div>

							<img src="{{ get_storage_file_url(optional($ticket->shop->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.logo') }}">
						</p>

						<p>
				            @if($ticket->user->image)
								<img src="{{ get_storage_file_url(optional($ticket->user->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @else
			            		<img src="{{ get_gravatar_url($ticket->user->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @endif
							<span class="lead indent5">
								@can('view', $ticket->user)
						            <a href="#" data-link="{{ route('admin.admin.user.show', $ticket->user_id) }}" class="ajax-modal-btn small">{{ $ticket->user->getName() }}</a>
								@else
									{{ $ticket->user->getName() }}
								@endcan
							</span>
				        </p>

						<hr/>

						<div class="form-group text-muted">
						  	<label>{{ trans('app.created_at') }}</label>
							{{ $ticket->created_at->diffForHumans() }}
							<span class="spacer10"></span>
						  	<label>{{ trans('app.updated_at') }}</label>
							{{ $ticket->updated_at->diffForHumans() }}
						</div>
					</div>
			  	</div>

			  	<div class="col-md-7 nopadding-right">
					<span class="label label-outline"> {{ $ticket->category->name }} </span> &nbsp;
					{!! $ticket->priorityLevel() !!}
					{!! $ticket->statusName() !!}
					<p class="lead">{{ $ticket->subject }}</p>

					@if(count($ticket->attachments))
						{{ trans('app.attachments') . ': ' }}
						@foreach($ticket->attachments as $attachment)
				            <a href="{{ route('attachment.download', $attachment->path) }}"><i class="fa fa-file"></i></a>
						@endforeach
					@endif

					@if($ticket->message)
					  <div class="well">
						{!! $ticket->message !!}
					  </div>
					@endif

			        @if($ticket->replies->count())
						<div class="form-group">
						  	<label>{{ trans('app.conversations') }}</label>
						</div>

				        @foreach($ticket->replies as $reply)
							@include('admin.partials._reply_conversations')
				        @endforeach
			        @endif

			        <hr/>
					<span class="pull-right">
						<a href="#" data-link="{{ route('admin.support.ticket.reply', $ticket) }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.reply') }}</a>
						{!! Form::open(['route' => ['admin.support.ticket.archive', $ticket], 'method' => 'delete', 'class' => 'inline']) !!}
							<button class="confirm btn btn-danger" type="submit"><i class="fa fa-archive"></i> {{ trans('app.archive') }}</button>
						{!! Form::close() !!}
					</span>
					<div class="spacer50"></div>
			  	</div>

			  	<div class="col-md-3">
					<div class="form-group">
						@if($ticket->assignedTo)
						  	<label>{{ trans('app.assigned_to') }}</label>
				            @if($ticket->assignedTo->image)
								<img src="{{ get_storage_file_url(optional($ticket->assignedTo->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @else
			            		<img src="{{ get_gravatar_url($ticket->assignedTo->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @endif

							<p>
								<span class="lead indent5">{{ $ticket->assignedTo->getName() }}</span>
								<br/>
								@can('view', $ticket->assignedTo)
					            	<a href="#" data-link="{{ route('admin.admin.user.show', $ticket->assigned_to) }}" class="ajax-modal-btn small">{{ trans('app.view_detail') }}</a>
								@endcan
							</p>
						@endif

						@can('assign', $ticket)
							<a class="btn btn-default ajax-modal-btn" href="#" data-link="{{ route('admin.support.ticket.showAssignForm', $ticket) }}"><i class="fa fa-hashtag"></i> {{ trans('app.assign') }}</a>
						@endcan
				  	</div>

					@if($ticket->shop->tickets)
						<div class="form-group">
							<label>{{ trans('app.other_conversations') }}</label>
							<ul class="list-unstyled">
								@foreach($ticket->shop->tickets as $old_ticket)
									@continue($old_ticket->id == $ticket->id)
									<li>
										<a href="{{ route('admin.support.ticket.show', $old_ticket->id) }}">{{ $old_ticket->subject }}</a>
										{!! $old_ticket->statusName() !!}
									</li>
								@endforeach
							</ul>
						</div>
					@endif
				</div>
			</div>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection