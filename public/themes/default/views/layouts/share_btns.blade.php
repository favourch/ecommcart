<div class="share">
	<span>
		<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'facebook'])" ><i class="fa fa-facebook"></i></a>

		<a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'twitter'])" ><i class="fa fa-twitter"></i></a>

		<a href="http://www.reddit.com/submit?{{http_build_query([
			'url' => Request::fullUrl(),
			'title' => $item->title,
		])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'reddit'])" ><i class="fa fa-reddit-alien"></i></a>

		<a href="https://pinterest.com/pin/create/button/?{{http_build_query([
            'url' => Request::fullUrl(),
            'media' => get_product_img_src($item, 'medium'),
            'description' => $item->title
        ])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'pinterest'])" ><i class="fa fa-pinterest"></i></a>

		<a href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'google+'])" ><i class="fa fa-google-plus"></i></a>

		<a href="http://www.linkedin.com/shareArticle?{{http_build_query([
			'url' => Request::fullUrl(),
			'title' => $item->title,
			'mini' => true
		])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'linkedin'])" ><i class="fa fa-linkedin"></i></a>

		<a href="http://www.tumblr.com/share?{{http_build_query([
			'u' => Request::fullUrl(),
			't' => $item->title,
            'v' => 3
		])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'tumblr'])" ><i class="fa fa-tumblr"></i></a>

		<a href="http://vk.com/share.php?{{http_build_query([
			'url' => Request::fullUrl(),
			'title' => $item->title,
            'image' => get_product_img_src($item, 'medium'),
			'noparse' => false
		])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'vk'])" ><i class="fa fa-vk"></i></a>

		<a href="http://www.digg.com/submit?{{http_build_query([
			'url' => Request::fullUrl(),
			'title' => $item->title
		])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'digg'])" ><i class="fa fa-digg"></i></a>

		<a href="http://www.viadeo.com/?{{http_build_query([
			'url' => Request::fullUrl(),
			'title' => $item->title,
            'image' => get_product_img_src($item, 'medium')
		])}}" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'viadeo'])" ><i class="fa fa-viadeo"></i></a>

		<a href="whatsapp://send?text={{rawurlencode($item->title ." | ". Request::fullUrl())}}" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'WhatsApp'])"><i class="fa fa-whatsapp"></i></a>

		<a href="mailto:?subject={{ $item->title }}&amp;body={{ Request::fullUrl() }}" data-toggle="tooltip" data-placement="top" title="@lang('theme.share_on',['name' => 'email'])"><i class="fa fa-envelope-o"></i></a>
	</span>
	<div class="addthis_native_toolbox"></div>

</div>