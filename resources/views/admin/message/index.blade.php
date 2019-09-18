@extends('admin.layouts.master')

@section('content')
	@php
		$search_q = isset($search_q) ? $search_q : Null;
		$requestLabel = isset(request()->route()->parameters['label']) ? request()->route()->parameters['label'] : 1;
	@endphp

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-2 nopadding">
        	@include('admin.message._left_nav')
        </div>
        <!-- /.col -->
        <div class="col-md-10 nopadding-right">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{ $search_q ? trans('app.search_result') : get_msg_folder_name_from_label($requestLabel) }}</h3>
              <div class="box-tools col-lg-4 pull-right nopadding-right">
                <div class="has-feedback">
				    {!! Form::open(['route' => 'message.search', 'method' => 'get', 'id' => 'form', 'data-toggle' => 'validator']) !!}
						<div class="input-group">
							{!! Form::text('q', null, ['class' => 'form-control input-sm', 'placeholder' => trans('app.placeholder.search'), 'required']) !!}
							<div class="help-block with-errors"></div>
					     	<span class="input-group-btn">
					        	<button class="btn btn-default" type="submit"> <i class="fa fa-search"></i> </button>
					    	</span>
					    </div><!-- /input-group -->
				    {!! Form::close() !!}
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->

            <div class="box-body no-padding">
              	<div class="mailbox-controls">
	                <!-- Check all button -->
					<div class="btn-group ">
						<button type="button" class="btn btn-sm btn-default checkbox-toggle"><i class="fa fa-square-o" data-toggle="tooltip" data-placement="top" title="{{ trans('app.select_all') }}"></i>
						</button>
						<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							<span class="caret"></span>
							<span class="sr-only">{{ trans('app.toggle_dropdown') }}</span>
						</button>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('admin.support.message.massUpdate', [ App\Message::STATUS_NEW, 'status' ]) }}" class="massAction" data-doafter="reload">
								<i class="fa fa-envelope-o"></i> {{ trans('app.new') }}</a></li>
							<li><a href="{{ route('admin.support.message.massUpdate', [ App\Message::STATUS_READ, 'status' ]) }}" class="massAction" data-doafter="reload"><i class="fa fa-envelope-open"></i> {{ trans('app.read') }}</a></li>
							<li><a href="{{ route('admin.support.message.massUpdate', [ App\Message::STATUS_UNREAD, 'status' ]) }}" class="massAction" data-doafter="reload"><i class="fa fa-envelope"></i> {{ trans('app.unread') }}</a></li>
							<li class="divider"></li>

							@if($requestLabel <= \App\Message::LABEL_DRAFT)
								<li><a href="{{ route('admin.support.message.massUpdate', [ App\Message::LABEL_SPAM, 'label' ]) }}" class="massAction" data-doafter="remove"><i class="fa fa-filter"></i> {{ trans('app.spam') }}</a></li>

								<li><a href="{{ route('admin.support.message.massUpdate', [ App\Message::LABEL_TRASH, 'label' ]) }}" class="massAction" data-doafter="remove"><i class="fa fa-trash"></i> {{ trans('app.trash') }}</a></li>
							@else
								<li><a href="{{ route('admin.support.message.massUpdate', [ App\Message::LABEL_INBOX, 'label' ]) }}" class="massAction" data-doafter="remove"><i class="fa fa-inbox"></i> {{ trans('app.move_to_inbox') }}</a></li>
							@endif

							@if($requestLabel > \App\Message::LABEL_DRAFT)
								<li><a href="{{ route('admin.support.message.massDestroy') }}" class="massAction" data-doafter="remove"><i class="glyphicon glyphicon-trash"></i> {{ trans('app.delete_permanently') }}</a></li>
							@endif
						</ul>
	                </div>

	                <button type="button" class="btn btn-default btn-sm" onClick="window.location.reload();"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="{{ trans('app.refresh') }}"></i></button>

                	@if($search_q)
		                <div id="" style="display: inline;"> {{ trans('app.search_result_for') . " '" . $search_q . "'" }} </div>
					@endif

	                <div class="pull-right">
	                	@if($messages->count())
							{{ $messages->links('admin.partials._pagination_btn') }}
						@endif
	                </div>
	                <!-- /.pull-right -->
              	</div>

              	<div class="table-responsive mailbox-messages" id="massSelectArea">
	                <table class="table table-hover table-striped">
	                  	<tbody>
							@forelse($messages as $message)
		                  		<tr id="item_{{ $message->id }}">
				                    <td><input id="{{ $message->id }}" type="checkbox" class="massCheck"></td>
				                    <td class="mailbox-name">
				                    	<a href="{{ route('admin.support.message.show', $message) }}">
											{!! highlightWords($message->customer->name, $search_q) !!}
				                    	</a>
				                	</td>
				                    <td class="mailbox-subject">
				                    	<a href="{{ route('admin.support.message.show', $message) }}">
				                    		<b>{!! highlightWords($message->subject, $search_q) !!} </b> - {!! highlightWords(str_limit($message->message, 180 - strlen($message->subject)), $search_q) !!}
				                    	</a>
				                    </td>
				                    <td class="">
				                    	<small>
					                    	@if($message->status < $message::STATUS_READ)
					                    		{!! $message->statusName() !!}
											@endif
					                    	@if($message->about())
												{!! $message->about() !!}
											@endif
					                    	@if($message->replies_count)
						                    	<span class="label label-default" data-toggle="tooltip" data-placement="top" title="{{ trans('app.replies') }}">{{ $message->replies_count }}</span>
											@endif
										</small>
				                    </td>
				                    <td class="mailbox-attachment">
				                    	@if($message->hasAttachments())
					                    	<i class="fa fa-paperclip" data-toggle="tooltip" data-placement="top" title="{{ trans('app.attachments') }}"></i>
										@endif
				                    </td>
				                    <td class="mailbox-date">{{ $message->updated_at->diffForHumans() }}</td>
		                  		</tr>
	                  		@empty
	                  			<tr><p class="text-center"> {{ trans('app.no_data_found') }} </p></tr>
							@endforelse
	                  	</tbody>
	                </table>
	                <!-- /.table -->
              	</div>
              	<!-- /.mail-box-messages -->

              	<div class="mailbox-controls">
	                <div class="pull-right">
	                	@if($messages->count())
							{{ $messages->links('admin.partials._pagination_btn') }}
						@endif
	                </div>
                </div>
                <br><br>
            </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
