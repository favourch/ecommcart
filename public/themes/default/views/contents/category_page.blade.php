<section>
  <div class="container full-width">
      <div class="row">
        @if($products->count())

          <div class="col-md-2 bg-light">

            @include('contents.product_list_sidebar_filters')

          </div><!-- /.col-md-2 -->
          <div class="col-md-10" style="padding-left: 15px;">

            @include('contents.product_list')

          </div><!-- /.col-md-10 -->

        @else

          <div class="clearfix space50"></div>
          <p class="lead text-center space50">
            <span class="space50">@lang('theme.no_product_found')</span><br/>
            <div class="space50 text-center">
              <a href="{{ url('categories') }}" class="btn btn-primary btn-sm flat">@lang('theme.button.shop_from_other_categories')</a>
            </div>
          </p>
          <div class="clearfix space50"></div>

        @endif
      </div><!-- /.row -->
  </div><!-- /.container -->
</section>