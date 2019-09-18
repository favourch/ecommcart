<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, shrink-to-fit=no">
        <title> {{ get_platform_title() }} </title>
        <link rel="icon" href="{{ Storage::url('icon.png') }}" type="image/x-icon" />
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <link rel="apple-touch-icon" href="{{ Storage::url('icon.png') }}">

        <!-- Theme CSS -->
        <link href="{{ selling_theme_asset_url('css/vendor.css') }}" rel="stylesheet">
        <link href="{{ selling_theme_asset_url('css/agency.css') }}" rel="stylesheet">
        <link href="{{ selling_theme_asset_url('css/style.css') }}" rel="stylesheet">

        <!-- Ionicons -->
        {{-- <link href="https://unpkg.com/ionicons@4.4.4/dist/css/ionicons.min.css" rel="stylesheet"> --}}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    </head>

    <body id="page-top" class="index">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Navigation -->
        @include('nav.mainnav')

        <!-- Header -->
        <header>
            <div class="container">
                <div class="intro-text">
                    <div class="intro-lead-in">{{ __('theme.intro_lead') }}</div>
                    <div class="intro-heading">{{ __('theme.intro_heading') }}</div>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg selling">{{ __('theme.button.selling') }}</a>
                    <p class="sellin-price-tagline">{{ __('theme.selling_price_taglind', ['price' => get_formated_currency($subscription_plans->min('cost'))]) }}</p>
                </div>
            </div>
        </header>

        <!-- Services Section -->
        <section id="services">
            @yield('content')
        </section>


        <!-- Contact Section -->
        <section id="contact">
            @include('contact')
        </section>

        <footer class="page-footer font-small indigo pt-0">
            <div class="container">
                <ul class="quicklinks navbar nav-justified text-center">
                    <li><a href="{{ route('page.open', \App\Page::PAGE_ABOUT_US) }}" target="_blank">{{ trans('theme.nav.about_us') }}</a></li>
                    <li><a href="{{ route('page.open', \App\Page::PAGE_PRIVACY_POLICY) }}" target="_blank">{{ trans('theme.nav.privacy_policy') }}</a></li>
                    <li><a href="{{ route('page.open', \App\Page::PAGE_TNC_FOR_MERCHANT) }}" target="_blank">{{ trans('theme.nav.term_and_conditions') }}</a></li>
                    <li><a href="{{ route('page.open', \App\Page::PAGE_RETURN_AND_REFUND) }}" target="_blank">{{ trans('theme.nav.return_and_refund_policy') }}</a></li>
                </ul>

                <div class="row">
                    <div class="col-md-4">
                        <span class="copyright">{{ get_platform_title() }}</span>
                    </div>
                    <div class="col-md-4 text-center">
                        <span class="copyright">
                            © {{ date('Y') }} <a href="{{ url('/') }}">{{ get_platform_title() }}</a>
                        </span>
                    </div>
                    <div class="col-md-4 ">
                        @if($social_media_links = get_social_media_links())
                            <ul class="list-inline social-buttons pull-right">
                                @foreach($social_media_links as $social_media => $link)
                                    <li><a href="{{$link}}" target="_blank"><i class="fa fa-{{$social_media}}"></i></a></li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </footer> <!--/Footer-->

        <!-- Portfolio Modals -->
        <!-- Use the modals below to showcase details about your portfolio projects! -->

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        <!-- Contact Form JavaScript -->
        {{-- <script src="js/jqBootstrapValidation.js"></script> --}}
        {{-- <script src="js/contact_me.js"></script> --}}

        <!-- Theme JavaScript -->
        <script src="{{ selling_theme_asset_url('js/jqBootstrapValidation.min.js') }}"></script>
        <script src="{{ selling_theme_asset_url('js/app.js') }}"></script>
    </body>
</html>
