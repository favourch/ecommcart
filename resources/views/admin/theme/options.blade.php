@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.theme_options') }}</h3>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	    	<table class="table table-stripe">
	    		<thead>
	    			<tr>
	    				<th>@lang('app.options')</th>
	    				<th>@lang('app.values')</th>
	    				<th>&nbsp;</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<tr>
	    				<th>@lang('app.featured_categories')</th>
	    				<td>
	    					@foreach($featured_categories as $category)
			    				<span class="label label-outline">{{ $category }}</span>
	    					@endforeach
	    				</td>
	    				<td>
	    					<a href="#" data-link="{{ route('admin.appearance.featuredCategories') }}" class="ajax-modal-btn btn btn-sm btn-default flat"><i class="fa fa-edit"></i> @lang('app.edit')</a>
	    				</td>
	    			</tr>
	    		</tbody>
	    	</table>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection