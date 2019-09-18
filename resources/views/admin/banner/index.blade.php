@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.banners') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Banner::class)
				<a href="#" data-link="{{ route('admin.appearance.banner.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_banner') }}</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
		    <table class="table table-hover table-no-sort">
		        <thead>
			        <tr>
			          <th>{{ trans('app.detail') }}</th>
			          <th>{{ trans('app.banner_image') }}</th>
			          <th>{{ trans('app.background') }}</th>
			          <th>{{ trans('app.options') }}</th>
			          <th>{{ trans('app.created_at') }}</th>
			          <th>&nbsp;</th>
			        </tr>
		        </thead>
		        <tbody>
			        @foreach($banners as $banner )
				        <tr>
				          	<td>
					          	<strong>{!! $banner->title !!} </strong>
					          	@unless($banner->group)
						          	<span class="label label-default indent10">{{ strtoupper(trans('app.draft')) }}</span>
					          	@endunless
								<br/>
					          	<span class="small">{!! $banner->description !!}</span>
				          	</td>
					        <td>
								<img src="{{ get_storage_file_url(optional($banner->featuredImage)->path, 'small') }}" class="thumbnail" alt="{{ trans('app.banner_image') }}">
					        </td>
					        <td>
				 	  			@if($banner->hasImages())
									<img src="{{ get_storage_file_url(optional($banner->images->first())->path, 'small') }}" class="thumbnail" width="100%" alt="{{ trans('app.image') }}">
								@elseif($banner->bg_color)
									<div class="" style="padding: 20px 5px; background-color: {{ $banner->bg_color }};">
										<h4 class="text-center" style="color: #d3d3d3; font-weight: lighter;">{{ strtoupper($banner->bg_color) }}</h4>
									</div>
								@endif
				          	</td>
				          	<td>
					          	{{ trans('app.group') . ': ' }}
					          	<strong>
						          	@if($banner->group)
						          		{!! $banner->group->name !!}
									@else
						          		{!! trans('app.unspecified') !!}
									@endif
					          	</strong>
								<br/>
					          	{{ trans('app.columns') . ': ' }}<strong>{!! $banner->columns !!}</strong>
								<br/>
					          	{{ trans('app.order') . ': ' }}<strong>{!! $banner->order !!}</strong>
								<br/>
					          	{{ trans('app.link_label') . ': ' }}<strong>{!! $banner->link_label !!}</strong>
								<br/>
					          	{{ trans('app.link') . ': ' }}<strong>{!! $banner->link !!}</strong>
				          	</td>
				          	<td>
					          	{{ $banner->created_at->toFormattedDateString() }}
				          	</td>
				          	<td class="row-options text-muted small">
								@can('update', $banner)
				                    <a href="#" data-link="{{ route('admin.appearance.banner.edit', $banner->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								@endcan
								@can('delete', $banner)
				                    {!! Form::open(['route' => ['admin.appearance.banner.destroy', $banner->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
@endsection