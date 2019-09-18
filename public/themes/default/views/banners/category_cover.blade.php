<section class="category-banner-img-wrapper">
	<div class="banner banner-o-hid" style="background-color: #333; background-image:url( {{ get_cover_img_src($category, 'category') }} );">
		<div class="banner-caption">
			<h5 class="banner-title">{{ $category->name }}</h5>
			<p class="banner-desc">{{ $category->description }}</p>
		</div>
	</div>
</section>