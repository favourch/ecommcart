@extends('admin.layouts.master')

@section('content')
  <!-- Info boxes -->
  <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="fa fa-credit-card"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.revenue') }}</span>
              <span class="info-box-number">
                  {{ get_formated_currency($sales_total) }}
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">
                  <i class="fa fa-clock-o"></i> {{ trans('app.latest_months', ['months' => config('charts.default.months')]) }}
              </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-percent"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('app.conversion_rate') }}</span>
                <span class="info-box-number">
                  @if($orders_count)
                    {{ get_formated_decimal(( $orders_count / ($orders_count + $abandoned_carts_count) ) * 100, true, 1) }} {{ trans('app.percent') }}
                  @else
                    0
                  @endif
                </span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted">
                  <i class="fa fa-clock-o"></i> {{ trans('app.latest_months', ['months' => config('charts.default.months')]) }}
                </span>
            </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-red">
            <i class="fa fa-cart-arrow-down"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.abandoned_carts') }}</span>
                <span class="info-box-number">
                  {{ $abandoned_carts_count }}
                </span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted">
                  <i class="fa fa-clock-o"></i> {{ trans('app.latest_months', ['months' => config('charts.default.months')]) }}
                </span>
          </div><!-- /.info-box-content -->
        </div>
      </div><!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-green">
            <i class="fa fa-calculator"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.avg_order_value') }}</span>
                <span class="info-box-number">
                  @if($orders_count)
                    {{ get_formated_currency($sales_total/$orders_count) }}
                  @else
                    0
                  @endif
                </span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted">
                  <i class="fa fa-clock-o"></i> {{ trans('app.latest_months', ['months' => config('charts.default.months')]) }}
                </span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->
  </div><!-- /.row -->

  <div class="row">
    <div class="col-sm-8 nopadding-right">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title text-warning">
            <i class="fa fa-calendar"></i> {{ trans('app.sales_by_months') }}
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <p class="text-muted"><span class="lead"> {{ trans('app.total') }}: {{ get_formated_currency($sales_total) }} </span><span class="pull-right">{{ $orders_count . ' ' . trans('app.orders') }}</span></p>
            <div>{!! $chart->container() !!}</div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-sm-4">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title text-warning">
            <i class="fa fa-money"></i> {{ trans('app.finances') }}
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-default">
              <tbody>
                <tr>
                  <td>{{ trans('app.sales_total') }}</td>
                  <td class="pull-right">{{ get_formated_currency($sales_total) }}</td>
                </tr>
                <tr>
                  <td>{{ trans('app.discounts') }}</td>
                  <td class="pull-right">-{{ get_formated_currency($discount_total, config('system_settings.decimals')) }}</td>
                </tr>
                <tr>
                  <td>{{ trans('app.refunds') }}</td>
                  <td class="pull-right">-{{ get_formated_currency($latest_refund_total, config('system_settings.decimals')) }}</td>
                </tr>
                <tr>
                  <td>{{ trans('app.net_sales') }}</td>
                  <td class="pull-right"><span class="lead">{{ get_formated_currency($sales_total - ($discount_total + $latest_refund_total)) }}</span></td>
                </tr>
              </tbody>
            </table>
            <div class="clearfix spacer20"></div>
            <small class="text-muted pull-right"><i class="fa fa-info-circle"></i> {{ trans('app.latest_months', ['months' => config('charts.default.months')]) }}</small>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->

  <!--
  Top Selling Items
   -->
  <div class="box box-solid">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="icon ion-md-rocket"></i> {{ trans('app.top_selling_items') }}</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
          <table class="table no-margin table-condensed table-no-sort">
              <thead>
                <tr class="text-muted">
                    <th width="60px">&nbsp;</th>
                    <th>{{ trans('app.listing') }}</th>
                    <th>{{ trans('app.attributes') }}</th>
                    <th class="text-center" width="8%">{{ trans('app.units_sold') }}</th>
                    <th class="text-center">{{ trans('app.gross_sales') }}</th>
                    <th>&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                @foreach($top_listings as $inventory)
                  <tr>
                    <td>
                        <img src="{{ get_storage_file_url(optional($inventory->image)->path, 'tiny') }}" class="img-md" alt="{{ trans('app.image') }}">
                    </td>
                    <td>
                        <h5 class="nopadding">
                          <small>{{ trans('app.sku') . ': ' }}</small>
                            @can('view', $inventory)
                                <a href="#" data-link="{{ route('admin.stock.inventory.show', $inventory->id) }}" class="ajax-modal-btn modal-btn">{{ $inventory->sku }}</a>
                            @else
                              {{ $inventory->sku }}
                            @endcan
                        </h5>

                        <span class="text-muted">
                            {{ $inventory->name }}
                        </span>
                    </td>
                    <td>
                      {{ implode(' | ', array_column($inventory->attributeValues->toArray(), 'value') ) }}
                    </td>
                    <td class="text-center">{{ $inventory->sold_qtt }}</td>
                    <td class="text-center">{{ get_formated_currency($inventory->gross_sales) }}</td>
                    <td>&nbsp;</td>
                  </tr>
                @endforeach
              </tbody>
          </table>
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->
  <!--
  End Top Selling Items
   -->

  <!--
  Top Customers
   -->
  <div class="row">
    <div class="col-sm-6 nopadding-right">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title text-warning">
            <i class="fa fa-user-secret"></i> {{ trans('app.top_customers') }}
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin table-condensed">
                  <thead>
                    <tr class="text-muted">
                      <th width="60px">&nbsp;</th>
                      <th>{{ trans('app.name') }}</th>
                      <th class="text-center"><i class="fa fa-shopping-cart"></i></th>
                      <th class="text-center">{{ trans('app.revenue') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($top_customers as $customer)
                      <tr>
                        <td>
                          @if($customer->image)
                            <img src="{{ get_storage_file_url(optional($customer->image)->path, 'tiny') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
                          @else
                            <img src="{{ get_gravatar_url($customer->email, 'tiny') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
                          @endif
                        </td>
                        <td>
                            @can('view', $customer)
                                <a href="#" data-link="{{ route('admin.admin.customer.show', $customer->id) }}" class="ajax-modal-btn modal-btn">{{ $customer->getName() }}</a>
                            @else
                              {{ $customer->getName() }}
                            @endcan
                        </td>
                        <td class="text-center">{{ $customer->orders_count }}</td>
                        <td class="text-center">{{ get_formated_currency(round($customer->orders->sum('total'))) }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="3">{{ trans('app.no_data_found') }}</td>
                      </tr>
                    @endforelse
                  </tbody>
              </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-sm-6 nopadding-left">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title text-warning">
            <i class="fa fa-user-secret"></i> {{ trans('app.returning_customers') }}
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin table-condensed">
                  <thead>
                    <tr class="text-muted">
                      <th width="60px">&nbsp;</th>
                      <th>{{ trans('app.name') }}</th>
                      <th class="text-center"><i class="fa fa-shopping-cart"></i></th>
                      <th class="text-center">{{ trans('app.revenue') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($returning_customers as $customer)
                      <tr>
                        <td>
                          @if($customer->image)
                            <img src="{{ get_storage_file_url(optional($customer->image)->path, 'tiny') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
                          @else
                            <img src="{{ get_gravatar_url($customer->email, 'tiny') }}" class="img-circle" alt="{{ trans('app.avatar') }}">
                          @endif
                        </td>
                        <td>
                            @can('view', $customer)
                                <a href="#" data-link="{{ route('admin.admin.customer.show', $customer->id) }}" class="ajax-modal-btn modal-btn">{{ $customer->getName() }}</a>
                            @else
                              {{ $customer->getName() }}
                            @endcan
                        </td>
                        <td class="text-center">{{ $customer->orders_count }}</td>
                        <td class="text-center">{{ get_formated_currency(round($customer->orders->sum('total'))) }}</td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="3">{{ trans('app.no_data_found') }}</td>
                      </tr>
                    @endforelse
                  </tbody>
              </table>
            </div><!-- /.table-responsive -->
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  <!--
  End Top Customers
   -->

  <div class="row">
    <div class="col-sm-6 nopadding-right">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title text-warning">
            <i class="fa fa-code-fork"></i> {{ trans('app.top_categories') }}
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin">
                    <thead>
                      <tr class="text-muted">
                          <th>{{ trans('app.name') }}</th>
                          <th class="text-center">{{ trans('app.items') }}</th>
                          <th class="text-center">{{ trans('app.status') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($top_categories as $category)
                        <tr>
                          <td>{{ $category->name }}</td>
                          <td class="text-center">{{ $category->listings_count }}</td>
                          <td class="text-center">{{ ($category->active) ? trans('app.active') : trans('app.inactive') }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-sm-6 nopadding-left">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title text-warning">
            <i class="fa fa-truck"></i> {{ trans('app.top_suppliers') }}
          </h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table class="table no-margin table-condensed">
                    <thead>
                      <tr class="text-muted">
                          <th width="60px">&nbsp;</th>
                          <th>{{ trans('app.name') }}</th>
                          <th class="text-center">{{ trans('app.items') }}</th>
                          <th class="text-center">{{ trans('app.status') }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($top_suppliers as $supplier)
                        <tr>
                          <td>
                              <img src="{{ get_storage_file_url(optional($supplier->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.logo') }}">
                          </td>
                          <td>{{ $supplier->name }}</td>
                          <td class="text-center">{{ $supplier->inventories_count }}</td>
                          <td class="text-center">{{ ($supplier->active) ? trans('app.active') : trans('app.inactive') }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
@endsection

@section('page-script')
  @include('plugins.chart')
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>

  {!! $chart->script() !!}

@endsection
