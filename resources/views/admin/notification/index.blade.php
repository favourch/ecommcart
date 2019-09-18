@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.notifications') }}</h3>
	      <div class="box-tools pull-right">
			{!! Form::open(['route' => ['admin.notifications.deleteAll'], 'method' => 'delete']) !!}
				{!! Form::button('<i class="fa fa-trash-o"></i> ' . trans('app.delete_all'), ['type' => 'submit', 'class' => 'confirm btn btn-flat btn-new']) !!}
			{!! Form::close() !!}
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
		    <div id="menu">
		      <div class="panel list-group">
                @forelse(Auth::user()->notifications as $notification)
	                <div class="list-group-item">
	                  @php
	                    $notification_view = 'admin.partials.notifications.' . snake_case(class_basename($notification->type));
	                  @endphp

	                  @include($notification_view)
	                  {{-- @includeFirst([$notification_view, 'admin.partials.notifications.default']) --}}

	                  <span class="pull-right text-muted">{{ $notification->created_at->diffForHumans() }}
							{!! Form::open(['route' => ['admin.notifications.delete', $notification->id], 'method' => 'delete', 'class' => 'data-form']) !!}
								{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent indent20', 'title' => trans('app.delete'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
							{!! Form::close() !!}
	                  </span>
	                </div>
             	@empty
             		<h5 class="text-center">{{ trans('app.no_data_found') }}</h5>
                @endforelse
	           </div>
           </div>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection