<div class="section-title">
    <h4>@lang('theme.manage_your_account')</h4>
</div>
<ul class="account-sidebar-nav">
    <li class="{{ $tab == 'dashboard' ? 'active' : '' }}">
    	<a href="{{ route('account', 'dashboard') }}"><i class="fa fa-dashboard"></i> @lang('theme.nav.dashboard')</a>
    </li>
    <li class="{{ $tab == 'orders' ? 'active' : '' }}">
    	<a href="{{ route('account', 'orders') }}"><i class="fa fa-shopping-cart"></i> @lang('theme.nav.my_orders')</a>
    </li>
    <li class="{{ $tab == 'wishlist' ? 'active' : '' }}">
    	<a href="{{ route('account', 'wishlist') }}"><i class="fa fa-heart-o"></i> @lang('theme.nav.my_wishlist')</a>
    </li>
    <li class="{{ $tab == 'disputes' ? 'active' : '' }}">
    	<a href="{{ route('account', 'disputes') }}"><i class="fa fa-rocket"></i> @lang('theme.nav.refunds_disputes')</a>
    </li>
    <li class="{{ $tab == 'coupons' ? 'active' : '' }}">
    	<a href="{{ route('account', 'coupons') }}"><i class="fa fa-tags"></i> @lang('theme.nav.my_coupons')</a>
    </li>
    {{--
    <li class="{{ $tab == 'gift_cards' ? 'active' : '' }}">
        <a href="{{ route('account', 'gift_cards') }}"><i class="fa fa-gift"></i> @lang('theme.nav.gift_cards')</a>
    </li> --}}
    <li class="{{ $tab == 'account' ? 'active' : '' }}">
    	<a href="{{ route('account', 'account') }}"><i class="fa fa-user"></i> @lang('theme.nav.my_account')</a>
    </li>
</ul>