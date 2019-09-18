<aside class="category-filters">
    @unless(Request::is('category/*'))
        <div class="category-filters-section">
            <h3>@lang('theme.category')</h3>
            <ul class="cateogry-filters-list">
                @foreach($categories as $slug => $category)
                    @if(Request::is('search'))
                        <li>
                            <a href="#" class="link-filter-opt" data-name="in" data-value="{{ $category->slug }}">{{ $category->name }}
                                {{-- <span class="small">({{ $category->listings_count }})</span> --}}
                            </a>
                        </li>
                    @else
                        <li><a href="{{ route('category.browse', $category->slug) }}">{{ $category->name }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endunless

    {{-- condition --}}
    <div class="category-filters-section">
        <h3>@lang('theme.condition')</h3>
        <div class="checkbox">
            <label>
                <input name="condition[New]" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('condition.New') ? 'checked' : '' }}> @lang('theme.new') <span class="small">({{ $products->where('condition', 'New')->count() }})</span>
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="condition[Used]" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('condition.Used') ? 'checked' : '' }}> @lang('theme.used') <span class="small">({{ $products->where('condition', 'Used')->count() }})</span>
            </label>
        </div>
        <div class="checkbox">
            <label>
                <input name="condition[Refurbished]" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('condition.Refurbished') ? 'checked' : '' }}> @lang('theme.refurbished') <span class="small">({{ $products->where('condition', 'Refurbished')->count() }})</span>
            </label>
        </div>
    </div>

    {{-- rating --}}
    @unless(Request::is('search*'))
        <div class="category-filters-section">
            <h3>@lang('theme.rating')
                @if(Request::has('rating'))
                    <a href="#" data-name="rating" class="clear-filter small text-lowercase pull-right">@lang('theme.button.clear')</a>
                @endif
            </h3>
            <ul class="cateogry-filters-list">
                @for ($i = 4; $i > 0; $i--)
                    <li>
                        <a href="#" data-name="rating" data-value="{{$i}}" class="link-filter-opt product-info-rating">
                            @for ($j = 0; $j < 5; $j++)
                                @if($j < $i)
                                    <span class="rated">&#9733;</span>
                                @else
                                    <span>&#9734;</span>
                                @endif
                            @endfor
                            <span class="small {{ Request::get('rating') == $i ? 'active' : '' }}">&amp; @lang('theme.up')</span>
                        </a>
                    </li>
                @endfor
            </ul>
        </div>
    @endunless

    {{-- price --}}
    <div class="category-filters-section">
        <h3>@lang('theme.price')
            @if(Request::has('price'))
                <a href="#" data-name="price" class="clear-filter small text-lowercase pull-right">@lang('theme.button.clear')</a>
            @endif
        </h3>
        <ul class="cateogry-filters-list space20">
            @foreach(generate_ranges($priceRange['min'], $priceRange['max'], 5) as $ranges)
                <li>
                    <a href="#" data-name="price" data-value="{{$ranges['lower'].'-'.$ranges['upper']}}" class="link-filter-opt {{ Request::get('price') == $ranges['lower'].'-'.$ranges['upper'] ? 'active' : '' }}">
                        @if($loop->first)
                            {{ trans('theme.price_under', ['value' => get_formated_currency($ranges['upper'])]) }}
                        @elseif($loop->last)
                            {{ trans('theme.price_above', ['value' => get_formated_currency($ranges['lower'])]) }}
                        @else
                            <span class="text-lowercase">
                                {{ get_formated_currency($ranges['lower']) . ' ' . trans('theme.to') . ' ' . get_formated_currency($ranges['upper']) }}
                            </span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
        <input type="text" id="price-slider" />
    </div>

    {{-- brand --}}
    <div class="category-filters-section">
        <h3>@lang('theme.brand')</h3>
        @foreach($brands as $brand)
            <div class="checkbox">
                <label>
                    <input name="brand[{{str_replace(' ', '%20', $brand)}}]" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('brand.'.$brand) ? 'checked' : '' }}> {{ $brand }}
                </label>
            </div>
        @endforeach
    </div>
</aside>