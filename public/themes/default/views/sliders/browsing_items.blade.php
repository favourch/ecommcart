@unless(empty($recently_viewed_items))
	<section class="bg-light">
	  <div class="container full-width">
	    <div class="section-title">
	      <h4 class="small">{!! trans('theme.section_headings.recently_viewed') !!}</h4>
	    </div>
	    <div class="section-content">

	      @include('sliders.carousel_thumbs_small', ['products' => $recently_viewed_items])

	    </div>
	  </div><!-- /.container -->
	</section>
@endunless