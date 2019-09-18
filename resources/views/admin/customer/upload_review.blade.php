@extends('admin.layouts.master')

@section('content')
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans('app.preview') }}</h3>
			<div class="box-tools pull-right">
				@can('create', App\Customer::class)
					<a href="#" data-link="{{ route('admin.admin.customer.bulk') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
				@endcan
			</div>
		</div> <!-- /.box-header -->

		<div class="box-body">
		    <table class="table table-striped">
		        <thead>
					<tr>
						<th>{{ trans('app.image') }}</th>
						<th width="20%">{{ trans('app.name') }}</th>
						<th>{{ trans('app.email') }}</th>
						<th>{{ trans('app.description') }}</th>
						<th>{{ trans('app.sex') }}</th>
						<th>{{ trans('app.dob') }}</th>
						<th width="20%">{{ trans('app.addresses') }}</th>
						<th>{{ trans('app.accepts_marketing') }}</th>
						<th>{{ trans('app.active') }}</th>
					</tr>
		        </thead>
		        <tbody>
		        	@foreach($rows as $row)
		        		@continue( ! $row['email'] )

		        		<tr>
		        			<td><img src="{{ $row['avatar_link'] ?: get_placeholder_img('tiny') }}" class="img-sm"></td>
		        			<td>
		        				{{ $row['full_name'] }}<br/>
		        				<strong>{{ trans('app.nice_name') }}: </strong> {{ $row['nice_name'] }}
		        			</td>
		        			<td>{{ $row['email'] }}</td>
		        			<td>{{ $row['description'] }}</td>
		        			<td>{{ ucfirst($row['sex']) }}</td>
		        			<td>{{ $row['dob'] }}</td>
		        			<td>
	        					@if($row['primary_address_line_1'])
	        						<address>
	        							<strong>{{ trans('app.primary_address') }}:</strong><br/>
	        							{{ $row['primary_address_line_1'] }}<br/>
	        							{!! $row['primary_address_line_2'] ? $row['primary_address_line_2'] . '<br/>' : '' !!}
	        							{{ $row['primary_address_city'] . ' ' . $row['primary_address_zip_code'] }}<br/>
	        							{{ $row['primary_address_state_name'] }}<br/>
	        							{{ $row['primary_address_country_code'] }}<br/>
	        							@if($row['primary_address_phone'])
		        							<strong>{{ trans('app.phone') }}: </strong> {{ $row['primary_address_phone'] }}<br/>
										@endif
	        						</address>
	        					@endif
	        					@if($row['billing_address_line_1'])
	        						<address>
	        							<strong>{{ trans('app.billing_address') }}:</strong><br/>
	        							{{ $row['billing_address_line_1'] }}<br/>
	        							{!! $row['billing_address_line_2'] ? $row['billing_address_line_2'] . '<br/>' : '' !!}
	        							{{ $row['billing_address_city'] . ' ' . $row['billing_address_zip_code'] }}<br/>
	        							{{ $row['billing_address_state_name'] }}<br/>
	        							{{ $row['billing_address_country_code'] }}<br/>
	        							@if($row['billing_address_phone'])
		        							<strong>{{ trans('app.phone') }}: </strong> {{ $row['billing_address_phone'] }}<br/>
										@endif
	        						</address>
	        					@endif
	        					@if($row['shipping_address_line_1'])
	        						<address>
	        							<strong>{{ trans('app.shipping_address') }}:</strong><br/>
	        							{{ $row['shipping_address_line_1'] }}<br/>
	        							{!! $row['shipping_address_line_2'] ? $row['shipping_address_line_2'] . '<br/>' : '' !!}
	        							{{ $row['shipping_address_city'] . ' ' . $row['shipping_address_zip_code'] }}<br/>
	        							{{ $row['shipping_address_state_name'] }}<br/>
	        							{{ $row['shipping_address_country_code'] }}<br/>
	        							@if($row['shipping_address_phone'])
		        							<strong>{{ trans('app.phone') }}: </strong> {{ $row['shipping_address_phone'] }}<br/>
										@endif
	        						</address>
	        					@endif
		        			</td>
		        			<td class="text-center"><i class="fa fa-{{ $row['accepts_marketing'] == 'TRUE' ? 'check' : 'times' }} text-muted"></i></td>
		        			<td class="text-center"><i class="fa fa-{{ $row['active'] == 'TRUE' ? 'check' : 'times' }} text-muted"></i></td>
		        		</tr>
		        	@endforeach
		        </tbody>
		    </table>
		</div> <!-- /.box-body -->

		<div class="box-footer">
			<a href="{{ route('admin.admin.customer.index') }}" class="btn btn-default btn-flat">{{ trans('app.cancel') }}</a>
			<div class="box-tools pull-right">
				{!! Form::open(['route' => 'admin.admin.customer.import', 'id' => 'form', 'class' => 'inline-form', 'data-toggle' => 'validator']) !!}
		        	@foreach($rows as $row)
		        		@continue( ! $row['email'] )
						{{ Form::hidden('data[]', serialize($row)) }}
		        	@endforeach
					{!! Form::button(trans('app.looks_good'), ['type' => 'submit', 'class' => 'confirm btn btn-new btn-flat']) !!}
				{!! Form::close() !!}
			</div>
		</div> <!-- /.box-footer -->
	</div> <!-- /.box -->
@endsection