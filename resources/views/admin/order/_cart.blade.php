<div class="row">
  <div class="col-md-12">
    <table class="table table-sripe">
      <tbody id="items">
        <tr id='empty-cart' style="display: {{ (isset($cart) && count($cart->inventories) > 0) ? 'none' : 'table-row' }}"><td colspan="5">{{ trans('help.empty_cart') }}</td></tr>

        @if(isset($cart) && count($cart->inventories) > 0)
          @php
            $i = 1;
          @endphp
          @foreach($cart->inventories as $item )
            @php
              $id = $item->pivot->inventory_id;
            @endphp

            <tr id="{{ $id }}">
              <td>
                @if($item->image)
                  <img src="{{ get_storage_file_url($item->image->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
                @elseif($item->product->featuredImage)
                  <img src="{{ get_storage_file_url($item->product->featuredImage->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
                @else
                  <img src="{{ get_storage_file_url(optional($item->product->image)->path, 'tiny') }}" class="img-circle img-md" alt="{{ trans('app.image') }}">
                @endif
              </td>
              <td class="nopadding-right" width="55%">
                {{ $item->pivot->item_description }}
                {{ Form::hidden("cart[".$i."][inventory_id]", $id) }}
                {{ Form::hidden("cart[".$i."][item_description]", $item->pivot->item_description) }}
                {{ Form::hidden("cart[".$i."][shipping_weight]", $item->shipping_weight) }}
              </td>
              <td class="nopadding-right" width="15%">
                {{ Form::number("cart[".$i."][unit_price]", get_formated_decimal($item->sale_price), ['id' => 'price-'.$id, 'class' => 'form-control itemPrice no-border', 'step' => 'any', 'required']) }}
              </td>
              <td>x</td>
              <td class="nopadding-right" width="10%">
                {{ Form::number("cart[".$i."][quantity]", $item->pivot->quantity, ['id' => 'qtt-'.$id, 'class' => 'form-control itemQtt no-border', 'required']) }}
              </td>
              <td class="nopadding-right text-center" width="10%">{{ get_formated_currency_symbol() }}
                <span id="total-{{$id}}"  class="itemTotal">
                  {{ get_formated_decimal($item->pivot->quantity * $item->sale_price) }}
                </span>
              </td>
              <td class="small"><i class="fa fa-trash text-muted deleteThisRow" data-toggle="tooltip" data-placement="left" title="{{ trans('help.romove_this_cart_item') }}"></i></td>
            </tr>
            <?php $i++; ?>
          @endforeach
        @endif
      </tbody>
    </table>
  </div>
</div>