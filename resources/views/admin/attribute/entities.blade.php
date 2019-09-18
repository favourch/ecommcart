@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.attribute') . ': ' . $attribute->name . ' | ' . trans('app.type') . ': ' . $attribute->attributeType->type }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\AttributeValue::class)
				<a href="#" data-link="{{ route('admin.catalog.attributeValue.create', $attribute) }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_attribute_value') }} </a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-short" id="sortable" data-action="{{ Route('admin.catalog.attributeValue.reorder') }}">
	        <thead>
		        <tr>
			        <th width="7px">{{ trans('app.#') }}</th>
			        <th>{{ trans('app.position') }}</th>
			        <th>{{ trans('app.values') }}</th>
			        <th>{{ trans('app.color') }}</th>
			        <th>{{ trans('app.pattern') }}</th>
			        <th>{{ trans('app.option') }}</th>
		        </tr>
	        </thead>
	        <tbody>
		        @foreach($attributeValues as $attributeValue )
			        <tr id="{{ $attributeValue->id }}">
			        	<td>
							<i data-toggle="tooltip" data-placement="top" title="{{ trans('app.move') }}" class="fa fa-arrows sort-handler"></i>
			        	</td>
						<td><span class="order"> {{ $attributeValue->order }} </span></td>
						<td>{{ $attributeValue->value }}</td>
						<td>
							@if($attributeValue->color)
								<i class="fa fa-square" style="color: {{ $attributeValue->color }}"></i>
							  	{{ $attributeValue->color }}
							@endif
						</td>
						<td>
					 	  	@if($attributeValue->image)
								<img src="{{ get_storage_file_url($attributeValue->image->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
							@endif
						</td>
						<td class="row-options">
							@can('view', $attributeValue)
								<a href="#" data-link="{{ route('admin.catalog.attributeValue.show', ['id' => $attributeValue->id]) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.detail') }}" class="fa fa-expand"></i></a>&nbsp;
							@endcan
							@can('update', $attributeValue)
								<a href="#" data-link="{{ route('admin.catalog.attributeValue.edit', ['id' => $attributeValue->id]) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
							@endcan
							@can('delete', $attributeValue)
								{!! Form::open(['route' => ['admin.catalog.attributeValue.trash', $attributeValue->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
		          <th>{{ trans('app.values') }}</th>
		          <th>{{ trans('app.color') }}</th>
		          <th>{{ trans('app.deleted_at') }}</th>
		          <th>{{ trans('app.option') }}</th>
		        </tr>
	        </thead>
	        <tbody>
		        @foreach($trashes as $trash )
			        <tr>
			          <td>{{ $trash->value }}</td>
			          <td>
			          	@if($trash->color)
							<i class="fa fa-square" style="color: {{ $trash->color }}"></i>
				          	{{ $trash->color }}
			          	@endif
			          </td>
			          <td>{{ $trash->deleted_at->diffForHumans() }}</td>
			          <td class="row-options">
						@can('delete', $trash)
		                    <a href="{{ route('admin.catalog.attributeValue.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

		                    {!! Form::open(['route' => ['admin.catalog.attributeValue.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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

@section('page-script')
	@include('plugins.drag-n-drop')
@endsection