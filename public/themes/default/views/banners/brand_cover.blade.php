<section class="brand-banner-img-wrapper">
	<div class="banner banner-o-hid" style="background-color: #333; background-image:url( {{ get_cover_img_src($brand, 'brand') }} );">
		<div class="banner-caption">
			<img src="{{ get_storage_file_url(optional($brand->logo)->path, 'mini') }}" class="img-rounded">
			<h5 class="banner-title">{{ $brand->name }}</h5>
			<p class="banner-desc">{{ $brand->description }}</p>
		</div>
	</div>
</section>