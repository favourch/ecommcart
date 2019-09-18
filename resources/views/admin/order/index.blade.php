@extends('admin.layouts.master')

@section('buttons')
	@can('create', App\Order::class)
		<a href="#" data-link="{{ route('admin.order.order.searchCutomer') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_order') }}</a>
	@endcan
@endsection

@section('content')

	{{-- @include('admin.partials._filter') --}}

	@php
		$unpaid_orders = $orders->where('payment_status', '<' , App\Order::PAYMENT_STATUS_PAID);
	@endphp

	<div class="box">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs nav-justified">
				<li class="{{ Request::has('tab') ? '' : 'active' }}"><a href="#all_orders_tab" data-toggle="tab">
					<i class="fa fa-shopping-cart hidden-sm"></i>
					{{ trans('app.all_orders') }}
				</a></li>
				<li class="{{ Request::input('tab') == 'unpaid' ? 'active' : '' }}"><a href="#unpaid_tab" data-toggle="tab">
					<i class="fa fa-money hidden-sm"></i>
					{{ trans('app.statuses.unpaid') }}
				</a></li>
				<li class="{{ Request::input('tab') == 'unfulfilled' ? 'active' : '' }}"><a href="#unfulfilled_tab" data-toggle="tab">
					<i class="fa fa-shopping-basket hidden-sm"></i>
					{{ trans('app.statuses.unfulfilled') }}
				</a></li>
			</ul>
			<div class="tab-content">
			    <div class="tab-pane {{ Request::has('tab') ? '' : 'active' }}" id="all_orders_tab">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('app.order_number') }}</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('app.customer') }}</th>
								<th>{{ trans('app.grand_total') }}</th>
								<th>{{ trans('app.payment') }}</th>
								<th>{{ trans('app.status') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order )
								<tr>
									<td>
										@can('view', $order)
											<a href="{{ route('admin.order.order.show', $order->id) }}">
												{{ $order->order_number }}
											</a>
										@else
											{{ $order->order_number }}
										@endcan
										@if($order->disputed)
											<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
										@endif
									</td>
							        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
									<td>{{ $order->customer->name }}</td>
									<td>{{ get_formated_currency($order->grand_total) }}</td>
									<td>{!! $order->paymentStatusName() !!}</td>
									<td>
										<span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
											{{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
										</span>
									</td>
									<td class="row-options">
										@can('archive', $order)
											{!! Form::open(['route' => ['admin.order.order.archive', $order->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-archive text-muted"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.order_archive'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'unpaid' ? 'active' : '' }}" id="unpaid_tab">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('app.order_number') }}</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('app.customer') }}</th>
								<th>{{ trans('app.grand_total') }}</th>
								<th>{{ trans('app.payment') }}</th>
								<th>{{ trans('app.status') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($unpaid_orders as $order )
								<tr>
									<td>
										@can('view', $order)
											<a href="{{ route('admin.order.order.show', $order->id) }}">
												{{ $order->order_number }}
											</a>
										@else
											{{ $order->order_number }}
										@endcan
										@if($order->disputed)
											<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
										@endif
									</td>
							        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
									<td>{{ $order->customer->name }}</td>
									<td>{{ get_formated_currency($order->grand_total )}}</td>
									<td>{!! $order->paymentStatusName() !!}</td>
									<td>
										<span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
											{{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
										</span>
									</td>
									<td class="row-options">
										@can('archive', $order)
											{!! Form::open(['route' => ['admin.order.order.archive', $order->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-archive text-muted"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.order_archive'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			    <div class="tab-pane {{ Request::input('tab') == 'unfulfilled' ? 'active' : '' }}" id="unfulfilled_tab">
					<table class="table table-hover table-desc">
						<thead>
							<tr>
								<th>{{ trans('app.order_number') }}</th>
								<th>{{ trans('app.order_date') }}</th>
								<th>{{ trans('app.customer') }}</th>
								<th>{{ trans('app.grand_total') }}</th>
								<th>{{ trans('app.payment') }}</th>
								<th>{{ trans('app.status') }}</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							@foreach($orders as $order )
								@unless($order->isFulfilled())
									<tr>
										<td>
											@can('view', $order)
												<a href="{{ route('admin.order.order.show', $order->id) }}">
													{{ $order->order_number }}
												</a>
											@else
												{{ $order->order_number }}
											@endcan
											@if($order->disputed)
												<span class="label label-danger indent5">{{ trans('app.statuses.disputed') }}</span>
											@endif
										</td>
								        <td>{{ $order->created_at->toDayDateTimeString() }}</td>
										<td>{{ $order->customer->name }}</td>
										<td>{{ get_formated_currency($order->grand_total )}}</td>
										<td>{!! $order->paymentStatusName() !!}</td>
										<td>
											<span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
												{{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
											</span>
										</td>
										<td class="row-options">
											@can('archive', $order)
												{!! Form::open(['route' => ['admin.order.order.archive', $order->id], 'method' => 'delete', 'class' => 'data-form']) !!}
													{!! Form::button('<i class="fa fa-archive text-muted"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.order_archive'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
												{!! Form::close() !!}
											@endcan
										</td>
									</tr>
								@endunless
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div> <!-- /.box -->

	<div class="box collapsed-box">
		<div class="box-header with-border">
			<h3 class="box-title"><i class="fa fa-trash-o"></i> {{ trans('app.trash') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>{{ trans('app.order_number') }}</th>
						<th>{{ trans('app.order_date') }}</th>
						<th>{{ trans('app.grand_total') }}</th>
						<th>{{ trans('app.payment') }}</th>
						<th>{{ trans('app.status') }}</th>
						<th>{{ trans('app.archived_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($archives as $archive )
					<tr>
						<td>
							@can('view', $archive)
								<a href="#" data-link="{{ route('admin.order.order.show', $archive->id) }}"  class="ajax-modal-btn">
									{{ $archive->order_number }}
								</a>
							@else
								{{ $archive->order_number }}
							@endcan
						</td>
				        <td>{{ $archive->created_at->toDayDateTimeString() }}</td>
						<td>{{ $archive->amount_total }}</td>
						<td>{!! $archive->paymentStatusName() !!}</td>
						<td>
							<span class="label label-outline" style="background-color: {{ optional($archive->status)->label_color }}">
								{{ $archive->status ? strToupper(optional($archive->status)->name) : trans('app.statuses.new') }}
							</span>
						</td>
						<td>{{ $archive->deleted_at->diffForHumans() }}</td>
						<td class="row-options">
							@can('archive', $archive)
								<a href="{{ route('admin.order.order.restore', $archive->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>
							@endcan
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection