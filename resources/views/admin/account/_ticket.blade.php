<div class="row">
	<div class="col-xs-12">
		<table class="table table-hover table-no-sort">
			<thead>
				<tr>
					<th>{{ trans('app.subject') }}</th>
					<th>{{ trans('app.category') }}</th>
					<th>{{ trans('app.priority') }}</th>
					<th><i class="fa fa-comments-o"></i></th>
					<th>{{ trans('app.updated_at') }}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tickets as $ticket )
					<tr>
						<td>
							<a href="{{ route('admin.account.ticket.show', $ticket->id) }}">{{ $ticket->subject }}</a>
		                    <span class="indent5">
								{!! $ticket->statusName() !!}
							</span>
							@if($ticket->attachments_count)
								<i class="fa fa-paperclip pull-right"></i>
							@endif
						</td>
						<td><span class="label label-outline"> {{ $ticket->category->name }} </span></td>
						<td>{!! $ticket->priorityLevel() !!}</td>
						<td><span class="label label-default">{{ $ticket->replies_count }}</span></td>
			          	<td>{{ $ticket->updated_at->diffForHumans() }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-xs-12">
		<a href="#" data-link="{{ route('admin.account.ticket.create') }}" class="ajax-modal-btn btn btn-lg btn-new btn-flat">
			<i class="fa fa-ticket"></i>
			{{ trans('app.submit_a_ticket') }}
		</a>
	</div>
</div>