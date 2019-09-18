@extends('admin.layouts.master')

@section('buttons')
    @if(Gate::allows('create', App\Order::class) || Gate::allows('create', App\Cart::class))
		<a href="#" data-link="{{ route('admin.order.order.searchCutomer') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_order') }}</a>
	@endif
@endsection

@section('content')
	@can('index', App\Cart::class)
		@include('admin/partials/_cart_list')
	@endcan

	<div class="box collapsed-box">
		<div class="box-header with-bcart">
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
	                    <th>{{ trans('app.created_at') }}</th>
	                    <th>{{ trans('app.customer') }}</th>
	                    <th>{{ trans('app.items') }}</th>
	                    <th>{{ trans('app.quantities') }}</th>
	                    <th>{{ trans('app.grand_total') }}</th>
	                    <th>{{ trans('app.deleted_at') }}</th>
	                    <th class="text-right">{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($trashes as $trash )
					<tr>
                        <td>{{ $trash->created_at->diffForHumans() }}</td>
                        <td>{{ $trash->customer->name }}</td>
                        <td>{{ $trash->item_count }}</td>
                        <td>{{ $trash->quantity }}</td>
                        <td>{{ get_formated_currency($trash->grand_total) }}</td>
                        <td>{{ $trash->deleted_at->diffForHumans() }}</td>
						<td class="row-options">
							@can('delete', $trash)
								<a href="{{ route('admin.order.cart.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

								{!! Form::open(['route' => ['admin.order.cart.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
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