@extends('admin.layouts.master')

@section('content')
	<div class="row">
	  	<div class="col-md-3 nopadding-right">
			<div class="box">
			    <div class="box-header with-border">
			      	<h3 class="box-title">{{ trans('app.topics') }}</h3>
					<div class="box-tools pull-right">
						@can('create', App\Faq::class)
							<a href="#" data-link="{{ route('admin.utility.faqTopic.create') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.add_topic') }}</a>
						@endcan
					</div>
			    </div> <!-- /.box-header -->
			    <div class="box-body">
			      	<table class="table">
						<tbody>
						    @foreach($topics as $topic )
						        <tr>
						        	<td>{{ $topic->name }}</td>
						        	<td class="small">{{ $topic->for }}</td>
									<td class="row-options text-muted small">
										@can('create', App\Faq::class)
											<a href="#" data-link="{{ route('admin.utility.faqTopic.edit', $topic->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
											{!! Form::open(['route' => ['admin.utility.faqTopic.destroy', $topic->id], 'method' => 'delete', 'class' => 'data-form']) !!}
												{!! Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.trash'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
											{!! Form::close() !!}
										@endcan
									</td>
						        </tr>
						    @endforeach
						</tbody>
			    	</table>
				</div>
			</div>
		</div>

	  	<div class="col-md-9">
			<div class="box">
			    <div class="box-header with-border">
			      <h3 class="box-title">{{ trans('app.faqs') }}</h3>
			      <div class="box-tools pull-right">
					@can('create', App\Faq::class)
						<a href="#" data-link="{{ route('admin.utility.faq.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_faq') }}</a>
					@endcan
			      </div>
			    </div> <!-- /.box-header -->
			    <div class="box-body">
			      <table class="table table-hover table-2nd-short">
			        <thead>
				        <tr>
				          <th>{{ trans('app.detail') }}</th>
				          <th>{{ trans('app.topic') }}</th>
				          <th>{{ trans('app.updated_at') }}</th>
				          <th>&nbsp;</th>
				        </tr>
			        </thead>
			        <tbody>
				        @foreach($faqs as $faq )
					        <tr>
					          <td width="60%">
									@can('update', $faq)
					                    <a href="#" data-link="{{ route('admin.utility.faq.edit', $faq->id) }}"  class="ajax-modal-btn"><strong>{!! $faq->question !!}</strong></a>
									@else
							          	<strong>{!! $faq->question !!}</strong>
									@endcan
									<br/>
						          	<span class="excerpt-td">{!! $faq->answer !!}</span>
					          </td>
					          <td>
					          	{{ $faq->topic->name }}
						        <br/><span class="label label-default">{{ strtoupper($faq->topic->for) }}</span>
					          </td>
					          <td class="small">
					          	{{ $faq->updated_at->toFormattedDateString() }}
						      </td>
					          <td class="row-options text-muted small">
								@can('update', $faq)
				                    <a href="#" data-link="{{ route('admin.utility.faq.edit', $faq->id) }}"  class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>&nbsp;
								@endcan
								@can('delete', $faq)
				                    {!! Form::open(['route' => ['admin.utility.faq.destroy', $faq->id], 'method' => 'delete', 'class' => 'data-form']) !!}
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
		</div>
	</div>
@endsection
