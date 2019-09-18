@if($wishlist->count() > 0)
    <div class="row product-list">
        @foreach($wishlist as $wish)
            <div class="col-md-12">
                <div class="product product-list-view">
                    <ul class="product-info-labels">
                        @if($wish->inventory->free_shipping == 1)
                            <li>@lang('theme.free_shipping')</li>
                        @endif
                        @if($wish->inventory->stuff_pick == 1)
                            <li>@lang('theme.stuff_pick')</li>
                        @endif
                        @if($wish->inventory->hasOffer())
                            <li>@lang('theme.percent_off', ['value' => get_percentage_of($wish->inventory->sale_price, $wish->inventory->offer_price)])</li>
                        @endif
                    </ul>

                    <div class="product-img-wrap">
                        <img class="product-img-primary" src="{{ get_product_img_src($wish->inventory, 'medium') }}" alt="{{ $wish->inventory->title }}" title="{{ $wish->inventory->title }}" />

                        <img class="product-img-alt" src="{{ get_product_img_src($wish->inventory, 'medium', 'alt') }}" alt="{{ $wish->inventory->title }}" title="{{ $wish->inventory->title }}" />

                        <a class="product-link" href="{{ route('show.product', $wish->inventory->slug) }}"></a>
                    </div>

                    <div class="product-actions">
                        <a class="btn btn-default flat itemQuickView" href="{{ route('quickView.product', $wish->inventory->slug) }}">
                            <i class="fa fa-external-link" data-toggle="tooltip" title="@lang('theme.button.quick_view')"></i>
                            <span>@lang('theme.button.quick_view')</span>
                        </a>

                        <a class="btn btn-primary flat" href="{{ route('direct.checkout', $wish->inventory->slug) }}">
                            <i class="fa fa-rocket"></i> @lang('theme.button.buy_now')
                        </a>

                        {!! Form::open(['route' => ['wishlist.remove', $wish], 'method' => 'delete', 'class' => 'data-form']) !!}
                            <button class="btn btn-link btn-block confirm" type="submit">
                                <i class="fa fa-trash-o" data-toggle="tooltip" title="@lang('theme.button.remove_from_wishlist')"></i>
                                <span>@lang('theme.button.remove')</span>
                            </button>
                        {!! Form::close() !!}
                    </div>

                    <div class="product-info">
                        @include('layouts.ratings', ['ratings' => $wish->inventory->feedbacks->avg('rating')])

                        <a href="{{ route('show.product', $wish->inventory->slug) }}" class="product-info-title">
                            {{ $wish->inventory->title }}
                        </a>

                        <div class="product-info-availability">
                            @lang('theme.availability'): <span>{{ ($wish->inventory->stock_quantity > 0) ? trans('theme.in_stock') : trans('theme.out_of_stock') }}</span>
                        </div>

                        @include('layouts.pricing', ['item' => $wish->inventory])

                        <div class="product-info-desc"> {{ $wish->inventory->description }} </div>
                        <ul class="product-info-feature-list">
                            <li>{{ $wish->inventory->condition }}</li>
                        </ul>
                    </div><!-- /.product-info -->
                </div><!-- /.product -->
            </div><!-- /.col-md-* -->
        @endforeach
    </div><!-- /.row .product-list -->
    <div class="sep"></div>
@else
  <div class="clearfix space50"></div>
  <p class="lead text-center space50">
    @lang('theme.empty_wishlist')
    <a href="{{ url('/') }}" class="btn btn-primary btn-sm flat">@lang('theme.button.shop_now')</a>
  </p>
@endif

<div class="row pagenav-wrapper">
    {{ $wishlist->links('layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->

<div class="clearfix space20"></div>