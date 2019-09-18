@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#benefits" aria-controls="benefits" role="tab" data-toggle="tab">{{ trans('theme.benefits') }}</a></li>
                <li role="presentation"><a href="#howItWorks" aria-controls="howItWorks" role="tab" data-toggle="tab">{{ trans('theme.how_it_works') }}</a></li>
                <li role="presentation"><a href="#pricing" aria-controls="pricing" role="tab" data-toggle="tab">{{ trans('theme.pricing') }}</a></li>
                <li role="presentation"><a href="#faqs" aria-controls="faqs" role="tab" data-toggle="tab">{{ trans('theme.faq') }}</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="benefits">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">{{ trans('theme.benefits') }}</h2>
                            <h3 class="section-subheading text-muted">{{ trans('messages.merchant_benefits') }}</h3>
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-{{ trans('theme.benefit.one.icon') }} fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="service-heading">{{ trans('theme.benefit.one.title') }}</h4>
                            <p class="text-muted">{{ trans('theme.benefit.one.detail') }}</p>
                        </div>
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-{{ trans('theme.benefit.two.icon') }} fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="service-heading">{{ trans('theme.benefit.two.title') }}</h4>
                            <p class="text-muted">{{ trans('theme.benefit.two.detail') }}</p>
                        </div>
                        <div class="col-md-4">
                            <span class="fa-stack fa-4x">
                                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                <i class="fa fa-{{ trans('theme.benefit.three.icon') }} fa-stack-1x fa-inverse"></i>
                            </span>
                            <h4 class="service-heading">{{ trans('theme.benefit.three.title') }}</h4>
                            <p class="text-muted">{{ trans('theme.benefit.three.detail') }}</p>
                        </div>
                    </div>
				</div>
                <!--  .tabpanel -->

                <div role="tabpanel" class="tab-pane" id="howItWorks">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">{{ trans('theme.how_it_works') }}</h2>
                            <h3 class="section-subheading text-muted">{{ trans('messages.how_the_marketplace_works') }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-image">
                                        <img class="img-circle img-responsive" src="{{ selling_theme_asset_url('img/step_1.png') }}" alt="">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4>&nbsp;</h4>
                                            <h4 class="subheading">{{ trans('theme.how_it_work_steps.step_1.title') }}</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p class="text-muted">{!! trans('theme.how_it_work_steps.step_1.detail') !!}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-image">
                                        <img class="img-circle img-responsive" src="{{ selling_theme_asset_url('img/step_2.png') }}" alt="">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4>&nbsp;</h4>
                                            <h4 class="subheading">{{ trans('theme.how_it_work_steps.step_2.title') }}</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p class="text-muted">{!! trans('theme.how_it_work_steps.step_2.detail') !!}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-image">
                                        <img class="img-circle img-responsive" src="{{ selling_theme_asset_url('img/step_3.png') }}" alt="">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4>&nbsp;</h4>
                                            <h4 class="subheading">{{ trans('theme.how_it_work_steps.step_3.title') }}</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p class="text-muted">{!! trans('theme.how_it_work_steps.step_3.detail') !!}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-image">
                                        <img class="img-circle img-responsive" src="{{ selling_theme_asset_url('img/step_4.png') }}" alt="">
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4>&nbsp;</h4>
                                            <h4 class="subheading">{{ trans('theme.how_it_work_steps.step_4.title') }}</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p class="text-muted">{!! trans('theme.how_it_work_steps.step_4.detail') !!}</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="timeline-inverted">
                                    <div class="timeline-image">
                                        <h4>{!! trans('theme.how_it_work_steps.ending') !!}</h4>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--  .tabpanel -->

                <div role="tabpanel" class="tab-pane" id="pricing">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">{{ trans('theme.pricing') }}</h2>
                            <h3 class="section-subheading text-muted">{{ trans('messages.choose_subscription') }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class='pricing pricing-palden'>
                            @foreach($subscription_plans as $plan)
                                <div class='pricing-item {{ $plan->featured ? "pricing__item--featured" : ""}}'>
                                  <div class='pricing-deco'>
                                    <svg class='pricing-deco-img' enable-background='new 0 0 300 100' height='100px' id='Layer_1' preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px' x='0px' xml:space='preserve' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns='http://www.w3.org/2000/svg' y='0px'>
                                      <path class='deco-layer deco-layer--1' d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;   c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z' fill='#FFFFFF' opacity='0.6'></path>
                                      <path class='deco-layer deco-layer--2' d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;  c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z' fill='#FFFFFF' opacity='0.6'></path>
                                      <path class='deco-layer deco-layer--3' d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;  H42.401L43.415,98.342z' fill='#FFFFFF' opacity='0.7'></path>
                                      <path class='deco-layer deco-layer--4' d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;   c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z' fill='#FFFFFF'></path>
                                    </svg>

                                    <div class='pricing-price'><span class='pricing-currency'>
                                        {{ config('system_settings.currency.symbol') }}</span>{{ get_formated_decimal($plan->cost) }}<span class='pricing-period'>{{ __('theme.per_month') }}</span>
                                    </div>
                                    <h3 class='pricing-title'>{{ $plan->name }}</h3>
                                  </div>

                                  @if($plan->best_for)
                                    <p class='pricing-for'>{{ $plan->best_for }}</p>
                                  @endif

                                  <ul class='pricing-feature-list'>
                                    <li class='pricing-feature'>{{ __('theme.plan.team_size', ['size' => $plan->team_size]) }}</li>
                                    <li class='pricing-feature'>{{ __('theme.plan.inventory_limit', ['limit' => $plan->inventory_limit]) }}</li>

                                    @if($plan->transaction_fee > 0 && $plan->marketplace_commission > 0)
                                        <li class='pricing-feature'>{{ __('theme.plan.transaction_and_commission', ['commission' => $plan->marketplace_commission, 'fee' => get_formated_currency($plan->transaction_fee)]) }}</li>
                                    @else
                                        @if($plan->transaction_fee > 0)
                                            <li class='pricing-feature'>{{ __('theme.plan.transaction_fee', ['fee' => get_formated_currency($plan->transaction_fee)]) }}</li>
                                        @else
                                            <li class='pricing-feature'>{{ __('theme.plan.no_transaction_fee') }}</li>
                                        @endif

                                        @if($plan->marketplace_commission > 0)
                                            <li class='pricing-feature'>{{ __('theme.plan.marketplace_commission', ['commission' => $plan->marketplace_commission]) }}</li>
                                        @else
                                            <li class='pricing-feature'>{{ __('theme.plan.no_marketplace_commission') }}</li>
                                        @endif
                                    @endif
                                  </ul>
                                  <a href="{{ route('register', $plan) }}" class='pricing-action'>{{ __('theme.button.choose_plan') }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--  .tabpanel -->

                <div role="tabpanel" class="tab-pane" id="faqs">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2 class="section-heading">{{ trans('theme.faq') }}</h2>
                            <h3 class="section-subheading text-muted">{{ trans('messages.faqs') }}</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="panel-group" id="accordion">
                            @foreach($faqTopics as $topic)
                                <div class="faqHeader">{{ $topic->name }}</div>
                                <div class="panel panel-default">
                                    @foreach($topic->faqs as $faq)
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#faq-{{ $faq->id }}">{!! $faq->question !!}</a>
                                            </h4>
                                        </div>
                                        <div id="faq-{{ $faq->id }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                {!! $faq->answer !!}
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                                @unless($loop->last)
                                    <br/>
                                @endunless
                            @endforeach
                        </div>
                    </div>
                </div>
                <!--  .tabpanel -->
            </div>
        </div>
    </div>
@endsection
