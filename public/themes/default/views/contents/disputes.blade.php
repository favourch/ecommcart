@if($disputes->count() > 0)
  <table class="table" id="buyer-order-table">
  	<thead>
    	<tr><th colspan="3">@lang('theme.disputes')</th></tr>
  	</thead>
  	<tbody>
			@foreach($disputes as $dispute)
          <tr class="order-info-head">
            	<td width="50%">
                  <h5><span>@lang('theme.order_id'): </span>{{ $dispute->order->order_number }}</h5>
                  <h5><span>@lang('theme.order_time_date'): </span>{{ $dispute->order->created_at->toDayDateTimeString() }}</h5>
            	</td>
            	<td width="25%" class="store-info">
                  <h5>
                    <span>@lang('theme.store'):</span>
                    @if($dispute->shop)
                      <a href="{{ route('show.store', $dispute->shop->slug) }}"> {{ $dispute->shop->name }}</a>
                    @else
                      @lang('theme.seller')
                    @endif
                  </h5>
                  <h5>
                      <span>@lang('theme.status')</span>
                      {{ optional($dispute->order->status)->name }}
                  </h5>
            	</td>
            	<td width="25%" class="order-amount">
                  <h5><span>@lang('theme.order_amount'): </span>{{ get_formated_currency($dispute->order->grand_total) }}</h5>
                  <div class="btn-group" role="group">
                    <a class="btn btn-xs btn-default flat" href="{{ route('order.detail', $dispute->order) }}">@lang('theme.button.order_detail')</a>
                    <a class="btn btn-xs btn-default flat" href="{{ route('order.detail', $dispute->order) . '#message-section' }}">@lang('theme.button.contact_seller')</a>
                  </div>
            	</td>
        	</tr> <!-- /.order-info-head -->
        	@foreach($dispute->order->inventories as $item)
              <tr class="order-body">
                <td colspan="2">
                    <div class="product-img-wrap">
                      <img src="{{ get_storage_file_url(optional($item->image)->path, 'small') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}" />
                    </div>
                    <div class="product-info">
                        <a href="{{ route('show.product', $item->slug) }}" class="product-info-title">{{ $item->pivot->item_description }}</a>

                        <div class="order-info-amount">
                            <span>{{ get_formated_currency($item->pivot->unit_price) }} x {{ $item->pivot->quantity }}</span>
                        </div>
                        {{--
                        <ul class="order-info-properties">
                            <li>Size: <span>L</span></li>
                            <li>Color: <span>RED</span></li>
                        </ul> --}}
                        @if($dispute->product_id == $item->product_id)
                          <span class="label label-danger">@lang('theme.disputed')</span>
                        @endif
                    </div>
                </td>
                @if($loop->first)
                  <td rowspan="{{ $loop->count }}" class="order-actions text-center">
                    <p>{!! $dispute->order->dispute->statusName() !!}</p>

                    <a href="{{ route('dispute.open', $dispute->order) }}" class="btn btn-link btn-xs btn-block">{!! trans('theme.button.details') !!}</a>
                  </td>
                @endif
              </tr> <!-- /.order-body -->
        	@endforeach

        	@if($dispute->order->message_to_customer)
              <tr class="message_from_seller">
                <td colspan="3">
                  <p>
                    <strong>@lang('theme.message_from_seller'): </strong> {{ $dispute->order->message_to_customer }}
                  </p>
                </td>
              </tr>
        	@endif

        	@if($dispute->order->buyer_note)
              <tr class="order-info-footer">
                <td colspan="3">
                  <p class="order-detail-buyer-note">
                    <span>@lang('theme.note'): </span> {{ $dispute->order->buyer_note }}
                  </p>
                </td>
              </tr>
        	@endif
			@endforeach
  	</tbody>
  </table>
  <div class="sep"></div>
@else
  	<div class="clearfix space50"></div>
  	<p class="lead text-center space50">
    	@lang('theme.nothing_found')
  	</p>
@endif

<div class="row pagenav-wrapper">
    {{ $disputes->links('layouts.pagination') }}
</div><!-- /.row .pagenav-wrapper -->
<div class="clearfix space20"></div>