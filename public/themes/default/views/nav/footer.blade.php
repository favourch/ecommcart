<!-- FOOTER -->
<div class="main-footer">
  <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-5">
      <div class="footer-subscribe-form">
        <h3>@lang('theme.subscription')</h3>
        {!! Form::open(['route' => 'newsletter.subscribe', 'class' => 'form-inline', 'id' => 'form', 'data-toggle' => 'validator']) !!}
          <div class="form-group">
            <input name="email" class="footer-subscribe-input" placeholder="@lang('theme.placeholder.email')" type="email" required>
            <button class="footer-subscribe-submit" type="submit">@lang('theme.button.subscribe')</button>
            <div class="help-block with-errors"></div>
          </div>
        {!! Form::close() !!}

        <p class="tips">@lang('theme.help.subscribe_to_newsletter')</p>
      </div>

      <div class="footer-social-networks">
        @if($social_media_links = get_social_media_links())
          <h3>@lang('theme.stay_connected')</h3>
          <ul class="footer-social-list">
            @foreach($social_media_links as $social_media => $link)
              <li><a class="fa fa-{{$social_media}}" href="{{$link}}" target="_blank"></a></li>
            @endforeach
          </ul>
        @endif
      </div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-2">
      <h3>@lang('theme.nav.let_us_help')</h3>
      <ul class="footer-link-list">
        <li><a href="{{ route('account', 'dashboard') }}" rel="nofollow">@lang('theme.nav.your_account')</a></li>
        <li><a href="{{ route('account', 'orders') }}" rel="nofollow">@lang('theme.nav.your_orders')</a></li>
        @foreach($pages->where('position', 'footer_1st_column') as $page)
          <li><a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">{{ $page->title }}</a></li>
        @endforeach
        <li><a href="{{ route('blog') }}" target="_blank">@lang('theme.nav.blog')</a></li>
      </ul>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-2">
      <h3>@lang('theme.nav.make_money')</h3>
      <ul class="footer-link-list">
        <li>
          <a class="navbar-item-mergin-top" href="{{ url('/selling') }}">{{ trans('theme.nav.sell_on', ['platform' => get_platform_title()]) }}</a>
        </li>
        <li><a href="{{ url('/selling#pricing') }}" rel="nofollow">@lang('theme.nav.become_merchant')</a></li>
        <li><a href="{{ url('/selling#howItWorks') }}" rel="nofollow">@lang('theme.nav.how_it_works')</a></li>
        @foreach($pages->where('position', 'footer_2nd_column') as $page)
          <li><a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">{{ $page->title }}</a></li>
        @endforeach
        <li><a href="{{ url('/selling#faqs') }}" rel="nofollow">@lang('theme.nav.faq')</a></li>
      </ul>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-2">
      <h3>@lang('theme.nav.customer_service')</h3>
      <ul class="footer-link-list">
        <li><a href="{{ route('account', 'disputes') }}" rel="nofollow">@lang('theme.nav.refunds_disputes')</a></li>
        <li><a href="{{ route('account', 'orders') }}" rel="nofollow">@lang('theme.nav.contact_seller')</a></li>
        @foreach($pages->where('position', 'footer_3rd_column') as $page)
          <li><a href="{{ get_page_url($page->slug) }}" rel="nofollow" target="_blank">{{ $page->title }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</div><!-- /.container -->

<!-- SECONDARY FOOTER -->
<footer class="user-helper-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div><!-- /.main-footer -->
</footer>