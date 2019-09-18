<div class="modal fade" id="shopReviewsModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content flat">
        <div class="modal-body nopadding">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="position: absolute; top: 5px; right: 10px; z-index: 9; color: #eee;">&times;</button>
            <div class="box-widget widget-shop">
                <div class="widget-shop-header"  style="background-image:url( {{ get_cover_img_src($shop, 'shop') }} );">
                    <h2 class="widget-shop-name">{{ $shop->name }}</h2>
                    <p class="member-since small">
                        {{ trans('theme.member_since') }}: {{ $shop->created_at->diffForHumans() }}
                    </p>
                </div> <!-- /.widget-shop-header -->

                <div class="widget-shop-image">
                    <img src="{{ get_storage_file_url(optional($shop->logo)->path, 'small') }}" class="img-circle" alt="{{ trans('theme.logo') }}">
                </div>

                <div class="row">
                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">{{ $shop->inventories_count }}</h5>
                        <span class="description-text">{{ trans('theme.active_listings') }}</span>
                      </div>
                    </div>

                    <div class="col-sm-4 border-right">
                      <div class="description-block">
                        <h5 class="description-header">&nbsp;</h5>
                        <span class="description-text small">
                            @include('layouts.ratings', ['ratings' => $shop->feedbacks->avg('rating'), 'count' => $shop->feedbacks->count()])
                        </span>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">{{ \App\Helpers\Statistics::sold_items_count($shop->id) }}</h5>
                        <span class="description-text">{{ trans('theme.items_sold') }}</span>
                      </div>
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.widget-shop -->

            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#description_tab" data-toggle="tab">
                    {{ trans('theme.description') }}
                  </a></li>
                  @if($shop->config->return_refund)
                  <li><a href="#refund_policy_tab" data-toggle="tab">
                    {{ trans('theme.return_and_refund_policy') }}
                  </a></li>
                  @endif
                  <li><a href="#reviews_tab" data-toggle="tab">
                    {{ trans('theme.latest_reviews') }}
                  </a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="description_tab">
                        {!! $shop->description !!}
                    </div> <!-- /.tab-pane -->

                    <div class="tab-pane" id="refund_policy_tab">
                        {!! $shop->config->return_refund !!}
                    </div> <!-- /.tab-pane -->

                    <div class="tab-pane" id="reviews_tab">
                        @forelse($shop->feedbacks->sortByDesc('created_at') as $feedback)
                            <p>
                                <b>{{ $feedback->customer->nice_name ?? $feedback->customer->name  }}</b>

                                <span class="pull-right small">
                                    <b class="text-success">@lang('theme.verified_purchase')</b>
                                    <span class="text-muted"> | {{ $feedback->created_at->diffForHumans() }}</span>
                                </span>
                            </p>

                            <p>{{ $feedback->comment }}</p>

                            @include('layouts.ratings', ['ratings' => $feedback->rating])

                            @unless($loop->last)
                                <div class="sep"></div>
                            @endunless
                        @empty
                            <div class="space20"></div>
                            <p class="lead text-center text-muted">@lang('theme.no_reviews')</p>
                        @endforelse
                    </div> <!-- /.tab-pane -->
                </div> <!-- /.tab-content -->
            </div> <!-- /.nav-tabs-custom -->
        </div><!-- /.modal-body -->
    </div><!-- /.modal-content -->
</div><!-- /#shopReviewsModal -->