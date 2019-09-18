@extends('admin.layouts.master')

@section('content')
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">{{ trans('app.blogs') }}</h3>
	      <div class="box-tools pull-right">
			@can('create', App\Blog::class)
				<a href="#" data-link="{{ route('admin.utility.blog.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_blog') }}</a>
			@endcan
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-no-sort">
	        <thead>
		        <tr>
		          <th>{{ trans('app.image') }}</th>
		          <th>{{ trans('app.blog_title') }}</th>
		          <th>{{ trans('app.author') }}</th>
		          <th><i class="fa fa-comments"></i></th>
		          <th>{{ trans('app.date') }}</th>
		          <th>&nbsp;</th>
		        </tr>
	        </thead>
	        <tbody>
		        @foreach($blogs as $blog )
			        <tr>
			          <td>
						<img src="{{ get_storage_file_url(optional($blog->image)->path, 'tiny') }}" class="img-sm" alt="{!! $blog->title !!}">
			          </td>
			          <td width="60%">
							@can('update', $blog)
			                    <a href="#" data-link="{{ route('admin.utility.blog.edit', $blog->id) }}"  class="ajax-modal-btn"><strong>{!! $blog->title !!}</strong></a>
							@else
					          	<strong>{!! $blog->title !!}</strong>
							@endcan
							<br/>
				          	<span class="excerpt-td">{!! $blog->excerpt !!}</span>
				          	@if(!$blog->status)
					          	<br/><span class="label label-default">{{ strtoupper(trans('app.draft')) }}</span>
					        @endif
			          </td>
			          <td>{{ $blog->author ? $blog->author->getName() : '' }}</td>
			          <td>{{ $blog->comments_count }}</td>
			          <td class="small">
			          	@if($blog->status)
				          	{{ trans('app.published_at') }}<br/>
				          	{{ optional($blog->published_at)->toFormattedDateString() }}
				        @else
				          	{{ trans('app.updated_at') }}<br/>
				          	{{ $blog->updated_at->toFormattedDateString() }}
				        @endif
				      </td>
			          <td class="row-options text-muted small">
							@can('update', $blog)
			                    <a href="#" data-link="{{ route('admin.utility.blog.edit', $blog->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
							@endcan
						@can('delete', $blog)
		                    {!! Form::open(['route' => ['admin.utility.blog.trash', $blog->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
	      <h3 class="box-title"><i class="fa fa-trash-o"></i>{{ trans('app.trash') }}</h3>
	      <div class="box-tools pull-right">
	        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
	        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-2nd-short">
	        <thead>
	        <tr>
	          <th>{{ trans('app.blog_title') }}</th>
	          <th>{{ trans('app.author') }}</th>
	          <th>{{ trans('app.deleted_at') }}</th>
	          <th>{{ trans('app.option') }}</th>
	        </tr>
	        </thead>
	        <tbody>
		        @foreach($trashes as $trash )
			        <tr>
			          <td width="65%">
				          	<strong>{!! $trash->title !!}</strong>
				          	<span class="excerpt-td">{!! $trash->excerpt !!}</span>
			          </td>
			          <td>{{ $trash->author->getName() }}</td>
			          <td>{{ $trash->deleted_at->diffForHumans() }}</td>
			          <td class="row-options small">
						@can('delete', $trash)
		                    <a href="{{ route('admin.utility.blog.restore', $trash->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.restore') }}" class="fa fa-database"></i></a>&nbsp;
		                    {!! Form::open(['route' => ['admin.utility.blog.destroy', $trash->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
