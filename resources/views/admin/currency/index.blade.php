@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.currencies') }}</h3>
			<div class="box-tools pull-right">
				@can('create', App\Currency::class)
					<a href="#" data-link="{{ route('admin.utility.currency.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_currency') }}</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.iso_code') }}</th>
						<th>{{ trans('app.name') }}</th>
						<th>{{ trans('app.symbol') }}</th>
						<th>{{ trans('app.subunit') }}</th>
						<th>{{ trans('app.decimal_mark') }}</th>
						<th>{{ trans('app.thousands_separator') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($currencies as $currency )
					<tr>
						<td>{{ $currency->iso_code }}</td>
						<td>{{ $currency->name }}</td>
						<td>{{ $currency->symbol }}</td>
						<td>{{ $currency->subunit }}</td>
						<td>
				          	<span class="label label-default">{{ $currency->decimal_mark }}</span>
						</td>
						<td>
				          	<span class="label label-default">{{ $currency->thousands_separator }}</span>
						</td>
						<td class="row-options">
							@can('update', $currency)
								<a href="#" data-link="{{ route('admin.utility.currency.edit', $currency->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
							@endcan

							@can('delete', $currency)
								{!! Form::open(['route' => ['admin.utility.currency.destroy', $currency->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
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