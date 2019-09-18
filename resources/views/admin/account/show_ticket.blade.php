@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      	<h3 class="box-title">{{ trans('app.ticket') }}</h3>
	      	<div class="box-tools pull-right">
				<a href="#" data-link="{{ route('admin.account.ticket.reply', $ticket) }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.reply') }}</a>
				<a href="{{ route('admin.account.ticket') }}" class="btn btn-default btn-flat">{{ trans('app.back') }}</a>
	      	</div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
			<div class="row">
			  	<div class="col-md-2 nopadding-right">
					<div class="form-group indent10">
						<p>
						  	<label>{{ trans('app.category') }}</label>
							{{ $ticket->category->name }}
						</p>
						<p>
						  	<label>{{ trans('app.priority') }}</label>
							{!! $ticket->priorityLevel() !!}
						</p>
						<p>
						  	<label>{{ trans('app.status') }}</label>
							{!! $ticket->statusName() !!}
						</p>
			  		</div>
			  	</div>
			  	<div class="col-md-7">
					<p class="lead">{{ $ticket->subject }}</p>

					@if(count($ticket->attachments))
						{{ trans('app.attachments') . ': ' }}
						@foreach($ticket->attachments as $attachment)
				            <a href="{{ route('attachment.download', $attachment->id) }}"><i class="fa fa-file"></i></a>
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
						<a href="#" data-link="{{ route('admin.account.ticket.reply', $ticket) }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.reply') }}</a>
						{!! Form::open(['route' => ['admin.account.ticket.archive', $ticket], 'method' => 'delete', 'class' => 'inline']) !!}
							<button class="confirm btn btn-danger" type="submit"><i class="fa fa-trash"></i> {{ trans('app.delete') }}</button>
						{!! Form::close() !!}
					</span>
					<div class="spacer50"></div>
			  	</div>

			  	<div class="col-md-3">
					@if($ticket->assignedTo)
						<div class="form-group indent10">
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
							<hr/>
					  	</div>
					@endif

					<div class="form-group indent10">
						<p>
						  	<label>{{ trans('app.created_at') }}</label>
							{{ $ticket->created_at->diffForHumans() }}
						</p>
						<p>
						  	<label>{{ trans('app.updated_at') }}</label>
							{{ $ticket->updated_at->diffForHumans() }}
						</p>
					</div>
				</div>
			</div>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection