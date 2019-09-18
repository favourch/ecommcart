<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
      <ul class="sidebar-menu">
        <li class=" {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
          <a href="{{ url('admin/dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>{{ trans('nav.dashboard') }}</span>
          </a>
        </li>
        @if(Gate::allows('index', \App\Category::class) || Gate::allows('index', \App\Attribute::class) || Gate::allows('index', \App\Product::class) || Gate::allows('index', \App\Manufacturer::class) || Gate::allows('index', \App\CategoryGroup::class) || Gate::allows('index', \App\CategorySubGroup::class))
          <li class="treeview {{ Request::is('admin/catalog*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-tags"></i>
              <span>{{ trans('nav.catalog') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @if(Gate::allows('index', \App\Category::class) || Gate::allows('index', \App\CategoryGroup::class) || Gate::allows('index', \App\CategorySubGroup::class))
                <li class="{{ Request::is('admin/catalog/category*') ? 'active' : '' }}">
                  <a href="#">
                    <i class="fa fa-angle-double-right"></i>
                    {{ trans('nav.categories') }}
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    @can('index', \App\CategoryGroup::class)
                      <li class="{{ Request::is('admin/catalog/categoryGroup*') ? 'active' : '' }}">
                        <a href="{{ route('admin.catalog.categoryGroup.index') }}">
                          <i class="fa fa-angle-right"></i>{{ trans('nav.groups') }}
                        </a>
                      </li>
                    @endcan

                    @can('index', \App\CategorySubGroup::class)
                      <li class="{{ Request::is('admin/catalog/categorySubGroup*') ? 'active' : '' }}">
                        <a href="{{ route('admin.catalog.categorySubGroup.index') }}">
                          <i class="fa fa-angle-right"></i>{{ trans('nav.sub-groups') }}
                        </a>
                      </li>
                    @endcan

                    @can('index', \App\Category::class)
                      <li class="{{ Request::is('admin/catalog/category') ? 'active' : '' }}">
                        <a href="{{ url('admin/catalog/category') }}">
                          <i class="fa fa-angle-right"></i>{{ trans('nav.categories') }}
                        </a>
                      </li>
                    @endcan
                  </ul>
                </li>
              @endif

              @can('index', \App\Attribute::class)
                <li class=" {{ Request::is('admin/catalog/attribute*') ? 'active' : '' }}">
                  <a href="{{ url('admin/catalog/attribute') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.attributes') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Product::class)
                <li class=" {{ Request::is('admin/catalog/product*') ? 'active' : '' }}">
                  <a href="{{ url('admin/catalog/product') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.products') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Manufacturer::class)
                <li class=" {{ Request::is('admin/catalog/manufacturer*') ? 'active' : '' }}">
                  <a href="{{ url('admin/catalog/manufacturer') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.manufacturers') }}
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        @if(Gate::allows('index', \App\Inventory::class) || Gate::allows('index', \App\Warehouse::class) || Gate::allows('index', \App\Supplier::class))
          <li class="treeview {{ Request::is('admin/stock*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-cubes"></i>
              <span>{{ trans('nav.stock') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\Inventory::class)
                <li class=" {{ Request::is('admin/stock/inventory*') ? 'active' : '' }}">
                  <a href="{{ url('admin/stock/inventory') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.inventories') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Warehouse::class)
                <li class=" {{ Request::is('admin/stock/warehouse*') ? 'active' : '' }}">
                  <a href="{{ url('admin/stock/warehouse') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.warehouses') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Supplier::class)
                <li class=" {{ Request::is('admin/stock/supplier*') ? 'active' : '' }}">
                  <a href="{{ url('admin/stock/supplier') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.suppliers') }}
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        @if(Gate::allows('index', \App\Order::class) || Gate::allows('index', \App\Cart::class))
          <li class="treeview {{ Request::is('admin/order*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-cart-plus"></i>
              <span>{{ trans('nav.orders') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\Order::class)
                <li class=" {{ Request::is('admin/order/order*') ? 'active' : '' }}">
                  <a href="{{ url('admin/order/order') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.orders') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Cart::class)
                <li class=" {{ Request::is('admin/order/cart*') ? 'active' : '' }}">
                  <a href="{{ url('admin/order/cart') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.carts') }}
                  </a>
                </li>
              @endcan

              {{-- @can('index', \App\Payment::class) --}}
                {{-- <li class=" {{ Request::is('admin/order/payment*') ? 'active' : '' }}">
                  <a href="{{ url('admin/order/payments') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.payments') }}
                  </a>
                </li> --}}
              {{-- @endcan --}}
            </ul>
          </li>
        @endif

        @if(Gate::allows('index', \App\User::class) || Gate::allows('index', \App\Customer::class))
          <li class="treeview {{ Request::is('admin/admin*') || Request::is('address/addresses/customer*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-user-secret"></i>
              <span>{{ trans('nav.admin') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\User::class)
                <li class=" {{ Request::is('admin/admin/user*') ? 'active' : '' }}">
                  <a href="{{ url('admin/admin/user') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.users') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Customer::class)
                <li class=" {{ Request::is('admin/admin/customer*') || Request::is('address/addresses/customer*') ? 'active' : '' }}">
                  <a href="{{ url('admin/admin/customer') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.customers') }}
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        @if(Gate::allows('index', \App\Merchant::class) || Gate::allows('index', \App\Shop::class))
          <li class="treeview {{ Request::is('admin/vendor*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-map-marker"></i>
              <span>{{ trans('nav.vendors') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\Shop::class)
                <li class=" {{ Request::is('admin/vendor/merchant*') ? 'active' : '' }}">
                  <a href="{{ url('admin/vendor/merchant') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.merchants') }}
                  </a>
                </li>
              @endcan
              @can('index', \App\Shop::class)
                <li class=" {{ Request::is('admin/vendor/shop*') ? 'active' : '' }}">
                  <a href="{{ url('admin/vendor/shop') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.shops') }}
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        @if(Gate::allows('index', \App\Carrier::class) || Gate::allows('index', \App\Packaging::class))
          <li class="treeview {{ Request::is('admin/shipping*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-truck"></i>
              <span>{{ trans('nav.shipping') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\Carrier::class)
                <li class=" {{ Request::is('admin/shipping/carrier*') ? 'active' : '' }}">
                  <a href="{{ url('admin/shipping/carrier') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.carriers') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Packaging::class)
                <li class=" {{ Request::is('admin/shipping/packaging*') ? 'active' : '' }}">
                  <a href="{{ url('admin/shipping/packaging') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.packaging') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\ShippingZone::class)
                <li class=" {{ Request::is('admin/shipping/shippingZone*') ? 'active' : '' }}">
                  <a href="{{ url('admin/shipping/shippingZone') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.shipping_zones') }}
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        {{-- temporarily hidden from super admin --}}
        @if(!Auth::user()->isSuperAdmin())
        @if(Gate::allows('index', \App\Coupon::class) || Gate::allows('index', \App\GiftCard::class))
          <li class="treeview {{ Request::is('admin/promotion*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-paper-plane"></i>
              <span>{{ trans('nav.promotions') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\Coupon::class)
                <li class=" {{ Request::is('admin/promotion/coupon*') ? 'active' : '' }}">
                  <a href="{{ url('admin/promotion/coupon') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.coupons') }}
                  </a>
                </li>
              @endcan
              {{-- @can('index', \App\GiftCard::class)
                <li class=" {{ Request::is('admin/promotion/giftCard*') ? 'active' : '' }}">
                  <a href="{{ url('admin/promotion/giftCard') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.gift_cards') }}
                  </a>
                </li>
              @endcan --}}
            </ul>
          </li>
        @endif
        @endif

        @if(Gate::allows('index', \App\OrderStatus::class) || Gate::allows('index', \App\Currency::class))
          <li class="treeview {{ Request::is('admin/utility*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-asterisk"></i>
              <span>{{ trans('nav.utilities') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\Currency::class)
                <li class=" {{ Request::is('admin/utility/currency*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/currency') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.currencies') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\OrderStatus::class)
                <li class=" {{ Request::is('admin/utility/orderStatus*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/orderStatus') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.order_statuses') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Page::class)
                <li class=" {{ Request::is('admin/utility/page*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/page') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.pages') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Blog::class)
                <li class=" {{ Request::is('admin/utility/blog*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/blog') }}">
                    <i class="fa fa-angle-double-right"></i> <span>{{ trans('nav.blogs') }}</span>
                  </a>
                </li>
              @endcan

              @can('index', \App\Faq::class)
                <li class=" {{ Request::is('admin/utility/faq*') ? 'active' : '' }}">
                  <a href="{{ url('admin/utility/faq') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.faqs') }}
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        @if(Gate::allows('index', \App\Message::class) || Gate::allows('index', \App\Ticket::class) || Gate::allows('index', \App\Dispute::class) || Gate::allows('index', \App\Refund::class))
          <li class="treeview {{ Request::is('admin/support*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-support"></i>
              <span>{{ trans('nav.support') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @can('index', \App\Message::class)
                <li class=" {{ Request::is('admin/support/message*') ? 'active' : '' }}">
                  <a href="{{ url('admin/support/message/labelOf/'. \App\Message::LABEL_INBOX) }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.support_messages') }}
                  </a>
                </li>
              @endcan

              @if(Auth::user()->isFromPlatform())
                @can('index', \App\Ticket::class)
                  <li class=" {{ Request::is('admin/support/ticket*') ? 'active' : '' }}">
                    <a href="{{ url('admin/support/ticket') }}">
                      <i class="fa fa-angle-double-right"></i> {{ trans('nav.support_tickets') }}
                    </a>
                  </li>
                @endcan
              @endif

              @can('index', \App\Dispute::class)
                <li class=" {{ Request::is('admin/support/dispute*') ? 'active' : '' }}">
                  <a href="{{ url('admin/support/dispute') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.disputes') }}
                  </a>
                </li>
              @endcan

              @can('index', \App\Refund::class)
                <li class=" {{ Request::is('admin/support/refund*') ? 'active' : '' }}">
                  <a href="{{ url('admin/support/refund') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.refunds') }}
                  </a>
                </li>
              @endcan
            </ul>
          </li>
        @endif

        @if((new \App\Helpers\Authorize(Auth::user(), 'customize_appearance'))->check())
          <li class="treeview {{ Request::is('admin/appearance*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-paint-brush"></i>
              <span>{{ trans('nav.appearance') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li class=" {{ Request::is('admin/appearance/theme') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/theme') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.themes') }}
                  </a>
                </li>

                <li class=" {{ Request::is('admin/appearance/banner*') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/banner') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.banners') }}
                  </a>
                </li>

                <li class=" {{ Request::is('admin/appearance/slider*') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/slider') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.sliders') }}
                  </a>
                </li>

                <li class=" {{ Request::is('admin/appearance/theme/option*') ? 'active' : '' }}">
                  <a href="{{ url('admin/appearance/theme/option') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.theme_options') }}
                  </a>
                </li>
            </ul>
          </li>
        @endif

        <li class="treeview {{ Request::is('admin/setting*') ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>{{ trans('nav.settings') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            @can('index', \App\SubscriptionPlan::class)
              <li class=" {{ Request::is('admin/setting/subscriptionPlan*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/subscriptionPlan') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.subscription_plans') }}
                </a>
              </li>
            @endcan

            @can('index', \App\Role::class)
              <li class=" {{ Request::is('admin/setting/role*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/role') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.user_roles') }}
                </a>
              </li>
            @endcan

            @can('index', \App\Tax::class)
              <li class=" {{ Request::is('admin/setting/tax*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/tax') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.taxes') }}
                </a>
              </li>
            @endcan

            @can('index', \App\EmailTemplate::class)
              <li class=" {{ Request::is('admin/setting/emailTemplate*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/emailTemplate') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.email_templates') }}
                </a>
              </li>
            @endcan

            @can('view', \App\Config::class)
              <li class=" {{ Request::is('admin/setting/general*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/general') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.general') }}
                </a>
              </li>

              <li class=" {{ Request::is('admin/setting/config*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/config') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.config') }}
                </a>
              </li>

              <li class=" {{ Request::is('admin/setting/paymentMethod*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/paymentMethod') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.payment_methods') }}
                </a>
              </li>
            @endcan

            @can('view', \App\System::class)
              <li class=" {{ Request::is('admin/setting/system/general*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/system/general') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.system_settings') }}
                </a>
              </li>
            @endcan

            @can('view', \App\SystemConfig::class)
              <li class=" {{ Request::is('admin/setting/system/config*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/system/config') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.config') }}
                </a>
              </li>
            @endcan

            @if(Auth::user()->isAdmin())
              <li class=" {{ Request::is('admin/setting/announcement*') ? 'active' : '' }}">
                <a href="{{ url('admin/setting/announcement') }}">
                  <i class="fa fa-angle-double-right"></i> {{ trans('nav.announcements') }}
                </a>
              </li>
            @endif
          </ul>
        </li>

        @if(Auth::user()->isAdmin() || Auth::user()->isMerchant())
          <li class="treeview {{ Request::is('admin/report*') || Request::is('admin/shop/report*') ? 'active' : '' }}">
            <a href="#">
              <i class="fa fa-map"></i>
              <span>{{ trans('nav.reports') }}</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
              @if(Auth::user()->isAdmin())
                <li class=" {{ Request::is('admin/report/kpi*') ? 'active' : '' }}">
                  <a href="{{ route('admin.kpi') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.performance') }}
                  </a>
                </li>
                <li class=" {{ Request::is('admin/report/visitors*') ? 'active' : '' }}">
                  <a href="{{ route('admin.report.visitors') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.visitors') }}
                  </a>
                </li>
              @elseif(Auth::user()->isMerchant())
                <li class=" {{ Request::is('admin/shop/report/kpi*') ? 'active' : '' }}">
                  <a href="{{ route('admin.shop-kpi') }}">
                    <i class="fa fa-angle-double-right"></i> {{ trans('nav.performance') }}
                  </a>
                </li>
              @endif
            </ul>
          </li>
        @endif

        <!--
        <li class="header">LABELS</li>
        <li><a href="#">
        <i class="fa fa-circle-o text-red"></i> <span>Important</span></a>
        </li>
        <li><a href="#">
        <i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a>
        </li>
        <li><a href="#">
        <i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a>
        </li>
        -->
      </ul>
  </section>
  <!-- /.sidebar -->
</aside>
