<section class="store-banner-img-wrapper">
	<div class="banner banner-o-hid" style="background-color: #333; background-image:url( {{ get_cover_img_src($shop, 'shop') }} );">
		<div class="banner-caption">
			<img src="{{ get_storage_file_url(optional($shop->logo)->path, 'mini') }}" class="img-rounded">
			<h5 class="banner-title">
                <a href="#" data-toggle="modal" data-target="#shopReviewsModal">{{ $shop->name }}</a>
			</h5>
            <span class="small">
	            @include('layouts.ratings', ['ratings' => $shop->feedbacks->avg('rating'), 'count' => $shop->feedbacks->count()])
	        </span>
			<p class="member-since small">{{ trans('theme.member_since') }}: {{ $shop->created_at->diffForHumans() }}</p>
		</div>
	</div>
</section>