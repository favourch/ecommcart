@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.preview') }}</h3>
			<div class="box-tools pull-right">
				@can('create', App\Product::class)
					<a href="#" data-link="{{ route('admin.catalog.product.bulk') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->

		<div class="box-body">
		    <table class="table table-striped">
		        <thead>
					<tr>
						<th>{{ trans('app.image') }}</th>
						<th width="20%">{{ trans('app.name') }}</th>
						<th width="25%">{{ trans('app.description') }}</th>
						<th width="20%">{{ trans('app.listing') }}</th>
						<th>{{ trans('app.category') }}</th>
						<th>{{ trans('app.tags') }}</th>
						<th>{{ trans('app.has_variant') }}</th>
						<th>{{ trans('app.requires_shipping') }}</th>
						<th>{{ trans('app.active') }}</th>
					</tr>
		        </thead>
		        <tbody>
		        	@foreach($rows as $row)
		        		@continue( ! $row['name'] )

		        		<tr>
		        			<td><img src="{{ $row['image_link'] ?: get_placeholder_img('tiny') }}" class="img-sm"></td>
		        			<td>
		        				{{ $row['name'] }}<br/>
		        				<strong>{{ trans('app.slug') }}: </strong> {{ $row['slug'] ?: str_slug($row['name'], '-') }}
		        			</td>
		        			<td>{{ $row['description'] }}</td>
		        			<td>
		        				<dl>
		        					<dt>{{ trans('app.gtin') }}: </dt> <dd>{{ $row['gtin_type'] . ' ' . $row['gtin'] }}</dd>
		        					@if($row['mpn'])
			        					<dt>{{ trans('app.part_number') }}: </dt> <dd>{{ $row['mpn'] }}</dd>
									@endif
		        					@if($row['manufacturer'])
		        						<dt>{{ trans('app.manufacturer') }}: </dt> <dd>{{ $row['manufacturer'] }}</dd>
									@endif
		        					@if($row['brand'])
		        						<dt>{{ trans('app.brand') }}: </dt> <dd>{{ $row['brand'] }}</dd>
									@endif
		        					@if($row['model_number'])
		        						<dt>{{ trans('app.model_number') }}: </dt> <dd>{{ $row['model_number'] }}</dd>
									@endif
		        					@if($row['origin_country'])
		        						<dt>{{ trans('app.origin') }}: </dt> <dd>{{ $row['origin_country'] }}</dd>
									@endif
		        					@if($row['minimum_price'])
		        						<dt>{{ trans('app.min_price') }}: </dt> <dd>{{ get_formated_currency($row['minimum_price']) }}</dd>
									@endif
		        					@if($row['maximum_price'])
		        						<dt>{{ trans('app.max_price') }}: </dt> <dd>{{ get_formated_currency($row['maximum_price']) }}</dd>
									@endif
		        				</dl>
		        			</td>
		        			<td>{{ $row['categories'] }}</td>
		        			<td>{{ $row['tags'] }}</td>
		        			<td class="text-center"><i class="fa fa-{{ $row['has_variant'] == 'TRUE' ? 'check' : 'times' }} text-muted"></i></td>
		        			<td class="text-center"><i class="fa fa-{{ $row['requires_shipping'] == 'TRUE' ? 'check' : 'times' }} text-muted"></i></td>
		        			<td class="text-center"><i class="fa fa-{{ $row['active'] == 'TRUE' ? 'check' : 'times' }} text-muted"></i></td>
		        		</tr>
		        	@endforeach
		        </tbody>
		    </table>
		</div> <!-- /.box-body -->

		<div class="box-footer">
			<a href="{{ route('admin.catalog.product.index') }}" class="btn btn-default btn-flat">{{ trans('app.cancel') }}</a>
			<div class="box-tools pull-right">
				{!! Form::open(['route' => 'admin.catalog.product.import', 'id' => 'form', 'class' => 'inline-form', 'data-toggle' => 'validator']) !!}
		        	@foreach($rows as $row)
		        		@continue( ! $row['name'] )
						{{ Form::hidden('data[]', serialize($row)) }}
		        	@endforeach
					{!! Form::button(trans('app.looks_good'), ['type' => 'submit', 'class' => 'confirm btn btn-new btn-flat']) !!}
				{!! Form::close() !!}
			</div>
		</div> <!-- /.box-footer -->
	</div> <!-- /.box -->
@endsection