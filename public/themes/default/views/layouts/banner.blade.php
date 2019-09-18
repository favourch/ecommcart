@php
	if(isset($banner['images'][0]['path']) && Storage::exists($banner['images'][0]['path']))
		$bg_img = asset('storage/' . $banner['images'][0]['path']);
	else
		$bg_img = '';
@endphp

<div class="col-md-{{ $banner['columns'] }}">
	<div class="banner banner-o-hid outline-effect animated zoomIn" style="background-color: {{ $banner['bg_color'] }}; background-image:url( {{ $bg_img }} );">
		<a class="banner-link" href="{{ $banner['link'] }}"></a>
		<div class="banner-caption">
			<h5 class="banner-title">{{ $banner['title'] }}</h5>
			<p class="banner-desc">{{ $banner['description'] }}</p>
			<p class="banner-link-btn">{!! $banner['link_label'] ? $banner['link_label'] . ' <i class="fa fa-caret-right"></i>' : '' !!}</p>
		</div>
	    @if(Storage::exists($banner['featured_image']['path']))
		    <img class="banner-img" src="{{ asset('storage/' . $banner['featured_image']['path']) }}" alt="{{ $banner['title'] or 'Banner Image' }}" title="{{ $banner['title'] or 'Banner Image' }}">
    	@endif
	</div>
</div>