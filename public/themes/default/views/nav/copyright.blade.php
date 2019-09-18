<div class="copyright-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
              <ul class="links-list">
                @foreach($pages->where('position', 'copyright_area') as $page)
                  <li><a href="{{ get_page_url($page->slug) }}" target="_blank">{{ $page->title }}</a></li>
                @endforeach
                <li><a href="{{ url('admin/dashboard') }}">@lang('theme.nav.merchant_dashboard')</a></li>
              </ul>
            </div>
            <div class="col-md-4">
                <p class="copyright-text">© {{ date('Y') }} <a href="{{ url('/') }}">{{ get_platform_title() }}</a></p>
            </div>
        </div>
    </div>
</div><!-- /.copyright-area -->