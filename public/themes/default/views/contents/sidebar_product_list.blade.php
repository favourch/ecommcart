<ul class="sidebar-product-list">
    @foreach($products as $item)
        <li>
            <div class="product-widget">
                <div class="product-img-wrap">
                    <img class="product-img" src="{{ get_inventory_img_src($item, 'small') }}" data-name="product_image" alt="{{ $item->title }}" title="{{ $item->title }}" />
                    <!-- <img class="product-img" src="{{ get_storage_file_url(optional($item->image)->path, 'small') }}" data-name="product_image" alt="{{ $item->title }}" title="{{ $item->title }}" /> -->
                </div>
                <div class="product-info">
                    @include('layouts.ratings', ['ratings' => $item->feedbacks->avg('rating')])

                    <a href="{{ route('show.product', $item->slug) }}" class="product-info-title">{{ $item->title }}</a>

                    @include('layouts.pricing', ['item' => $item])
                </div>
            </div>
        </li>
    @endforeach
</ul>