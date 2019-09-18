<a href="#" data-link="{{ route('admin.support.message.create') }}"  class="ajax-modal-btn btn btn-new btn-lg btn-block">{{ trans('app.compose') }}</a>

<a href="#" data-link="{{ route('admin.support.message.create', true) }}"  class="ajax-modal-btn btn btn-info btn-lg btn-block margin-bottom">{{ trans('app.new_message_with_template') }}</a>

<div class="box box-solid">
	<div class="box-header">
	  <h3 class="box-title">{{ trans('app.folders') }}</h3>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="{{ Request::is('*/labelOf/' . App\Message::LABEL_INBOX.'*') || (isset($message) && $message->label == App\Message::LABEL_INBOX) ? 'active' : '' }}">
				<a href="{{ route('admin.support.message.labelOf', App\Message::LABEL_INBOX) }}"><i class="fa fa-inbox"></i> {{ trans('app.inbox') }}
					@if($unread_msg_count = \App\Helpers\Statistics::unread_msg_count())
						<span class="label label-primary pull-right">{{ $unread_msg_count }}</span>
					@endif
				</a>
			</li>
			<li class="{{ Request::is('*/labelOf/' . App\Message::LABEL_SENT.'*') || (isset($message) && $message->label == App\Message::LABEL_SENT) ? 'active' : '' }}">
				<a href="{{ route('admin.support.message.labelOf', App\Message::LABEL_SENT) }}"><i class="fa fa-envelope-o"></i> {{ trans('app.sent') }}</a>
			</li>
			<li class="{{ Request::is('*/labelOf/' . App\Message::LABEL_DRAFT.'*') || (isset($message) && $message->label == App\Message::LABEL_DRAFT) ? 'active' : '' }}">
				<a href="{{ route('admin.support.message.labelOf', App\Message::LABEL_DRAFT) }}"><i class="fa fa-file-text-o"></i> {{ trans('app.drafts') }}
					@if($draft_msg_count = \App\Helpers\Statistics::draft_msg_count())
						<span class="label label-default pull-right">{{ $draft_msg_count }}</span>
					@endif
				</a>
			</li>
			<li class="{{ Request::is('*/labelOf/' . App\Message::LABEL_SPAM.'*') || (isset($message) && $message->label == App\Message::LABEL_SPAM) ? 'active' : '' }}">
				<a href="{{ route('admin.support.message.labelOf', App\Message::LABEL_SPAM) }}"><i class="fa fa-filter"></i> {{ trans('app.spams') }}
					@if($spam_msg_count = \App\Helpers\Statistics::spam_msg_count())
						<span class="label label-warning pull-right">{{ $spam_msg_count }}</span>
					@endif
				</a>
			</li>
			<li class="{{ Request::is('*/labelOf/' . App\Message::LABEL_TRASH.'*') || (isset($message) && $message->label == App\Message::LABEL_TRASH) ? 'active' : '' }}">
				<a href="{{ route('admin.support.message.labelOf', App\Message::LABEL_TRASH) }}"><i class="fa fa-trash-o"></i> {{ trans('app.trash') }}
					@if( ($trash_msg_count = \App\Helpers\Statistics::trash_msg_count()) && $trash_msg_count > 10 )
						<span class="label label-danger pull-right">{{ $trash_msg_count }}</span>
					@endif
				</a>
			</li>
		</ul>
	</div>
	<!-- /.box-body -->
</div>
<!-- /. box -->