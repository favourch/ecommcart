@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.attributes') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\AttributeValue::class)
				<a href="#" data-link="{{ route('admin.catalog.attributeValue.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_attribute_value') }} </a>
			@endcan
			@can('create', App\Attribute::class)
				<a href="#" data-link="{{ route('admin.catalog.attribute.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_attribute') }} </a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-short" id="sortable" data-action="{{ Route('admin.catalog.attribute.reorder') }}">
	        <thead>
		        <tr>
			        <th width="7px">{{ trans('app.#') }}</th>
					<th>{{ trans('app.position') }}</th>
					<th>{{ trans('app.name') }}</th>
					<th>{{ trans('app.type') }}</th>
					<th>{{ trans('app.entities') }}</th>
					<th>{{ trans('app.option') }}</th>
		        </tr>
	        </thead>
	        <tbody>
		        @foreach($attributes as $attribute )
			        <tr id="{{ $attribute->id }}">
				        <td>
							<i data-toggle="tooltip" data-placement="top" title="{{ trans('app.move') }}" class="fa fa-arrows sort-handler"> </i>
				        </td>
						<td><span class="order">{{ $attribute->order }}</span></td>
						<td>
							@can('view', $attribute)
								<a href="{{ route('admin.catalog.attribute.entities', $attribute->id) }}">{{ $attribute->name }}</a>
							@else
								{{ $attribute->name }}
							@endcan
						</td>
						<td>{{ $attribute->attributeType->type }}</td>
						<td>
							<span class="label label-default">{{ $attribute->attribute_values_count }}</span>
						</td>
						<td class="row-options">
							@can('view', $attribute)
								<a href="{{ route('admin.catalog.attribute.entities', $attribute->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.entities') }}" class="fa fa-expand"></i></a>&nbsp;
							@endcan
							@can('update', $attribute)
								<a href="#" data-link="{{ route('admin.catalog.attribute.edit', $attribute->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
							@endcan
							@can('delete', $attribute)
								{!! Form::open(['route' => ['admin.catalog.attribute.trash', $attribute->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
	          <th>{{ trans('app.name') }}</th>
  			  <th>{{ trans('app.type') }}</th>
	          <th>{{ trans('app.deleted_at') }}</th>
	          <th>{{ trans('app.option') }}</th>
	        </tr>
	        </thead>
	        <tbody>
		        @foreach($trashes as $trash )
			        <tr>
			          <td>{{ $trash->name }}</td>
					  <td>{{ $trash->attributeType->type }}</td>
			          <td>{{ $trash->deleted_at->diffForHumans() }}</td>
			          <td class="row-options">
						@can('delete', $trash)
		                    <a href="{{ route('admin.catalog.attribute.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;

		                    {!! Form::open(['route' => ['admin.catalog.attribute.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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