@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.shops') }}</h3>
			<div class="box-tools pull-right">
				@can('create', App\Merchant::class)
					<a href="#" data-link="{{ route('admin.vendor.merchant.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_merchant') }}</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->
		<div class="box-body">
			<table class="table table-hover table-option">
				<thead>
					<tr>
						<th>{{ trans('app.shop_name') }}</th>
						<th>{{ trans('app.current_billing_plan') }}</th>
						<th>{{ trans('app.owner') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($shops as $shop )
						<tr>
							<td>
								<img src="{{ get_storage_file_url(optional($shop->logo)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.logo') }}">
								<p class="indent10">
									@can('view', $shop)
										<a href="#" data-link="{{ route('admin.vendor.shop.show', $shop->id) }}"  class="ajax-modal-btn">{{ $shop->name }}</a>
									@else
										{{ $shop->name }}
									@endcan

				            		@if($shop->config->maintenance_mode)
							          	<span class="label label-default indent10">{{ trans('app.maintenance_mode') }}</span>
				            		@elseif(!$shop->active)
					            		<span class="label label-default indent10">{{ trans('app.inactive') }}</span>
									@endif
								</p>
							</td>
				          	<td>{{ $shop->current_billing_plan }}</td>
							<td>
					            @if($shop->owner->image)
									<img src="{{ get_storage_file_url(optional($shop->owner->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @else
				            		<img src="{{ get_gravatar_url($shop->owner->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
					            @endif
								<p class="indent10">
									@can('view', $shop->owner)
							            <a href="#" data-link="{{ route('admin.vendor.merchant.show', $shop->owner_id) }}" class="ajax-modal-btn">{{ $shop->owner->getName() }}</a>
									@else
										{{ $shop->owner->getName() }}
									@endcan
								</p>
							</td>
							<td class="row-options">
								@can('view', $shop)
									<a href="#" data-link="{{ route('admin.vendor.shop.show', $shop->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i></a>&nbsp;

									<a href="{{ route('admin.vendor.shop.staffs', $shop->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.staffs') }}" class="fa fa-users"></i></a>&nbsp;
								@endcan

								@can('secretLogin', $shop->owner)
									<a href="{{ route('admin.user.secretLogin', $shop->owner->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.secret_login_merchant') }}" class="fa fa-user-secret"></i></a>&nbsp;
								@endcan

								@can('update', $shop)
									<a href="#" data-link="{{ route('admin.vendor.shop.edit', $shop->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;

									@if($shop->primaryAddress)
										<a href="#" data-link="{{ route('address.edit', $shop->primaryAddress->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.update_address') }}" class="fa fa-map-marker"></i></a>&nbsp;
									@else
										<a href="#" data-link="{{ route('address.create', ['shop', $shop->id]) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.add_address') }}" class="fa fa-plus-square-o"></i></a>&nbsp;
									@endif
								@endcan

								@can('delete', $shop)
									{!! Form::open(['route' => ['admin.vendor.shop.trash', $shop->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
						<th>{{ trans('app.email') }}</th>
						<th>{{ trans('app.owner') }}</th>
						<th>{{ trans('app.deleted_at') }}</th>
						<th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($trashes as $trash )
					<tr>
						<td>
							<img src="{{ get_storage_file_url(optional($trash->logo)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.logo') }}">
							<p class="indent10">
								{{ $trash->name }}
							</p>
						</td>
						<td>{{ $trash->email }}</td>
						<td>
				            @if($trash->owner->image)
								<img src="{{ get_storage_file_url(optional($trash->owner->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @else
			            		<img src="{{ get_gravatar_url($trash->owner->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @endif
							<p class="indent10">{{ $trash->owner->getName() }}</p>
						</td>
						<td>{{ $trash->deleted_at->diffForHumans() }}</td>
						<td class="row-options">
							@can('delete', $trash)
								<a href="{{ route('admin.vendor.shop.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

								{!! Form::open(['route' => ['admin.vendor.shop.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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