@if($visitor->isBlocked())
	<a href="{{ route('admin.visitor.unban', $visitor) }}" class="confirm"><i class="fa fa-tree" data-toggle="tooltip" title="{{ trans('app.unblock_ip') }}"></i></a>
@else
	{!! Form::open(['route' => ['admin.visitor.ban', $visitor], 'method' => 'delete', 'class' => 'data-form']) !!}
		{!! Form::button('<i class="fa fa-ban"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.ban_ip'), 'data-toggle' => 'tooltip', 'data-placement' => 'left']) !!}
	{!! Form::close() !!}
@endif