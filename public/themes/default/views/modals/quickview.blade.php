<div class="modal-dialog modal-xl" role="document">
    <div class="modal-content flat">
        <a class="close" data-dismiss="modal" aria-hidden="true">&times;</a>
        <div class="row sc-product-item">
            <div class="col-md-5 col-sm-6">
                @include('layouts.jqzoom', ['item' => $item])
            </div>
            <div class="col-md-7 col-sm-6">
                <div class="product-single">
                    @include('layouts.product_info', ['item' => $item])

                    <div class="sep"></div>

                    <div class="row product-attribute">
                        <div class="col-sm-6 col-xs-12">
                            <div class="product-info-options">
                                @foreach($item->attributeValues as $attribute_value)
                                    <div class="row">
                                        <div class="col-sm-3 col-xs-4">
                                            <span class="info-label">{{ $attribute_value->attribute->name }}:</span>
                                        </div>
                                        <div class="col-sm-9 col-xs-8 nopadding-left">
                                            {{ $attribute_value->value }}
                                        </div><!-- /.col-sm-9 .col-xs-6 -->
                                    </div><!-- /.row -->
                                @endforeach
                            </div><!-- /.product-option -->

                            <div class="clearfix space50"></div>

                            <a href="{{ route('show.product', $item->slug) }}" class="btn btn-info btn-block flat space10">
                                @lang('theme.button.view_product_details')
                            </a>
                        </div>
                        <div class="col-sm-6 col-xs-12 nopadding-left">
                            <div class="section-title space10">
                              {!! trans('theme.section_headings.key_features') !!}
                            </div>
                            <ul class="key_feature_list">
                                @foreach(unserialize($item->key_features) as $key_feature)
                                    <li>{{ $key_feature }}</li>
                                @endforeach
                            </ul>
                        </div><!-- /.col-sm-9 .col-xs-6 -->
                    </div><!-- /.row -->

                    <div class="sep"></div>

                    <a href="{{ route('cart.addItem', $item->slug) }}" class="btn btn-primary flat sc-add-to-cart" data-dismiss="modal">
                        <i class="fa fa-shopping-bag"></i> @lang('theme.button.add_to_cart')
                    </a>

                    <a href="{{ route('direct.checkout', $item->slug) }}" class="btn btn-warning flat" id="buy-now-btn"><i class="fa fa-rocket"></i>
                        @lang('theme.button.buy_now')
                    </a>

                    @if($item->product->inventories_count > 1)
                        <a href="{{ route('show.offers', $item->product->slug) }}" class="btn btn-sm btn-link">
                            @lang('theme.view_more_offers', ['count' => $item->product->inventories_count])
                        </a>
                    @endif
                </div><!-- /.product-single -->

                <div class="space50"></div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->