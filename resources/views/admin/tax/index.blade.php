@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.taxes') }}</h3>
			<div class="box-tools pull-right">
				@can('create', App\Tax::class)
					<a href="#" data-link="{{ route('admin.setting.tax.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_tax') }}</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.name') }}</th>
						<th>{{ trans('app.tax_rate') }}</th>
						<th>{{ trans('app.region') }}</th>
						<th>{{ trans('app.public') }}</th>
						<th>{{ trans('app.status') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($taxes as $tax )
					<tr>
						<td>{{ $tax->name }}</td>
						<td>{{ get_formated_decimal($tax->taxrate) . ' ' . trans('app.%') }}</td>
						<td>
							{{ $tax->state ? $tax->state->name . ' :: ' : '' }}
							{{ $tax->country ? $tax->country->name : '' }}
						</td>
						<td>{{ ($tax->public) ? trans('app.yes') : '-' }}</td>
						<td>{{ ($tax->active) ? trans('app.active') : trans('app.inactive') }}</td>
						<td class="row-options">
							@can('update', $tax)
								<a href="#" data-link="{{ route('admin.setting.tax.edit', $tax->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
							@endcan

							@can('delete', $tax)
								{!! Form::open(['route' => ['admin.setting.tax.trash', $tax->id], 'method' => 'delete', 'class' => 'data-form']) !!}
									{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
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
			<h3 class="box-title"><i class="fa fa-trash-o"></i>{{ trans('app.trash') }}</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
				<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
						<th>{{ trans('app.name') }}</th>
						<th>{{ trans('app.tax_rate') }}</th>
						<th>{{ trans('app.country') }}</th>
						<th>{{ trans('app.deleted_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($trashes as $trash )
						<tr>
							<td>{{ $trash->name }}</td>
							<td>{{ $trash->taxrate }} {{ trans('app.%') }}</td>
							<td>{{ $tax->country->name }}</td>
							<td>{{ $trash->deleted_at->diffForHumans() }}</td>
							<td class="row-options">
								@can('delete', $trash)
									<a href="{{ route('admin.setting.tax.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

									{!! Form::open(['route' => ['admin.setting.tax.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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