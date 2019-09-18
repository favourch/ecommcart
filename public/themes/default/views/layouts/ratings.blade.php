<div class="product-info-rating">
	@if($ratings)
		@for($i = 0; $i < 5; $i++)
			@if( ($ratings - $i) >= 1 )
				<span class="rated"><i class="fa fa-star fa-fw"></i></span>
			@elseif( ($ratings - $i) < 1 && ($ratings - $i) > 0 )
				<span class="rated"><i class="fa fa-star-half-o fa-fw"></i></span>
			@else
				<span><i class="fa fa-star-o fa-fw"></i></span>
			@endif
		@endfor
	@endif

	@if(isset($count) && $count)
		@if(isset($item))
			<a href="{{ route('show.product', $item->slug) . '#reviews_tab' }}" class="product-info-rating-count">({{ get_formated_decimal($ratings,true,1) }}) {{ trans_choice('theme.reviews', $count, ['count' => $count]) }}</a>
		@else
			<a class="product-info-rating-count">({{ get_formated_decimal($ratings,true,1) }}) {{ trans_choice('theme.reviews', $count, ['count' => $count]) }}</a>
		@endif
	@endif
</div>