@if($customer->image)
	<img src="{{ get_storage_file_url(optional($customer->image)->path, 'tiny') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
@else
	<img src="{{ get_gravatar_url($customer->email, 'tiny') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
@endif
<p class="indent10">
	{{ $customer->nice_name }}
	@unless($customer->active)
        <span class="label label-default indent10">{{ trans('app.inactive') }}</span>
    @endunless
</p>