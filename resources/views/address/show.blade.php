@extends('admin.layouts.master')

@section('content')
	<div class="admin-user-widget">
	    <span class="admin-user-widget-img">
	        <img src="{{ get_storage_file_url(optional($addressable->image)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.avatar') }}">
	    </span>

	    <div class="admin-user-widget-content">
	        <span class="admin-user-widget-title">
	            {{ trans('app.'. $addressable_type) . ': ' . $addressable->name }}
	        </span>
	        <span class="admin-user-widget-text text-muted">
	            {{ trans('app.email') . ': ' . $addressable->email }}
	        </span>
	        @if($addressable->primaryAddress)
		        <span class="admin-user-widget-text text-muted">
		            {{ trans('app.phone') . ': ' . $addressable->primaryAddress->phone }}
		        </span>
		        <span class="admin-user-widget-text text-muted">
		            {{ trans('app.zip_code') . ': ' . $addressable->primaryAddress->zip_code }}
		        </span>
	        @endif
	        <a href="#" data-link="{{ route('admin.admin.' . $addressable_type . '.show', $addressable->id) }}" class="ajax-modal-btn small">{{ trans('app.view_detail') }}</a>

	        <span class="pull-right" style="margin-top: -60px;margin-right: 30px;font-size: 40px; color: rgba(0, 0, 0, 0.2);">
	            <i class="fa fa-check-square-o"></i>
	        </span>
	    </div>            <!-- /.admin-user-widget-content -->
	</div>          <!-- /.admin-user-widget -->

	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.addresses') }}</h3>
	      <div class="box-tools pull-right">
			<a href="#" data-link="{{ route('address.create', [$addressable_type, $addressable->id]) }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_address') }}</a>
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	    	@foreach($addresses as $address)
		        <div class="row">
			        <div class="col-md-6">
				        {!! $address->toHtml() !!}
				        <div class="pull-right">
				    		<a href="#" data-link="{{ route('address.edit', $address->id) }}" class="ajax-modal-btn">
				    			<i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i>
				    		</a>&nbsp;
				    		@unless($address->address_type == 'Primary')
								{!! Form::open(['route' => ['address.destroy', $address->id], 'method' => 'delete', 'class' => 'data-form', 'style' => 'display: inline;']) !!}
								    {!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
								{!! Form::close() !!}
					        @endunless
					        <span class="spacer10"></span>
				        </div>
			        </div>
			        <div class="col-md-6">
	            		@if(config('system_settings.address_show_map'))
		                    <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q={{ urlencode($address->toGeocodeString()) }}&output=embed"></iframe>
						@endif
			        </div>
		        </div>

	    		@unless($loop->last)
			        <hr/>
		        @endunless
	    	@endforeach
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection