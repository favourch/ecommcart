@extends('admin.layouts.master')

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-2 nopadding no-print">
        	@include('admin.message._left_nav')
        </div>
        <!-- /.col -->
        <div class="col-md-10 nopadding-right">
          	<div class="box box-primary">
	            <div class="box-header with-border">
	              <h3 class="box-title">{{ trans('app.message') }}</h3>
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
					</div>
	            </div>
	            <!-- /.box-header -->

	            <div class="box-body no-padding">
	              	<div class="mailbox-read-info">
	              		<div class="row">
		              		<div class="col-md-1">
					            @if($message->customer->image)
									<img src="{{ get_storage_file_url(optional($message->customer->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @else
				            		<img src="{{ get_gravatar_url($message->customer->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @endif

								@can('view', $message->customer)
					            	<a href="#" data-link="{{ route('admin.admin.customer.show', $message->customer) }}" class="ajax-modal-btn small">{{ trans('app.view_detail') }}</a>
								@endcan
							</div>
		              		<div class="col-md-11 nopadding-left">
				                <h3>{!! $message->subject !!}</h3>
				                <h5>
				                	{{ trans('app.from') }}: <strong>{{ $message->customer->getName() }} </strong>
				                	{{ '<' . $message->customer->email . '>' }}
				                  	<span class="mailbox-read-time pull-right">
				                  		{{ $message->updated_at->toDayDateTimeString() }}
				                  	</span>
				              	</h5>
			              	</div>
		              	</div>
	              	</div>
	              	<!-- /.mailbox-read-info -->
	              	<div class="mailbox-controls text-center no-print">
		                <div class="btn-group">
							@if($message->label < \App\Message::LABEL_DRAFT)
								@can('reply', $message)
									<a href="#" data-link="{{ route('admin.support.message.reply', $message) }}" class="ajax-modal-btn btn btn-default btn-sm">
										<i data-toggle="tooltip" data-placement="top" title="{{ trans('app.reply') }}" class="fa fa-reply"></i> {{ trans('app.reply') }}
									</a>

									<a href="#" data-link="{{ route('admin.support.message.reply', [$message, true]) }}" class="ajax-modal-btn btn btn-default btn-sm">
					                	<i class="fa fa-reply"></i> {{ trans('app.reply_with_template') }}
					                </a>
			                  	@endcan

								@if($message->label == \App\Message::LABEL_INBOX)
									<a href="{{ route('admin.support.message.update', [$message, \App\Message::STATUS_UNREAD, 'status']) }}" class="btn btn-default btn-sm">
			       		           		<i class="fa fa-envelope-o"></i> {{ trans('app.mark_as_unread') }}
			       		           	</a>
		       		           	@endif

								@can('update', $message)
									<a href="{{ route('admin.support.message.update', [$message, \App\Message::LABEL_SPAM]) }}" class="btn btn-default btn-sm">
			       		           		<i class="fa fa-filter"></i> {{ trans('app.mark_as_spam') }}
			       		           	</a>

									<a href="{{ route('admin.support.message.update', [$message, \App\Message::LABEL_TRASH]) }}" class="btn btn-default btn-sm">
				                  		<i class="fa fa-trash-o"></i> {{ trans('app.trash') }}
				                  	</a>
			                  	@endcan

							@else
								@if($message->label == \App\Message::LABEL_DRAFT)
									<a href="#" data-link="{{ route('admin.support.message.edit', $message) }}" class="ajax-modal-btn btn btn-default btn-sm">
										<i class="fa fa-send"></i> {{ trans('app.open') }}
									</a>
			                  	@endif

								@if($message->label > \App\Message::LABEL_DRAFT)
									@can('update', $message)
										<a href="{{ route('admin.support.message.update', [$message, \App\Message::LABEL_INBOX]) }}" class="btn btn-default btn-sm">
				       		           		<i class="fa fa-inbox"></i> {{ trans('app.move_to_inbox') }}
				       		           	</a>
				                  	@endcan
			                  	@endif

								@can('delete', $message)
									<a href="{{ url('admin/support/message/destroy/'. $message->id) }}" class="btn btn-default btn-sm confirm ajax-silent">
										<i class="glyphicon glyphicon-trash"></i> {{ trans('app.delete_permanently') }}
									</a>
			                  	@endcan
							@endif
		                </div>
		                <!-- /.btn-group -->

	                	<button type="button" class="btn btn-default btn-sm" onclick="window.print();">
	                  		<i class="fa fa-print"></i> {{ trans('app.print') }}
	                  	</button>
	              	</div>
	              	<!-- /.mailbox-controls -->

					<div class="mailbox-read-message">
						{!! $message->message !!}
					</div>
					<!-- /.mailbox-read-message -->
	            </div>
	            <!-- /.box-body -->

            	@if($message->attachments->count())
		            <div class="box-footer">
			            @include('admin.message._view_attachments')
		            </div>
	            	<!-- /.box-footer -->
	            @endif

				@unless($message->label == \App\Message::LABEL_DRAFT)
					@if($message->replies->count())
			            <div class="box-footer">
							<div class="form-group">
							  	<label>{{ trans('app.replies') }}</label>
							</div>

					        @foreach($message->replies as $reply)
								@include('admin.partials._reply_conversations')
					        @endforeach
						</div>
			        @endif
		            <!-- /.box-footer -->
		        @endunless

	            <div class="box-footer no-print">
					@if($message->label < \App\Message::LABEL_DRAFT)
		              	<div class="pull-right">
							@can('reply', $message)
								<a href="#" data-link="{{ route('admin.support.message.reply', $message) }}" class="ajax-modal-btn btn btn-default btn-sm">
				                	<i class="fa fa-reply"></i> {{ trans('app.reply') }}
				                </a>

								<a href="#" data-link="{{ route('admin.support.message.reply', [$message, true]) }}" class="ajax-modal-btn btn btn-default btn-sm">
				                	<i class="fa fa-reply"></i> {{ trans('app.reply_with_template') }}
				                </a>
							@endcan
		              	</div>

						@can('update', $message)
							<a href="{{ route('admin.support.message.update', [$message, \App\Message::LABEL_TRASH]) }}" class="btn btn-default btn-sm">
				              	<i class="fa fa-trash-o"></i> {{ trans('app.trash') }}
				             </a>

							<a href="{{ route('admin.support.message.update', [$message, \App\Message::LABEL_SPAM]) }}" class="btn btn-default btn-sm">
	       		           		<i class="fa fa-filter"></i> {{ trans('app.mark_as_spam') }}
	       		           	</a>
		              	@endcan
	              	@else
						@if($message->label > \App\Message::LABEL_DRAFT)
							@can('update', $message)
								<a href="{{ route('admin.support.message.update', [$message, \App\Message::LABEL_INBOX]) }}" class="btn btn-default btn-sm">
		       		           		<i class="fa fa-inbox"></i> {{ trans('app.move_to_inbox') }}
		       		           	</a>
		                  	@endcan
	                  	@endif

						@can('delete', $message)
							<a href="{{ url('admin/support/message/destroy/'. $message->id) }}" class="btn btn-default btn-sm confirm ajax-silent">
								<i class="glyphicon glyphicon-trash"></i> {{ trans('app.delete_permanently') }}
							</a>
		              	@endcan
					@endif

	              	<button type="button" class="btn btn-default" onclick="window.print();">
	              		<i class="fa fa-print"></i> {{ trans('app.print') }}
	              	</button>
	            </div>
	            <!-- /.box-footer -->
	        </div>
        	<!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection