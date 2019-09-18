@extends('admin.layouts.master')

@section('content')
  <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-cart"></i> {{ trans('app.order') . ': ' . $order->order_number }}</h3>
          <div class="box-tools pull-right">
            <span class="label label-outline" style="background-color: {{ optional($order->status)->label_color }}">
              {{ $order->status ? strToupper(optional($order->status)->name) : trans('app.statuses.new') }}
            </span>
          </div>
        </div> <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-12">
              <div class="well well-lg">
                <span class="lead">
                  {{ trans('app.payment') . ': ' . $order->paymentMethod->name }}
                </span>

                <span class="pull-right lead">
                  {!! $order->paymentStatusName() !!}
                </span>
              </div>
            </div>
          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-12">
              <h4>{{ trans('app.order_details') }}</h4>
              <span class="spacer10"></span>
              <table class="table table-sripe">
                <tbody id="items">
                  @if(count($order->inventories) > 0)
                    @foreach($order->inventories as $item )
                      <tr>
                        <td>
                          @if($item->image)
                            <img src="{{ get_storage_file_url($item->image->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
                          @elseif(optional($item->product)->featuredImage)
                            <img src="{{ get_storage_file_url($item->product->featuredImage->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
                          @else
                            <img src="{{ get_storage_file_url(optional(optional($item->product)->image)->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
                          @endif
                        </td>
                        <td class="nopadding-right" width="55%">
                          {{ $item->pivot->item_description }}
                        </td>
                        <td class="nopadding-right" width="15%">
                          {{ get_formated_currency($item->pivot->unit_price) }}
                        </td>
                        <td>x</td>
                        <td class="nopadding-right" width="10%">
                          {{ $item->pivot->quantity }}
                        </td>
                        <td class="nopadding-right text-center" width="10%">
                          {{ get_formated_currency($item->pivot->quantity * $item->pivot->unit_price) }}
                        </td>
                      </tr>
                    @endforeach
                  @else
                      <tr id='empty-cart'><td colspan="6">{{ trans('help.empty_cart') }}</td></tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div><!-- /.row -->

          <span class="spacer30"></span>

          <div class="row">
            <div class="col-md-6">
              <dir class="spacer30"></dir>
              @if($order->admin_note)
                {{ trans('app.admin_note') }}:
                <blockquote>
                  {!! $order->admin_note !!}
                </blockquote>
              @endif
            </div>
            <div class="col-md-6" id="summary-block">
              <table class="table">
                <tr>
                  <td class="text-right">{{ trans('app.total') }}</td>
                  <td class="text-right" width="40%">
                    {{ get_formated_currency($order->total) }}
                  </td>
                </tr>

                <tr>
                  <td class="text-right">
                      <span>{{ trans('app.discount') }}</span>
                  </td>
                  <td class="text-right" width="40%"> &minus;
                    {{ get_formated_currency($order->discount) }}
                  </td>
                </tr>

                <tr>
                  <td class="text-right">
                    <span>{{ trans('app.shipping') }}</span><br/>
                    <em class="small">
                      @if($order->shippingRate)
                        {{ optional($order->shippingRate)->name }}
                        @php
                          $carrier_name = $order->carrier ? $order->carrier->name : ( $order->shippingRate ? optional($order->shippingRate->carrier)->name : Null);
                        @endphp
                        @if($carrier_name)
                            <small> {{ trans('app.by') . ' ' . $carrier_name }} </small>
                        @endif
                      @else
                        {{ trans('app.custom_shipping') }}
                      @endif
                    </em>
                  </td>
                  <td class="text-right" width="40%">
                    {{ get_formated_currency($order->shipping) }}
                  </td>
                </tr>

                @if($order->shippingPackage)
                  <tr>
                    <td class="text-right">
                      <span>{{ trans('app.packaging') }}</span><br/>
                      <em class="small">{{ optional($order->shippingPackage)->name }}</em>
                    </td>
                    <td class="text-right" width="40%">
                      {{ get_formated_currency($order->packaging) }}
                    </td>
                  </tr>
                @endif

                @if($order->handling)
                  <tr>
                    <td class="text-right">{{ trans('app.handling') }}</td>
                    <td class="text-right" width="40%">
                      {{ get_formated_currency($order->handling) }}
                    </td>
                  </tr>
                @endif

                <tr>
                  <td class="text-right">{{ trans('app.taxes') }} <br/>
                    <em class="small">
                      @if($order->shippingZone)
                        {{ optional($order->shippingZone)->name }}
                      @elseif($order->shippingRate)
                        {{ optional($order->shippingRate->shippingZone)->name }}
                      @endif
                      {{ get_formated_decimal($order->taxrate, true, 2) }}%
                    </em>
                  </td>
                  <td class="text-right" width="40%">
                    {{  get_formated_currency($order->taxes) }}
                  </td>
                </tr>

                <tr class="lead">
                  <td class="text-right">{{ trans('app.grand_total') }}</td>
                  <td class="text-right" width="40%">
                    {{ get_formated_currency($order->grand_total) }}
                  </td>
                </tr>
              </table>
            </div>
          </div><!-- /.row -->
        </div> <!-- /.box-body -->
      </div> <!-- /.box -->

      @php
        $refunded_amt = $order->refundedSum();
      @endphp

      @if($refunded_amt > 0)
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4><i class="fa fa-warning"></i> {{ trans('app.alert') }}!</h4>
          {!! trans('help.order_refunded', ['amount' => get_formated_currency($refunded_amt), 'total' => get_formated_currency($order->grand_total)]) !!}
        </div>
      @endif

      @can('fulfill', $order)
        <div class="box">
          <div class="box-body">
            <div class="box-tools">
              {!! Form::open(['route' => ['admin.order.order.togglePaymentStatus', $order], 'method' => 'put', 'class' => 'inline']) !!}
                <button type="submit" class="confirm ajax-silent btn btn-lg btn-danger">{{ $order->isPaid() ? trans('app.mark_as_unpaid') : trans('app.mark_as_paid') }}</button>
              {!! Form::close() !!}

              @can('initiate', App\Refund::class)
                @if($order->isPaid())
                  <a href="#" data-link="{{ route('admin.support.refund.form', $order) }}" class='ajax-modal-btn btn btn-flat btn-lg btn-default' >
                    {{ trans('app.initiate_refund') }}
                  </a>
                @endif
              @endcan

              <div class="pull-right">
                @if(!$order->status->fulfilled)
                  <a href="#" data-link="{{ route('admin.order.order.fulfillment', $order) }}" class='ajax-modal-btn btn btn-flat btn-lg btn-primary' >
                    {{ trans('app.fulfill_order') }}
                  </a>
                @else
                  @can('archive', $order)
                    {!! Form::open(['route' => ['admin.order.order.archive', $order->id], 'method' => 'delete', 'class' => 'inline']) !!}
                      <button type="submit" class="confirm ajax-silent btn btn-lg btn-default"><i class="fa fa-archive text-muted"></i> {{ trans('app.order_archive') }}</button>
                    {!! Form::close() !!}
                  @endcan

                  <a href="#" data-link="{{ route('admin.order.order.edit', $order) }}" class='ajax-modal-btn btn btn-flat btn-lg btn-default' >
                    {{ trans('app.update') }}
                  </a>
                @endif
              </div>
            </div>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      @endcan

      @include('admin.partials._activity_logs', ['logger' => $order])
    </div> <!-- /.col-md-8 -->

    <div class="col-md-4 nopadding-left">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ trans('app.customer') }}</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div> <!-- /.box-header -->
        <div class="box-body">
          <p>
            @if($order->customer->image)
              <img src="{{ get_storage_file_url(optional($order->customer->image)->path, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
            @else
              <img src="{{ get_gravatar_url($order->customer->email, 'tiny') }}" class="img-circle img-sm" alt="{{ trans('app.avatar') }}">
            @endif

            <span class="admin-user-widget-title indent5">
              @if(config('system_settings.vendor_can_view_customer_info'))
                <a href="#" data-link="{{ route('admin.admin.customer.show', $order->customer->id) }}" class="ajax-modal-btn">
                  {{ $order->customer->getName() }}
                </a>
              @else
                {{ $order->customer->getName() }}
              @endif

              @if($order->email)
                <br/><small>{{ trans('app.email') . ': ' . $order->email }}</small>
              @endif
            </span>
          </p>

          @if($order->customer->email)
            <span class="admin-user-widget-text text-muted">
              {{ trans('app.email') . ': ' . $order->customer->email }}
            </span>
          @endif

          <fieldset><legend>{{ strtoupper(trans('app.shipping_address')) }}</legend></fieldset>

          {!! address_str_to_html($order->shipping_address) !!}

          <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{ urlencode(address_str_to_geocode_str($order->shipping_address)) }}&output=embed"></iframe>

          <fieldset><legend>{{ strtoupper(trans('app.billing_address')) }}</legend></fieldset>

          @if($order->shipping_address == $order->billing_address)
            <small>
              <i class="fa fa-check-square-o"></i>
              {!! Form::label('same_as_shipping_address', strtoupper(trans('app.same_as_shipping_address')), ['class' => 'indent5']) !!}
            </small>
          @else
            {!! address_str_to_html($order->billing_address) !!}
          @endif
        </div>
      </div>

      @if($order->refunds->count())
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> {{ trans('app.refunds') }}</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div> <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-border">
              <tbody>
                @foreach($order->refunds as $refund )
                  <tr>
                    <td>{{ $refund->created_at->diffForHumans() }}</td>
                    <td>{{ get_formated_currency($refund->amount) }}</td>
                    <td>{!! $refund->statusName() !!}</td>
                    <td>
                      @can('approve', $refund)
                        <a href="#" data-link="{{ route('admin.support.refund.response', $refund) }}" class="ajax-modal-btn"><i data-toggle="tooltip" data-placement="top" title="{{ trans('app.response') }}" class="fa fa-random"></i></a>&nbsp;
                      @endcan
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endif

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> {{ trans('app.shipping') }}</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          </div>
        </div> <!-- /.box-header -->
        <div class="box-body">
          <span>{{ trans('app.tracking_id') }}: {{ $order->tracking_id }}</span><br/>
          <span>{{ trans('app.carrier') }}: <strong>{{ $order->carrier ? $order->carrier->name : ( $order->shippingRate ? optional($order->shippingRate->carrier)->name : '') }}</strong></span><br/>
          <span>{{ trans('app.total_weight') }}: <strong>{{ get_formated_weight($order->shipping_weight) }}</strong></span><br/>
          @if($order->carrier && $order->tracking_id)
            @php
              $tracking_url = getTrackingUrl($order->tracking_id, $order->carrier_id);
            @endphp
            <span><a href="{{ $tracking_url }}">{{ trans('app.tracking_url') }}</a>: {{ $tracking_url }}</span>
          @endif
        </div>
      </div>
    </div> <!-- /.col-md-4 -->
  </div> <!-- /.row -->
@endsection