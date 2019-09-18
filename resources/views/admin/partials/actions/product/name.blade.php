@if($product->featuredImage)
	<img src="{{ get_storage_file_url(optional($product->featuredImage)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.featured_image') }}">
@else
	<img src="{{ get_storage_file_url(optional($product->image)->path, 'tiny') }}" class="img-sm" alt="{{ trans('app.image') }}">
@endif
<p class="indent10">
	@can('view', $product)
		<a href="#" data-link="{{ route('admin.catalog.product.show', $product->id) }}" class="ajax-modal-btn">
			{{ $product->name }}
		</a>
	@else
		{{ $product->name }}
	@endcan

	@unless($product->active)
        <span class="label label-default indent10">{{ trans('app.inactive') }}</span>
    @endunless
</p>