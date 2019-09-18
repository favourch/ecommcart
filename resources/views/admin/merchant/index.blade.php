@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.merchants') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Merchant::class)
				<a href="#" data-link="{{ route('admin.vendor.merchant.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_merchant') }}</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
			<table class="table table-hover table-2nd-short">
				<thead>
					<tr>
					  <th>{{ trans('app.nice_name') }}</th>
					  <th>{{ trans('app.full_name') }}</th>
					  <th>{{ trans('app.shop') }}</th>
					  <th>{{ trans('app.current_billing_plan') }}</th>
					  <th>{{ trans('app.option') }}</th>
					</tr>
				</thead>
				<tbody>
				    @foreach($merchants as $merchant )
				        <tr>
				          <td>
				            @if($merchant->image)
								<img src="{{ get_storage_file_url(optional($merchant->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @else
			            		<img src="{{ get_gravatar_url($merchant->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
				            @endif
							<p class="indent10">
								{{ $merchant->nice_name }}

			            		@unless($merchant->active)
				            		<span class="label label-default indent10">{{ trans('app.inactive') }}</span>
								@endunless
							</p>
				          </td>
				          <td>
							@can('view', $merchant)
					            <a href="#" data-link="{{ route('admin.vendor.merchant.show', $merchant->id) }}" class="ajax-modal-btn">{{ $merchant->name }}</a>
							@else
					          	{{ $merchant->name }}
							@endcan
				          </td>
				          <td>
				          	@if($merchant->owns->name)
								<img src="{{ get_storage_file_url(optional($merchant->owns->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.logo') }}">
								<p class="indent10">
						            <a href="#" data-link="{{ route('admin.vendor.shop.show', $merchant->owns->id) }}" class="ajax-modal-btn">
										{{ $merchant->owns->name }}
							         </a>
								</p>
				          	@endif
				          </td>
				          <td>{{ $merchant->owns->current_billing_plan }}</td>
				          <td class="row-options">
							@can('view', $merchant)
					            <a href="#" data-link="{{ route('admin.vendor.merchant.show', $merchant->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.profile') }}" class="fa fa-user-circle-o"></i></a>&nbsp;
							@endcan

							@can('secretLogin', $merchant)
								<a href="{{ route('admin.user.secretLogin', $merchant) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.secret_login_user') }}" class="fa fa-user-secret"></i></a>&nbsp;
							@endcan

							@can('update', $merchant)
					            <a href="#" data-link="{{ route('admin.vendor.merchant.edit', $merchant->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;

								@if($merchant->primaryAddress)
									<a href="#" data-link="{{ route('address.edit', $merchant->primaryAddress->id) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.update_address') }}" class="fa fa-map-marker"></i></a>&nbsp;
								@else
									<a href="#" data-link="{{ route('address.create', ['merchant', $merchant->id]) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.add_address') }}" class="fa fa-plus-square-o"></i></a>&nbsp;
								@endif
							@endcan

							@can('delete', $merchant)
					            {!! Form::open(['route' => ['admin.vendor.shop.trash', $merchant->owns->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
		          <th>{{ trans('app.nice_name') }}</th>
		          <th>{{ trans('app.full_name') }}</th>
		          <th>{{ trans('app.email') }}</th>
		          <th>{{ trans('app.shop') }}</th>
		          <th>{{ trans('app.deleted_at') }}</th>
		          <th>{{ trans('app.option') }}</th>
		        </tr>
		        </thead>
		        <tbody>
			        @foreach($trashes as $trash )
				        <tr>
				          	<td>
								<img src="{{ get_storage_file_url(optional($trash->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
								<p class="indent10">
									{{ $trash->nice_name }}
								</p>
							</td>
					        <td>{{ $trash->name }}</td>
					        <td>{{ $trash->email }}</td>
					        <td>
					          	@if($trash->owns)
									<img src="{{ get_storage_file_url(optional($trash->owns->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.logo') }}">
									<p class="indent10">{{ $trash->owns->name }}</p>
					          	@endif
				          	</td>
				          <td>{{ $trash->deleted_at->diffForHumans() }}</td>
				          <td class="row-options">
							@can('delete', $trash)
			                    <a href="{{ route('admin.vendor.shop.restore', $trash->owns->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

			                    {!! Form::open(['route' => ['admin.vendor.shop.destroy', $trash->owns->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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