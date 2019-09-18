@extends('admin.layouts.master')

@section('content')
	<div class="alert alert-danger">
	    <strong><i class="icon fa fa-info-circle"></i>{{ trans('app.notice') }}</strong>
	    {{ trans('messages.import_ignored') }}
	</div>
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.import_failed') }}</h3>
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
						<th width="20%">{{ trans('app.reason') }}</th>
					</tr>
		        </thead>
		        <tbody>
		        	@foreach($failed_rows as $row)
		        		<tr>
		        			<td><img src="{{ $row['data']['image_link'] ?: get_placeholder_img('tiny') }}" class="img-sm"></td>
		        			<td>
		        				{{ $row['data']['name'] }}<br/>
		        				<strong>{{ trans('app.slug') }}: </strong> {{ $row['data']['slug'] ?: str_slug($row['data']['name'], '-') }}
		        			</td>
		        			<td>{{ $row['data']['description'] }}</td>
		        			<td>
		        				<dl>
		        					<dt>{{ trans('app.gtin') }}: </dt> <dd>{{ $row['data']['gtin_type'] . ' ' . $row['data']['gtin'] }}</dd>
		        					@if($row['data']['mpn'])
			        					<dt>{{ trans('app.part_number') }}: </dt> <dd>{{ $row['data']['mpn'] }}</dd>
									@endif
		        					@if($row['data']['manufacturer'])
		        						<dt>{{ trans('app.manufacturer') }}: </dt> <dd>{{ $row['data']['manufacturer'] }}</dd>
									@endif
		        					@if($row['data']['brand'])
		        						<dt>{{ trans('app.brand') }}: </dt> <dd>{{ $row['data']['brand'] }}</dd>
									@endif
		        					@if($row['data']['model_number'])
		        						<dt>{{ trans('app.model_number') }}: </dt> <dd>{{ $row['data']['model_number'] }}</dd>
									@endif
		        					@if($row['data']['origin_country'])
		        						<dt>{{ trans('app.origin') }}: </dt> <dd>{{ $row['data']['origin_country'] }}</dd>
									@endif
		        					@if($row['data']['minimum_price'])
		        						<dt>{{ trans('app.min_price') }}: </dt> <dd>{{ get_formated_currency($row['data']['minimum_price']) }}</dd>
									@endif
		        					@if($row['data']['maximum_price'])
		        						<dt>{{ trans('app.max_price') }}: </dt> <dd>{{ get_formated_currency($row['data']['maximum_price']) }}</dd>
									@endif
		        				</dl>
		        			</td>
		        			<td>{{ $row['data']['categories'] }}</td>
		        			<td><span class="label label-danger">{{ $row['reason'] }}</span></td>
		        		</tr>
		        	@endforeach
		        </tbody>
		    </table>
		</div> <!-- /.box-body -->
		<div class="box-footer">
			<a href="{{ route('admin.catalog.product.index') }}" class="btn btn-danger btn-flat">{{ trans('app.dismiss') }}</a>
			<div class="box-tools pull-right">
				{!! Form::open(['route' => 'admin.catalog.product.downloadFailedRows', 'id' => 'form', 'class' => 'inline-form', 'data-toggle' => 'validator']) !!}
		        	@foreach($failed_rows as $row)
		        		<input type="hidden" name="data[]" value="{{serialize($row['data'])}}">
		        	@endforeach
					{!! Form::button(trans('app.download_failed_rows'), ['type' => 'submit', 'class' => 'btn btn-new btn-flat']) !!}
				{!! Form::close() !!}
			</div>
		</div> <!-- /.box-footer -->
	</div> <!-- /.box -->
@endsection