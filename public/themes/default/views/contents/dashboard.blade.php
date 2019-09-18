<div class="clearfix space30"></div>
<?php
//echo "<pre>"; print_r($dashboard); echo "</pre>"; //exit();
?>
<div class="row">
    <div class="col-sm-3 col-xs-6 ">
      <div class="info-box bg-gray">
        <span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
        <div class="info-box-content">
          <a href="{{ route('account', 'orders') }}" class="info-box-text">@lang('theme.all_orders')</a>
          <span class="info-box-number">{{ $dashboard->orders_count }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-sm-3 col-xs-6  ">
      <div class="info-box bg-gray">
        <span class="info-box-icon bg-red"><i class="fa fa-rocket"></i></span>
        <div class="info-box-content">
          <a href="{{ route('account', 'disputes') }}" class="info-box-text">@lang('theme.disputes')</a>
          <span class="info-box-number">{{ $dashboard->disputes_count }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-xs-block"></div>

    <div class="col-sm-3 col-xs-6  ">
      <div class="info-box bg-gray">
        <span class="info-box-icon bg-green"><i class="fa fa-heart-o"></i></span>
        <div class="info-box-content">
          <a href="{{ route('account', 'wishlist') }}" class="info-box-text">@lang('theme.wishlist')</a>
          <span class="info-box-number">{{ $dashboard->wishlists_count }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-sm-3 col-xs-6  ">
      <div class="info-box bg-gray">
        <span class="info-box-icon bg-yellow"><i class="fa fa-tags"></i></span>
        <div class="info-box-content">
          <a href="{{ route('account', 'coupons') }}" class="info-box-text">@lang('theme.coupons')</a>
          <span class="info-box-number">{{ $dashboard->coupons_count }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>