<!-- CONTENT SECTION -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-5 nopadding-left">
              <div class="well well-sm text-muted">
                <p class="lead text-center space10">@lang('theme.section_headings.how_to_give_feedbacks')</p>
                <p class="">@lang('theme.help.be_honest_when_leave_feedbacks')</p>
              </div>

              <div class="section-title">@lang('theme.section_headings.give_feedbacks_to_seller'):</div>

              <table class="table bg-light" id="buyer-order-table" name="buyer-order-table">
                <tbody>
                  <tr class="order-info-head">
                    <td><h5 class="text-center"><span>@lang('theme.seller')</span></h5></td>
                  </tr>
                  <tr class="order-body">
                    <td>
                      <div class="product-img-wrap">
                        <img src="{{ get_storage_file_url(optional($order->shop->image)->path, 'small') }}" class="img-circle" alt="{{ $order->shop->slug }}" title="{{ $order->shop->slug }}" />
                      </div>
                      <div class="product-info">
                        <a href="{{ route('show.store', $order->shop->slug) }}" class="product-info-title">{{ $order->shop->name }}</a>
                        @if($order->shop->feedbacks->count())
                          @include('layouts.ratings', ['ratings' => $order->shop->averageFeedback(), 'count' => $order->shop->feedbacks->count()])
                        @else
                          <span class="text-muted small">@lang('theme.no_reviews')</span>
                        @endif
                      </div>
                    </td>
                  </tr> <!-- /.order-body -->
                  <tr class="order-info-head">
                    <td><h5><span>@lang('theme.how_satisfied_you_are')</span></h5></td>
                  </tr>
                  <tr class="order-body">
                    <td>
                      <div class="post-review-box">
                        @if($order->feedback->comment)
                          @include('layouts.ratings', ['ratings' => $order->feedback->rating])
                          <p>{{ $order->feedback->comment }}</p>
                        @else
                          {!! Form::open(['route' => ['shop.feedback', $order], 'files' => true, 'data-toggle' => 'validator']) !!}
                            <div class="product-info-rating feedback-stars">
                              <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.hate_it')" data-value="1">
                                <i class="fa fa-star fa-fw"></i>
                              </span>
                              <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.not_so_good')" data-value="2">
                                <i class="fa fa-star fa-fw"></i>
                              </span>
                              <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.its_ok')" data-value="3">
                                <i class="fa fa-star fa-fw"></i>
                              </span>
                              <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.like_it')" data-value="4">
                                <i class="fa fa-star fa-fw"></i>
                              </span>
                              <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.love_it')" data-value="5">
                                <i class="fa fa-star fa-fw"></i>
                              </span>
                              <span class="response small text-primary">@lang('theme.love_it')</span>
                              {{ Form::hidden('rating', 5,['class' => 'rating-value']) }}
                            </div>
                            <div class="form-group">
                              {{ Form::textarea('comment', null, ['rows' => '2', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.write_your_feedback'), 'minlength' => '10', 'maxlength' => '250']) }}
                              <div class="help-block with-errors"></div>
                            </div>
                            <button class="confirm btn btn-primary flat col-md-4" data-confirm="@lang('theme.confirm_action.cant_undo')" type="submit">@lang('theme.button.save')</button>
                          {!! Form::close() !!}
                        @endif
                      </div> <!-- /.post-review-box -->
                    </td>
                  </tr> <!-- /.order-body -->
                </tbody>
              </table>
            </div>

            <div class="col-md-7 nopadding-right">
              <div class="section-title">@lang('theme.section_headings.give_feedbacks_to_products'):</div>

              {!! Form::open(['route' => ['save.feedback', $order], 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
                @php
                  $feedback_given = TRUE;
                @endphp

                <table class="table" id="buyer-order-table" name="buyer-order-table">
                  <tbody>
                    <tr class="order-info-head">
                      <td><h5 class="text-center"><span>@lang('theme.product')</span></h5></td>
                      <td><h5><span>@lang('theme.how_was_the_product')</span></h5></td>
                    </tr>
                      @foreach($order->inventories as $item)
                        <tr class="order-body">
                          <td>
                            <div class="product-img-wrap">
                              <img src="{{ get_inventory_img_src($item, 'small') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}" />
                              <!-- <img src="{{ get_storage_file_url(optional($item->image)->path, 'small') }}" alt="{{ $item->slug }}" title="{{ $item->slug }}" /> -->
                            </div>
                            <div class="product-info">
                              <a href="{{ route('show.product', $item->slug) }}" class="product-info-title">{{ $item->pivot->item_description }}</a>
                              @if($item->feedbacks->count())
                                @include('layouts.ratings', ['ratings' => $item->averageFeedback(), 'count' => $item->feedbacks->count()])
                              @else
                                <span class="text-muted small">@lang('theme.no_reviews')</span>
                              @endif
                            </div>
                          </td>
                          <td>
                            @if($item->pivot->feedback_id)
                              @php
                                $feedback = \App\Feedback::find($item->pivot->feedback_id);
                              @endphp
                              @include('layouts.ratings', ['ratings' => $feedback->rating])
                              <p>{{ $feedback->comment }}</p>
                            @else
                              @php
                                $feedback_given = FALSE;
                              @endphp

                              <div class="post-review-box">
                                <div class="product-info-rating feedback-stars">
                                  <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.hate_it')" data-value="1">
                                    <i class="fa fa-star fa-fw"></i>
                                  </span>
                                  <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.not_so_good')" data-value="2">
                                    <i class="fa fa-star fa-fw"></i>
                                  </span>
                                  <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.its_ok')" data-value="3">
                                    <i class="fa fa-star fa-fw"></i>
                                  </span>
                                  <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.like_it')" data-value="4">
                                    <i class="fa fa-star fa-fw"></i>
                                  </span>
                                  <span class="star rated" data-toggle="tooltip" data-title="@lang('theme.love_it')" data-value="5">
                                    <i class="fa fa-star fa-fw"></i>
                                  </span>
                                  <span class="response small text-primary">@lang('theme.love_it')</span>
                                  {{ Form::hidden('items['.$item->pivot->inventory_id.'][rating]', 5,['class' => 'rating-value']) }}
                                </div>
                                <div class="form-group">
                                  {{ Form::textarea('items['.$item->pivot->inventory_id.'][comment]', null, ['rows' => '2', 'class' => 'form-control flat', 'placeholder' => trans('theme.placeholder.write_your_feedback'), 'minlength' => 10, 'maxlength' => 250]) }}
                                  <div class="help-block with-errors"></div>
                                </div>
                              </div> <!-- /.post-review-box -->
                            @endif
                          </td>
                        </tr> <!-- /.order-body -->
                      @endforeach
                      <tr>
                        <td>
                          @if( !$feedback_given && $order->inventories->count() > 1)
                            <p class="text-muted text-info small"><i class="fa fa-info-circle"></i> @lang('theme.help.give_all_feedbacks_together')</p>
                          @endif
                        </td>
                        <td>
                          @if($feedback_given)
                            <p class="text-muted">@lang('theme.notify.your_feedback_saved')</p>
                          @else
                            <button class="confirm btn btn-info btn-block flat" data-confirm="@lang('theme.confirm_action.cant_undo')" type="submit">@lang('theme.button.save')</button>
                          @endif
                        </td>
                      </tr>
                  </tbody>
                </table>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
<!-- END CONTENT SECTION -->

<div class="space20"></div>