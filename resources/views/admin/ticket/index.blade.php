@extends('admin.layouts.master')

@section('content')
	@if($assigned->count())
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">{{ trans('app.assigned_to_me') }}</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
				</div>
			</div> <!-- /.box-header -->
			<div class="box-body">
				<table class="table table-hover table-option">
					<thead>
						<tr>
							<th>{{ trans('app.merchant') }}</th>
							<th>{{ trans('app.subject') }}</th>
							<th>{{ trans('app.priority') }}</th>
							<th>{{ trans('app.replies') }}</th>
							<th>{{ trans('app.assigned_to') }}</th>
							<th>{{ trans('app.updated_at') }}</th>
							<th>{{ trans('app.option') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach($assigned as $ticket )
						<tr>
							<td>
								<img src="{{ get_storage_file_url(optional($ticket->shop->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.logo') }}">
								<p class="indent10">
									<strong>
										{{ $ticket->shop->name }}
									</strong>
									 <br/>
									{{ trans('app.by') . ' ' . $ticket->user->name }}
								</p>
							</td>
							<td>
								{!! $ticket->statusName() !!}
								<span class="label label-outline"> {{ $ticket->category->name }} </span> &nbsp;
								<a href="{{ route('admin.support.ticket.show', $ticket->id) }}">{{ $ticket->subject }}</a>
							</td>
							<td>{!! $ticket->priorityLevel() !!}</td>
							<td><span class="label label-default">{{ $ticket->replies_count }}</span></td>
							<td>{{ ($ticket->assigned_to) ? $ticket->assignedTo->name : '-' }}</td>
				          	<td>{{ $ticket->updated_at->diffForHumans() }}</td>
							<td class="row-options">
								@can('reply', $ticket)
									<a href="#" data-link="{{ route('admin.support.ticket.reply', $ticket) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.reply') }}" class="fa fa-reply"></i></a>&nbsp;
								@endcan

								@can('update', $ticket)
									<a href="#" data-link="{{ route('admin.support.ticket.edit', $ticket->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.update') }}" class="fa fa-edit"></i></a>&nbsp;
								@endcan

								@can('assign', $ticket)
									<a href="#" data-link="{{ route('admin.support.ticket.showAssignForm', $ticket->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.assign') }}" class="fa fa-hashtag"></i></a>&nbsp;
								@endcan
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div> <!-- /.box-body -->
		</div> <!-- /.box -->
	@endif

	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.open_tickets') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.merchant') }}</th>
						<th>{{ trans('app.subject') }}</th>
						<th>{{ trans('app.priority') }}</th>
						<th>{{ trans('app.replies') }}</th>
						<th>{{ trans('app.assigned_to') }}</th>
						<th>{{ trans('app.updated_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($tickets as $ticket )
					<tr>
						<td>
							<img src="{{ get_storage_file_url(optional($ticket->shop->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.logo') }}">
							<p class="indent10">
								<strong>
									{{ $ticket->shop->name }}
								</strong>
								 <br/>
								{{ trans('app.by') . ' ' . $ticket->user->name }}
							</p>
						</td>
						<td>
							{!! $ticket->statusName() !!}
							<span class="label label-outline"> {{ $ticket->category->name }} </span> &nbsp;
							<a href="{{ route('admin.support.ticket.show', $ticket->id) }}">{{ $ticket->subject }}</a>
						</td>
						<td>{!! $ticket->priorityLevel() !!}</td>
						<td><span class="label label-default">{{ $ticket->replies_count }}</span></td>
						<td>{{ ($ticket->assigned_to) ? $ticket->assignedTo->name : '-' }}</td>
			          	<td>{{ $ticket->updated_at->diffForHumans() }}</td>
						<td class="row-options">
							@can('reply', $ticket)
								<a href="#" data-link="{{ route('admin.support.ticket.reply', $ticket) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.reply') }}" class="fa fa-reply"></i></a>&nbsp;
							@endcan

							@can('update', $ticket)
								<a href="#" data-link="{{ route('admin.support.ticket.edit', $ticket->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.update') }}" class="fa fa-edit"></i></a>&nbsp;
							@endcan

							@can('assign', $ticket)
								<a href="#" data-link="{{ route('admin.support.ticket.showAssignForm', $ticket->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.assign') }}" class="fa fa-hashtag"></i></a>&nbsp;
							@endcan
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->

	<div class="box collapsed-box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.closed_tickets') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.shop') }}</th>
						<th>{{ trans('app.subject') }}</th>
						<th>{{ trans('app.priority') }}</th>
						<th>{{ trans('app.assigned_to') }}</th>
						<th>{{ trans('app.updated_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($closed as $ticket )
					<tr>
						<td>
							<strong>
								{{ $ticket->shop->name }}
							</strong>
							 <br/>
							{{ trans('app.by') . ' ' . $ticket->user->name }}
						</td>
						<td>
							{!! $ticket->statusName() !!}
							<span class="label label-outline"> {{ $ticket->category->name }} </span> &nbsp;
							<a href="{{ route('admin.support.ticket.show', $ticket->id) }}">{{ $ticket->subject }}</a>
						</td>
						<td>{!! $ticket->priorityLevel() !!}</td>
						<td>{{ ($ticket->assigned_to) ? $ticket->assignedTo->name : '-' }}</td>
			          	<td>{{ $ticket->updated_at->diffForHumans() }}</td>
						<td class="row-options">
							@can('update', $ticket)
			                    {!! Form::open(['route' => ['admin.support.ticket.reopen', $ticket->id], 'method' => 'POST', 'class' => 'data-form']) !!}
			                        {!! Form::button('<i class="glyphicon glyphicon-refresh"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.reopen'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
							@endcan
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection