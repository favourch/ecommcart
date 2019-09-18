@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.category_sub_groups') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\CategorySubGroup::class)
				<a href="#" data-link="{{ route('admin.catalog.categorySubGroup.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_category_sub_group') }} </a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-option">
	        <thead>
	        <tr>
	          <th>{{ trans('app.category_sub_group') }}</th>
	          <th>{{ trans('app.parent') }}</th>
	          <th>{{ trans('app.categories') }}</th>
	          <th>{{ trans('app.option') }}</th>
	        </tr>
	        </thead>
	        <tbody>
		        @foreach($categorySubGrps as $categorySubGrp )
			        <tr>
			          <td>	{{ $categorySubGrp->name }}
							@unless($categorySubGrp->active)
								<span class="label label-default indent5 small">{{ trans('app.inactive') }}</span>
							@endunless
			          </td>
			          <td>
			          	@if($categorySubGrp->group->deleted_at)
				          	<i class="fa fa-trash-o small"></i>
			          	@endif
			          	{{ $categorySubGrp->group->name }}
			          </td>
			          <td><span class="label label-default">{{ $categorySubGrp->categories_count }}</span></td>
			          <td class="row-options">
						@can('update', $categorySubGrp)
	                	    <a href="#" data-link="{{ route('admin.catalog.categorySubGroup.edit', $categorySubGrp->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-edit"></i></a>&nbsp;
						@endcan

						@can('delete', $categorySubGrp)
		                    {!! Form::open(['route' => ['admin.catalog.categorySubGroup.trash', $categorySubGrp->id], 'method' => 'delete', 'class' => 'data-form']) !!}
		                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => 'Trash', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
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
	      <h3 class="box-title"><i class="fa fa-trash-o"></i> {{ trans('app.trash') }}</h3>
	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
	        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-option">
	        <thead>
	        <tr>
	          <th>{{ trans('app.category_sub_group') }}</th>
	          <th>{{ trans('app.parent') }}</th>
	          <th>{{ trans('app.deleted_at') }}</th>
	          <th>{{ trans('app.option') }}</th>
	        </tr>
	        </thead>
	        <tbody>
		        @foreach($trashes as $trash )
			        <tr>
			          <td>{{ $trash->name }}</td>
			          <td>
			          	@if($trash->group->deleted_at)
				          	<i class="fa fa-trash-o small"></i>
			          	@endif
			          	{{ $trash->group->name }}
			          </td>
			          <td>{{ $trash->deleted_at->diffForHumans() }}</td>
			          <td class="row-options">
						@can('delete', $trash)
	                	    <a href="{{ route('admin.catalog.categorySubGroup.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="Restore" class="fa fa-database"></i></a>&nbsp;

		                    {!! Form::open(['route' => ['admin.catalog.categorySubGroup.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
		                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => 'Delete Permanently', 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
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