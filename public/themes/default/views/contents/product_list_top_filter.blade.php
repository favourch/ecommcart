<div class="container filter-wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <span>
                @lang('theme.sort_by'):
                <select name="sort_by" class="selectBoxIt" id="filter_opt_sort">
                    <option value="best_match">@lang('theme.best_match')</option>
                    <option value="newest" {{ Request::get('sort_by') == 'newest' ? 'selected' : '' }}>@lang('theme.newest')</option>
                    <option value="oldest" {{ Request::get('sort_by') == 'oldest' ? 'selected' : '' }}>@lang('theme.oldest')</option>
                    <option value="price_acs" {{ Request::get('sort_by') == 'price_acs' ? 'selected' : '' }}>@lang('theme.price'): @lang('theme.low_to_high')</option>
                    <option value="price_desc" {{ Request::get('sort_by') == 'price_desc' ? 'selected' : '' }}>@lang('theme.price'): @lang('theme.high_to_low')</option>
                </select>
            </span>

            <div class="checkbox">
                <label>
                  <input name="free_shipping" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('free_shipping') ? 'checked' : '' }}> @lang('theme.free_shipping') <span class="small">({{ $products->where('free_shipping', 1)->count() }})</span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="has_offers" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('has_offers') ? 'checked' : '' }}/>
                    @lang('theme.has_offers')
                    <span class="small">({{ $products->where('offer_price', '>', 0)->where('offer_start', '<', \Carbon\Carbon::now())->where('offer_end', '>', \Carbon\Carbon::now())->count() }})</span>
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="new_arrivals" class="i-check filter_opt_checkbox" type="checkbox" {{ Request::has('new_arrivals') ? 'checked' : '' }}/>
                    @lang('theme.new_arrivals')
                    <span class="small">
                        ({{ $products->where('created_at', '>', \Carbon\Carbon::now()->subDays(config('system.filter.new_arraival', 7)))->count() }})
                    </span>
                </label>
            </div>

            <span class="pull-right text-muted">
              <a href="#" class="viewSwitcher btn btn-primary btn-sm flat">
                <i class="fa fa-th" data-toggle="tooltip" title="@lang('theme.grid_view')"></i>
              </a>
              <a href="#" class="viewSwitcher btn btn-default btn-sm flat">
                <i class="fa fa-list" data-toggle="tooltip" title="@lang('theme.list_view')"></i>
              </a>
            </span>
        </div>
    </div>
</div><!-- /.filter-wrapper -->

<div class="clearfix space20"></div>