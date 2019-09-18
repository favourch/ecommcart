<div class="product-info">
	@if($item->product->manufacturer->slug)
  	<a href="{{ route('show.brand', $item->product->manufacturer->slug) }}" class="product-info-seller-name">{{ $item->product->manufacturer->name }}</a>
	@else
    <a href="{{ route('show.store', $item->shop->slug) }}" class="product-info-seller-name">{{ $item->shop->name }}</a>
	@endif

	<h5 class="product-info-title space10" data-name="product_name">{{ $item->title }}</h5>

	@include('layouts.ratings', ['ratings' => $item->feedbacks->avg('rating'), 'count' => $item->feedbacks_count])

	@include('layouts.pricing', ['item' => $item])

	<div class="row">
  	<div class="col-sm-6 col-xs-12 nopadding-right">
      	<div class="product-info-availability space10">@lang('theme.availability'):
      		<span>{{ $item->stock_quantity > 0 ? trans('theme.in_stock') : trans('theme.out_of_stock') }}</span>
      	</div>
  	</div>
  	<div class="col-sm-6 col-xs-12 nopadding-left">
      	<div class="product-info-condition space10">

          @lang('theme.condition'): <span><b>{{ $item->condition }}</b></span>

          @if($item->condition_note)
            <sup><i class="fa fa-question" data-toggle="tooltip" title="{{ $item->condition_note }}" data-placement="top"></i></sup>
          @endif
      	</div>
  	</div>
	</div>

	<a href="{{ route('wishlist.add', $item->product) }}" class="btn btn-link">
		<i class="fa fa-heart-o"></i> @lang('theme.button.add_to_wishlist')
	</a>
</div><!-- /.product-info -->

@include('layouts.share_btns')
