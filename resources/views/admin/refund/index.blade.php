@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.refunds') }}</h3>
			<div class="box-tools pull-right">
				@can('initiate', App\Refund::class)
					<a href="#" data-link="{{ route('admin.support.refund.form') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.initiate_refund') }}</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.order_number') }}</th>
						<th>{{ trans('app.return_goods') }}</th>
						<th>{{ trans('app.order_amount') }}</th>
						<th>{{ trans('app.refund_amount') }}</th>
						<th>{{ trans('app.status') }}</th>
						<th>{{ trans('app.created_at') }}</th>
						<th>{{ trans('app.updated_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($refunds as $refund )
						<tr>
							<td>
					            @can('index', App\Order::class)
									<a href="{{ route('admin.order.order.show', $refund->order_id) }}">
										{{ $refund->order->order_number }}
									</a>
								@else
									{{ $refund->order->order_number }}
								@endcan
							</td>
							<td>{!! get_yes_or_no($refund->return_goods) !!}</td>
							<td>{{ get_formated_currency($refund->order->grand_total) }}</td>
							<td>{{ get_formated_currency($refund->amount) }}</td>
							<td>{!! $refund->statusName() !!}</td>
				          	<td>{{ $refund->created_at->diffForHumans() }}</td>
				          	<td>{{ $refund->updated_at->diffForHumans() }}</td>
							<td class="row-options">
					            @can('index', App\Customer::class)
									<a href="#" data-link="{{ route('admin.admin.customer.show', $refund->order->customer_id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.customer') }}" class="fa fa-user"></i></a>&nbsp;
								@endcan

								@can('approve', $refund)
									<a href="#" data-link="{{ route('admin.support.refund.response', $refund) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.response') }}" class="fa fa-random"></i></a>&nbsp;
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
			<h3 class="box-title">{{ trans('app.closed_refunds') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.order_number') }}</th>
						<th>{{ trans('app.return_goods') }}</th>
						<th>{{ trans('app.order_amount') }}</th>
						<th>{{ trans('app.refund_amount') }}</th>
						<th>{{ trans('app.status') }}</th>
						<th>{{ trans('app.created_at') }}</th>
						<th>{{ trans('app.updated_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($closed as $refund )
						<tr>
							<td>
					            @can('index', App\Order::class)
									<a href="{{ route('admin.order.order.show', $refund->order_id) }}">
										{{ $refund->order->order_number }}
									</a>
								@else
									{{ $refund->order->order_number }}
								@endcan
							</td>
							<td>{!! get_yes_or_no($refund->return_goods) !!}</td>
							<td>{{ get_formated_currency($refund->order->total) }}</td>
							<td>{{ get_formated_currency($refund->amount) }}</td>
							<td>{!! $refund->statusName() !!}</td>
				          	<td>{{ $refund->created_at->diffForHumans() }}</td>
				          	<td>{{ $refund->updated_at->diffForHumans() }}</td>
							<td class="row-options">
					            {{-- @can('index', App\Customer::class) --}}
									<a href="#" data-link="{{ route('admin.admin.customer.show', $refund->order->customer_id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.customer') }}" class="fa fa-user"></i></a>&nbsp;
								{{-- @endcan --}}
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection