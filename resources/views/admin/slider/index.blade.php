@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.sliders') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Slider::class)
				<a href="#" data-link="{{ route('admin.appearance.slider.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_slider') }}</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
		    <table class="table table-hover table-no-sort">
		        <thead>
			        <tr>
			          <th>{{ trans('app.detail') }}</th>
			          <th>{{ trans('app.slider') }}</th>
			          <th>{{ trans('app.options') }}</th>
			          <th>{{ trans('app.created_at') }}</th>
			          <th>&nbsp;</th>
			        </tr>
		        </thead>
		        <tbody>
			        @foreach($sliders as $slider )
				        <tr>
				          	<td>
								<img src="{{ get_storage_file_url(optional($slider->images->first())->path, 'slider_thumb') }}" class="" height ="50%" alt="{{ trans('app.image') }}">
								<p class="indent10">
						          	<strong style="color: {{ $slider->title_color }}">{!! $slider->title !!} </strong>
									<br/>
						          	<small style="color: {{ $slider->sub_title_color }}">{!! $slider->sub_title !!}</small>
								</p>
				          	</td>
					        <td>
								<img src="{{ get_storage_file_url(optional($slider->featuredImage)->path, 'slider_thumb') }}" class="thumbnail" alt="{{ trans('app.slider_image') }}">
					        </td>
				          	<td>
					          	{{ trans('app.title_color') . ': ' }}<strong>{!! $slider->title_color !!}</strong>
								<br/>
					          	{{ trans('app.sub_title_color') . ': ' }}<strong>{!! $slider->sub_title_color !!}</strong>
								<br/>
					          	{{ trans('app.order') . ': ' }}<strong>{!! $slider->order !!}</strong>
								<br/>
					          	{{ trans('app.link') . ': ' }}<strong>{!! $slider->link !!}</strong>
				          	</td>
				          	<td>
					          	{{ $slider->created_at->toFormattedDateString() }}
				          	</td>
				          	<td class="row-options text-muted small">
								@can('update', $slider)
				                    <a href="#" data-link="{{ route('admin.appearance.slider.edit', $slider->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								@endcan
								@can('delete', $slider)
				                    {!! Form::open(['route' => ['admin.appearance.slider.destroy', $slider->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
