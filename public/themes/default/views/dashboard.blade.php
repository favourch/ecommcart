@extends('layouts.main')

@section('content')
    <!-- HEADER SECTION -->
    @include('headers.account_page')

    <div class="container">
        @if(! Auth::guard('customer')->user()->isVerified())
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong><i class="icon fa fa-info-circle"></i> {{ trans('theme.notice') }}</strong>
                {{ trans('messages.email_verification_notice') }}
                <a href="{{ route('customer.verify') }}"> {{ trans('auth.resend_varification_link') }}</a>
            </div>
        @endif
    </div>

    <!-- CONTENT SECTION -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-2 nopadding">
                    @include('nav.account_page_sidebar')
                </div><!-- /.col-md-2 -->

                <div class="col-md-10 nopadding-right">
                    @include('contents.' . $tab)
                </div><!-- /.col-md-10 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section>

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')
@endsection