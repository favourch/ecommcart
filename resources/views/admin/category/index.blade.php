@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.categories') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Category::class)
				<a href="#" data-link="{{ route('admin.catalog.category.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_category') }}</a>
			@endcan
	      </div>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-short">
	        <thead>
	        <tr>
			  <th>{{ trans('app.cover_image') }}</th>
	          <th>{{ trans('app.category_name') }}</th>
	          <th>{{ trans('app.parent') }}</th>
	          <th>{{ trans('app.products') }}</th>
	          <th>{{ trans('app.listings') }}</th>
	          <th>{{ trans('app.option') }}</th>
	        </tr>
	        </thead>
	        <tbody>
		        @foreach($categories as $category )
			        <tr>
			          	<td>
							<img src="{{ get_storage_file_url(optional($category->featuredImage)->path, 'mini') }}" class="img-sm" alt="{{ trans('app.image') }}">
			          	</td>
			          	<td>
			          		<h5>
			          			{{ $category->name }}
			          			@if($category->featured)
				          			<small class="label label-primary indent10">{{ trans('app.featured') }}</small>
			          			@endif
								@unless($category->active)
									<span class="label label-default indent5 small">{{ trans('app.inactive') }}</span>
								@endunless
			          		</h5>
			          		@if($category->description)
				          		<span class="excerpt-td small">
				          			{!! str_limit($category->description, 200) !!}
				          		</span>
				          	@endif
			          	</td>
				        <td>
				          	@if($category->subGroup->deleted_at)
					          	<i class="fa fa-trash-o small"></i>
				          	@endif
				        	{{ $category->subGroup->name }}
				        </td>
			          	<td><span class="label label-default">{{ $category->products_count }}</span></td>
			          	<td><span class="label label-warning">{{ $category->listings_count }}</span></td>
				        <td class="row-options">
							@can('update', $category)
		                	    <a href="#" data-link="{{ route('admin.catalog.category.edit', $category->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
	                	    @endcan
							@can('delete', $category)
			                    {!! Form::open(['route' => ['admin.catalog.category.trash', $category->id], 'method' => 'delete', 'class' => 'data-form']) !!}
			                        {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
							@endcan
						</td>
			        </tr>
		        @endforeach
	        </tbody>
	      </table>
	    </div>
	    <!-- /.box-body -->
	</div>
	<!-- /.box -->

	<div class="box collapsed-box">
	    <div class="box-header with-border">
	      <h3 class="box-title"><i class="fa fa-trash-o"></i> {{ trans('app.trash') }}</h3>
	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
	        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	      </div>
	    </div>
	    <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-option">
	        <thead>
	        <tr>
	          <th>{{ trans('app.category_name') }}</th>
	          <th>{{ trans('app.parent') }}</th>
	          <th>{{ trans('app.deleted_at') }}</th>
	          <th>{{ trans('app.option') }}</th>
	        </tr>
	        </thead>
	        <tbody>
		        @foreach($trashes as $trash )
			        <tr>
			          <td>
			          	<h5>{{ $trash->name }}</h5>
			          	@if($trash->description)
				          	<span class="excerpt-td small">{!! str_limit($trash->description, 150) !!}</span>
			          	@endif
			          </td>
				      <td>
				          	@if($trash->subGroup->deleted_at)
					          	<i class="fa fa-trash-o small"></i>
				          	@endif
					      	{{ $trash->subGroup->name }}
				      </td>
			          <td>{{ $trash->deleted_at->diffForHumans() }}</td>
			          <td class="row-options">
						@can('delete', $trash)
		                    <a href="{{ route('admin.catalog.category.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

		                    {!! Form::open(['route' => ['admin.catalog.category.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
		                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
							{!! Form::close() !!}
						@endcan
			          </td>
			        </tr>
		        @endforeach
	        </tbody>
	      </table>
	    </div>
	    <!-- /.box-body -->
	</div>
	<!-- /.box -->
@endsection