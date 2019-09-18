<div class="owl-carousel big-carousel carousel-img-only">
    @foreach($products as $item)
        <div class="product-widget">
            <img class="product-img" src="{{ get_inventory_img_src($item, 'medium') }}" data-name="product_image" alt="{{ $item->title }}" title="{{ $item->title }}" />
            <!-- <img class="product-img" src="{{ get_storage_file_url(optional($item->image)->path, 'medium') }}" data-name="product_image" alt="{{ $item->title }}" title="{{ $item->title }}" /> -->
            <a class="product-link itemQuickView" href="{{ route('quickView.product', $item->slug) }}"></a>
        </div>
    @endforeach
</div>