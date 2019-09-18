@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.disputes') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>{{ trans('app.customer') }}</th>
						<th>{{ trans('app.type') }}</th>
						<th>{{ trans('app.response') }}</th>
						<th>{{ trans('app.updated_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($disputes as $dispute )
						<tr>
							<td>
					            @if($dispute->customer->image)
									<img src="{{ get_storage_file_url(optional($dispute->customer->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @else
				            		<img src="{{ get_gravatar_url($dispute->customer->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @endif
					            <p class="indent10">
									<strong>{{ $dispute->customer->name }}</strong>
		    						@if (Auth::user()->isFromPlatform() && $dispute->shop)
										<br/><span>{{ trans('app.vendor') . ': ' . optional($dispute->shop)->name }}</span>
									@endif
					            </p>
							</td>
							<td>
	    						@if (!Auth::user()->isFromPlatform())
									{!! $dispute->statusName() !!}
								@endif
								<a href="{{ route('admin.support.dispute.show', $dispute->id) }}">{{ $dispute->dispute_type->detail }}</a>
							</td>
							<td><span class="label label-default">{{ $dispute->replies_count }}</span></td>
				          	<td>{{ $dispute->updated_at->diffForHumans() }}</td>
							<td class="row-options">
								@can('response', $dispute)
									<a href="#" data-link="{{ route('admin.support.dispute.response', $dispute) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.response') }}" class="fa fa-reply"></i></a>&nbsp;
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
			<h3 class="box-title">{{ trans('app.closed_disputes') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.customer') }}</th>
						<th>{{ trans('app.type') }}</th>
						<th>{{ trans('app.response') }}</th>
						<th>{{ trans('app.updated_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($closed as $dispute )
						<tr>
							<td>
					            @if($dispute->customer->image)
									<img src="{{ get_storage_file_url(optional($dispute->customer->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @else
				            		<img src="{{ get_gravatar_url($dispute->customer->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @endif
					            <p class="indent10">
									<strong>{{ $dispute->customer->name }}</strong>
		    						@if (Auth::user()->isFromPlatform() && $dispute->shop)
										<br/><span>{{ trans('app.vendor') . ': ' . optional($dispute->shop)->name }}</span>
									@endif
					            </p>
							</td>
							<td>
	    						@if (!Auth::user()->isFromPlatform())
									{!! $dispute->statusName() !!}
								@endif
								<a href="{{ route('admin.support.dispute.show', $dispute->id) }}">{{ $dispute->dispute_type->detail }}</a>
							</td>
							<td><span class="label label-default">{{ $dispute->replies_count }}</span></td>
				          	<td>{{ $dispute->updated_at->diffForHumans() }}</td>
							<td class="row-options">
								@can('response', $dispute)
									<a href="#" data-link="{{ route('admin.support.dispute.response', $dispute) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.response') }}" class="fa fa-reply"></i></a>&nbsp;
								@endcan
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection