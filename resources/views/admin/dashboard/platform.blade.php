@extends('admin.layouts.master')

@section('page-style')
  @include('plugins.ionic')
@endsection

@section('content')
  <!-- Info boxes -->
  <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="icon ion-md-people"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.customers') }}</span>
              <span class="info-box-number">
                  {{ $customer_count }}
                  <a href="{{ route('admin.admin.customer.index') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                    <i class="icon ion-md-send"></i>
                  </a>
              </span>
              <div class="progress" style="background: transparent;"></div>
              <span class="progress-description text-muted">
                  <i class="icon ion-md-add"></i>
                  {{ trans('app.new_in_30_days', ['new' => $new_customer_last_30_days, 'model' => trans('app.customers')]) }}
              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="icon ion-md-contacts"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">{{ trans('app.merchants') }}</span>
                <span class="info-box-number">
                    {{ $merchant_count }}
                    <a href="{{ route('admin.vendor.merchant.index') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                      <i class="icon ion-md-send"></i>
                    </a>
                </span>
                <div class="progress" style="background: transparent;"></div>
                <span class="progress-description text-muted">
                  <i class="icon ion-md-add"></i>
                  {{ trans('app.new_in_30_days', ['new' => $new_merchant_last_30_days, 'model' => trans('app.merchants')]) }}
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-right nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-green">
            <i class="icon ion-md-cart"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.todays_sale') }}</span>
              <span class="info-box-number">
                {{ get_formated_currency($todays_sale_amount) }}
                <a href="{{ route('admin.kpi') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                  <i class="icon ion-md-send"></i>
                </a>
              </span>

              @php
                $difference = $todays_sale_amount - $yesterdays_sale_amount;
                $todays_sale_percents = $todays_sale_amount == 0 ? 0 : round(($difference / $todays_sale_amount) * 100);
              @endphp
              <div class="progress">
                <div class="progress-bar progress-bar-success" style="width: {{$todays_sale_percents}}%"></div>
              </div>
              <span class="progress-description text-muted">
                @if($todays_sale_amount == 0)
                  <i class="icon ion-md-hourglass"></i>
                  {{ trans('messages.no_sale', ['date' => trans('app.today')]) }}
                @else
                  <i class="icon ion-md-arrow-{{ $difference < 0 ? 'down' : 'up'}}"></i>
                  {{ trans('messages.todays_sale_percents', ['percent' => $todays_sale_percents, 'state' => $difference < 0 ? trans('app.down') : trans('app.up')]) }}
                @endif
              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-md-3 col-sm-6 col-xs-12 nopadding-left">
        <div class="info-box">
          <span class="info-box-icon bg-red">
            <i class="icon ion-md-heart"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.visitors_today') }}</span>
              <span class="info-box-number">
                {{ $todays_visitor_count }}
                <a href="{{ route('admin.report.visitors') }}" class="pull-right small" data-toggle="tooltip" data-placement="left" title="{{ trans('app.detail') }}" >
                  <i class="icon ion-md-send"></i>
                </a>
              </span>

              @php
                $last_months = $last_60days_visitor_count - $last_30days_visitor_count;
                $difference = $last_30days_visitor_count - $last_months;
                $last_30_days_percents = $last_months == 0 ? 100 : round(($difference / $last_months) * 100);
              @endphp
              <div class="progress">
                <div class="progress-bar progress-bar-info" style="width: {{$last_30_days_percents}}%"></div>
              </div>
              <span class="progress-description text-muted">
                <i class="icon ion-md-arrow-{{ $difference > 0 ? 'up' : 'down'}}"></i>
                {{ trans('messages.last_30_days_percents', ['percent' => $last_30_days_percents, 'state' => $difference > 0 ? trans('app.increase') : trans('app.decrease')]) }}
              </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-md-8 col-sm-7 col-xs-12">
      <div class="box">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#visitors_tab" data-toggle="tab">
              <i class="icon ion-md-pulse hidden-sm"></i>
              {{ trans('app.visitors_graph') }}
            </a></li>
            <li><a href="#latest_product_tab" data-toggle="tab">
              <i class="fa fa-cubes hidden-sm"></i>
              {{ trans('app.recently_added_products') }}
            </a></li>
            <li><a href="#open_ticket_tab" data-toggle="tab">
              <i class="fa fa-ticket hidden-sm"></i>
              {{ trans('app.open_tickets') }}
            </a></li>
          </ul>
          <!-- /.nav .nav-tabs -->

          <div class="tab-content">
            <div class="tab-pane active" id="visitors_tab">
              <div>{!! $chart->container() !!}</div>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="latest_product_tab">
              <div class="box-body nopadding">
                <div class="table-responsive">
                  <table class="table no-margin table-condensed">
                      <thead>
                        <tr>
                          <th>{{ trans('app.name') }}</th>
                          <th>{{ trans('app.gtin') }}</th>
                          <th width="20px">&nbsp;</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($latest_products as $product)
                            <tr>
                              <td>
                                <img src="{{ get_storage_file_url(optional($product->featuredImage)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.featured_image') }}">
                                <p class="indent5">
                                  <a href="#" data-link="{{ route('admin.catalog.product.show', $product->id) }}"  class="ajax-modal-btn">
                                    {{ $product->name }}
                                  </a>
                                  @unless($product->active)
                                        <span class="label label-default indent10">{{ trans('app.inactive') }}</span>
                                    @endunless
                                </p>
                              </td>
                              <td>
                                <span class="label label-outline">{{ $product->gtin_type }}</span> {{ $product->gtin }}
                              </td>
                              <td>
                                @can('update', $product)
                                  <a href="{{ route('admin.catalog.product.edit', $product->id) }}"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.edit') }}" class="fa fa-edit"></i></a>
                                @endcan
                              </td>
                            </tr>
                        @empty
                          <tr>
                            <td colspan="3">{{ trans('app.no_data_found') }}</td>
                          </tr>
                        @endforelse
                      </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                @can('index', App\Product::class)
                  <a href="{{ route('admin.catalog.product.index') }}" class="btn btn-default btn-flat pull-right">
                    <i class="icon ion-md-cube"></i> {{ trans('app.products') }}
                  </a>
                @endcan
              </div>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="open_ticket_tab">
              <div class="box-body nopadding">
                <div class="table-responsive">
                  <table class="table no-margin table-condensed">
                      <thead>
                        <tr>
                          <th width="65%">{{ trans('app.subject') }}</th>
                          <th>{{ trans('app.priority') }}</th>
                          <th><i class="icon ion-md-chatbubbles"></i></th>
                          <th>{{ trans('app.updated_at') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($open_tickets as $ticket)
                            <tr>
                              <td>
                                <span class="label label-outline"> {{ $ticket->category->name }} </span>
                                <p class="indent5">
                                  <a href="{{ route('admin.support.ticket.show', $ticket->id) }}">{{ $ticket->subject }}</a>
                                </p>
                              </td>
                              <td>{!! $ticket->priorityLevel() !!}</td>
                              <td><span class="label label-default">{{ $ticket->replies_count }}</span></td>
                              <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                          <tr>
                            <td colspan="3">{{ trans('app.no_data_found') }}</td>
                          </tr>
                        @endforelse
                      </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
                @can('index', App\Ticket::class)
                  <a href="{{ route('admin.support.ticket.index') }}" class="btn btn-default btn-flat pull-right">
                    <i class="fa fa-ticket"></i> {{ trans('app.tickets') }}
                  </a>
                @endcan
              </div>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col-*-* -->

    <div class="col-md-4 col-sm-5 col-xs-12 nopadding-left">
      @if($dispute_count > 0)
        <div class="info-box bg-red">
          <span class="info-box-icon"><i class="icon ion-md-megaphone"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">{{ trans('app.appealed_disputes') }}</span>
            <span class="info-box-number">
                {{ $dispute_count }}
                <a href="{{ route('admin.support.dispute.index') }}" class="pull-right" data-toggle="tooltip" data-placement="left" title="{{ trans('app.take_action') }}" >
                  <i class="icon ion-md-paper-plane"></i>
                </a>
            </span>

            @php
              $last_months = $last_60days_dispute_count - $last_30days_dispute_count;
              $difference = $last_30days_dispute_count - $last_months;
              $last_30_days_percents = $last_months == 0 ? 100 : round(($difference / $last_months) * 100);
            @endphp
            <div class="progress">
              <div class="progress-bar" style="width: {{$last_30_days_percents}}%"></div>
            </div>

            <span class="progress-description">
                <i class="icon ion-md-arrow-{{ $difference > 0 ? 'up' : 'down'}}"></i>
                {{ trans('messages.last_30_days_percents', ['percent' => $last_30_days_percents, 'state' => $difference > 0 ? trans('app.increase') : trans('app.decrease')]) }}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      @endif

      <div class="box">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs nav-justified">
            <li class="active"><a href="#top_customer_tab" data-toggle="tab">
              <i class="icon ion-md-people hidden-sm"></i>
              {{ trans('app.top_customers') }}
            </a></li>
            <li><a href="#top_merchant_tab" data-toggle="tab">
              <i class="icon ion-md-rocket hidden-sm"></i>
              {{ trans('app.top_vendors') }}
            </a></li>
          </ul>
          <!-- /.nav .nav-tabs -->

          <div class="tab-content nopadding">
            <div class="tab-pane active" id="top_customer_tab">
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin table-condensed">
                      <thead>
                        <tr class="text-muted">
                          <th>{{ trans('app.name') }}</th>
                          <th><i class="icon ion-md-cart"></i></th>
                          <th>{{ trans('app.revenue') }}</th>
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
                              <p class="indent5">
                                @can('view', $customer)
                                    <a href="#" data-link="{{ route('admin.admin.customer.show', $customer->id) }}" class="ajax-modal-btn modal-btn">{{ $customer->getName() }}</a>
                                @else
                                  {{ $customer->getName() }}
                                @endcan
                              </p>
                            </td>
                            <td>
                              <span class="label label-outline">{{ $customer->orders_count }}</span>
                            </td>
                            <td>{{ get_formated_currency(round($customer->orders->sum('total'))) }}</td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="3">{{ trans('app.no_data_found') }}</td>
                          </tr>
                        @endforelse
                      </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" id="top_merchant_tab">
              <div class="box-body">
                <div class="table-responsive">
                  <table class="table no-margin table-condensed">
                      <thead>
                        <tr class="text-muted">
                          <th>{{ trans('app.name') }}</th>
                          <th><i class="fa fa-cubes"></i></th>
                          <th>{{ trans('app.revenue') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($top_vendors as $vendor)
                          <tr>
                            <td>
                              <img src="{{ get_storage_file_url(optional($vendor->image)->path, 'tiny') }}" class="img-circle" alt="{{ trans('app.logo') }}">
                              <p class="indent5">
                                @can('view', $vendor)
                                    <a href="#" data-link="{{ route('admin.vendor.shop.show', $vendor->id) }}" class="ajax-modal-btn modal-btn">{{ $vendor->name }}</a>
                                @else
                                  {{ $vendor->name }}
                                @endcan
                              </p>
                            </td>
                            <td>
                              <span class="label label-outline">{{ $vendor->inventories_count }}</span>
                            </td>
                            <td>
                              {{ get_formated_currency(round($vendor->revenue->first()['total'])) }}
                            </td>
                          </tr>
                        @empty
                          <tr>
                            <td colspan="3">{{ trans('app.no_data_found') }}</td>
                          </tr>
                        @endforelse
                      </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col-*-* -->
  </div>
@endsection

@section('page-script')
  @include('plugins.chart')
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>

  {!! $chart->script() !!}
@endsection
